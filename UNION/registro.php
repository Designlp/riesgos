<?php

// Incluimos el archivo de conexión a la base de datos
include_once 'db.php';

// Recogemos los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];

// Preparamos la consulta SQL
$sql = "INSERT INTO usuarios (username, password, name) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $password, $name );
// Ejecutamos la consulta
if ($stmt->execute()) {
    echo "Usuario registrado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>


