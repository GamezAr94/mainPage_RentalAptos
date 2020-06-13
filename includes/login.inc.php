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
            $sql = "SELECT *
                    FROM users
                    WHERE name_users=? OR email_users = ?;";
            //preparar el statement connection de la base de datos
            $stmt = mysqli_stmt_init($conn);

            //checar si funciona la conexion en la base de datos con el query
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=sqlerror");
                exit();
            }else{
                //pasar los parametros del usuario a la base de datos 
                //para despues compararlos y ver si el nombre o email son correctos
                mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);

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

                    if($row['pass_users'] != $password){
                        header("Location: ../index.php?error=wrongpasswordd");
                        exit();
                    }else if($row['pass_users'] == $password){
                        //iniciar una session
                        //se crea una variable global que contiene la informacion del usuario
                        session_start();

                        $_SESSION['userId'] = $row['id_users'];
                        $_SESSION['userUid'] = $row['name_users'];

                        //llevar al usuario al inicio de pantalla con un mensaje exitoso
                        header("Location: ../prueba.php?login=success");
                        exit();
                    }else{
                        header("Location: ../index.php?error=wrongpassword");
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