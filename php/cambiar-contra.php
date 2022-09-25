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
                    echo "<script>alert('La contraseña se cambió con exito')</script>"; 
                    
                  }
                  //Alerta si el campo del numero de cuenta y del correo estan vacios
                } else if($NCuenta == "" || $Correo == "") {

                  echo "Numero de cuenta o correo no ingresados";

                  //Alerta si el numero de cuenta o el correo no son iguales a los de la base de datos
                } else if(($NCuenta != $row['num_cuenta']) && ($Correo != $row['correo'])) {

                    echo 'numero de cuenta o contraseña incorrectos';

                }

              // $result->close();
                  $conn->close();

              }
             
              
            ?>

<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">      
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
     

      <!----------------------------Cambio Contraseña --------------->

      <section id="profile-banner">
        <div class="container contra-container">
          <div id="myForm">
                <form method="post" action="cambiar-contra.php" class="form-container" enctype="multipart/form-data" target="self">
                  <h1 class="titulo">Cambio de Contraseña</h1>

                  <h6>Para Cambiar su contraseña confirme su Numero de Cuenta y Correo</h6>

                  <label for="numcuenta"><b>Numero de Cuenta</b></label>

                  <input type="text" placeholder="Ingrese Numero de cuenta" name="numcuenta" value="<?php if (isset($_POST['enviar'])){ echo htmlentities($_POST['numcuenta']); } ?>" required>

                  <label for="correo"><b>Correo</b></label>

                  <input type="text" placeholder="Ingrese su Correo" name="correo" value="<?php if (isset($_POST['enviar'])){ echo htmlentities($_POST['correo']); } ?>" required>

                  <label for="Contra1"><b>Nueva Contraseña</b></label>
                  
                  <input type="password" placeholder="Ingrese su nueva Contraseña" name="Contra1" value="<?php if (isset($_POST['enviar'])){ echo htmlentities($_POST['Contra1']); } ?>" required>

                  <button type="submit" name="enviar" value="submit" class="btn">CONFIRMAR</button>
                </div>
        </div>
      </section>

  

      

 
            
              










    
  </body>

    <script src="../js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script>

</html>

