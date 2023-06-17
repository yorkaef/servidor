<?php
$servername = "localhost";
$username = "yorkaef";
$password = "yorkaef";
$dbname = "login";

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error al conectar a la base de datos: " . $conexion->connect_error);
}