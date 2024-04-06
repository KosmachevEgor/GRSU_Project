import * as THREE from 'three'
import { GLTFLoader } from "three/addons/loaders/GLTFLoader.js"
import { OrbitControls } from 'three/addons/controls/OrbitControls.js'
import * as TWEEN from '@tweenjs/tween.js'
import { CSS2DRenderer, CSS2DObject } from 'three/addons/renderers/CSS2DRenderer.js'

const modelPath = document.getElementById('spine-model-path').value
const modelName = document.getElementById('spine-model-title').value
document.body.style.overflow = 'hidden'

const scene = new THREE.Scene()

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000)

const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('main-canvas') })

//CSSrenderer
const CSSrenderer = new CSS2DRenderer()
CSSrenderer.setSize(window.innerWidth, window.innerHeight)
CSSrenderer.domElement.style.position = 'absolute'
CSSrenderer.domElement.style.top = 0
CSSrenderer.domElement.style.pointerEvents = 'none'
main.appendChild(CSSrenderer.domElement)

const controls = new OrbitControls(camera, renderer.domElement)

controls.target = new THREE.Vector3(0, 0, 0)
controls.update()

const loader = new GLTFLoader()

const canvas = document.getElementById('main-canvas')

scene.background = new THREE.Color("hsl(208, 18%, 39%)")

camera.position.set(1.25, 0.8, 1.75)

//Lights
const lightPositions = [{ x: 5, y: 5, z: 5 }, { x: -5, y: 5, z: 5 }, { x: 5, y: 5, z: -5 }, { x: 5, y: -5, z: -5 }]
const directionalLights = lightPositions.map(pos => {
    const dLight = new THREE.DirectionalLight(0xffffff)
    dLight.position.set(pos.x, pos.y, pos.z)
    scene.add(dLight)
    return dLight
})

//Model Loader
let model = null
loader.load(modelPath, function (gltf) {
    const obj = gltf.scene
    model = obj
    handleModelAttributes(model)
    scene.add(obj)
})

function handleModelAttributes(model) {
    if (modelName === 'Межпозвонковый диск') {
        let i = 1
        model.children.forEach(item => {
            if (item.name !== "Shell") {
                item.renderOrder = i
                i++
            }
        })
    } else if (modelName === 'Лакуна') {
        model.children.forEach(item => {
            if (item.name === 'Body')
                item.renderOrder = 1
            if (item.name === 'Chondrocyte') {
                item.material.depthWrite = true
                item.material.side = THREE.DoubleSide
            }
        })
    } else if (modelName === 'Хондроцит') {
        model.children.forEach(item => {
            if (item.name === "PlasmaMembrana") {
                item.renderOrder = 5
            }
        })
    }
}


let timeout
let clickHandled = false
let lastClickedObject = null
let modelLabel = null

async function handleMouseUp(event) {
    clearTimeout(timeout)
    if (!clickHandled) {
        const rect = canvas.getBoundingClientRect()
        const width = rect.width
        const height = rect.height

        const xNormalized = (event.clientX - rect.left) / width * 2 - 1
        const yNormalized = -(event.clientY - rect.top) / height * 2 + 1

        const mouseVector = new THREE.Vector3(xNormalized, yNormalized, 0.5).unproject(camera)

        const raycaster = new THREE.Raycaster(camera.position, mouseVector.sub(camera.position).normalize())

        const objectsToCheck = scene.children.filter(child =>
            !(child instanceof THREE.Light) && !(child instanceof THREE.Line))

        const intersects = raycaster.intersectObjects(objectsToCheck)

        const objects = (objectsToCheck.length > 0) ? objectsToCheck[0].children : []

        objects.forEach(item => {
            if (item.initialY === undefined) {
                item.initialY = item.position.y
            }
        })

        if (intersects.length > 0) {
            const firstIntersect = intersects[0].object

            const tweens = objects.map(item => {
                const tween = new TWEEN.Tween(item.position)
                    .to({ y: item.initialY }, (lastClickedObject !== firstIntersect) ? 1000 : 1000)
                    .easing(TWEEN.Easing.Cubic.InOut)

                if (lastClickedObject !== firstIntersect) {
                    tween.onComplete(() => {
                        if (item !== firstIntersect) {
                            const offsetY = item.position.y > firstIntersect.position.y ? 0.5 : -0.5
                            new TWEEN.Tween(item.position)
                                .to({ y: item.position.y + offsetY }, 1000)
                                .easing(TWEEN.Easing.Cubic.InOut)
                                .start()
                        }
                    })
                }
                return tween
            })

            await Promise.all(tweens.map(tween => tween.start()))

            if (lastClickedObject !== firstIntersect) {
                try {
                    const data = await getCachedData('http://localhost:8000/api/parts/' + firstIntersect.name);
                    createLabel(data[0].title, data[0].description, firstIntersect);
                    lastClickedObject = firstIntersect;
                } catch (error) {
                    console.error("Error: ", error);
                }
            } else {
                scene.remove(modelLabel);
                lastClickedObject = null;
            }
        }
    }
    clickHandled = false
}

