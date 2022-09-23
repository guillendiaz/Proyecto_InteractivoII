<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

if (isset($_POST['submit'])) {
	$email = $_POST["e-mail"];
	$nucuenta = $_POST["nucuenta"];
	$pwd = $_POST["password"];
	echo $pwd;

	require_once 'dbh.inc.php';
	require_once 'funciones.inc.php';

	/*if (emptyInputLogin($email, $nucuenta, $pwd) !== false) {
		header("Location: ../index.php?error=CamposVaciosEmty");
		exit();
	}*/

	loginUser($conn, $email, $nucuenta, $pwd);
}else{
	header("Location: ../index.php?error=CamposVaciosLogin");
	exit();
}