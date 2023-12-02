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


function changeValue(subdimension, content, index, value){
    console.log('changed on subdimension: ' + subdimension + '\ncontent: ' + content + '\nindex: ' + index + '\nvalue: ' + value);

    fetch('handle_input.php?subdimension=' + subdimension + '&content=' + content + '&index=' + index + '&value=' + value);
}