<?php
    require "header.php";
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
<?php
    class tenantList{
        public $cont_start;
        public $cont_end;
        public $tenant_address;
        public $tenant_name;
        public $tenant_phone;
        public $roomTitle = "(Full Apto)";
    }
    function get_tenantInfo($conn) {
        $_SESSION["tenantInfoList"] = array();
        $sql = 'SELECT room_users.room_fk, room_users.ru_rent,CONCAT(`name_users`, " ", `lastN_users`) as fullname, `phone_users`, `ru_startD`, ru_endD, CONCAT(apts_uniNum,"-",apts_strtNum," ", apts_strtName, " st.") AS fullAddress
        FROM `users` 
        LEFT JOIN room_users
        ON users.id_users = room_users.users_fk
        LEFT JOIN apartaments
        ON room_users.apto_fk = apartaments.apts_id
        WHERE room_users.ru_startD < CURRENT_DATE() AND room_users.ru_endD > CURRENT_DATE();';
        $result = mysqli_query($conn,$sql);
        $queryResults = mysqli_num_rows($result);
        if($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tenant = new tenantList;
                $_SESSION["totalTenants"] += 1;
                $_SESSION['totalCollected'] += $row['ru_rent'];
                $tenant->cont_start = date("d M Y", strtotime($row['ru_startD']));
                $tenant->cont_end = date("d M Y", strtotime($row['ru_endD']));
                $tenant->tenant_address = $row['fullAddress'];
                $tenant->tenant_name = $row['fullname'];
                $tenant->tenant_phone = $row['phone_users'];
                if(isset($row['room_fk'])){
                    $sqlRoomTitle = 'SELECT room.room_title
                                    FROM room_users
                                    LEFT JOIN room
                                    ON room.room_id = room_users.room_fk
                                    WHERE room.room_id ='.$row['room_fk'].';';
                    $resultTitle = mysqli_query($conn, $sqlRoomTitle);
                    $queryResultsTitle = mysqli_num_rows($resultTitle);
                    if($queryResultsTitle > 0){
                        while($rowTitle = mysqli_fetch_assoc($resultTitle)){
                            $tenant->roomTitle = "(".$rowTitle['room_title']." Room)";
                        }
                    }
                }
                array_push($_SESSION["tenantInfoList"], $tenant);
            }
        }else{
            //header("Location: index.php?error=apto-request-sql");
        }
    }

    class requesList{
        public $id_req;
        public $date_req;
        public $address_req;
        public $tenant_req;
        public $type_req;
        public $subject_req;
        public $isDone_req;
        public $roomTitle = "(Full Apto)";
    }
    function get_requestList($conn){
        $_SESSION["requestInfoList"] = array();
        $sql='SELECT room_users.room_fk, `request_id`,`request_date`,`request_type`,`request_subject`, `isDone_req`, CONCAT(apartaments.apts_uniNum, "-", apartaments.apts_strtNum, " ", apartaments.apts_strtName, " st.") as fullAddress, CONCAT(users.name_users, " ", users.lastN_users) AS fullName
        FROM `request`
        LEFT JOIN room_users
        ON  room_users.ro_us = request.ro_us_fk
        LEFT JOIN apartaments 
        ON apartaments.apts_id = room_users.apto_fk
        LEFT JOIN users
        ON users.id_users = room_users.users_fk
        WHERE request.isDone_req = 0
        ORDER BY request.request_date AND request.isDone_req
        LIMIT 150;';
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);
        if($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){
                $request = new requesList;
                $request->id_req = $row['request_id'];
                $request->date_req = date('h:ia d-M-Y', strtotime($row['request_date']));
                $request->address_req = $row['fullAddress'];
                $request->tenant_req = $row['fullName'];
                $request->type_req = $row['request_type'];
                $request->subject_req = substr($row['request_subject'], 0, 60);
                $row['isDone_req'] == 0?$request->isDone_req = "&#9744;":$request->isDone_req = "&#9745;";
                if($row['isDone_req']==0){
                    $_SESSION['totalReqPendings']+=1;
                }
                if(isset($row['room_fk'])){
                    $sqlRoomTitle = 'SELECT room.room_title
                                    FROM room_users
                                    LEFT JOIN room
                                    ON room.room_id = room_users.room_fk
                                    WHERE room.room_id ='.$row['room_fk'].';';
                    $resultTitle = mysqli_query($conn, $sqlRoomTitle);
                    $queryResultsTitle = mysqli_num_rows($resultTitle);
                    if($queryResultsTitle > 0){
                        while($rowTitle = mysqli_fetch_assoc($resultTitle)){
                            $request->roomTitle = "(".$rowTitle['room_title']." Room)";
                        }
                    }
                }
                array_push($_SESSION["requestInfoList"], $request);
            }
        }else{

        }
    }

    class apartmentList{
        public $id_apto;
        public $rent_apto;
        public $start_apto;
        public $end_apto;
        public $numRooms;
        public $address_apto;
        public $nexAvailable;
    }
    function get_aptoList($conn){
        $_SESSION['aptoInfoList'] = array();
        $sql = 'SELECT aptocontract.ac_rent, apartaments.apts_id, CONCAT(apts_uniNum,"-",apts_strtNum," ", apts_strtName, " st. ", apts_postCode) AS address, ac_startD, ac_endD, COUNT(room.apts_fk) as numRooms
                FROM apartaments
                LEFT JOIN aptocontract
                on aptocontract.apts_fk = apartaments.apts_id
                LEFT JOIN room
                ON room.apts_fk = apartaments.apts_id
                WHERE aptocontract.ac_startD < CURRENT_DATE() AND aptocontract.ac_endD > CURRENT_DATE()
                GROUP BY apartaments.apts_id';
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);
        if($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){
                $apto = new apartmentList;
                $_SESSION["totalApartments"] += 1;
                $apto->id_apto = $row['apts_id'];
                $apto->rent_apto = $row['ac_rent'];
                $_SESSION['totalPayedApto'] += $apto->rent_apto;
                $apto->start_apto = date("d M Y", strtotime($row['ac_startD']));
                $apto->end_apto = date("d M Y", strtotime($row['ac_endD']));
                $apto->address_apto = $row['address'];
                $apto->numRooms = $row['numRooms'];
                $sqlMaxDate = "SELECT MAX(`ru_endD`) AS maxDate
                FROM `room_users`
                WHERE apto_fk =".$row['apts_id'].";";
                $resultDate = mysqli_query($conn, $sqlMaxDate);
                $queryResultsDate = mysqli_num_rows($resultDate);
                if($queryResultsDate > 0){
                    while($rowDate = mysqli_fetch_assoc($resultDate)){
                        if(strtotime($rowDate['maxDate']) > strtotime(date("Y-M-d"))){
                            $apto->nexAvailable = date("d M Y", strtotime($rowDate['maxDate']));
                        }else{
                            $apto->nexAvailable = "Now";
                        }
                    }
                }
                array_push($_SESSION['aptoInfoList'],$apto);
            }
        }else{

        }
    }
?>