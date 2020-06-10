/*
    funcion para que el menu cambie de clase y se muestr o se oculte cada que sea clickeado
*/
const btn = document.getElementById('menu-hamburger');
const menu = document.getElementById('menu');
const login = document.getElementById('form-login');
const navMenu = document.getElementById('nav');
function onClickMenu(){
    btn.classList.toggle("burger-close");
    btn.classList.toggle("burger");

    menu.classList.toggle("hide");

    navMenu.style.display = "block";

    login.className = 'hiden';
}
function onClickLogin(){
    login.classList.toggle('hiden');
    navMenu.style.display = "none";
}