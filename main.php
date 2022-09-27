<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'includes/funciones.inc.php';
require_once 'includes/dbh.inc.php';

$sql = "SELECT imgId FROM historias ORDER BY imgId DESC";
$result = mysqli_query($conn, $sql);

$sqlpost = "SELECT ID, descripcion FROM posts ORDER BY ID DESC";
$resultpost = mysqli_query($conn, $sqlpost);

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">




    <title>AnimationStudents</title>
</head>
<body>
    <!--------------------------------------------Sidebar----------------------------------------->
        <nav id="navbar-side">
            <ul>
                <li>
                    <a href="main.html" class="logo-sidebar">
                        <img src="images/unitec_mini.png" class="img-fluid logo-unitec" alt="unitec_mini">
                    </a>
                </li>
                <li class="nav-1">
                    <a href="perfil.html" class="logo">
                         <img src="<?php echo $fileSRC;?>" class="img-fluid">
                         <span class="nav-item"><?php echo $_SESSION['Nom']." ".$_SESSION['Apel'];?></span>
                    </a>
                </li>
                <li class="nav-2"><a href="main.html" class="icon-sidebar">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Home</span>
                </a></li>
                <li class="nav-3"><a href="insbloppost.php" class="icon-sidebar">
                    <i class="fas fa-calendar "></i>
                    <span class="nav-item">Calendario</span>
                </a></li>
                <li class="nav-4">
                	<!--BOTON PARA MODAL SUBIR PUBLICACION -->
                	<a href="#" type="button" data-toggle="modal" data-target="#subir-publicacion" class="icon-sidebar">
                    <i class="fas fa-plus"></i>
                    <span class="nav-item">Agregar publicacion</span>
                	</a>
            	</li>
                <li class="nav-4">
                	<a href="#" type="button" data-toggle="modal" data-target="#subir-historia" class="icon-sidebar">
                    <i class="fas fa-plus"></i>
                    <span class="nav-item">Subir Historia</span>
                	</a>
                </li>
                <li class="nav-5"><a href="#" class="icon-sidebar log-out" onclick="botonSalir()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Cerrar Sesion</span>
                </a></li>
            </ul>
        </nav>








        <!--Pop up de botonSalir -->
        <div id="ventanaSalir" class="modal container-fluid" style="display: none;">
            <div class="contenidoSalir">
                <h4>¿Estás seguro que quieres cerrar sesión?</h4>
                <div class="opcionesSalir">
                    <a href="Registro.html" class="botonSi">SI</a>
                    <a onclick="botonSalir()" href="#" class="botonNo">NO</a>
            </div>
            </div>
        </div>


        <!-- POP UP PUBLICACION NUEVO-->

        <div class="modal fade" id="subir-publicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

			<div class="modal-dialog m-container" role="document">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="ion-ios-close"><i class="fas fa-times"></i></span>
				  </button>

					<div class="modal-content m-content">
					    <div class="modal-body p-4 p-md-5">


					    	<form method="post" action="insbloppost.php" class="form-container" enctype="multipart/form-data">
			                    <div class="container subir-img">
			                        <h1 class="titulo">Subir imagen</h1>
			                            <div class="container upload-container">
				                              <input type="file" name="postImage" class="uploadFile" value="Upload Photo">
			                        	</div>
			                    </div>
			                    <div class="container post-descripcion">
			                        <label for="descripcion"><b>Descripción del post</b></label>
			                        <br>
			                        <textarea name="descripcion" rows="5" cols="30"></textarea>
			                        <br>
			                        <button type="submit" name="submit" value="submit" class="btn btn-blue">Listo</button>
			                        <input href="#" type="submit" data-dismiss="modal" aria-label="Close" value="Cancelar" class="btn-red cerrar">
			                    </div>
              				</form>

			            </div>
				    </div>
			</div>
		</div>


		 <!-- POP UP HISTORIA NUEVO-->

        <div class="modal fade" id="subir-historia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

			<div class="modal-dialog m-container" role="document">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="ion-ios-close"><i class="fas fa-times"></i></span>
				  </button>

					<div class="modal-content m-content">
					    <div class="modal-body p-4 p-md-5">


                        <div class="container">
                            <h1 class="titulo">Nueva Historia</h1>
                        </div>

                        <div class="container">

                             <div class="container">
                                <p>Seleccione un archivo de foto.</p>
                            </div>
                            <div class="seleccionados">

                                <!--BOTON de SELECCIONAR Archivos-->


                                <form name="frmImage" enctype="multipart/form-data" action="inserthistoria.php"
                                  method="post" class="frmImageUpload">
                                  <label>Subir Archivo de Imagen:</label><br>
                                  <input name="userImage" type="file" class="inputFile">
                                  <input type="submit" value="Submit" class="btnSubmit" />
                                </form>
                            </div>
                        </div>



                        <div class="publicarCancelar">

                            <!--Botones para PUBLICAR o CANCELAR el post-->

                          

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
              <div class="carousel">
                <div class="carousel-cell">
                    <img src="images/baba.jpg" class="img-fluid hfoto" alt="historia">
                </div>
                <div class="carousel-cell">
                    <img src="images/1.png" alt="historia">
                     <div class="pfoto"><img src="images/Haslin.png" class="img-fluid" alt="gay"></div>
                </div>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="carousel-cell"><img src="imgvista.php?image_id=<?php echo $row["imgId"]; ?>" class="img-fluid"></div>
                <?php
                }
                mysqli_close($conn);
                ?>
              </div>

               </section>



        <!---------------------------------------------------Feed-------------------------------------------------->
               <section id="feed">

                        <!-------------------------------Publicacion----------------------------------->

                        <?php
                        while ($row = mysqli_fetch_array($resultpost)) {
                        ?>
                        <div class="container publicacion">
                            <div class="row post-header">
                                <article class="col-2">
                                    <img src="images/baba.jpg" class="img-fluid post-profile" alt="Profile-user">
                                </article>
                                <article class="col-10 container-fluid">
                                        <h1 class="titulo"><?php echo $_SESSION['Nom'].' '.$_SESSION['Apel']; ?></h1>
                                        <p><?php echo $row['descripcion']; ?></p>
                                </article>
                            </div>
                            <div class="post-img">
                                <img src="imgvistapost.php?image_id=<?php echo $row["ID"]; ?>" class="img-fluid">
                            </div>

                              <div class="container post-comments">

                                <i class="fas fa-thumbs-up like content"> Reacciones

								<div class="emoji">

									<div class="hello">
										<a href="#" class="btn"><img src="images/emoji_risa.png"></a>
									</div>
									<div class="hello">
										<a href="#" class="btn"><img src="images/emoji_alegria.png"></a>
									</div>
									<div class="hello">
										<a href="#" class="btn"><img src="images/emoji_sorpresa.png"></a>
									</div>
									<div class="hello">
										<a href="#" class="btn"><img src="images/emoji_encanto.png"></a>
									</div>

								</div>

								</i>

								<i class="fas fa-comment-dots like"></i> <p>comments</p>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

               </section>

            </section>



  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>

        $(".carousel").flickity({
            cellAlign: 'left', //cuandp empieza, empieza a la derecha
            wrapAround: true, //significa que es un loop
            freeScroll: true,
            prevNextButtons: false,
            pageDots: false
        });

    </script>
	<script>
        $(".imgAdd").click(function(){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
        });
        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
        });
        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }

            });
        });
    </script>

</body>
</html>
