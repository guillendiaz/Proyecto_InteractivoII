<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        require_once "includes/dbh.inc.php";
        $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
        $sql = "INSERT INTO historias(imgType ,imgData)
	VALUES('{$imageProperties['mime']}', '{$imgData}')";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: listimg.php");
        }
    }
}
?>

<HTML>
<HEAD>
<TITLE>Subir Imagen to MySQL BLOB</TITLE>
<link href="imageStyles.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
	<form name="frmImage" enctype="multipart/form-data" action=""
		method="post" class="frmImageUpload">
		<label>Subir Archivo de Imagen:</label><br> 
		<input name="userImage" type="file" class="inputFile"> 
		<input type="submit" value="Submit" class="btnSubmit" />
	</form>
	</div>
</BODY>
</HTML>