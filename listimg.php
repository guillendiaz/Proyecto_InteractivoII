<?php
require_once "includes/dbh.inc.php";
$sql = "SELECT imgId FROM historias ORDER BY imgId DESC";
$result = mysqli_query($conn, $sql);
?>

<HTML>
<HEAD>
<TITLE>Listar BLOP Imagenes</TITLE>
<link href="imageStyles.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
		<img src="imgvista.php?image_id=<?php echo $row["imgId"]; ?>">
	<br/>
	
<?php
}
mysqli_close($conn);
?>
</BODY>
</HTML>