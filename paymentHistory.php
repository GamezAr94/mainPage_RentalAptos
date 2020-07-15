<?php
    require "header.php";
    include 'includes/userContent.inc.php';
?>
    <div class="contentHistory">
        <div class="title">
            <h5>History Payments</h5>
        </div>


        <?php
            foreach($_SESSION['contratoId'] as $contatoId){
                echo $contatoId;
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
                            echo "ES NULL";
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
                                }
                            }else{
                                header("Location: index.php?error=payment-sql");
                            }
                        }
                    }
                }else{
                    header("Location: index.php?error=payment-sql");
                }
            }
        ?>
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
        </div>
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
    <script>
        function printContent(el){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementsByClassName(el)[0].innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
<?php
    require "footer.php";
?>