<?php
$host = 'localhost';
$db   = 'u583014169_riesgos';
$user = 'u583014169_riesgos';
$pass = 'infUMSA19921963';

$dsn = "mysql:host=$host;dbname=$db";
$pdo = new PDO($dsn, $user, $pass);


// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

?>


