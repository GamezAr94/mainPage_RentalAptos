<?php
    require "header.php";
    if(!isset($_SESSION['memberId'])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?error=not-session-member");
    }else{
    }
?>
<div class="memberBody">
    <div class="salute">
        <i class="<?php
        date_default_timezone_set('Canada/Pacific');
        if((int)date("H") > 12 && (int)date("H") <= 19){
            echo "fas fa-sun yellow";
        }else if(((int)date("H") > 19) || ((int)date("H") >= 0 && (int)date("H") <= 4)){
            echo "fas fa-cloud-moon blue";
        }else if((int)date("H") > 4 && (int)date("H") <= 12){
        echo "fas fa-coffee orange";
        }else{
            echo "";    
        }?>"></i>
        <p>Welcolme back <?php echo $_SESSION['memberName'];?></p>
    </div>
    <div class="content">
        <div class="section">
            <p>List of Tenants</p>
            <div class="list">
                <table>
                    <tr>
                        <th>Contract Start</th>
                        <th>Contract End</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Info</th>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st., V6Z 3C1</td>
                        <td>Arturo Gamez O.</td>
                        <td>236886</td>
                        <td><button>View</button></td>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st., V6Z 3C1</td>
                        <td>Arturo Gamez O.</td>
                        <td>236886</td>
                        <td><button>View</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="section">
            <p>List of apartments</p>
            <div class="list">
                <table>
                    <tr>
                        <th>Contract Start</th>
                        <th>Contract End</th>
                        <th>Address</th>
                        <th># Rooms</th>
                        <th>Edit</th>
                        <th>Rooms</th>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st., V6Z 3C1</td>
                        <td>3</td>
                        <td><button>Edit</button></td>
                        <td><button>Rooms</button></td>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st</td>
                        <td>3</td>
                        <td><button>Edit</button></td>
                        <td><button>Rooms</button></td>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st</td>
                        <td>3</td>
                        <td><button>Edit</button></td>
                        <td><button>Rooms</button></td>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st</td>
                        <td>3</td>
                        <td><button>Edit</button></td>
                        <td><button>Rooms</button></td>
                    </tr>
                    <tr>
                        <td>5-jul-2019</td>
                        <td>5-jul-2020</td>
                        <td>906-1875 Robson st</td>
                        <td>3</td>
                        <td><button>Edit</button></td>
                        <td><button>Rooms</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="section">
            <p>List of Requeriments</p>
            <div class="list">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Apartment</th>
                        <th>Tenant</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Is Done</th>
                        <th>View</th>
                    </tr>
                    <tr>
                        <td>5-jul-2019 20:04</td>
                        <td>906-1875 Robson st., V6Z 3C1</td>
                        <td>Arturo Gamez O.</td>
                        <td>Cleaning</td>
                        <td>Clean Apartment</td>
                        <td><span>&#9744;</span></td>
                        <td><button>View</button></td>
                    </tr>
                    <tr>
                        <td>5-jul-2019 5:32</td>
                        <td>906-1875 Robson st., V6Z 3C1</td>
                        <td>Arturo Gamez O.</td>
                        <td>Cleaning</td>
                        <td>Clean Apartment</td>
                        <td><span>&#9745;</span></td>
                        <td><button>View</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    require "footer.php";
?>