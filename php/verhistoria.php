<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Error en Conexion");

if(isset($_POST['filename']) && isset($_FILES['enviar'])
{
  $id = mysql_real_escape_string($_GET['id']);
  $query = mysql_query("SELECT imagen FROM 'historias' WHERE 'ID'='$id'");
  while($row = mysql_fetch_assoc($query))
  {
    $imageData = $row["imagen"];
  }
  header("content-type: image/png");
  echo $imageData;
}
else{
  echo "Error";
}

 ?>
