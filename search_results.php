<?php
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
                    displayFullApto($row);
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

    function displayFullApto($results){
        echo '
                    
                    <a href="aptos_content.php?idapto='.$results["apts_id"].'" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                            <!-- Cambiar por el precio del apartamento no por el de cuarto-->
                                <div class="price">$aptoresult</div>
                                <div class="rooms">5 rooms</div>
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
?>

