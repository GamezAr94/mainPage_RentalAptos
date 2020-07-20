<?php

include 'dbh.inc.php';
    if(isset($_POST['send-request'])){
        $userName = $_POST['userName'];
        $contractId = $_POST['contractId'];
        $request = $_POST['request'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        echo $userName." ".$contractId." ".$request." ".$subject." ".$message;
        if(empty($subject) || empty($message)){
            //Agregar un error provider de que no se permiten campos vacios
            //header("Location: ../index.php?error=emptyfields");
            exit();
        }else{
            $sql = "INSERT INTO request (request_date, request_type, request_subject, request_message, ro_us_fk)
            VALUES (CURRENT_DATE(),?,?,?,?);";
            
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo $conn;
                echo $stmt;
                //header("Location: ../index.php?error=sqlerrorBro");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "sssi", $request, $subject, $message, $contractId);

                //ejecutar el statement
                mysqli_stmt_execute($stmt);
            }
        }
    }else{
        header("Location: ../blas.php");
    }
?>