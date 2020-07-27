
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