
var bannerRequest = document.getElementById("requestSent");
var mark = document.getElementById("visible");
$(document).ready(function(){
    displayBanner();
    setTimeout(hideBanner,1700);
})
function displayBanner(){
    bannerRequest.style.opacity = 1;
    bannerRequest.style.visibility = "visible";
    mark.style.display = "inline";
};
function hideBanner(){
    bannerRequest.style.visibility = "hidden";
    mark.style.display = "none";
    bannerRequest.style.opacity = 0;
};
