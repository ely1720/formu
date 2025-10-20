<?php
// ===================================================================
// Archivo: conexion.php
// Descripción: Configura la conexión a la base de datos MySQL.
// ===================================================================

$servidor = "localhost";
$usuario = "root";
$password = "";   // no tengo contra!
$base_datos = "bdely_db";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error al conectar a la base de datos: " . $conn->connect_error);
}
?>
