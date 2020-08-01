<?php
include 'dbh.inc.php';

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
                
                    //ejecutar el statement
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_execute($stmtContract);
                    $dirName = $unitNum.$streetNum.$streetName.$postCode;
                    if (!file_exists('../img/'.$dirName)) {
                        mkdir('../img/'.$dirName);
                    }
                    $photoCounter = 0;
                     // Loop through each Picture
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
                                if($fileSize <= 1500000){
                                    $photoCounter++;
                                    //changuing the name with miliseconds
                                    //adding the address of the apartment
                                    $fileNameNew = "apto".$photoCounter."-".$unitNum.$streetNum.$streetName."-".uniqid('', true).".".$fileActualExt;
                                    //the destination of the image
                                    $fileDestination = '../img/'.$dirName."/".$fileNameNew;
                                    //move image from, to 
                                    if(move_uploaded_file($fileTmpName, $fileDestination)){
                                        $sqlUploadImage = "INSERT INTO `picture`(`picture_bio`, `picture_location`, `apts_fk`) 
                                        VALUES ($shortDesc,'$fileNameNew', (SELECT MAX(apts_id) FROM apartaments))";
                                        if(mysqli_query($conn, $sqlUploadImage)){
                                            header("Location: ../addApartment.php?successfullUpload");
                                        }else{
                                            DeletingApto($conn);
                                            header("Location: ../addApartment.php?errorUploadingFiles");
                                            exit();
                                        }
                                    }else{
                                        DeletingApto($conn);
                                        header("Location: ../addApartment.php?errorMovingFiles");
                                        exit();
                                    }
                                }else{
                                    DeletingApto($conn);
                                    header("Location: ../addApartment.php?errorFileTooBig");
                                }
                            }else{
                                DeletingApto($conn);
                                header("Location: ../addApartment.php?errorUploadingPictures");
                            }
                        }else{
                            DeletingApto($conn);
                            header("Location: ../addApartment.php?errorUploadingPicturesOfThisType");
                        }
                    }
            }
        }
    }
}else{
    header("Location: ../addApartment.php?error=noConnection");
}

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