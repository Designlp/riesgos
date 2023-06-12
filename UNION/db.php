<?php

$servername = "localhost";
$username = "u583014169_riesgos";
$password = "infUMSA19921963";
$dbname = "u583014169_riesgos";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

?>
