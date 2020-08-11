<?php
    include 'dbh.inc.php';

    $idApto = $_POST['idApto'];
    if(is_numeric($idApto)){
        $sql = "SELECT `room_id`,`room_title` 
        FROM `room`
        WHERE `apts_fk` = ".$idApto.";";
    }else{
        $sql = "SELECT `room_id`,`room_title` 
        FROM `room`
        WHERE `apts_fk` = 0;";
    }

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $GLOBALS['idRoom'] = $row["room_id"];
            echo '<option value='.$row["room_id"].'>'.$row["room_title"].'</option>';
        }
    }else{
        echo '<option value="0" disabled>Your list of Rooms is empty</option>';
    }                            
?>