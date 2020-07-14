<?php
    require "header.php";
    require "search_pannel.php";
?>
<!--this is the body content of the min page-->
    <div id="bodyContent">


    <?php 
            $sql = $allApartmentsSQL;
            
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);

            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    
                    <a href="aptos_content.php?idroom='.$row["room_id"].'" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                                <div class="price">$'.$row["room_price"].'</div>
                            </div>
                            <div class="info">
                                <p class="comments">'.$row["apts_strtNum"]." ".$row["apts_strtName"].' st.</p>
                                <p class="details">('.$row["room_title"].") ".$row["room_desc"].'</p>';
                                ?>
                                <?php
                                    if((strtotime(date("Y-m-d"))-strtotime($row["ru_endD"]))< 0){
                                        echo '<p id="date">'.date("d M Y", strtotime($row["ru_endD"])).'</p>';
                                    }else{
                                        echo '<p id="date">Now</p>';
                                    }
                                ?>
                                <?php echo '
                                <p class="amount">$'.$row["room_price"].'</p>
                            </div>
                        </div>
                    </a>
                    
                    ';
                }
            }else{
                require 'sorry_message.php';
            }
        ?>



        <?php /*
            $sql = $allApartmentsSQL;
            
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);

            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    
                    <a href="aptos_content.php?idroom='.$row["room_id"].'" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                                <div class="price">$'.$row["room_price"].'</div>
                            </div>
                            <div class="info">
                                <p class="comments">'.$row["apts_strtNum"]." ".$row["apts_strtName"].' st.</p>
                                <p class="details">'.$row["room_desc"].'</p>';
                                ?>
                                <?php
                                    if((strtotime(date("Y-m-d"))-strtotime($row["ru_endD"]))< 0){
                                        echo '<p id="date">'.date("d M Y", strtotime($row["ru_endD"])).'</p>';
                                    }else{
                                        echo '<p id="date">Now</p>';
                                    }
                                ?>
                                <?php echo '
                                <p class="amount">$'.$row["room_price"].'</p>
                            </div>
                        </div>
                    </a>
                    
                    ';
                }
            }else{
                require 'sorry_message.php';
            }
        */?>
    </div>


<?php
    require "footer.php";
?>