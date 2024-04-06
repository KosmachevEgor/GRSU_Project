import * as THREE from 'three'
import { GLTFLoader } from "three/addons/loaders/GLTFLoader.js"
import { OrbitControls } from 'three/addons/controls/OrbitControls.js'
import * as TWEEN from '@tweenjs/tween.js'
import { CSS2DRenderer, CSS2DObject } from 'three/addons/renderers/CSS2DRenderer.js'

let modelPaths = JSON.parse(document.getElementById('spine-models').value).map(element => 'storage/' + element.model_path)
let main = document.getElementById('main')

let loadedModels = []
let objectsToIgnore = []
let modelLabel = null

const scene = new THREE.Scene()

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000)

const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('main-canvas') })

const PartsNavigation = document.getElementById('nav-parts');

const cache = {}; // объект для кэширования данных

const CSSrenderer = new CSS2DRenderer()
CSSrenderer.setSize(window.innerWidth, window.innerHeight)
CSSrenderer.domElement.style.position = 'absolute'
CSSrenderer.domElement.style.top = 0
CSSrenderer.domElement.style.pointerEvents = 'none'
main.appendChild(CSSrenderer.domElement)

const controls = new OrbitControls(camera, renderer.domElement)

const loader = new GLTFLoader()

const canvas = document.getElementById('main-canvas')

const dLight1 = new THREE.DirectionalLight(0xffffff)
const dLight2 = new THREE.DirectionalLight(0xffffff)
const dLight3 = new THREE.DirectionalLight(0xffffff)
const dLight4 = new THREE.DirectionalLight(0xffffff)

scene.background = new THREE.Color("hsl(208, 18%, 39%)")
camera.position.set(1.25, 0.8, 1.75)

dLight1.position.set(5, 5, 5)
scene.add(dLight1)
dLight2.position.set(-5, 5, 5)
scene.add(dLight2)
dLight3.position.set(5, 5, -5)
scene.add(dLight3)
dLight4.position.set(5, -5, -5)
scene.add(dLight4)

controls.target = new THREE.Vector3(0, 0, 0)
controls.update()


//Load Models
function loadModel(path, index) {
    return new Promise((resolve, reject) => {
        loader.load(path, function (gltf) {
            const model = gltf.scene
            if (index !== 0) {
                model.visible = false
                objectsToIgnore.push(model)

                if (index === 1) {
                    let i = 1
                    model.children.forEach(item => {
                        if (item.name != "Shell") {
                            item.renderOrder = i
                            i++
                        }
                    })
                }
                if (index === 2) {
                    model.children.forEach(item => {
                        if (item.name == 'Body')
                            item.renderOrder = 1
                        if (item.name == 'Chondrocyte') {
                            item.material.depthWrite = true
                            item.material.side = 2
                        }
                    })
                }
                if (index === 3) {
                    model.children.forEach(item => {
                        if (item.name == "PlasmaMembrana") {
                            item.renderOrder = 5
                        }
                    })
                }
            } else {
                model.children.forEach(async item => {
                    item.material.transparent = true
                    item.material.opacity = 0
                    new TWEEN.Tween(item.material)
                        .to({ opacity: 1 }, 500)
                        .start()
                })
                selectTagConfigure(model)
                culcCenterModel(model)
            }

            loadedModels.push(model)
            scene.add(model)
            resolve()
        }, undefined, reject)
    })
}
function loadModelsSequentially(modelPaths) {
    return modelPaths.reduce((promiseChain, path, index) => {
        return promiseChain.then(() => {
            return loadModel(path, index)
        })
    }, Promise.resolve())
}

loadModelsSequentially(modelPaths)
    .then(() => {
        console.log('Все модели успешно загружены!')
    })
    .catch((error) => {
        console.error('Произошла ошибка загрузки моделей:', error)
    })


let timeout
let time
let clickHandled = false
let lastClickedObject = null

