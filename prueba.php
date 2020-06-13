<?php
    require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>

<?php
    require "footer.php";
?>