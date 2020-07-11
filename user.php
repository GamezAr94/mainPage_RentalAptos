<?php
    require "header.php";
?>
    <div id="mainUserContent">
        <div class="userSalut"><i>Icon</i> <p>Welcolme&nbsp;</p><p id="userName">Arturo Gamez.</p></div>
        <div class="content">
            <div class="summarize">
                <div class="title">
                    <h4>Summarize</h4>
                    <p class="label">Last payment:</p>
                    <p class="lastMonth">15, January 2020</p>
                </div>
                <table>
                    <tr>
                        <th>Rent:</th>
                        <th>$1200</th>
                    </tr>
                    <tr>
                        <th>BCHydro:</th>
                        <th>$40</th>
                    </tr>
                    <tr>
                        <th>Internet:</th>
                        <th>$90</th>
                    </tr>
                    <tr>
                        <th>Early payment:</th>
                        <th>-$50</th>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <th>$1280</th>
                    </tr>
                </table>
            </div>
            <div class="generalInfo">
            <div class="summarize">
                <div class="title">
                    <h4>Information</h4>
                </div>
                <table>
                    <tr>
                        <th>Rent:</th>
                        <th>$1200</th>
                    </tr>
                    <tr>
                        <th>BCHydro:</th>
                        <th>$40</th>
                    </tr>
                    <tr>
                        <th>Internet:</th>
                        <th>$90</th>
                    </tr>
                    <tr>
                        <th>Early payment:</th>
                        <th>-$50</th>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <th>$1280</th>
                    </tr>
                </table>
            </div>
            </div>
        </div>
        
    </div>


<!--
    <h1>HOLAAAA</h1>
    <main>
    <?php
    //checar si la secion esta iniciada 
        /*
        if(isset($_SESSION['userId'])){
            echo '<p>You are logged in!!!!!!</p>';
            echo $_SESSION['userId'];
            echo $_SESSION['userUid'];
        }else{
            header("Location: index.php?error=session-not-started");
        }
        */
    ?>
    </main>
    -->
<?php
    require "footer.php";
?>