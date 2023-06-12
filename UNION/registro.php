<?php

// Incluimos el archivo de conexión a la base de datos
include_once 'db.php';

// Recogemos los datos del formulario
$username = $_POST['username'];
$passwords = $_POST['password'];
$names = $_POST['name'];

// Creamos una contraseña segura utilizando la función password_hash
$contrasenaHash = password_hash($password, PASSWORD_DEFAULT);

// Preparamos la consulta SQL
$sql = "INSERT INTO usuarios (usuario, name, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $names, $contrasenaHash);

// Ejecutamos la consulta
if ($stmt->execute()) {
    echo "Usuario registrado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>


