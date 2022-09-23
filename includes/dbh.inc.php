<?php 
$hn = 'localhost';
$db = 'redsocial';
$un = 'root';
$pw = 'root';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Error en Conexion");
