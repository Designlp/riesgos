<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$impacto = $data['impacto'];
$frecuencia = $data['frecuencia'];
$resultado = $data['resultado'];
$user_id = $_SESSION['user_id'];  // Obtén el ID del usuario de la sesión

$sql = 'INSERT INTO riesgos (nombre, descripcion, impacto, frecuencia, resultado, user_id) VALUES (?, ?, ?, ?, ?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$nombre, $descripcion, $impacto, $frecuencia, $resultado, $user_id]);

$riesgo = [
  'id' => $pdo->lastInsertId(),
  'nombre' => $nombre,
  'descripcion' => $descripcion,
  'impacto' => $impacto,
  'frecuencia' => $frecuencia,
  'resultado' => $resultado,
  'user_id' => $user_id
];

echo json_encode($riesgo);
?>
