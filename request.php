<?php
    require "header.php";
    if(!isset($_SESSION['userId'])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?error=not-session");
    }
?>
<div id="requestSent">
    <div class="messageBox">
        <div class="checkMark" id="visible">
            <div></div>
            <div></div>
        </div>
        <div class="messageSent">
            <p>Request sent successfully!</p>
        </div>
    </div>
</div>
    <div class="contentRequest">
        <div class="title">
            <h5>Request</h5>
        </div>
        <div class="formContent">
            <p class="icon"><i class="far fa-envelope"></i></p>
            <div class="information">
                <p>Please,</p>
                <p class="detail"> Please, make sure to be specific in your request description, this will help us process your request </p>
                <?php
                    if(!empty($_GET)){
                        if(!empty($_GET['errorSpam'])){
                            echo '<p id="red" class="detail">You have reached the limit of requestes today, please try tomorrow. Thank you</p>
                            <p class= "detail"> We are processing your request, Thank you for your patience.</p>';
                        }
                        if(!empty($_GET['successful'])){
                            echo'<p id="blue" class="detail">We are happy to help you, our team is processing your request, Thank you for your patience. </p>
                                    <p class= "detail"> (processing time 1-2 days)</p>';
                        }
                    }
                ?>
            </div>
            <div class="form">
                <form id="sendRequestButton" action="includes/addRequest.inc.php" method="post">
                    <label for="userName">User Name:</label>
                    <?php
                        echo "<input type='text' name='userName' value='".$_SESSION['nameUser']."' readonly>";
                    ?>

                    <label for="contractId">Apartement:</label>
                    <select name="contractId" id="contractId">   
                        <?php
                            foreach($_SESSION['contratoId'] as $contatoId){
                                $sql = "SELECT apartaments.apts_strtNum,apartaments.apts_uniNum, apartaments.apts_strtName, room.room_title, room_users.ro_us
                                        FROM room_users
                                        left JOIN room
                                        on room.room_id = room_users.room_fk
                                        LEFT JOIN apartaments
                                        on apartaments.apts_id = room.apts_fk
                                        WHERE room_users.room_fk is NOT NULL and room_users.ru_endD > CURRENT_DATE() AND room_users.ro_us = ".$contatoId."
                                        GROUP BY room_users.room_fk
                                        union 
                                        select apartaments.apts_strtNum,apartaments.apts_uniNum, apartaments.apts_strtName, room_users.room_fk, room_users.ro_us
                                        from room_users
                                        LEFT JOIN apartaments
                                        on apartaments.apts_id = room_users.apto_fk
                                        where room_users.room_fk is null and room_users.ru_endD > CURRENT_DATE() AND room_users.ro_us = ".$contatoId."
                                        GROUP BY room_users.apto_fk;";
                                $result = mysqli_query($conn,$sql);
                                $queryResults = mysqli_num_rows($result);
                                if($queryResults > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $apts_strtNum = $row['apts_strtNum'];
                                        $apts_uniNum = $row['apts_uniNum'];
                                        $apts_strtName = $row['apts_strtName'];
                                        $room_title = $row['room_title'];
                                        $ro_us = $row['ro_us'];
                                        echo '<option value="'.$row["ro_us"].'">'.$room_title." ".$apts_uniNum."-".$apts_strtNum." ".$apts_strtName.' st.</option>';
                                    }
                                }else{
                                    //header("Location: index.php?error=apto-request-sql");
                                }
                            }
                        ?>
                    </select>

                    <label for="request">Type of request:</label>
                    <select name="request" id="request">
                        <optgroup label="Maintenance Request">
                            <option value="Cleanning">Clean</option>
                            <option value="fixing">Reparate</option>
                            <option value="replace">Replace</option>
                            <option value="painting">Paint</option>
                            <option selected="selected" value="other_Maintenance">Other Maintenance</option>
                        </optgroup>
                        <optgroup label="Payment Information">
                            <option value="bills">My billing information</option>
                            <option value="extra_Charges">Additional charges info</option>
                        </optgroup>
                        <optgroup label="Other Inquiries">
                            <option value="extension">Extend my contract</option>
                            <option value="other_Inquiry">Other inquiry</option>
                        </optgroup>
                    </select>
                    
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" placeholder="Subject..." id="subject">

                    <label for="message">Specify your request:</label>
                    <textarea name="message" placeholder="Message..." id="message"></textarea>
                    <?php
                        if(empty($_GET['errorSpam'])){
                            echo '<button type="submit" id= "buttonRequest" name="send-request">Send</button>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
<?php
    require "footer.php";
?>

<?php
    foreach($_SESSION['contratoId'] as $contatoId){
        $sql = "SELECT apartaments.apts_strtNum,apartaments.apts_uniNum, apartaments.apts_strtName, room.room_title, room_users.ro_us
                FROM room_users
                left JOIN room
                on room.room_id = room_users.room_fk
                LEFT JOIN apartaments
                on apartaments.apts_id = room.apts_fk
                WHERE room_users.room_fk is NOT NULL and room_users.ru_endD > CURRENT_DATE() AND room_users.ro_us = ".$contatoId."
                GROUP BY room_users.room_fk
                union 
                select apartaments.apts_strtNum,apartaments.apts_uniNum, apartaments.apts_strtName, room_users.room_fk, room_users.ro_us
                from room_users
                LEFT JOIN apartaments
                on apartaments.apts_id = room_users.apto_fk
                where room_users.room_fk is null and room_users.ru_endD > CURRENT_DATE() AND room_users.ro_us = ".$contatoId."
                GROUP BY room_users.apto_fk;";
        $result = mysqli_query($conn,$sql);
        $queryResults = mysqli_num_rows($result);
        if($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){
                $apts_strtNum = $row['apts_strtNum'];
                $apts_uniNum = $row['apts_uniNum'];
                $apts_strtName = $row['apts_strtName'];
                $room_title = $row['room_title'];
                $ro_us = $row['ro_us'];
                echo '<option value="extension">'.$room_title!=Null?$room_title:"".$apts_uniNum."-".$apts_strtNum." ".$apts_strtName.'</option>';
            }
        }else{
            header("Location: index.php?error=apto-request-sql");
        }
    }
?>