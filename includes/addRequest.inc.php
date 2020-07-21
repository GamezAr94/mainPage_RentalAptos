<?php

include 'dbh.inc.php';
    //if(isset($_POST['send-request'])){
        $userName = $_POST['userName'];
        $contractId = $_POST['contractId'];
        $request = $_POST['request'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        echo $userName." ".$contractId." ".$request." ".$subject." ".$message;
        if(empty($subject) || empty($message) || empty($request) || empty($contractId) || empty($userName)){
            //Agregar un error provider de que no se permiten campos vacios
            header("Location: ../request.php?error=emptyfields");
            exit();
        }else{
            $spam = countSpam($conn);
            if($spam >= 4){
                header("Location: ../request.php?errorSpam=limit-of-requests-today-".$spam);
                exit();
            }else{
                $sql = "INSERT INTO request (request_date, request_type, request_subject, request_message, ro_us_fk)
                VALUES (NOW(),?,?,?,?);";
                
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo $conn;
                    echo $stmt;
                    echo "please contact support services. Sorry for the inconvenients.";
                    //header("Location: ../index.php?error=sqlerrorBro");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "sssi", $request, $subject, $message, $contractId);
                    header("Location: ../request.php?successful=request-sent");
                    //ejecutar el statement
                    mysqli_stmt_execute($stmt);
                }
            }
        }
    //}else{
        //header("Location: ../blas.php");
    //}


    function countSpam($conn){
        $sqlSpam = "SELECT COUNT(`request_date`) as Spam
        FROM `request` 
        WHERE request_date = CURRENT_DATE();";
            
            $stmtSpam = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmtSpam, $sqlSpam)){
                
                header("Location: ../index.php?error=sqlerrorBro");
                exit();
            }else{
                mysqli_stmt_execute($stmtSpam);

                //guardar toda la info del SELECT
                $resultSpam = mysqli_stmt_get_result($stmtSpam);

                //guardar los resultados de la busqueda en rows
                if($row = mysqli_fetch_assoc($resultSpam)){
                    return $row['Spam'];
                }
            }
    }
?>