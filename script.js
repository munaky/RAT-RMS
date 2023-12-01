let sidebarhidden = false

function hidesidebar(){
    const navbar = document.getElementById("navbar")
    const table = document.querySelector("table")
    const button = document.getElementById("navbartoggle")
    if (sidebarhidden) {
        navbar.style.left = "0px";
        table.style.marginLeft = "2rem"
        button.style.right = "-10px"
        button.innerHTML = "<"
    } else {
        const navbarwidth = navbar.offsetWidth
        navbar.style.left = "-" + navbarwidth + "px";
        
        table.style.marginLeft = "-10rem"
        button.style.right = "-20px"
        button.innerHTML = ">"
    }
    sidebarhidden = !sidebarhidden
}
  