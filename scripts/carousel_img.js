const slides = document.getElementsByClassName('fade');

window.addEventListener("load", function(){
    if(slides.length > 0){
        for(let i = 0; i < slides.length; i++){
            slides[i].style.display = "none";
        }
        slides[slides.length-1].style.display = "block";
    }
});

let current = slides.length -1;
function plusSlides(){
    if(slides.length > 1){
        if(current > 0){
            slides[current].style.display = "none";
            current--;
            slides[current].style.display = "block";
        }else if(current == 0){
            slides[current].style.display = "none";
            current=slides.length -1;
            slides[current].style.display = "block";
        }
    }
}
function minusSlides(){
    if(slides.length > 1){
        if(current == slides.length-1){
            slides[current].style.display = "none";
            current=0;
            slides[current].style.display = "block";
        }else if(current < slides.length-1){
            slides[current].style.display = "none";
            current++;
            slides[current].style.display = "block";
        }
    }
}