<?php
include 'dbh.inc.php';

if(isset($_POST['save-apto'])){

    $unitNum = ucfirst(strtolower($_POST['unitNum']));
    $streetNum = ucfirst(strtolower($_POST['streetNum']));
    $streetName = ucfirst(strtolower($_POST['streetName']));
    $rent = $_POST['rent'];
    $postCode1 = $_POST['postCode1'];
    $postCode2 = $_POST['postCode2'];
    $shortDesc = ucfirst(strtolower($_POST['shortDesc']));
    $longDesc = ucfirst(strtolower($_POST['longDesc']));
    $comments = ucfirst(strtolower($_POST['comments']));

    $company = ucfirst(strtolower($_POST['company']));
    $landlordFName = ucfirst(strtolower($_POST['landlordFName']));
    $landlordLName = ucfirst(strtolower($_POST['landlordLName']));
    $landlordEmail = ucfirst(strtolower($_POST['landlordEmail']));
    $landlordPhone = ucfirst(strtolower($_POST['landlordPhone']));
    $contrcStart = ucfirst(strtolower($_POST['contrcStart']));
    $contrcEnd = ucfirst(strtolower($_POST['contrcEnd']));
    $pay = ucfirst(strtolower($_POST['pay']));
    if(empty($unitNum) || empty($streetNum) || empty($streetName) || empty($rent) || empty($postCode1) || empty($postCode2) || empty($shortDesc) || empty($longDesc) ||
    empty($contrcStart) || empty($landlordFName) || empty($landlordLName) || empty($contrcEnd) || empty($pay)){
        //Agregar un error provider de que no se permiten campos vacios
        header("Location: ../addApartment.php?error=emptyfields");
        exit();
    }else{
        $sql = "INSERT INTO `apartaments`(`apts_strtNum`, `apts_strtName`, `apts_price`, `apts_shortDesc`, `apts_longDesc`, `apts_postCode`, `apts_uniNum`, `apts_comments`) 
            VALUES (?,?,?,?,?,?,?,?);";
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //echo $stmt;
            echo "please contact support services. Sorry for the inconvenients.";
            //header("Location: ../index.php?error=sqlerrorBro");
            exit();
        }else{
            $postCode = strtoupper($postCode1."-".$postCode2);
            mysqli_stmt_bind_param($stmt, "ssdsssss", $streetNum, $streetName, $rent, $shortDesc, $longDesc, $postCode, $unitNum, $comments);
            
            $sqlContract = "INSERT INTO `aptocontract`(`ac_startD`, `ac_endD`, `apts_fk`, `ac_rent`, `ac_companyName`, `ac_landlordFName`, `ac_landlordLName`, `ac_landlordEmail`, `ac_landlordPhone`) 
            VALUES (?,?, (SELECT MAX(apts_id) FROM apartaments),?,?,?,?,?,?);";
            $stmtContract = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmtContract, $sqlContract)){
                echo "please contact support services, or try again. Sorry for the inconvenients.";
                exit();
            }else{
                mysqli_stmt_bind_param($stmtContract, "ssdsssss", $contrcStart, $contrcEnd, $pay, $company, $landlordFName, $landlordLName, $landlordEmail, $landlordPhone);
                
                try{
                    //ejecutar el statement
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_execute($stmtContract);
                    if (!file_exists('../img/'.$unitNum.$streetNum.$streetName.$postCode."-".$contrcStart.$contrcEnd)) {
                        mkdir('../img/'.$unitNum.$streetNum.$streetName.$postCode."-".$contrcStart.$contrcEnd, 0777, true);
                    }
                }catch(mysqli_sql_exception $e){
                    echo "There is a problem creating the new apartament, please try again or call IT services if the problem persists. Sorry for the inconvenients.";
                    exit();
                }
            }
            header("Location: ../addApartment.php?successful=apto-added");
        }
    }
}else{
    //header("Location: ../blas.php");
}

?>