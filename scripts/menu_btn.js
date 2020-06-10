/*
    funcion para que el menu cambie de clase y se muestr o se oculte cada que sea clickeado
*/
const btn = document.getElementById('menu-hamburger');
const menu = document.getElementById('menu');
function onClickMenu(){
    btn.classList.toggle("burger-close");
    btn.classList.toggle("burger");

    menu.classList.toggle("show");
    menu.classList.toggle("hide");
}