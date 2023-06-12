<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$impacto = $data['impacto'];
$frecuencia = $data['frecuencia'];
$resultado = $data['resultado']; // Recupera el resultado

$sql = 'INSERT INTO riesgos (nombre, descripcion, impacto, frecuencia, resultado) VALUES (?, ?, ?, ?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$nombre, $descripcion, $impacto, $frecuencia, $resultado]); // Agrega el resultado a la consulta SQL

$riesgo = [
  'id' => $pdo->lastInsertId(),
  'nombre' => $nombre,
  'descripcion' => $descripcion,
  'impacto' => $impacto,
  'frecuencia' => $frecuencia,
  'resultado' => $resultado // Agrega el resultado al objeto de respuesta
];

echo json_encode($riesgo);
?>
