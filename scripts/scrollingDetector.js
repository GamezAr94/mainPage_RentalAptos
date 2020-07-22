var header = document.querySelector("header");
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
    console.log(window.pageYOffset);
    if(window.pageYOffset > 150){
        header.style.height = "50px";
        centralize.style.width = "97%";
    }else{
        header.style.height = "100px";
        centralize.style.width = "93%";
    }
};