<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../php/CSS/login.css">
    <title>Iniciar sesion</title>
</head>
<body>

<section  class="barra">
      
<h2>Bienvenido</h2>

    </section>

    <section>

    <div class="separador"></div>

    <div class="users-form">

    <form action="/php/loginA.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    
</div>

</section>

    <a class="publicidad" href="/php/publicidad.php"><h1>Anuncios</h1></a>
</body>
</html>
