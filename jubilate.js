function Menu() {
    let menu = document.getElementById("menuMobile");
   
  
    if (menu.className == "menuMobile abierto") {
      menu.setAttribute("class", "menuMobile");
    } else {
      menu.setAttribute("class", "menuMobile abierto");
    }
}  