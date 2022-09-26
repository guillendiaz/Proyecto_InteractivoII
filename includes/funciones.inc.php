<?php
//comprobar que los campos esten llenos
function emptyInputSignup($nombre, $apellido, $email, $nucuenta, $pwd, $confpwd){
$result;
if (empty($nombre) || empty($apellido) || empty($email) || empty($nucuenta) || empty($pwd) || empty($confpwd)) {
	$result = true;
}
else{
	$result = false;
}
return $result;
}

//comprobar que el # cuenta solo contiene numeros
function invalidNoCuenta($nucuenta){
$result;
if (!preg_match("/^[0-9]*$/", $nucuenta)) {
	$result = true;
}
else{
	$result = false;
}
return $result;
}

//comprobar que el email sea valido
function invalidEmail($email){
$result;
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$result = true;
}
else{
	$result = false;
}
return $result;
}

//comprobar que el # de cuenta no exista en el registro
function cuentaExists($conn, $nucuenta, $email){
	$sql = "SELECT * FROM usuarios WHERE num_cuenta = ? OR correo = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=CuentaExistente");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $nucuenta, $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}else{
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

//comprobar la contraseña
function pwdMatch($pwd, $confpwd){
$result;
if ($pwd !== $confpwd) {
	$result = true;
}
else{
	$result = false;
}
return $result;
}

function crearUsuario($conn, $nombre, $apellido, $nucuenta, $tel, $email, $pwd){
	$sql = "INSERT INTO usuarios (nombre, apellido, num_cuenta, num_telefono, correo, contrasenia) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=consultafallo");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $apellido, $nucuenta, $tel, $email, $pwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("Location: ../index.php?error=none");
	exit();
}

function emptyInputLoging($email, $nucuenta, $pwd){
$result;
if (empty(empty($email) || empty($nucuenta) || empty($pwd))) {
	$result = true;
}
else{
	$result = false;
}
return $result;
}



function loginUser($conn, $email, $nucuenta, $pwd){

		session_start();
		$query = "SELECT ID, nombre, apellido, num_cuenta, num_telefono, correo, contrasenia FROM usuarios WHERE correo = '$email' && contrasenia = '$pwd' ";
    $result = $conn->query($query);

    if (!$result) die("Fatal Error");
    $row = $result->fetch_array(MYSQLI_ASSOC);

		$_SESSION['id'] = $row['ID'];
        $_SESSION['Nom'] = $row['nombre'];
        $_SESSION['Apel'] = $row['apellido'];
        $_SESSION['N_Cuenta'] = $row['num_cuenta'];
        $_SESSION['N_Tel'] = $row['num_telefono'];
        $_SESSION['Correo'] = $row['correo'];
        $_SESSION['Contra'] = $row['contrasenia'];


		$sql = "SELECT count(*) as 'contar' FROM usuarios WHERE correo = '$email' and num_cuenta = '$nucuenta' and contrasenia = '$pwd'";
		$consulta = mysqli_query($conn, $sql);

		$array = mysqli_fetch_array($consulta);

		if ($array['contar'] > 0) {
			$_SESSION['id'] = $nucuenta;
			header("Location: ../main.php");
		}else{
			header("Location: ../index.php?error=datosincorrectos");

		exit();
	}
}
