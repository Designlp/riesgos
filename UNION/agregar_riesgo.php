<?php
require 'db.php';

// Leer los datos del POST
$datos = json_decode(file_get_contents('php://input'), true);

// Preparar la consulta SQL
$sql = 'INSERT INTO riesgos (descripcion, impacto, frecuencia) VALUES (?, ?, ?)';
$stmt = $pdo->prepare($sql);

// Ejecutar la consulta con los datos recibidos
$stmt->execute([$datos['descripcion'], $datos['impacto'], $datos['frecuencia']]);

// Recuperar el ID del nuevo riesgo
$id = $pdo->lastInsertId();

// Añadir el ID a los datos devueltos
$datos['id'] = $id;

// Enviar los datos de vuelta como JSON
echo json_encode($datos);
?>
