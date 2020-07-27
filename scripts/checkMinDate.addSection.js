
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
    var month = (new Date().getMonth()+1) < 10 ? "0"+(new Date().getMonth()+1):(new Date().getMonth()+1);
    var date = new Date().getFullYear() + "-" + month + "-" + new Date().getDate();
    
    document.getElementById('end').min = date;
