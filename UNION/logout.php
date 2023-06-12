<?php
session_start();
session_unset();
session_destroy();

header('Location: index.php'); // reemplaza 'login.php' con la URL de tu página de inicio de sesión
exit();
?>