function handleMouseDown(event) {
    timeout = setTimeout(function () {
        if (event.which == 2) {
            const rect = canvas.getBoundingClientRect()
            const width = rect.width
            const height = rect.height

            const x = ((event.clientX - rect.left) / width) * 2 - 1
            const y = -((event.clientY - rect.top) / height) * 2 + 1
            const mouseVector = new THREE.Vector3(x, y, 0.5).unproject(camera)

            const raycaster = new THREE.Raycaster(camera.position, mouseVector.sub(camera.position).normalize())

            const objectsToCheck = scene.children.filter(child =>
                !(child instanceof THREE.Light || child instanceof THREE.Line || objectsToIgnore.includes(child)))

            const intersects = raycaster.intersectObjects(objectsToCheck)


            if (intersects.length > 0) {
                const firstIntersect = intersects[0].object

                const currentModel = loadedModels.find(model => model.children.includes(firstIntersect))
                if (currentModel) {
                    const currentModelId = loadedModels.indexOf(currentModel)
                    if (currentModelId < loadedModels.length - 1) {
                        scene.remove(modelLabel)
                        const nextModel = loadedModels[currentModelId + 1]
                        currentModel.children.forEach(item => {
                            new TWEEN.Tween(item.material)
                                .to({ opacity: 0 }, 2000)
                                .onComplete(() => {
                                    culcCenterModel(nextModel)
                                    nextModel.visible = true
                                    nextModel.children.forEach(item => {
                                        item.material.transparent = true
                                        item.material.opacity = 0
                                        new TWEEN.Tween(item.material)
                                            .to({ opacity: (item.name == 'PlasmaMembrana' ? 0.5 : 1) }, 500)
                                            .onComplete(() => {
                                                scene.remove(currentModel)
                                            })
                                            .start()
                                    })
                                })
                                .start()
                        })
                        selectTagConfigure(nextModel)
                    }
                }
                objectsToIgnore.shift()
            }
            clickHandled = true
        }
    }, 2000)
}

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
            !(child instanceof THREE.Light) && !(child instanceof THREE.Line) && !objectsToIgnore.includes(child))

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

            Promise.all(tweens.map(tween => tween.start()))

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

canvas.addEventListener('mousedown', handleMouseDown)
canvas.addEventListener('mouseup', handleMouseUp)
PartsNavigation.addEventListener('change', partsChange)

function createLabel(title, description, object) {

    scene.remove(modelLabel)

    const boundingBox = new THREE.Box3().setFromObject(object.parent)
    const max = boundingBox.max

    const wrapperDiv = document.createElement('div')
    wrapperDiv.className = 'label-wrapper'
    wrapperDiv.style.color = 'white'
    wrapperDiv.style.backgroundColor = 'transparent'
    wrapperDiv.style.width = '25%'
    wrapperDiv.style.padding = '1%'
    wrapperDiv.style.border = 'solid 4px white'
    wrapperDiv.style.borderRadius = '15px'

    const modelDiv = document.createElement('div')
    modelDiv.className = 'label'
    modelDiv.textContent = title

    const modelDescriptionDiv = document.createElement('div')
    modelDescriptionDiv.className = 'label'
    modelDescriptionDiv.textContent = description

    wrapperDiv.appendChild(modelDiv)
    wrapperDiv.appendChild(modelDescriptionDiv)

    modelLabel = new CSS2DObject(wrapperDiv)
    modelLabel.position.set(max.x + 0.2, object.initialY, object.position.z)
    modelLabel.center.set(0, 0)
    scene.add(modelLabel)
}

function culcCenterModel(model) {
    const boundingBox = new THREE.Box3().setFromObject(model)

    const center = new THREE.Vector3()
    boundingBox.getCenter(center)

    controls.target = new THREE.Vector3(center.x, center.y, center.z)
    controls.update()
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

function selectTagConfigure(model) {
    const existingValues = {};
    PartsNavigation.innerHTML = ''
    model.children.forEach(async item => {
        try {
            const data = await getCachedData('http://localhost:8000/api/parts/' + item.name);
            if (!existingValues[data[0].title]) {
                let option = document.createElement('option');
                option.value = data[0].part_name
                option.innerHTML = data[0].title
                PartsNavigation.appendChild(option)
                existingValues[data[0].title] = true;
            }
        } catch (error) {
            console.error("Error: ", error);
        }
    })
}

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