function createLabel(title, description, object) {

    scene.remove(modelLabel)

    const boundingBox = new THREE.Box3().setFromObject(object.parent)
    const max = boundingBox.max

    const wrapperDiv = document.createElement('div')
    wrapperDiv.className = 'label-wrapper'
    wrapperDiv.style.cssText = `
        color: white;
        background-color: transperent;
        width: 25%;
        padding: 1%;
        border: solid 4px white;
        border-radius: 15px;
    `

    const modelDiv = document.createElement('div')
    modelDiv.className = 'label'
    modelDiv.textContent = title

    const modelDescriptionDiv = document.createElement('div')
    modelDescriptionDiv.className = 'label'
    modelDescriptionDiv.textContent = description

    wrapperDiv.appendChild(modelDiv)
    wrapperDiv.appendChild(modelDescriptionDiv)

    modelLabel = new CSS2DObject(wrapperDiv)
    modelLabel.position.set(max.x, object.initialY, object.position.z)
    modelLabel.center.set(0, 0)
    scene.add(modelLabel)
}
//Control Panel
const AutoRotateBtn = document.getElementById('btn-autoRotate-cam')
const ControlCamBtn = document.getElementById('btn-control-cam')
const ColorPickerBtn = document.getElementById('color-picker')

let RotateFlag = false;
let ControlFlag = true;

AutoRotateBtn.addEventListener('click', () => {
    if (!RotateFlag) {
        controls.autoRotate = true
        RotateFlag = true
    } else {
        controls.autoRotate = false;
        RotateFlag = false;
    }
})

ControlCamBtn.addEventListener('click', () => {
    if (!ControlFlag) {
        controls.enabled = true
        ControlFlag = true
    } else {
        controls.enabled = false;
        ControlFlag = false;
    }
})

ColorPickerBtn.addEventListener('input', () => {
    scene.background = new THREE.Color(ColorPickerBtn.value)
})

const PartsNavigation = document.getElementById('nav-parts');

const cache = {}; // объект для кэширования данных

async function getCachedData(url) {
    if (cache[url]) {
        return cache[url]; // если данные уже есть в кэше, возвращаем их
    } else {
        const response = await fetch(url); // делаем запрос к серверу
        const data = await response.json();
        cache[url] = data; // сохраняем полученные данные в кэше
        return data;
    }
}

async function partsChange() {
    const selectedPart = PartsNavigation.options[PartsNavigation.selectedIndex].value

    const objectsToCheck = scene.children.filter(child =>
        !(child instanceof THREE.Light) && !(child instanceof THREE.Line))

    const objects = (objectsToCheck.length > 0) ? objectsToCheck[0].children : []

    let myObject;

    objects.forEach(item => {
        if (item.initialY === undefined) {
            item.initialY = item.position.y
        }
        if (item.name == selectedPart) {
            myObject = item
        }
        if (selectedPart == 'D' && item.name == 'D3') {
            myObject = item
        }
        if (selectedPart == 'H20' && item.name == 'H2O_1') {
            myObject = item
        }
    })

    const tweens = objects.map(item => {
        const tween = new TWEEN.Tween(item.position)
            .to({ y: item.initialY }, (lastClickedObject !== myObject) ? 1000 : 1000)
            .easing(TWEEN.Easing.Cubic.InOut)

        if (lastClickedObject !== myObject) {
            tween.onComplete(() => {
                if (item !== myObject) {
                    const offsetY = item.position.y > myObject.position.y ? 0.5 : -0.5
                    new TWEEN.Tween(item.position)
                        .to({ y: item.position.y + offsetY }, 1000)
                        .easing(TWEEN.Easing.Cubic.InOut)
                        .start()
                }
            })
        }
        return tween
    })

    await Promise.all(tweens.map(tween => tween.start()))

    if (lastClickedObject !== myObject) {
        try {
            const data = await getCachedData('http://localhost:8000/api/parts/' + myObject.name);
            createLabel(data[0].title, data[0].description, myObject);
            lastClickedObject = myObject;
        } catch (error) {
            console.error("Error: ", error);
        }
    } else {
        scene.remove(modelLabel);
        lastClickedObject = null;
    }
}

PartsNavigation.addEventListener('change', partsChange)

canvas.addEventListener('mouseup', handleMouseUp)

function resizeCanvasToDisplaySize() {
    const canvas = renderer.domElement
    const width = canvas.clientWidth
    const height = canvas.clientHeight

    renderer.setSize(width, height, false)
    CSSrenderer.setSize(width, height, false)

    camera.aspect = width / height
    camera.updateProjectionMatrix()
}

function animate(time) {
    requestAnimationFrame(animate)
    resizeCanvasToDisplaySize()

    controls.update()
    TWEEN.update(time)

    renderer.render(scene, camera)
    CSSrenderer.render(scene, camera)
}

animate()
