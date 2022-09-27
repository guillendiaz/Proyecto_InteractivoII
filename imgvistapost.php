<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "includes/dbh.inc.php";
if (isset($_GET['image_id'])) {
    $sql = "SELECT imagen, imgType FROM posts WHERE ID=" . $_GET['image_id'];
    $result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    header("Content-type: " . $row["imgType"]);
    echo $row["imagen"];
}
mysqli_close($conn);
?>