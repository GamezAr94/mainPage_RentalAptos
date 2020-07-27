<?php
    require "header.php";
    include "includes/memberSection.inc.php";
    if(!isset($_SESSION['memberId'])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?error=not-session-member");
    }else{
        $_SESSION["totalTenants"] = 0;
        $_SESSION["totalApartments"] = 0;
        $_SESSION['totalPayedApto'] = 0;
        $_SESSION['totalCollected'] = 0;
        $_SESSION['totalReqPendings'] = 0;
    }
?>
<div class="memberBody">
    <div class="salute">
        <i class="<?php
        //date_default_timezone_set('Canada/Pacific');
        if((int)date("H") > 12 && (int)date("H") <= 19){
            echo "fas fa-sun yellow";
        }else if(((int)date("H") > 19) || ((int)date("H") >= 0 && (int)date("H") <= 4)){
            echo "fas fa-cloud-moon blue";
        }else if((int)date("H") > 4 && (int)date("H") <= 12){
        echo "fas fa-coffee orange";
        }else{
            echo "";    
        };?>"></i>
        <p>Welcolme back <?php echo $_SESSION['memberName'];?></p>
    </div>
    <div class="content">
        <div class="section">
            <p>Add Data</p>
        </div>
        <div class="addingMenu">
            <a href="addApartment.php">Add Appartment</a>
            <a href="addRoom.php">Add Room</a>
            <a href="addTenant.php">Add Tenant</a>
        </div>
        <div class="section">
            <?php
                get_tenantInfo($conn);
            ?>
            <p>List of Tenants</p>
            <div class="info">
                <p>Number of Tenanants: <?php echo $_SESSION["totalTenants"]; ?></p>
                <p>Total Collected per Month: $<?php echo $_SESSION["totalCollected"]; ?></p>
            </div>
            <div class="list">
                <table>
                    <tr>
                        <th>Contract Started</th>
                        <th>Contract Ends</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Info</th>
                    </tr>
                    <?php
                    foreach($_SESSION["tenantInfoList"] as $tenant){ 
                        echo '<tr>
                            <td>'.$tenant->cont_start.'</td>
                            <td>'.$tenant->cont_end.'</td>
                            <td><i>'.$tenant->roomTitle."</i> ".$tenant->tenant_address.'</td>
                            <td>'.$tenant->tenant_name.'</td>
                            <td>'.$tenant->tenant_phone.'</td>
                            <td><button>View</button></td>
                        </tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="section"> 
            <?php
                    get_aptoList($conn);
            ?>
            <p>List of apartments</p>
            <div class="info">
                <p>Number of Apartments: <?php echo $_SESSION['totalApartments']; ?></p>
                <p>Total Payed per Month: $<?php echo $_SESSION['totalPayedApto']; ?></p>
            </div>
            <div class="list">
                <table>
                    <tr>
                        <th>Contract Started</th>
                        <th>Contract Ends</th>
                        <th>Rent to Pay per Month</th>
                        <th>Address</th>
                        <th># Rooms</th>
                        <th>Available on</th>
                        <th>Rooms</th>
                    </tr>
                    <?php
                        foreach($_SESSION["aptoInfoList"] as $aptoList){
                            echo '<tr>
                                    <td>'.$aptoList->start_apto.'</td>
                                    <td>'.$aptoList->end_apto.'</td>
                                    <td>$'.$aptoList->rent_apto.'</td>
                                    <td>'.$aptoList->address_apto.'</td>
                                    <td>'.$aptoList->numRooms.'</td>
                                    <td>'.$aptoList->nexAvailable.'</td>
                                    <td><button>View</button></td>
                                </tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
        <div class="section">
            <?php
                get_requestList($conn);
            ?>
            <p>List of Requeriments</p>
            <div class="info">
                <p>Pending Requeriments: <?php echo $_SESSION['totalReqPendings'];?></p>
            </div>
            <div class="list">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Apartment</th>
                        <th>Tenant</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Is Done</th>
                        <th>View</th>
                    </tr>
                    <?php
                        foreach($_SESSION["requestInfoList"] as $requestInfoList){
                            echo '<tr>
                                    <td>'.$requestInfoList->date_req.'</td>
                                    <td><i>'.$requestInfoList->roomTitle."</i> ".$requestInfoList->address_req.'</td>
                                    <td>'.$requestInfoList->tenant_req.'</td>
                                    <td>'.$requestInfoList->type_req.'</td>
                                    <td>'.$requestInfoList->subject_req.'</td>
                                    <td><span>'.$requestInfoList->isDone_req.'</span></td>
                                    <td><button>View</button></td>
                                </tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    require "footer.php";
?> 