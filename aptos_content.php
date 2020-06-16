<?php

    require "header.php";
            $idroom = $_GET['idroom'];

            $sql = "SELECT *
            FROM apartaments
            INNER JOIN room ON apartaments.apts_id = room.apts_fk
            INNER JOIN room_users ON room.room_id = room_users.room_fk
            where room_users.ru_endD in (
                select MAX(ru_endD)
                from room_users
                group by room_fk) AND room.room_id = ?";
            //preparar el statement connection de la base de datos
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ../index.php?error=sqlerror");
                exit();
            }else{
                //pasar los parametros del usuario a la base de datos 
                //para despues compararlos y ver si el nombre o email son correctos
                mysqli_stmt_bind_param($stmt, "i", $idroom);
                //ejecutar el statement
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                $queryResults = mysqli_num_rows($result);
                if($queryResults > 0){
                        $row = mysqli_fetch_assoc($result);
                        echo '
                        <div id="container-info">
                    
                        <div class="content">
                            <div class="img-container">
                                <div class="slideshow-container">
                                    <div class="mySlides fade">
                                        <img src="img/img2.jpg">
                                    </div>
                                    
                                    <div class="mySlides fade">
                                        <img src="img/img1.jpg">
                                    </div>

                                    <div class="mySlides fade">
                                        <img src="img/img3.png">
                                    </div>

                                    <a id="prev" onclick="minusSlides()"><i class="fas fa-chevron-left"></i></a>
                                    <a id="next" onclick="plusSlides()"><i class="fas fa-chevron-right"></i></a>

                                </div>
                            </div>
                            <div class="info">
                                <h3>'.$row["apts_strtNum"].' '.$row["apts_strtName"].'</h3>
                                <div class="details">
                                    <p>Price: $'.$row["room_price"].'</p>
                                    <p>Available: '; ?>
                                <?php
                                    if((strtotime(date("Y-m-d"))-strtotime($row["ru_endD"]))< 0){
                                        echo date("d M Y", strtotime($row["ru_endD"]));
                                    }else{
                                        echo "Now";
                                    }
                                ?>
                                    
                                <?php   echo '</p>
                                </div>
                                <h5>Big room with own tv</h5>
                                <p>
                                    Turpis primis morbi platea cum adipiscing imperdiet. Senectus diam curae; ultrices fringilla. Id inceptos lectus tempus! Nisi eros interdum luctus habitant hendrerit cubilia per eu. Litora nunc semper volutpat nam venenatis sapien sociis blandit porttitor himenaeos. Sapien himenaeos in orci tempor est imperdiet quis libero et sed. Fusce himenaeos nibh aliquam convallis hendrerit. Sagittis a natoque.

                                    Facilisi, interdum id semper potenti ultricies eget? Turpis in scelerisque ultrices cras lectus felis. Dui dictumst duis malesuada massa nec fringilla dictum varius felis. Sociis libero viverra lorem gravida per fusce malesuada libero vehicula erat. Est condimentum aliquam auctor nulla fames mauris. Bibendum tortor sit proin dictum eleifend risus leo morbi.
                                </p>
                                <p class="amenities">Amenities</p>
                                <p>- Ping Pong</p>
                                <p>- Parking</p>
                                <p>- Storage</p>
                                <p>- Laundry in unite</p>
                                <p>- Pet friendly</p>
                            </div>
                        </div>
                        <div class="apply">
                            APPLY ONLYNE NOW 
                        </div>
                    </div>
                        ';
                }else{
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
            }
?>
    

<?php 

    require "footer.php";

?>