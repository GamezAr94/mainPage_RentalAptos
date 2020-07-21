<?php
    //starting the sessions in all the web pages 
    session_start();
    include 'includes/dbh.inc.php';
    include 'includes/variablesSQL.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- this is the header for the rest of the subpages-->
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/normalize.css">
    <title>Home Sweet Home / Rental Apartments and spaces</title>
</head>

<body>
    <header>
        <div class="centralize">
            <a href="index.php">
                <h1>GZ</h1>
            </a>
            <div id="menu-hamburger" class="burger" onclick="onClickMenu()">
                <div id="bar1" class="bar"></div>
                <div id="bar2" class="bar"></div>
                <div id="bar3" class="bar"></div>
            </div>
            <div id="menu" class="menu hide">
                <nav id="nav">
                    <ul>
                        <?php
                            if(isset($_SESSION['userId'])){
                                echo '<li><a href="user.php">Account</a></li>
                                <li><a href="paymentHistory.php">Payment History</a></li>
                                <li><a href="#">Make Payment</a></li>
                                <li><a href="request.php">Request</a></li>
                                <li class="login"><a onclick="onClickLogin()">Logout</a></li>';
                            }else if(isset($_SESSION['memberId'])){
                                echo '<li><a href="member.php">Account</a></li>
                                <li><a href="paymentHistory.php">Apartments</a></li>
                                <li><a href="#">Rooms</a></li>
                                <li><a href="request.php">Tenants</a></li>
                                <li class="login"><a onclick="onClickLogin()">Logout</a></li>';
                            }else{
                                echo '<li><a href="index.php">Home</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Careers</a></li>
                                <li class="cntct"><a onclick="onClickContact()">Contact</a></li>
                                <li class="login"><a onclick="onClickLogin()">Login</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
                <div id="form-login" class="hiden">
                    <?php
                    //checar si la secion esta iniciada 
                    if(isset($_SESSION['userId']) || isset($_SESSION['memberId'])){
                        echo '<div>Logout</div>';
                        echo '<form action="includes/logout.inc.php" method ="post">
                            <button type="submit" name="logout-submit">Logout</button>
                            </form>';
                        }else{
                            echo '<div>Login</div>';
                            echo '<form action="includes/login.inc.php" method="post">
                            <input type="text" name="mailuid" placeholder="Username/E-mail...">
                            <input type="password" name="pwd" placeholder="Password...">
                            <button type="submit" name="login-submit">Login</button>
                            </form>';
                        }
                    ?>
                    
                    
                </div>
                <div id="contact" class="contact-hiden">
                    <p>Contact us</p>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Name...">
                        <input type="text" name="email" placeholder="Emal...">
                        <input type="text" name="subject" placeholder="Subject...">
                        <textarea name="message"></textarea>
                        <button type="submit" name="send-message">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
            if(!empty($_GET) && !isset($_SESSION['userId']) && !isset($_SESSION['memberId'])){
                if(!empty($_GET['error'])){
                    $popup = $_GET['error'];
                    echo '<div id="error-login">Login error: '.$popup.'</div>';
                }
            }
        ?>
    </header>