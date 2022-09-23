<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die("Error en Conexion");

  //Recuperacion de los valores de sesion
  session_start();
  $id = $_SESSION['id'];
  $NumeroCuenta = $_SESSION['N_Cuenta'];
  $Nombre = $_SESSION['Nom'];
  $Apellido = $_SESSION['Apel'];

  //Validacion de la tabla perfil en base al ID del usuario
  $queryS = "SELECT foto, user_ID FROM perfil WHERE user_ID = '$id'";
  $resultS = $conn->query($queryS);

  if (!$resultS) die("Fatal Error");
  $rowS = $resultS->fetch_array(MYSQLI_ASSOC);

  //Recuperacion de las variables de foto y el ID
  $fotoU = $rowS['foto'];
  $uID = $rowS['user_ID'];

  //Link de busqueda a la foto de perfil del usuario
  $fileSRC = "Users/".$NumeroCuenta."/".$fotoU;



  //Control del Contador de Filas en la tabla del la Base de DATOS
                            $queryC = "SELECT imagen,descripcion,tag,user_ID FROM post";
                            $resultC = $conn->query($queryC);
                            if (!$resultC) die("Fatal Error");

                            $count = $resultC->num_rows;
                            for ($i = 0; $i < $count; $i++) {
                              //Control del FOR Loop
                              $row = $resultC->fetch_array(MYSQLI_ASSOC);
                              $uD = $row['user_ID'];

                              //Agarrar Imagen de Tabla perfil
                              $query3 = "SELECT foto FROM perfil WHERE user_ID = '$uD'";
                              $result3 = $conn->query($query3);
                              if (!$result3) die("Fatal Error");
                              $rowF = $result3->fetch_array(MYSQLI_ASSOC);
                              //$fotoU = $rowF['foto'];

                              //Agarrar nombre apellido y numero de cuenta de tabla de usuarios
                              $query2 = "SELECT nombre, apellido, num_cuenta FROM usuarios WHERE ID = '$uD'";
                              $result2 = $conn->query($query2);
                              if (!$result2) die("Fatal Error");
                              $rowN = $result2->fetch_array(MYSQLI_ASSOC);

                              //Variables
                              $Nombre2 = $rowN['nombre'];
                              $Apellido2 = $rowN['apellido'];
                              $numC = $rowN['num_cuenta'];
                              $imagen = $row['imagen'];
                              $descripcion = $row['descripcion'];

                              //Direccion de Imagen (IMPORTANTE)
                              $imgUser = "Users/".$numC."/".$fotoU;
                              $imgPost = "Users/".$numC."/Posts/".$imagen;

                               }
                              $conn->close();



?>