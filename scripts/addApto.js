var saveButton = document.getElementById("addAptoForm");
var bannerRequest = document.getElementById("requestSent");
var mark = document.getElementById("visible");
var  send = true;
//bannerRequest.style.transition = "all .3s";

requestButton.onsubmit=function(){
    event.preventDefault();
    if(send){
        displayBanner();
        setTimeout(function(){
            requestButton.submit()
        },1700);
    }
}
function displayBanner(){
    bannerRequest.style.opacity = 1;
    bannerRequest.style.visibility = "visible";
    mark.style.display = "inline";
}