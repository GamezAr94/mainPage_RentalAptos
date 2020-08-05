
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
/*
    set the min date doesnt work.
    var month = (new Date().getMonth()+1) < 10 ? "0"+(new Date().getMonth()+1):(new Date().getMonth()+1);
    var date = new Date().getFullYear() + "-" + month + "-" + new Date().getDate();
    
    document.getElementById('end').min = date;
*/
//once the user sets the starting contract the end of contract cannot be less than the start date
    $( "#start" ).focusout(function() {
        document.getElementById('end').min = document.getElementById('start').value;
    })

//once the user sets the end contract checks if the contract is greather than the start date, if not it change the start date
  $( "#end" ).focusout(function() {
      if(document.getElementById('start').value >= document.getElementById('end').value){
        document.getElementById('start').value = document.getElementById('end').value;
      }
})
