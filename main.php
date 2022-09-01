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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">



    <title>AnimationStudents</title>
</head>
<body>
    <!--------------------------------------------Sidebar----------------------------------------->
        <nav>
            <ul>
                <li>
                    <a href="main.html" class="logo-sidebar">
                        <img src="images/unitec_mini.png" class="img-fluid logo-unitec" alt="unitec_mini">
                    </a>
                </li>
                <li>
                    <a href="perfil.html" class="logo">
                         <img src="<?php echo $fileSRC;?>" class="img-fluid">
                         <span class="nav-item"><h4><?php echo $Nombre." ".$Apellido;?></h4></span>
                    </a>
                </li>
                <li><a href="#" class="icon-sidebar">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Home</span>
                </a></li>
                <li><a href="#" class="icon-sidebar">
                    <i class="fas fa-calendar"></i>
                    <span class="nav-item">Calendario</span>
                </a></li>
                <li><a href="#" id="publicacionBTN" class="icon-sidebar">
                    <i class="fas fa-plus"></i>
                    <span class="nav-item">Agregar publicacion</span>
                </a></li>
                <li><a href="#" class="icon-sidebar log-out" onclick="botonSalir()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Cerrar Sesion</span>
                </a></li>
            </ul>
        </nav>

        <!---------------------------------------Menu derecha--------------------------------------------->

        <section id="menu-derecha">

            <div class="container-fluid sugerencias">
                    <div class="container-fluid sugerencias-user">
                    <h1 class="subtitulo">Sugerencias para ti</h1>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">Nombre Generico</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">Nombre Generico</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">Nombre Generico</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">Nombre Generico</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                </div>
                <div class="container-fluid explora-tags">
                    <h1 class="subtitulo">Explora tags</h1>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">#Modelado3d</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">#Dibujo</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">#Animacion</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                    <div class="row">
                        <article class="col-md-6 col-sm-12">
                            <h2 class="subtitulo-2">#Ilustracion</h2>
                        </article>
                        <article class="col-md-6 col-sm-12">
                            <button class="btn btn-azul">Seguir</button>
                        </article>
                    </div>
                </div>
            </div>

        </section>

        <!--Pop up de botonSalir -->
        <div id="ventanaSalir" class="modal" style="display: none;">
            <div class="contenidoSalir">
                <h4>¿Estás seguro que quieres cerrar sesión?</h4>
                <div class="opcionesSalir">
                    <a href="index.php" class="botonSi">SI</a>
                    <a onclick="botonSalir()" href="#" class="botonNo">NO</a>
            </div>
            </div>
        </div>

        <!--Pop UP Publicacion-->
        <div id="myModal" class="modal">
            <div id="ventanaPublicar">
                <div class="content">
                    <div class="container">

                         <!--Titulo de Nueva Publicación-->
                        <div id="tituloNuevaPub" class="borde">
                            <h1>Nueva Publicación</h1>

                            <!--X de cierre-->
                            <span class="xCerrar"><i class="fas fa-times"></i></span>
                        </div>

                        <div class="agregarArchivo borde">

                            <!--Seleccion de Archivos a Publicar-->
                             <div>
                                <p>Seleccione un archivo de foto, video o pdf para publicar.</p>
                            </div>
                            <div class="seleccionados">
                                <img class="imgPublicar" src="images/ejemplo1.png" alt="placeholder">
                                <img class="imgPublicar" src="images/ejemplo2.png" alt="placeholder">

                                <!--BOTON de SELECCIONAR Archivos-->
                                <button class="seleccionarArchivo">
                                        <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>

                        <div class="borde descripcionInput">

                            <!--Input de DESCRIPCION del Post-->
                            <input type="text" name="Descripción" placeholder="Descripción...">

                            <!--EMOTES-->
                            <div class="emotes">
                                <span class="smile">&#128512;</span>
                                <span class="emotesrow"><i class="fas fa-heart"></i> <i class="fas fa-thumbs-up"></i>&#128562;&#128518;</span>
                            </div>
                        </div>

                        <div class="publicarCancelar">

                            <!--Botones para PUBLICAR o CANCELAR el post-->
                            <input href="#" type="submit" value="Cancelar" class="btn-red cerrar">
                            <input href="#" type="submit" value="Publicar" class="btn-blue">
                        </div>
                    </div>
                </div>
             </div>
        </div>


        <section id="columnacentral">


            <!----------------------Barra de Busqueda----------------------->
            <div class="container-fluid">
                <div class="busqueda">
                    <input id="taskInput" type="text" placeholder="Buscar...">
                </div>
            </div>

            <!----------------------------------------Historias------------------------------------------>

            <section id="historias">

                   <div class="container-fluid">
                       <div class="container text-center">
                           <div class="row mx-auto my-auto justify-content-center">
                               <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                                   <div class="carousel-inner" role="listbox">
                                       <div class="carousel-item active">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 1</div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="carousel-item">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 2</div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="carousel-item">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 3</div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="carousel-item">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 4</div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="carousel-item">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 5</div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="carousel-item">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 6</div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="carousel-item">
                                           <div class="col-md-3">
                                               <div class="card">
                                                   <div class="card-img">
                                                       <img src="images/schmebulok.jpg" class="img-fluid">
                                                   </div>
                                                   <div class="card-img-overlay">Slide 7</div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="prev">
                                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   </a>
                                   <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button" data-bs-slide="next">
                                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   </a>
                               </div>
                           </div>
                       </div>
                   </div>

              </section>



        <!---------------------------------------------------Feed-------------------------------------------------->
               <section id="feed">

                    <!--Botones TODOS y SEGUIDOS-->
                            <button class="btn btn-dark"><a data-toggle="pill" href="#todosTab">Todos</a></button>
                            <button class="btn btn-light"><a data-toggle="pill" href="#siguiendoTab">Siguiendo</a></button>

                        <!-------------------------------Publicacion----------------------------------->


                        <?php
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
                              $fotoU = $rowF['foto'];

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

                              echo "<div class='container publicacion'>
                                      <div class='row post-header'>
                                        <article class='col-2'>
                                          <img src='$fileSRC' class='img-fluid post-profile' alt='Profile-user'>
                                            </article>
                                            <article class='col-10'>
                                              <h1 class='titulo'>$Nombre $Apellido</h1>
                                              <p>$descripcion</p>
                                            </article>
                                            </div>
                                            <div class='post-img'>
                                              <img src='$imgPost' class='contenidoImg' width='100%' height='100%'>
                                            </div>

                                            <div class='container post-comments'>
                                              <i class='fas fa-heart'></i> <p>reacciones</p> <i class='fas fa-thumbs-up'></i> <p>comments</p>
                                            </div>
                                          </div>";

                      }

                      $conn->close();
                      ?>
  <!--                  <div class="container publicacion">
                            <div class="row post-header">
                                <article class="col-2">
                                    <img src="images/baba.jpg" class="img-fluid post-profile" alt="Profile-user">
                                </article>
                                <article class="col-10">
                                        <h1 class="titulo">Nombre Generico</h1>
                                        <p>Aqui va el texto para el post #blessed #GOAT</p>
                                </article>
                            </div>
                            <div class="post-img">
                                <img src="">
                            </div>

                            <div class="container post-comments">
                                <i class="fas fa-heart"></i> <p>reacciones</p> <i class="fas fa-thumbs-up"></i> <p>comments</p>
                            </div>
                        </div>

                       <div class="container publicacion">
                            <div class="row post-header">
                                <article class="col-2">
                                    <img src="images/baba.jpg" class="img-fluid post-profile" alt="Profile-user">
                                </article>
                                <article class="col-10">
                                        <h1 class="titulo">Nombre Generico</h1>
                                        <p>Aqui va el texto para el post #blessed #GOAT</p>
                                </article>
                            </div>
                            <div class="post-img">
                                <img src="">
                            </div>

                            <div class="container post-comments">
                                <i class="fas fa-heart"></i> <p>reacciones</p> <i class="fas fa-thumbs-up"></i> <p>comments</p>
                            </div>
                        </div> -->


               </section>
            </section>




    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
