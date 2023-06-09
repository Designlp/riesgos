<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="registross.css">
</head>
<body>
    <h2>Evalua tus riesgos</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="registro.php" method="post">
                <h1>Crear cuenta</h1>
                <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" >
                <input type="text" id="name" name="name" placeholder="Ingresa tu Nombre"><br>

                <input type="password" id="password" name="password" placeholder="Ingresa tu Contraseña"><br>
          
                <input type="submit" value="Registrarse">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="POST">
                <h1>Inicia sesion</h1>
                        <input type="text" name="username" placeholder="Nombre de usuario" required>
                <input type="password" name="password" placeholder="Contraseñaa" required>
                <input type="submit" value="Ingresar">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bienvenido de Vuelta!</h1>
                    <p>Nos da gusto tenerte por aca </p>
                    <button class="ghost" id="signIn">Ingresar</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hola, Bienvenido!</h1>
                    <p>Ingresa tus datos personales y evalua tus riesgos</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
    <script src="registro.js"></script>
</body>
</html>