<?php
    require "header.php";
    if(!isset($_SESSION['memberId'])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?error=not-session-member");
    }else{
    }
?>

<div id="requestSent">
    <div class="messageBox">
        <div class="checkMark" id="visible">
            <div></div>
            <div></div>
        </div>
        <div class="messageSent">
            <p>Room added succesfully!</p>
        </div>
    </div>
</div>

<div class="add">
    <div class="title">
        <p>Add a Room</p>
    </div>
    <div class="addContainer">
            <form action="includes/addRoom.inc.php" method="post" enctype="multipart/form-data" id="addRoomForm" >
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Room Information</p>
                        <ul>
                            <li>You can upload up to 5 images simultaniously on "Select Room Images" field (files extensions must be .jpg or .png)</li>
                        </ul>
                    </div>
                    <div class="required">
                        <label for="aptos">Add a Room into:</label>
                        <select name="aptos" id="aptos" required="required">
                            <?php

                                $sql = "SELECT `apts_uniNum`, `apts_strtNum`, `apts_strtName`, `apts_id` 
                                FROM `apartaments` 
                                LEFT JOIN aptocontract
                                ON aptocontract.apts_fk = apartaments.apts_id
                                WHERE aptocontract.ac_endD > CURDATE();";

                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $GLOBALS['idApto'] = $row["apts_id"];
                                        echo '<option value='.$row["apts_id"].'>'.$row["apts_uniNum"].'-'.$row["apts_strtNum"].' '.$row["apts_strtName"].'</option>';
                                    }
                                    echo '<option value="3"> prueba usando el 3</option>';
                                    echo '<option value="5" >prueba usando el 5</option>';
                                    echo '<option value="13" >prueba usando el 13</option>';
                                }else{
                                    echo '<option value="0" disabled>Your list of Apartaments is empty</option>';
                                }

                            ?>
                        </select>
                    </div>
                    <div class="long">
                        <p>The apartment selected has <strong>0</strong> room(s) at this moment.</p>
                        <?php
                        /*
                        echo $variable = "<script>hola()</script>";
                        echo '<p>'.$variable.' </p>';
                            if(isset($GLOBALS['idApto'])){
                                $sql = "SELECT COUNT(`apts_fk`) AS countRooms 
                                FROM `room` 
                                WHERE apts_fk =".$GLOBALS['idApto'].";";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<p>The apartment selected has <strong>'.$row['countRooms'].'</strong> room(s) at this moment.</p>';
                                    }
                                }else{
                                    echo '<p>The apartment selected has <strong>'.$row['countRooms'].'</strong> rooms at this moment.</p>';
                                }
                            }else{
                                echo "<p>You don't have any apartament at this moment</p> <p>Please go to 'Add an Apartment' section an add more apartaments, Thank you.</p>";
                            }*/
                        ?>
                    </div>
                    <div class="required">
                        <label for="roomTitle">Room Title: <i>(max 20 characters)</i></label>
                        <input type="text" minlength="1" maxlength="20" id="roomTitle" name="roomTitle" placeholder="Room Title" required="required">
                    </div>
                    <div class="required">
                        <label for="rent">Room Price: $</label>
                        <input type="number" placeholder="0.00" name="rent" id="rent" min="1" step="0.01" required="required">
                    </div>
                    <div class="long required">
                        <label for="shortDesc">Short Description: </label>
                        <textarea id="shortDesc" minlength="5" maxlength="100" rows="2" name="shortDesc" required="required"></textarea>
                    </div>
                    <div class="long required">
                        <label for="longDesc">Room Long Description: </label>
                        <textarea id="longDesc" minlength="5" maxlength="1000"  rows="10" name="longDesc" required="required"></textarea>
                    </div>
                    <div class="long required">
                        <label for="roomImg">Select Room images</label>
                        <input type="file" id="roomImg" multiple name="roomImg[]" required="required" accept="image/png, image/jpeg">
                    </div>
                </section>
                <section>
                    <div class="extraInfo">
                        <p class="subtitle">Please, before to submit revise if the information provided is correct</p>
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                    <div>
                        <button type="submit" name="saveRoom">Save</button>
                    </div>
                </section>
            </form>
    </div>
</div>
<script>
    var idApto;
    $(document).ready(function(){
        $("#aptos").change(function(){
            idApto = $(this).val();
            //alert(idApto);
        });
        idApto = $("#aptos").val();
        //alert(idApto);
    });
    function hola(){
        return 15;
    };
</script>
<?php
    if(isset($_GET["successfull"])){
        echo '<script src="scripts/addApto.js"></script>';
    }
?>
<?php
    require "footer.php";
?>