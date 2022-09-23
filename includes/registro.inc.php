<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

if (isset($_POST['submit'])) {
	
	$nombre = $_POST["name"];
	$apellido = $_POST["lastname"];
	$email = $_POST["e-mail"];
	$nucuenta = $_POST["nucuenta"];
	$pwd = $_POST["password"];
	$confpwd = $_POST["confpass"];
	$tel = '000000000';


	require_once 'dbh.inc.php';
	require_once 'funciones.inc.php';

	if (emptyInputSignup($nombre, $apellido, $email, $nucuenta, $pwd, $confpwd) !== false) {
		header("Location: ../index.php?error=CamposVacios");
		exit();
	}
	if (invalidNoCuenta($nucuenta) !== false) {
		header("Location: ../index.php?error=NumeroCuentaInvalido");
		exit();
	}
	if (invalidEmail($email) !== false) {
		header("Location: ../index.php?error=emailinvalido");
		exit();
	}
	if (cuentaExists($conn, $nucuenta, $email) !== false) {
		header("Location: ../index.php?error=NumeroCuentaExistente");
		exit();
	}
	if (pwdMatch($pwd, $confpwd) !== false) {
		header("Location: ../index.php?error=contraseñamala");
		exit();
	}
	crearUsuario($conn, $nombre, $apellido, $nucuenta, $tel, $email, $pwd);
}else{
	header("Location: ../index.php?error=emptyinput");
	exit();
}
