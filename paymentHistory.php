<?php
    require "header.php";
    include 'includes/userContent.inc.php';
    if(!isset($_SESSION['userId'])){
        header("Location: index.php?error=not-session");
    }
?>
    <div class="contentHistory">
        <div class="title">
            <h5>History Payments</h5>
        </div>


        <?php
            foreach($_SESSION['contratoId'] as $contatoId){
                $sql = "SELECT `apto_fk`,`room_fk`,`ru_startD`, `ru_endD`
                FROM room_users
                where room_users.ro_us = ".$contatoId.";";
                $result = mysqli_query($conn,$sql);
                $queryResults = mysqli_num_rows($result);
                if($queryResults > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $ru_startD = $row['ru_startD'];
                        $ru_endD = $row['ru_endD'];
                        if($row['apto_fk'] == null){
                            $sqlApto = "SELECT room_users.ru_startD, room_users.ru_endD, room.room_id, room.room_title, apartaments.apts_strtNum, apartaments.apts_strtName, apartaments.apts_postCode, apartaments.apts_uniNum
                                FROM `room_users` 
                                LEFT JOIN room
                                ON room.room_id = room_users.room_fk
                                LEFT JOIN apartaments
                                ON apartaments.apts_id = room.apts_fk
                                where room.room_id =".$row["room_fk"].";";
                                $resultApto = mysqli_query($conn,$sqlApto);
                                $queryResults = mysqli_num_rows($resultApto);
                                if($queryResults > 0){
                                    while($rowApto = mysqli_fetch_assoc($resultApto)){
                                        $apt_type = "Room";
                                        $apts_address = $rowApto["apts_uniNum"]."-".$rowApto["apts_strtNum"]." ".$rowApto["apts_strtName"]." ".$rowApto["apts_postCode"].", Vancouver B.C.";
                                        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                                            echo '<div class="pagos">
                                                <div class="addressInfo">
                                                    <p>'.$_SESSION['nameUser'].'</p>
                                                    
                                                        <p>'.$apts_address.'</p>
                                                </div>
                                                <div class="placeRent '.$contatoId.'">
                                                    <div class="generalInfo">
                                                        <div>
                                                            <p><strong>Rent type:</strong> '.$apt_type.'</p>
                                                                <p><strong>Tenant Name:</strong> '.$_SESSION['nameUser'].'</p>
                                                                <p><strong>Address:</strong> '.$apts_address.'</p>
                                                                <p><strong>Start contract:</strong> '.$ru_startD.'</p>
                                                                <p><strong>End contract:</strong> '.$ru_endD.'</p>
                                                        </div>
                                                    </div>
                                                    <div class="tableWrapper">
                                                        <table>
                                                            <tr class="headers">
                                                                <th>Type:</th>
                                                                <th>Date:</th>
                                                                <th>Amount:</th>
                                                                <th>Details:</th>
                                                            </tr>';
                                                            $sqlPays = "SELECT paymet.id_payment, paymet.type_payment, paymet.amount_payment, paymet.desc_payment, paymet.date_payment
                                                            FROM `room_users` 
                                                            LEFT JOIN paymet
                                                            ON paymet.ro_us_fk = room_users.ro_us
                                                            where room_users.ro_us = ".$contatoId.";";
                                                            $resultPays = mysqli_query($conn,$sqlPays);
                                                            $queryResultsPays = mysqli_num_rows($resultPays);
                                                            if($queryResultsPays > 0){
                                                                while($row = mysqli_fetch_assoc($resultPays)){
                                                                    echo '<tr>
                                                                            <th>'.$row['type_payment'].'</th>
                                                                            <th>'.$row['date_payment'].'</th>
                                                                            <th>'.$row['amount_payment'].'</th>
                                                                            <th>'.$row['desc_payment'].'</th>
                                                                        </tr>';
                                                                }
                                                            }else{
                                                                header("Location: index.php?error=payments-not-found");
                                                            }
                                                        echo('</table>
                                                    </div>
                                                </div>

                                                <div class="button">
                                                    <button onclick="printContent('.$contatoId.')">Print Content</button>
                                                </div>
                                            </div>');

                                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                                    }
                                }
                        }else{
                                $sqlApto = "SELECT `apts_strtNum`,`apts_strtName`,`apts_postCode`,`apts_uniNum`
                                from apartaments
                                where apts_id =".$row['apto_fk'].";";
                                $resultApto = mysqli_query($conn,$sqlApto);
                                $queryResults = mysqli_num_rows($resultApto);
                                if($queryResults > 0){
                                    while($rowApto = mysqli_fetch_assoc($resultApto)){
                                        $apt_type = "Apartament";
                                        $apts_address = $rowApto["apts_uniNum"]."-".$rowApto["apts_strtNum"]." ".$rowApto["apts_strtName"]." ".$rowApto["apts_postCode"].", Vancouver B.C.";
                                        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                                            echo '<div class="pagos">
                                                <div class="addressInfo">
                                                    <p>'.$_SESSION['nameUser'].'</p>
                                                    
                                                        <p>'.$apts_address.'</p>
                                                </div>
                                                <div class="placeRent '.$contatoId.'">
                                                    <div class="generalInfo">
                                                        <div>
                                                            <p><strong>Rent type:</strong> '.$apt_type.'</p>
                                                                <p><strong>Tenant Name:</strong> '.$_SESSION['nameUser'].'</p>
                                                                <p><strong>Address:</strong> '.$apts_address.'</p>
                                                                <p><strong>Start contract:</strong> '.$ru_startD.'</p>
                                                                <p><strong>End contract:</strong> '.$ru_endD.'</p>
                                                        </div>
                                                    </div>
                                                    <div class="tableWrapper">
                                                        <table>
                                                            <tr class="headers">
                                                                <th>Type:</th>
                                                                <th>Date:</th>
                                                                <th>Amount:</th>
                                                                <th>Details:</th>
                                                            </tr>';
                                                            $sqlPays = "SELECT paymet.id_payment, paymet.type_payment, paymet.amount_payment, paymet.desc_payment, paymet.date_payment
                                                            FROM `room_users` 
                                                            LEFT JOIN paymet
                                                            ON paymet.ro_us_fk = room_users.ro_us
                                                            where room_users.ro_us = ".$contatoId.";";
                                                            $resultPays = mysqli_query($conn,$sqlPays);
                                                            $queryResultsPays = mysqli_num_rows($resultPays);
                                                            if($queryResultsPays > 0){
                                                                while($row = mysqli_fetch_assoc($resultPays)){
                                                                    echo '<tr>
                                                                            <th>'.$row['type_payment'].'</th>
                                                                            <th>'.$row['date_payment'].'</th>
                                                                            <th>'.$row['amount_payment'].'</th>
                                                                            <th>'.$row['desc_payment'].'</th>
                                                                        </tr>';
                                                                }
                                                            }else{
                                                                header("Location: index.php?error=payments-not-found");
                                                            }
                                                        echo'</table>
                                                    </div>
                                                </div>

                                                <div class="button">
                                                    <button onclick="printContent('.$contatoId.')">Print Content</button>
                                                </div>
                                            </div>';

                                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                                                    
                                    }
                                }
                            }
                        }
                }else{
                    header("Location: index.php?error=payment-sql");
                }
            }
        ?>

        <!-- GOOD ONE   
        <div class="pagos">
            <div class="addressInfo">
                <?php
                    echo '<p>'.$_SESSION['nameUser'].'</p>
                
                    <p>'.$apts_address.'</p>';
                ?>
            </div>
            <div class="placeRent">
                <div class="generalInfo">
                    <div>
                        <?php
                            echo '<p><strong>Rent type:</strong> '.$apt_type.'</p>
                            <p><strong>Tenant Name:</strong> '.$_SESSION['nameUser'].'</p>
                            <p><strong>Address:</strong> '.$apts_address.'</p>
                            <p><strong>Start contract:</strong> '.$ru_startD.'</p>
                            <p><strong>End contract:</strong> '.$ru_endD.'</p>';
                        ?>
                    </div>
                </div>
                <div class="tableWrapper">
                    <table>
                        <tr class="headers">
                            <th>Type:</th>
                            <th>Date:</th>
                            <th>Amount:</th>
                            <th>Details:</th>
                        </tr>
                        <?php
                        echo $contatoId;
                        $sql = "SELECT `apto_fk`,`room_fk`,`ru_startD`, `ru_endD`
                        FROM room_users
                        where room_users.ro_us = ".$contatoId.";";
                        $result = mysqli_query($conn,$sql);
                        $queryResults = mysqli_num_rows($result);
                        if($queryResults > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                
                            }
                        }else{
                            header("Location: index.php?error=payments-not-found");
                        }
                        ?>
                        <tr>
                            <th>Rent</th>
                            <th>1 Jan 2020</th>
                            <th>$1500</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Other</th>
                            <th>1 Jan 2020</th>
                            <th>$50</th>
                            <th>Penalty from the manager: noisy party</th>
                        </tr>
                        <tr>
                            <th>BCHydro</th>
                            <th>1 Jan 2020</th>
                            <th>$80</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Shaw</th>
                            <th>1 Jan 2020</th>
                            <th>$90</th>
                            <th>-</th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="button">
                <button onclick="printContent('placeRent')">Print Content</button>
            </div>
        </div>-->

        <!--<div class="pagos">
            <div class="addressInfo">
                <p>Arturo Gamez Ortega.</p>
                <p>906-1875 Robson st., V6Z3C1, Vancouver BC, Canada</p>
            </div>
            <div class="placeRent">
                <div class="generalInfo">
                    <div>
                        <p><strong>Rent type:</strong> Room</p>
                        <p><strong>Address:</strong> 906-1875 Robson st., V6Z3C1, Vancouver BC, Canada</p>
                        <p><strong>Start contract:</strong> 1 Jan 2020</p>
                        <p><strong>End contract:</strong> 1 Jan 2021</p>
                    </div>
                </div>
                <div class="tableWrapper">
                    <table>
                        <tr class="headers">
                            <th>Type:</th>
                            <th>Date:</th>
                            <th>Amount:</th>
                            <th id="details">Details:</th>
                        </tr>
                        <tr>
                            <th>Rent</th>
                            <th>1 Jan 2020</th>
                            <th>$1500</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Other</th>
                            <th>1 Jan 2020</th>
                            <th>$50</th>
                            <th>Penalty from the manager: noisy party</th>
                        </tr>
                        <tr>
                            <th>BCHydro</th>
                            <th>1 Jan 2020</th>
                            <th>$80</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Shaw</th>
                            <th>1 Jan 2020</th>
                            <th>$90</th>
                            <th>-</th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="button">
                <button onclick="printContent('placeRent')">Print Content</button>
            </div>
        </div>-->

    </div>
<?php
    require "footer.php";
?>