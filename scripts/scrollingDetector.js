var header = document.querySelector("header");
var burguerMenu = document.querySelector("#menu-hamburger");
var centralize = document.querySelector("header .centralize");
/*header.addEventListener("scroll", headerSchrink);
function headerSchrink(){
    console.log("HOLA");
    if(window.pageYOffset > 150){
        header.style.height = "50px";
        centralize.style.width = "97%";
    }else{
        header.style.height = "100px";
        centralize.style.width = "93%";
    }
}*/

window.onscroll = function(){
    console.log(burguerMenu);
    if(window.pageYOffset > 150){
        header.style.height = "50px";
        centralize.style.width = "97%";
        burguerMenu.style.top = "12px";
    }else{
        header.style.height = "100px";
        centralize.style.width = "93%";
        burguerMenu.style.top = "37px";
    }
};