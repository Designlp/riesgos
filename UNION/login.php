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
      header('Location: content.php');
      exit();
    } else {
      echo 'Contraseña incorrecta.';
    }
  } else {
    echo 'Nombre de usuario no encontrado.';
  }



}


// Si el usuario no está autenticado, redirige a la página de inicio de sesión.
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // reemplaza 'login.php' con la URL de tu página de inicio de sesión
    exit();
}
?>