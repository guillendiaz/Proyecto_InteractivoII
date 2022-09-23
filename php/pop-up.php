<?php
              //metodo para cambiar contraseña
              if (isset($_POST['enviar'])) {
                require_once 'login.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error) die("Error en Conexion");

                $NCuenta =  $_POST['numcuenta'];
                $Correo =  $_POST['correo'];
                $ContraNueva = $_POST['Contra1'];


                //recuperacion de el usuario a base del numero de cuenta y correo
                $query = "SELECT ID , num_cuenta, correo FROM usuarios WHERE num_cuenta = '$NCuenta' && correo = '$Correo' ";
                $result = $conn->query($query);

                if (!$result) die("Fatal Error");
                $row = $result->fetch_array(MYSQLI_ASSOC);

                //comparacion si valores son los correctos
                if (($NCuenta != "" && $Correo != "") && (($NCuenta == $row['num_cuenta']) && ($Correo == $row['correo']))) {
                  $id = $row['ID'];
                  $query = "UPDATE usuarios SET contrasenia='$ContraNueva' WHERE ID = '$id'";
                  $result = $conn->query($query);
                  if (isset($_POST['enviar'])) {

                    //echo 'contraseña cambiada';
                    echo "<script>alert('Welcome to Geeks for Geeks')</script>"; 
                    
                  }
                  //Alerta si el campo del numero de cuenta y del correo estan vacios
                } else if($NCuenta == "" || $Correo == "") {

                  echo "Numero de cuenta o correo no ingresados";

                  //Alerta si el numero de cuenta o el correo no son iguales a los de la base de datos
                } else if(($NCuenta != $row['num_cuenta']) && ($Correo != $row['correo'])) {

                    echo 'numero de cuenta o contraseña incorrectos';

                }

              // $result->close();
              // header(Location: ../pop-ups.html);
                  $conn->close();
                  //include( "../pop-ups.html");

              }
             
              
            ?>