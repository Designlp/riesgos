<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
  $stmt->execute([$username]);

  if ($user = $stmt->fetch()) {
    if ($password === $user['password']) {
      $_SESSION['user_id'] = $user['id'];
      header('Location: index.php');
      exit();
    } else {
      echo 'Contraseña incorrecta.';
    }
  } else {
    echo 'Nombre de usuario no encontrado.';
  }
}
?>