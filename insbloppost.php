<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "includes/dbh.inc.php";
session_start();

$query = "SELECT * FROM usuarios";
    $result = $conn->query($query);

     if (!$result) die("Fatal Error");
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $_SESSION['id'] = $row['ID'];

if (isset($_POST['submit'])) {
	$descripcion = $_POST["descripcion"];
	$chga = "wht whit this";
	echo $_SESSION['id'];

	if (count($_FILES) > 0) {
    	if (is_uploaded_file($_FILES['postImage']['tmp_name'])) {
        	require_once "includes/dbh.inc.php";
        	$imgData = addslashes(file_get_contents($_FILES['postImage']['tmp_name']));
        	$imageProperties = getimageSize($_FILES['postImage']['tmp_name']);
        	$sql = "INSERT INTO posts(imagen, descripcion, tag, user_ID, imgType)
			VALUES('{$imgData}', '{$descripcion}', '{$chga}', '{$_SESSION['id']}', '{$imageProperties['mime']}')";
        	$current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        	if (isset($current_id)) {
            header("Location: main.php");
        }
    }
}
}
