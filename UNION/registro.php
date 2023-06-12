<?php

// Incluimos el archivo de conexión a la base de datos
include_once 'conexion.php';

// Recogemos los datos del formulario
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

// Creamos una contraseña segura utilizando la función password_hash
$contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

// Preparamos la consulta SQL
$sql = "INSERT INTO usuarios (usuario, nombre, contrasena) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $usuario, $nombre, $contrasenaHash);

// Ejecutamos la consulta
if ($stmt->execute()) {
    echo "Usuario registrado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>


