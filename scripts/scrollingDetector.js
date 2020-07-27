var header = document.querySelector("header");
var burguerMenu = document.querySelector("#menu-hamburger");
var centralize = document.querySelector("header .centralize");

window.onscroll = function(){
    if(window.pageYOffset > 100){
        header.style.height = "50px";
        centralize.style.width = "97%";
        burguerMenu.style.top = "12px";
    }else{
        header.style.height = "100px";
        centralize.style.width = "93%";
        burguerMenu.style.top = "37px";
    }
};