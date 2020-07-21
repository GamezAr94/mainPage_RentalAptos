<?php
    //checa si el boton fue clickeado
    if(isset($_POST['login-submit'])){
        //importa codigo de la base d edatos
        require 'dbh.inc.php';

        //guarda los valores agregados en el form
        $mailuid = $_POST['mailuid'];
        $password = $_POST['pwd'];
        //checar si las variables estan vacias
        if(empty($mailuid) || empty($password)){
            //regresa a la locacion index en este caso con un mensaje (corto)
            header("Location: ../index.php?error=emptyfields");
            exit();
        }else{
           /* $sql = "SELECT *
            FROM room_users
            INNER JOIN users
            ON room_users.users_fk = users.id_users
            WHERE (users.name_users=? OR users.email_users = ?) AND room_users.ru_endD in (
                select MAX(ru_endD)
                from room_users
                group by room_fk)";
                */
                /*$sql = "SELECT *
                FROM room_users
                INNER JOIN users
                ON room_users.users_fk = users.id_users
                WHERE (users.name_users=? OR users.email_users = ?) AND room_users.ru_endD > CURRENT_DATE();";*/
            $sql = "SELECT `id_member`,`name_member`,`lastN_member`,`phone_member`,`email_member`,`pass_member`,true as member
            FROM `member` 
            WHERE member.name_member=? OR member.email_member = ?
            UNION
            SELECT `id_users`,`name_users`,`lastN_users`,`phone_users`,`email_users`,`pass_users`,false as member
            FROM users
            WHERE users.name_users=? OR users.email_users = ?";
            //preparar el statement connection de la base de datos
            $stmt = mysqli_stmt_init($conn);

            //checar si funciona la conexion en la base de datos con el query
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=sqlerror");
                exit();
            }else{
                //pasar los parametros del usuario a la base de datos 
                //para despues compararlos y ver si el nombre o email son correctos
                mysqli_stmt_bind_param($stmt, "ssss", $mailuid, $mailuid, $mailuid, $mailuid);

                //ejecutar el statement
                mysqli_stmt_execute($stmt);

                //guardar toda la info del SELECT
                $result = mysqli_stmt_get_result($stmt);

                //guardar los resultados de la busqueda en rows
                if($row = mysqli_fetch_assoc($result)){
                    //checks if the password ingresed matches with the password in the database
                    //returns true or false
                    //use this method only if the password is hashed (encripted)
                    //$pwdCheck = password_verify($password, $row['pass_users']);

                    if($row['pass_member'] != $password){
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }else if($row['pass_member'] == $password){
                        if($row['member']==0){
                            session_start();
                            $_SESSION['userId'] = $row['id_member'];
                            header("Location: ../user.php?login=success0");
                            exit();
                        /*++++++++++++++CHECA SI EL CONTRATO HA EXPIRADO++++++++++++++++
                        //checa si su contrato aun no ha expirado, de haber expirado no podran acceder 
                        if($row['ru_endD'] >= date("Y-m-d")){
                        //iniciar una session
                        //se crea una variable global que contiene la informacion del usuario
                        session_start();

                        $_SESSION['userId'] = $row['id_users'];
                        //$_SESSION['userUid'] = $row['name_users'];

                        //llevar al usuario al inicio de pantalla con un mensaje exitoso
                        header("Location: ../user.php?login=success");
                        exit();
                        }else{
                            header("Location: ../index.php?error=nocurrentuser".date("Y-m-d").$row['ru_endD']);
                            exit();
                        }*/
                        }else if($row['member'] == 1){
                            $_SESSION['userId'] = $row['id_member'];
                            header("Location: ..?login=success1");
                        }else{

                        }

                    }else{
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }


                }else{
                    header("Location: ../index.php?error=nouser");
                }
            }
        }
    }else{
        header("Location: ../index.php");
    }

?>
