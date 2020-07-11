<?php
//this is the content of the apartaments subpage
    require "header.php";
    if(!empty($_GET)){
        if(!empty($_GET['idroom']) && empty($_GET['idapto'])){
            $idroom = $_GET['idroom'];
            //query to check if the user is not ingressing a invalid room id in the url, a valid id is the room in an apartment with valid contract
            $sql = $displayInfoRooms;
            //preparar el statement connection de la base de datos
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: index.php?error=sqlerror");
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
                                <?php 
                                    //para dividir la descripcion
                                   // $trozos = explode("\n", "HOLA");
                                   echo '</p>
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
                    header("Location: index.php?error=sqlerror");
                    exit();
                }
            }
        }else if(!empty($_GET['idapto']) && empty($_GET['idroom'])){
            $idapto = $_GET['idapto'];
            //query to check if the user is not ingressing a invalid room id in the url, a valid id is the room in an apartment with valid contract
            $sql = "SELECT *
            FROM apartaments
            inner join room
            on room.apts_fk = apartaments.apts_id
            INNER JOIN aptocontract
            on aptocontract.apts_fk = apartaments.apts_id
            left join room_users
            on room_users.room_fk = room.room_id
            where (room_users.ru_endD in (
                            select MAX(ru_endD)
                            from room_users
                            group by room_fk) is null or
                            room_users.ru_endD in (
                            select MAX(ru_endD)
                            from room_users
                            group by room_fk) )
                            AND aptocontract.ac_endD in (
                                                    select MAX(ac_endD)
                                                    FROM aptocontract
                                                    group by apts_fk) AND aptocontract.ac_endD > curdate() AND apartaments.apts_id = ?;";
            //preparar el statement connection de la base de datos
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: index.php?error=sqlerror");
                exit();
            }else{
                //pasar los parametros del usuario a la base de datos 
                //para despues compararlos y ver si el nombre o email son correctos
                mysqli_stmt_bind_param($stmt, "i", $idapto);
                //ejecutar el statement
                mysqli_stmt_execute($stmt);

                //Query to get the number of rooms in this apartment. I can add more queries here
                $result = mysqli_stmt_get_result($stmt);
                $queryResults = mysqli_num_rows($result);
                if($queryResults > 0){
                        $row = mysqli_fetch_assoc($result);

                        $rooms = "select *, count(apts_fk) as total
                        from room
                        where apts_fk = ".$row["apts_fk"]."
                        group by apts_fk;";
                        $totalRoom;
                        $stmtRoom = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmtRoom,$rooms)){
                            header("Location: index.php?error=sqlerrorroom");
                            exit();
                        }else{
                            mysqli_stmt_execute($stmtRoom);
                            $resultRoom = mysqli_stmt_get_result($stmtRoom);
                            $queryResultsRoom = mysqli_num_rows($resultRoom);
                            if($queryResults > 0){
                                $totalRoom = mysqli_fetch_assoc($resultRoom);
                            }
                        }

                        
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
                                    <p>Price: $'.$row["apts_price"].'</p>
                                    <p>Rooms: '.$totalRoom["total"].'</p>
                                    <p>Available: '; ?>
                                <?php
                                    if((strtotime(date("Y-m-d"))-strtotime($row["ru_endD"]))< 0){
                                        echo date("d M Y", strtotime($row["ru_endD"]));
                                    }else{
                                        echo "Now";
                                    }
                                ?>
                                <?php 
                                    //para dividir la descripcion en parrafos
                                   echo '</p>
                                </div>
                                <h5>'.$row["apts_shortDesc"].'</h5>';
                                    $desc = explode("\n", $row["apts_longDesc"]);
                                    for($i = 0; $i < count($desc); ++$i){
                                        echo '<p>'.$desc[$i].'</p>';
                                    }
                                echo '<p class="amenities">Amenities</p>
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
                    header("Location: index.php?error=sqlerror");
                    exit();
                }
            }

        }
    }
?>
<script>
var x = 0;
var imgContainer = document.getElementsByClassName("img-container");

window.onscroll = function() {myFunction()};

function myFunction() {
if(window.innerWidth > 880){
    var info = document.getElementsByClassName("info")[0].offsetHeight;
    console.log(info);
        x = offset = window.pageYOffset;
        if(x < (info-500) && x > 14){
            imgContainer[0].style.marginTop = x +"px";
        }
    }
}
</script>

<?php 

    require "footer.php";

?>