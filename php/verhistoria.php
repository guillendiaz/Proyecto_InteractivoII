<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Error en Conexion");



    $sql = "SELECT imagen FROM historias WHERE ID = '38'";
    $result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    header("content-type: image/png");
    echo $row["imagen"];

mysqli_close($conn);

//Create the connection and select the database





  //Get the image from the database
  $res = $db->query("SELECT image FROM gallery WHERE id = {$_GET['id']}");

  if($res->num_rows > 0){
      $img = $res->fetch_assoc();

      //Render the image
      header("Content-type: image/jpg");
      echo $img['image'];
  }else{
      echo 'Image not found...';
  }
}
?>
