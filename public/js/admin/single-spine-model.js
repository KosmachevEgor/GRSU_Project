import * as THREE from 'three'
import { GLTFLoader } from "three/addons/loaders/GLTFLoader.js"
import { OrbitControls } from 'three/addons/controls/OrbitControls.js'
import * as TWEEN from '@tweenjs/tween.js'


const modelPath = document.getElementById('spine-model-path').value
const parentDiv = document.getElementById('parent-div');

const scene = new THREE.Scene()
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000)
const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('main-canvas') })
const controls = new OrbitControls(camera, renderer.domElement)
const loader = new GLTFLoader();

const dLight1 = new THREE.DirectionalLight(0xffffff)
const dLight2 = new THREE.DirectionalLight(0xffffff)
const dLight3 = new THREE.DirectionalLight(0xffffff)

scene.background = new THREE.Color("hsl(208, 18%, 39%)")
camera.position.set(0.6, 0.27, 1)
dLight1.position.set(0, 5, 5)
scene.add(dLight1)
dLight2.position.set(0, 5, -5)
scene.add(dLight2)
dLight2.position.set(5, 0, 5)
scene.add(dLight3)

controls.target = new THREE.Vector3(0, 0, 0)
controls.autoRotate = true
controls.update()

loader.load(modelPath, function (gltf){
    const obj = gltf.scene
    scene.add(obj)
})

function resizeCanvasToDisplaySize() {
    const canvas = renderer.domElement
    const width = canvas.clientWidth
    const height = canvas.clientHeight

    renderer.setSize(width, height, false)
    camera.aspect = width / height
    camera.updateProjectionMatrix()
}
function animate(time) {
    requestAnimationFrame(animate)
    resizeCanvasToDisplaySize()
    controls.update()
    TWEEN.update(time);
    renderer.render(scene, camera)
}

animate()
