<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$impacto = $data['impacto'];
$frecuencia = $data['frecuencia'];

$sql = 'INSERT INTO riesgos (nombre, descripcion, impacto, frecuencia) VALUES (?, ?, ?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$nombre, $descripcion, $impacto, $frecuencia]);

$riesgo = [
  'id' => $pdo->lastInsertId(),
  'nombre' => $nombre,
  'descripcion' => $descripcion,
  'impacto' => $impacto,
  'frecuencia' => $frecuencia
];

echo json_encode($riesgo);
?>
