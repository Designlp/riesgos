<?php
$host = 'localhost';
$db   = 'u583014169_riesgos';
$user = 'u583014169_riesgos';
$pass = 'infUMSA19921963';

// Creamos la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobamos la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>