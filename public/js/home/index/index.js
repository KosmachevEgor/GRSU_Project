const block1 = document.getElementById('block1')
const block2 = document.getElementById('block2')
const block3 = document.getElementById('block3')
const body = document.body

block2.style.opacity = 0
block3.style.cssText += `opacity: 0; align-items: normal; flex-direction: column;`

window.addEventListener('scroll', function () {
    let opacityValue = 1 - window.scrollY / 900
    let gradientScore = window.scrollY / window.outerWidth
    console.log(gradientScore)
    block1.style.opacity = opacityValue > 0 ? opacityValue : 0
    block2.style.opacity = opacityValue < 1 ? 1 - opacityValue : 1
    block3.style.opacity = opacityValue < 1 ? Math.abs(opacityValue) : 0
    body.style.backgroundColor = `rgb(${255 - gradientScore * 255},${255 - gradientScore * 255},${255 - gradientScore * 255})`
})
