<?php

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbName = "rental_aptos";

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbName);
    if(!$conn){
        die("Connection failes: ".mysqli_connect_error());
    }
?>