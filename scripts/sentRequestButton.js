var requestButton = document.getElementById("sendRequestButton");
var bannerRequest = document.getElementById("requestSent");
var mark = document.getElementById("visible");
var subjectLabel = document.getElementById("subject");
var  send = true;
//bannerRequest.style.transition = "all .3s";

requestButton.onsubmit=function(){
    event.preventDefault();
    if(message.value.length <= 0){
        message.style.border = "1px solid red";
        send = false;
    }else{
        message.style.border = "0px";
    }
    if(subject.value.length <= 0){
        subject.style.border = "1px solid red";
        send = false;
    }else{
        subject.style.border = "0px";
    }
    if(subject.value.length > 0 && message.value.length > 0){
        send = true;
        subject.style.border = "0px";
        message.style.border = "0px";
    }
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
