<?php
    require "header.php";
    require "search_pannel.php";
    
    if(isset($_GET['search-aptos'])){
        $searchType = $_GET['searchAvailable'];
        if($searchType == "allAptos"){
            $sql = $allApartmentsSQL;
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            echo '<div id="bodyContent">';
            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    displayApartments($row);
                }
            }else{
                header("Location: index.php?error=pagenotfound");
                //Sorry at the moment we dont have available apartments
            }
        }else if($searchType == "thisMonth"){
            $sql = $thisMonthApartments;
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            echo '<div id="bodyContent">';
            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    displayApartments($row);
                }
            }else{
                echo "Sorry for the inconvenient, We don't have apartments at the moment";
                //Sorry at the moment we dont have available apartments
            }
        }
    }

    echo '</div>';
    require "footer.php";

    function displayApartments($results){
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
?>

