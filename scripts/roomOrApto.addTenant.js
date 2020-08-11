var x = document.getElementsByClassName("hideSelection");
     var rentApto = document.getElementById("rentApto");
     var rentRoom = document.getElementById("rentRoom");
     var roomSelect = document.getElementById("roomSelect");

     //code to make visible the options depending on what they want to rent (apto, room)
    rentApto.addEventListener("click", function(){
        for(var i = 0; i < x.length; i++){
            x[i].style.opacity = 1;
            x[i].style.visibility = "visible";
            x[i].style.display = "inline";
        }
        roomSelect.style.visibility = "hiden";
        roomSelect.style.opacity = 0;
        roomSelect.style.display = "none";
        document.getElementById('room').required = false;
    })
    //code to make visible the options depending on what they want to rent (apto, room)
    rentRoom.addEventListener("click", function(){
        for(var i = 0; i < x.length; i++){
            x[i].style.opacity = 1;
            x[i].style.visibility = "visible";
            x[i].style.display = "inline";
        }
        roomSelect.style.opacity = 1;
        roomSelect.style.visibility = "visible";
        roomSelect.style.display = "inline";
        document.getElementById('room').required = true;
    })
    //code to make automatic the value of damage deposit
    document.getElementById("rent").addEventListener("focusout", function(){
        document.getElementById("damageDeposit").value = Math.floor(this.value/2);
    })