<?php
    require "header.php";
?>
    <h1>HOLAAAA</h1>
    <main>
    <?php
    //checar si la secion esta iniciada 
        if(isset($_SESSION['userId'])){
            echo '<p>You are logged in!!!!!!</p>';
            echo $_SESSION['userId'];
            echo $_SESSION['userUid'];
        }else{
            header("Location: index.php?error=session-not-started");
        }
    ?>
    </main>

<?php
    require "footer.php";
?>