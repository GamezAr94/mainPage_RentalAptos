<?php
    require "header.php";
    include 'includes/userContent.inc.php';
    $userInfo = new UserInfo();
    $_SESSION['contratoId'] = array();
    $_SESSION['contractIdentify'] = array();
    $_SESSION['cntctInfo'] = array();
    $_SESSION['arrayContratos'] = array();
        if(isset($_SESSION['userId'])){
        $userid = $_SESSION['userId']; 
        if(empty($userid)){
            header("Location: index.php?error=empty-user-field");
            exit();
        }else{
            $sql = "SELECT * 
            FROM users 
            LEFT JOIN room_users 
            ON room_users.users_fk = users.id_users 
            WHERE users.id_users = ".$userid." AND room_users.ru_endD > CURRENT_DATE();";

            $result = mysqli_query($conn,$sql);
            $queryResults = mysqli_num_rows($result);
            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $Contract = new contractInfo();

                    $userInfo->set_userName($row['name_users']." ".$row['lastN_users']);
                    $userInfo->set_userEmail($row['email_users']);
                    $userInfo->set_userPhone($row['phone_users']);

                    $Contract->set_roomKey($row['room_fk']);
                    $Contract->set_rent($row['ru_rent']);
                    $Contract->set_aptoKey($row['apto_fk']);
                    $Contract->set_startD($row['ru_startD']);
                    $Contract->set_endD($row['ru_endD']);
                    $Contract->set_cncID($row['ro_us']);
                    $Contract->set_damageD($row['ru_damageD']);
                    $Contract->set_bcHydro($row['ru_bcHydro']);
                    $Contract->set_internet($row['ru_internet']);
                    $Contract->set_otherPay($row["ru_otherPay"]);
                    $Contract->set_totalPay($row['ru_internet']+$row['ru_bcHydro']+$row['ru_rent']+$row["ru_otherPay"]);

                    $_SESSION['userIdentifier'] = substr($row['name_users'], 0, 1).substr($row['lastN_users'], 0, 1).str_pad($row['id_users'], 5, '0', STR_PAD_LEFT);

                    $_SESSION['nameUser'] = $userInfo->get_userName();
                    $_SESSION['lasNameUser'] = $row['lastN_users'];

                    if(isset($row['apto_fk'])){
                        $aptoIdentify = "A".str_pad($row['apto_fk'], 5, '0', STR_PAD_LEFT)."_R".str_pad($row['room_fk'], 5, '0', STR_PAD_LEFT);
                    }else{
                        $aptoIdentify = "A".str_pad($row['apto_fk'], 5, '0', STR_PAD_LEFT)."_R".str_pad($row['room_fk'], 5, '0', STR_PAD_LEFT);
                    }


                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //IMPORTANT ID OF THE USERS, FIRST LETTER OF THE FIRST AND LAST NAME, USER ID, CONTRACT NUMBER, APTO ID, ROOM ID;
                    //ie. AG0009-0010-R005_A0 0 Arturo Gamez user id:9, contract num:10, apto id: 5, room id: 0
                    array_push($_SESSION['contractIdentify'], $_SESSION['userIdentifier']."-".str_pad($row['ro_us'], 5, '0', STR_PAD_LEFT)."-".$aptoIdentify);
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    
                    array_push($_SESSION['contratoId'], $row['ro_us']);
                    array_push($_SESSION['cntctInfo'], $Contract);
                }
            }else{
                header("Location: index.php?error=null-user");
            }
        }
    }else{
        header("Location: index.php?error=session-not-started");
    }

    if(isset($_SESSION['userId'])){


/*
        <div class="userSalut">
            <div class="userName">
                <i>Icon</i> 
                <p>Welcome&nbsp;</p>
                <p id="userName">'.$_SESSION['userName']." ".$_SESSION['userLastName']." ".$_SESSION['contractNum'].'</p>';
            </div>
            <div class="userApartment">
                <p>906-1875 Robson st., V6Z-3C1, Vancouver B.C., Canadá</p>
                </div>
        </div>*/





        echo '<div id="mainUserContent">
            <div class="userSalut">
                <div class="userName">
                    <i>Icon</i> 
                    <p>Welcome&nbsp;</p>';
                    echo '<p id="userName">'.$userInfo->get_userName().' </p>';
                echo '</div>
                </div>';
                    foreach($_SESSION['cntctInfo'] as $contract){
                        $sql = "SELECT * 
                        FROM room_users
                        LEFT JOIN room as r1
                        ON room_users.room_fk = r1.room_id
                        LEFT JOIN apartaments as a1
                        ON a1.apts_id = r1.apts_fk
                        left join apartaments as a2
                        on room_users.apto_fk = a2.apts_id
                            WHERE room_users.ro_us = ".$contract->get_cncID().";";
                        $result = mysqli_query($conn,$sql);
                        $queryResults = mysqli_num_rows($result);
                        if($queryResults > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $roomTitle = (isset($row["room_title"])?("(".$row["room_title"].") "):"");
                                    echo '
                                    <div class="userApartment">
                                        <p>'.$roomTitle.$row["apts_uniNum"]. "-" .$row["apts_strtNum"]. " ".$row["apts_strtName"]."  Vancouver, B.C. ".$row["apts_postCode"].', Canada.</p>
                                    </div>';

/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Testing the user id*/
                               /* foreach($_SESSION['contractIdentify'] as $hola){
                                    echo $hola.'      ';
                                    echo " ____".substr($_SESSION['contractIdentify'][0], 8 , 5);
                                }*/
if(date("d") <= 25){
    $earlyPayment = 50;
}else{
    $earlyPayment = 0;
}
$totalPay = $contract->get_totalPay()-$earlyPayment;
                                echo 
            '<div class="content">
                <div class="summarize">
                    <div class="title">
                        <h4>Summarize</h4>
                        <p class="label">Next payment:</p>
                        <p class="lastMonth">'.date('1 M Y',strtotime('next month')).'</p>
                    </div>
                    <table>
                        <tr>
                            <th>Rent:</th>
                            <th>$'.$contract->get_rent().'</th>
                        </tr>
                        <tr>
                            <th>BCHydro:</th>
                            <th>$'.$contract->get_bcHydro().'</th>
                        </tr>
                        <tr>
                            <th>Internet:</th>
                            <th>$'.$contract->get_internet().'</th>
                        </tr>
                        <tr>
                            <th>Early payment:</th>
                            <th>'.(($earlyPayment>0)?"-$".$earlyPayment:"-").'</th>
                        </tr>
                        <tr>
                            <th>Others:<sub><a href="#extraInfo">1</a></sub></th>
                            <th>'.(($contract->get_otherPay()>0)?" $".$contract->get_otherPay():"-").'</th>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <th>$'.$totalPay.'</th>
                        </tr>
                    </table>
                </div>
                <div class="summarize information">
                    <div class="title">
                        <h4>Information</h4>
                        <p class="label">Tenant Information</p>
                    </div>
                    <table>
                        <tr>
                            <th>Entry Date:</th>
                            <th>'.date("d M Y", strtotime($row["ru_startD"])).'</th>
                        </tr>
                        <tr>
                            <th>End of Contract:</th>
                            <th>'.date("d M Y", strtotime($row["ru_endD"])).'</th>
                        </tr>
                        <!--COMENTANDO PORQUE SE REPITE ESTA INFO EN EL ENCABEZADO DEL SUMMARIZE++++++++++++++++++++++++++++++
                        <tr>
                            <th>Next Payment Day:</th>
                            <th>'.date('1 M Y',strtotime('next month')).'</th>
                        </tr>-->
                        <tr>
                            <th>Damage Deposit:</th>
                            <th>$'.$row["ru_damageD"].'</th>
                        </tr>
                        <tr>
                            <th>Early Payment Date:<sub><a href="#extraInfo">2</a></sub></th>
                            <th>25</th>
                        </tr>
                    </table>';

                            }
                        


                            
                       }else{
                            header("Location: index.php?error=info-aptos");
                        }
echo '    </div>
</div>
';



    }
      /*  echo 
            '</div>
            <div class="content">
                <div class="summarize">
                    <div class="title">
                        <h4>Summarize</h4>
                        <p class="label">Next payment:</p>
                        <p class="lastMonth">31, January 2020</p>
                    </div>
                    <table>
                        <tr>
                            <th>Rent:</th>
                            <th>$1200</th>
                        </tr>
                        <tr>
                            <th>BCHydro:</th>
                            <th>$40</th>
                        </tr>
                        <tr>
                            <th>Internet:</th>
                            <th>$90</th>
                        </tr>
                        <tr>
                            <th>Early payment:</th>
                            <th>-$50</th>
                        </tr>
                        <tr>
                            <th>Others:</th>
                            <th>-</th>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <th>$1280</th>
                        </tr>
                    </table>
                </div>
                <div class="summarize information">
                    <div class="title">
                        <h4>Information</h4>
                        <p class="label">Tenant Information</p>
                    </div>
                    <table>
                        <tr>
                            <th>Entry Date:</th>
                            <th>Jan 1, 2020</th>
                        </tr>
                        <tr>
                            <th>End of Contract:</th>
                            <th>Jun 30, 2020</th>
                        </tr>
                        <tr>
                            <th>Next Payment Day:</th>
                            <th>Jan 31, 2020</th>
                        </tr>
                        <tr>
                            <th>Damage Deposit:</th>
                            <th>$600</th>
                        </tr>
                        <tr>
                            <th>Early Payment Date:</th>
                            <th>25</th>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
            
        </div>';
    */
}
echo'<div id="extraInfo">
<p>1. For more information about "Other" payments, please contact support services under <strong>Request</strong> section, with subject "Additional charges info" and you will get an email with detailed information.</p>
<p>2. Realize your rental payments every month before the 25th to receive your early payment discount, the discount may change without prior notice. </p>
<p>3. You can request your billing information under <strong>Request</strong> section, with the subject "My billing information" and you will get an email with an scaned view of your bills.</p>
</div>';
    require "footer.php";


