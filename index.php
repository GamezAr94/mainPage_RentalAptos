<?php
    require "header.php";
?>


    <div id="banner">
        <div class="img"></div>
    </div>
    <div id="options">
        <form id="form">
            <h2>Availability: </h2>
            <fieldset>
                <div>
                    <label><input type="radio" id="now" name="searchAvailable" value="thisMonth" checked onclick="advancedChecked()">
                        This month</label>
                    <label><input type="radio" id="allAptos" name="searchAvailable" value="allAptos" onclick="advancedChecked()">
                        All apartments</label>
                    <label><input type="radio" id="nextMonth" name="searchAvailable" value="nextMonth" onclick="advancedChecked()">
                        Other month <i>(advanced search)</i></label>
                </div>
            </fieldset>
            <fieldset id="advanced" class="default">
                <h3>Advanced Search: </h3>
                <div>
                    <label>Month: <input type="date" name="mes"></label>
                    <label>Price: <i>(All prices by default)</i><input type="text" name="price" placeholder="700"></label>
                </div>
            </fieldset>
            <button type="submit" name="search-aptos">Search</button>
        </form>
    </div>
    <div id="bodyContent">

        <?php
            $sql = "SELECT *
            FROM apartaments
            INNER JOIN room ON apartaments.apts_id = room.apts_fk
            INNER JOIN room_users ON room.room_id = room_users.room_fk
            where room_users.ru_endD in (
                select MAX(ru_endD)
                from room_users
                group by room_fk)
                ORDER BY room.room_price ASC;";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);

            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    
                    <a href="#" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                                <div class="price">$'.$row["room_price"].'</div>
                            </div>
                            <div class="info">
                                <p class="comments">'.$row["apts_strtNum"]." ".$row["apts_strtName"].' st.</p>
                                <p class="details">'.$row["room_desc"].'</p>
                                <p class="date">'.$row["ru_endD"].'</p>
                                <p class="amount">$'.$row["room_price"].'</p>
                            </div>
                        </div>
                    </a>
                    
                    ';
                }
            }else{
                echo "NADAAA";
            }
        ?>

<!--

<a href="#" class="apto-card">
                        <div class="aptos">
                            <div class="img">
                                <div class="price">$2500</div>
                            </div>
                            <div class="info">
                                <p class="comments">(1875 Robson st.)</p>
                                <p class="details">2 Bedrooms basement suite by Champlain Square for rent</p>
                                <p class="date">Jun 11</p>
                                <p class="amount">$2500</p>
                            </div>
                        </div>
                    </a>
        -->

        
        


    </div>


<?php
    require "footer.php";
?>