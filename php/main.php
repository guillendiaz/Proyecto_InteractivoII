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
                              //$conn->close();

  //Subir Post

//Si se presiona el boton de Listo
  if (isset($_POST['enviar'])){
    //Variable obtenidas de los campos ingresados
    $perfil = $_FILES['perfil']['name'];
    $descripcion = $_POST['descripcion'];
    //$tag = $_POST['tag'];

    //Validacion si el campo perfil o descripcion no estan vacios
    if ($perfil != "" || $descripcion != "") {
        //Obtiene las variables de sesion
        session_start();
        $NombreUsuario = $_SESSION['Nom'];
        $NumeroCuenta = $_SESSION['N_Cuenta'];
        $id = $_SESSION['id'];
        $date = Date('Y-m-d H:i:s.n');

        //Obtiene cuantas posts existen en la tabla de posts en base al ID del usuario
        $query3 = "SELECT count(user_ID) AS count FROM post WHERE user_ID = '$id'";
        $result3 = $conn->query($query3);

        if (!$result3) die("Fatal Error");

        $row2 = $result3->fetch_array(MYSQLI_ASSOC);

        //Contador que se suma uno a la cantidad de posts del usuario
        $count = $row2['count'] + 1;

        //Validacion si la imagen es un jpg o png
        switch ($_FILES['perfil']['type']) {

          case 'image/jpeg':
            $ext = 'jpg';
            break;

          case 'image/png':
            $ext = 'png';
            break;

          default:
            $ext = '';
            break;
        }

        //Asigna la imagen ingresada por el usuario en base a su numero de cuenta a su carpeta de posts
        if ($ext) {
          $n  = $count.".".$ext;
          $destdir = '../Users/'.$NumeroCuenta.'/Posts/';
          move_uploaded_file($_FILES['perfil']['tmp_name'], $destdir.$n);

        }

        //Obtiene el ID en base al numero de cuenta de la tabla de usuarios
        $query2 = "SELECT ID FROM usuarios WHERE num_cuenta = '$NumeroCuenta' ";
        $result2 = $conn->query($query2);

        if (!$result2) die("Fatal Error");

        $row = $result2->fetch_array(MYSQLI_ASSOC);
        $u = $row['ID'];

        //Insercion a la tabla de posts del usuario
        $query = "INSERT INTO post (imagen, descripcion, tag, fecha, user_ID)
                  VALUES" . "('$n','$descripcion','$tag','$date', $u)";

        $result = $conn->query($query);
        if (!$result) die("Fatal Error");

        //Al darle click al boton de listo se redirige a la pantalla principal
        if (isset($_POST['enviar'])){
            ?>
                <script type="text/javascript">
                window.location = "main.html";
                </script>
            <?php
        }

        $result->close();
        $result2->close();
        $conn->close();

    //Validacion de que no se ha podido agregar post a la tabla
    } else {
        echo "Se ha encontrado una falla";
    }
  }




?>