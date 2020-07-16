
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementsByClassName(el)[0].innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }