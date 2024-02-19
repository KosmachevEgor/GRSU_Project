window.onload = function(){
    const sidebar = document.querySelector(".sidebar")
    const closeBtn = document.querySelector("#btn")
    const section = document.querySelector(".section")
    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
            section.style['padding-left'] = "260px"

        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
            section.style['padding-left'] = "85px"
        }
    }
}
