<?php
    require "header.php";
?>
    <div id="mainUserContent">
        <div class="userSalut">
            <div class="userName">
                <i>Icon</i> 
                <p>Welcome&nbsp;</p>
                <p id="userName">Arturo Gamez.</p>
            </div>
            <div class="userApartment">
                <p>906-1875 Robson st., V6Z-3C1, Vancouver B.C., Canadá</p>
            </div>
        </div>
        <div class="content">
            <div class="summarize">
                <div class="title">
                    <h4>Summarize</h4>
                    <p class="label">Next payment:</p>
                    <p class="lastMonth">31, January 2020</p>
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
                        <th>Others:</th>
                        <th>-</th>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <th>$1280</th>
                    </tr>
                </table>
            </div>
            <div class="summarize information">
                <div class="title">
                    <h4>Information</h4>
                    <p class="label">Tenant Information</p>
                </div>
                <table>
                    <tr>
                        <th>Entry Date:</th>
                        <th>Jan 1, 2020</th>
                    </tr>
                    <tr>
                        <th>End of Contract:</th>
                        <th>Jun 30, 2020</th>
                    </tr>
                    <tr>
                        <th>Next Payment Day:</th>
                        <th>Jan 31, 2020</th>
                    </tr>
                    <tr>
                        <th>Damage Deposit:</th>
                        <th>$600</th>
                    </tr>
                    <tr>
                        <th>Early Payment Date:</th>
                        <th>25</th>
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