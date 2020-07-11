<?php
//This code make is the search engine, it runs everytime when the user press the search button
    require "header.php";
    require "search_pannel.php";
            echo '<div id="bodyContent">';
    if(isset($_GET['search-aptos'])){
        $searchType = $_GET['searchAvailable'];
        if($searchType == "allAptos"){
            $sql = $allApartmentsSQL;
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    displayRooms($row);
                }
            }else{
                require 'sorry_message.php';
            }
        }else if($searchType == "thisMonth"){
            $sql = $thisMonthApartments;
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    displayRooms($row);
                }
            }else{
                require 'sorry_message.php';
            }
        }else if($searchType == "fullApto"){
            $sql = $fullApto;
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sqlDetails = 'select *, count(apts_fk) as totalRooms
                    from room
                    where apts_fk ='.$row["apts_fk"].'
                    group by apts_fk;';   
                    $resultDetail = mysqli_query($conn, $sqlDetails);
                    $queryResultsDetails = mysqli_num_rows($resultDetail);
                    if($queryResultsDetails > 0){
                        while($rowDetails = mysqli_fetch_assoc($resultDetail)){
                            displayFullApto($row, $rowDetails);
                        }
                    }
                }
            }else{
                require 'sorry_message.php';
            }
        }
    }

    echo '</div>';
    require "footer.php";

    function displayRooms($results){
        echo '
                    
                    <a href="aptos_content.php?idroom='.$results["room_id"].'" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                                <div class="price">$'.$results["room_price"].'</div>
                            </div>
                            <div class="info">
                                <p class="comments">'.$results["apts_strtNum"]." ".$results["apts_strtName"].' st.</p>
                                <p class="details">'.$results["room_desc"].'</p>';
                                ?>
                                <?php
                                    if((strtotime(date("Y-m-d"))-strtotime($results["ru_endD"]))< 0){
                                        echo '<p id="date">'.date("d M Y", strtotime($results["ru_endD"])).'</p>';
                                    }else{
                                        echo '<p id="date">Now</p>';
                                    }
                                ?>
                                <?php echo '
                                <p class="amount">$'.$results["room_price"].'</p>
                            </div>
                        </div>
                    </a>
                    
                    ';
    }

    function displayFullApto($results, $rowDetails){
        echo '
                    
                    <a href="aptos_content.php?idapto='.$results["apts_id"].'" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                            <!-- Cambiar por el precio del apartamento no por el de cuarto-->
                                <div class="price">$'.$results["apts_price"].'</div>';
                                if($rowDetails["totalRooms"] > 1){
                                    echo '<div class="rooms">'.$rowDetails["totalRooms"].' rooms</div>';
                                }else{
                                    echo '<div class="rooms">'.$rowDetails["totalRooms"].' room</div>';
                                }
                            echo '</div>
                            <div class="info">
                                <p class="comments">'.$results["apts_strtNum"]." ".$results["apts_strtName"].' st.</p>
                                <p class="details">'.$results["apts_shortDesc"].'</p>';
                                ?>
                                <?php
                                    if((strtotime(date("Y-m-d"))-strtotime($results["ru_endD"]))< 0){
                                        echo '<p id="date">'.date("d M Y", strtotime($results["ru_endD"])).'</p>';
                                    }else{
                                        echo '<p id="date">Now</p>';
                                    }
                                ?>
                                <?php echo '
                                <p class="amount">$'.$results["apts_price"].'</p>
                            </div>
                        </div>
                    </a>
                    
                    ';
    }
?>

