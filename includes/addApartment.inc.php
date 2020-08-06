<?php
include 'dbh.inc.php';
$errorHandler = "";
$errorHandlerSQL = "";
$errorHandlerUpload = "";
$errorHandlerSize = "";
$errorHandlerProcess = "";
$errorHandlerExtension = "";
if(isset($_POST['saveApto'])){

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
    $fullRentBollean = $_POST['fullRent'];
    if(strtotime($contrcStart) > strtotime($contrcEnd)){
        //Agregar un error provider de que no se permiten campos vacios
        header("Location: ../addApartment.php?error=startDateGreatherThanEndDate");
        exit();
    }
    if(empty($unitNum) || empty($streetNum) || empty($streetName) || empty($rent) || empty($postCode1) || empty($postCode2) || empty($shortDesc) || empty($longDesc) ||
    empty($contrcStart) || empty($landlordFName) || empty($landlordLName) || empty($contrcEnd) || empty($pay)){
        //Agregar un error provider de que no se permiten campos vacios
        header("Location: ../addApartment.php?error=emptyfields");
        exit();
    }else{
        if(empty($fullRentBollean)){
            $fullRentBollean = false;
        }
        $sql = "INSERT INTO `apartaments`(`apts_strtNum`, `apts_strtName`, `apts_price`, `apts_shortDesc`, `apts_longDesc`, `apts_postCode`, `apts_uniNum`, `apts_comments`, `apts_isFullRent`) 
            VALUES (?,?,?,?,?,?,?,?,?);";
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //echo $stmt;
            echo "please contact support services. Sorry for the inconvenients.";
            //header("Location: ../index.php?error=sqlerrorBro");
            exit();
        }else{
            $postCode = strtoupper($postCode1."-".$postCode2);
            mysqli_stmt_bind_param($stmt, "ssdsssssi", $streetNum, $streetName, $rent, $shortDesc, $longDesc, $postCode, $unitNum, $comments, $fullRentBollean);
            
            $sqlContract = "INSERT INTO `aptocontract`(`ac_startD`, `ac_endD`, `apts_fk`, `ac_rent`, `ac_companyName`, `ac_landlordFName`, `ac_landlordLName`, `ac_landlordEmail`, `ac_landlordPhone`) 
            VALUES (?,?, (SELECT MAX(apts_id) FROM apartaments),?,?,?,?,?,?);";
            $stmtContract = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmtContract, $sqlContract)){
                echo "please contact support services, or try again. Sorry for the inconvenients.";
                exit();
            }else{
                mysqli_stmt_bind_param($stmtContract, "ssdsssss", $contrcStart, $contrcEnd, $pay, $company, $landlordFName, $landlordLName, $landlordEmail, $landlordPhone);

                    //ejecutar el statement
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_execute($stmtContract);
                    $dirName = $unitNum.$streetNum.$streetName.$postCode;
                    if (!file_exists('../img/'.$dirName)) {
                        mkdir('../img/'.$dirName, 0777, true);
                    }
                    $photoCounter = 0;
                    define('KB', 1024);
                    define('MB', 1048576);
                    define('GB', 1073741824);
                    define('TB', 1099511627776);
                    $header ="";
                    for($i = 0; $i < sizeof($_FILES['aptoImages']['name']); $i++){
                        $fileName = $_FILES['aptoImages']['name'][$i];
                        $fileTmpName = $_FILES['aptoImages']['tmp_name'][$i];
                        $fileSize = $_FILES['aptoImages']['size'][$i];
                        $fileError = $_FILES['aptoImages']['error'][$i];
                        $fileType = $_FILES['aptoImages']['type'][$i];
                
                        $fileExt = explode('.', $fileName);
                        $fileActualExt = strtolower(end($fileExt));
                        $allowed = array('jpg', 'png', 'jpeg');
                        if(in_array($fileActualExt, $allowed)){
                            if($fileError === 0){
                                if($fileSize <= 5*MB){
                                    //changuing the name with miliseconds
                                    //adding the address of the apartment
                                    $photoCounter++;
                                    $fileNameNew = "apto-".$unitNum.$streetNum."-".$streetName.$i."_".$photoCounter.uniqid('', true).".".$fileActualExt;
                                    //the destination of the image
                                    $fileDestination = '../img/'.$dirName."/".$fileNameNew;
                                    //move image from, to 
                                    if(move_uploaded_file($fileTmpName, $fileDestination)){
                                        $newName = $dirName."/".$fileNameNew;
                                        $sqlUploadImage = "INSERT INTO `picture`(`picture_bio`, `picture_location`, `apts_fk`) 
                                        VALUES ('$shortDesc','$newName', (SELECT MAX(apts_id) FROM apartaments))";
                                        if(mysqli_query($conn, $sqlUploadImage)){
                                            //no pasa nada cuando se hace la conexion exitosamente porque aun se debe salir del ciclo for 
                                        }else{
                                            if($errorHandler == ""){
                                                $errorHandler = "sqlError=".$fileName;
                                            }else{
                                                $errorHandler = $errorHandler."-".$fileName;
                                            }
                                        }
                                    }else{
                                        if($errorHandlerUpload == ""){
                                            $errorHandlerUpload = "errorUploading=".$fileName;
                                        }else{
                                            $errorHandlerUpload =  $errorHandlerUpload."-".$fileName;
                                        }
                                    }
                                }else{
                                    if($errorHandlerSize === ""){
                                        $errorHandlerSize = "errorSize=".$fileName;
                                    }else{
                                        $errorHandlerSize = $errorHandlerSize."-".$fileName;
                                    }
                                }
                            }else{
                                if($errorHandlerProcess == ""){
                                    $errorHandlerProcess = "errorProcess=".$fileName;
                                }else{
                                    $errorHandlerProcess += $errorHandlerProcess."-".$fileName;
                                }
                            }
                        }else{
                            if($errorHandlerExtension == ""){
                                $errorHandlerExtension = "errorExtension=".$fileName;
                            }else{
                                $errorHandlerExtension = $errorHandlerExtension."-".$fileName;
                            }
                        }
                    }
                    $header = $errorHandler."&".$errorHandlerUpload."&".$errorHandlerSize."&".$errorHandlerProcess."&".$errorHandlerExtension;
                    header("Location: ../addApartment.php?successfull=Upload&".$header);
            }
        }
    }
}else{
    header("Location: ../addApartment.php?errorConnection=noConnection");
}
//currently not using this function
function DeletingApto($conn){
    $maxID = 0;
    $sql = "SELECT max(apts_id) as 'apts_id' FROM apartaments";
    $queryResult = mysqli_query($conn, $sql);
    $MresultMaxId = mysqli_num_rows($queryResult);
    if($MresultMaxId > 0){
        while($rowTitle = mysqli_fetch_assoc($queryResult)){
            $maxID = $rowTitle['apts_id'];
        }
    }
    if($maxID > 0){
        $sqlDeletingContract = "DELETE FROM aptocontract
                        WHERE aptocontract.apts_fk =".$maxID.";";

        $sqlDeletingApto = "DELETE FROM apartaments
                        WHERE apartaments.apts_id =".$maxID.";";


        mysqli_query($conn, $sqlDeletingContract);
        mysqli_query($conn, $sqlDeletingApto);
    }
}
?>