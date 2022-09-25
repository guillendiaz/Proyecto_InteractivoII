<?php


if(isset($_POST['enviar_historias'])){
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die("Error en Conexion");

$fecha = date("_d_m_Y");
if ($_FILES)
{
  $name = $_FILES['filename']['name'];
  switch($_FILES['filename']['type'])
  {

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
}

if ($ext)
{
  $n = "$name.$fecha.$ext";
  move_uploaded_file($_FILES['filename']['tmp_name'], $n);
  
  echo "<script>alert('Historia Subida')</script>";
}else{
  echo "'$name' Debe ser una imagen";
}

echo $n;

$query = "INSERT INTO historias (imagen)
          VALUES" . "('$n')";


$result = $conn->query($query);
if (!$result) die("Fatal Error");
}





 ?>
