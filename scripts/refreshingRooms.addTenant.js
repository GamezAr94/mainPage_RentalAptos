
    $(document).ready(function(){
        $("#room").load("includes/load-rooms.inc.php",{ idApto: document.getElementById("aptos").value });
        $("#aptos").change(function(){
            $("#room").load("includes/load-rooms.inc.php",{ idApto: this.value });
        });
    })
