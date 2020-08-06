<?php
include 'dbh.inc.php';
    $errorHandler = "";
    $errorHandlerUpload = "";
    $errorHandlerSize = "";
    $errorHandlerProcess = "";
    $errorHandlerExtension = "";

    if(isset($_POST['saveRoom'])){
        $aptoId = $_POST['aptos'];
        $roomTitle = ucfirst(strtolower($_POST['roomTitle']));
        $rent = $_POST['rent'];
        $shortDesc = ucfirst(strtolower($_POST['shortDesc']));
        $longDesc = ucfirst(strtolower($_POST['longDesc']));
        if(empty($aptoId) || empty($roomTitle) || empty($rent) || empty($shortDesc) || empty($longDesc)){
            //Agregar un error provider de que no se permiten campos vacios
            header("Location: ../addRoom.php?error=emptyfields");
            exit();
        }else{
            $sql = "INSERT INTO `room`(`room_title`, `room_desc`, `apts_fk`, `room_price`, `room_shortDesc`) 
            VALUES (?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                //echo $stmt;
                echo "please contact support services. Sorry for the inconvenients.";
                //header("Location: ../index.php?error=sqlerrorBro");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "ssids", $roomTitle, $longDesc, $aptoId, $rent, $shortDesc);
                //ejecutar el statement
                mysqli_stmt_execute($stmt);
                $dirName = "Room-".$aptoId."-Title-".$roomTitle;
                if (!file_exists('../img/'.$dirName)) {
                    mkdir('../img/'.$dirName, 0777, true);
                }
                $photoCounter = 0;
                define('KB', 1024);
                define('MB', 1048576);
                define('GB', 1073741824);
                define('TB', 1099511627776);
                for($i = 0; $i < sizeof($_FILES['roomImg']['name']); $i++){
                    $fileName = $_FILES['roomImg']['name'][$i];
                    $fileTmpName = $_FILES['roomImg']['tmp_name'][$i];
                    $fileSize = $_FILES['roomImg']['size'][$i];
                    $fileError = $_FILES['roomImg']['error'][$i];
                    $fileType = $_FILES['roomImg']['type'][$i];
            
                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));
                    $allowed = array('jpg', 'png', 'jpeg');
                    if(in_array($fileActualExt, $allowed)){
                        if($fileError === 0){
                            if($fileSize <= 5*MB){
                                //changuing the name with miliseconds
                                //adding the address of the apartment
                                $photoCounter++;
                                $fileNameNew = "room-".$roomTitle."_".$photoCounter.uniqid('', true).".".$fileActualExt;
                                //the destination of the image
                                $fileDestination = '../img/'.$dirName."/".$fileNameNew;
                                //move image from, to 
                                if(move_uploaded_file($fileTmpName, $fileDestination)){
                                    $newName = $dirName."/".$fileNameNew;
                                    $sqlUploadImage = "INSERT INTO `picture`(`picture_bio`, `picture_location`, `apts_fk`, `room_fk`) 
                                    VALUES ('$shortDesc','$newName', $aptoId, (SELECT MAX(room_id) FROM room))";
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
                header("Location: ../addRoom.php?successfull=RoomUpload&".$header);
            }    
        }
    }else{
        header("Location: ../addRoom.php?errorConnection=noConnection");
    }

?>