?>

















<!--
guardando la pagina por si acaso 
 <div id="mainUserContent">
        <div class="userSalut">
            <div class="userName">
                <i>Icon</i> 
                <p>Welcome&nbsp;</p>
                <p id="userName">'.$_SESSION['userName']." ".$_SESSION['userLastName']." ".$_SESSION['contractNum'].'</p>';
            </div>
            <div class="userApartment">
                <p>906-1875 Robson st., V6Z-3C1, Vancouver B.C., Canadá</p>
            </div>
        </div>
        <div class="content">
            <div class="summarize">
                <div class="title">
                    <h4>Summarize</h4>
                    <p class="label">Next payment:</p>
                    <p class="lastMonth">31, January 2020</p>
                </div>
                <table>
                    <tr>
                        <th>Rent:</th>
                        <th>$1200</th>
                    </tr>
                    <tr>
                        <th>BCHydro:</th>
                        <th>$40</th>
                    </tr>
                    <tr>
                        <th>Internet:</th>
                        <th>$90</th>
                    </tr>
                    <tr>
                        <th>Early payment:</th>
                        <th>-$50</th>
                    </tr>
                    <tr>
                        <th>Others:</th>
                        <th>-</th>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <th>$1280</th>
                    </tr>
                </table>
            </div>
            <div class="summarize information">
                <div class="title">
                    <h4>Information</h4>
                    <p class="label">Tenant Information</p>
                </div>
                <table>
                    <tr>
                        <th>Entry Date:</th>
                        <th>Jan 1, 2020</th>
                    </tr>
                    <tr>
                        <th>End of Contract:</th>
                        <th>Jun 30, 2020</th>
                    </tr>
                    <tr>
                        <th>Next Payment Day:</th>
                        <th>Jan 31, 2020</th>
                    </tr>
                    <tr>
                        <th>Damage Deposit:</th>
                        <th>$600</th>
                    </tr>
                    <tr>
                        <th>Early Payment Date:</th>
                        <th>25</th>
                    </tr>
                </table>
            </div>
            </div>
        </div>
        
    </div>


    -->