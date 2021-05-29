<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login-registro.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <title>Registro - Tecnoetica</title>
</head>
<body>
    <!-- <div id="Form-idiomas">
        <form>
            <p>Idiomas:
            <select name="Idioma">
                <option value="ES">Español</option>
                <option value="CAT">Catalán</option>
                <option value="EN">Inglés</option>
                </select></p>
        </form>
    </div> -->
    <div id="LogoLogin">
            <img src="img/logotipo-blanco.png" alt="Logo" width="250px" height="100px">
        </div>
    
    <form class="box" method="POST" id="Form-Registro">
    <div id="menu">
        <h1>Registro</h1>
    </div><br>
        <p>Correo</p>
        <input type="email" name="email" placeholder="Correo electronico" required/>
        <p>Contraseña</p>
        <input type="password" name="pw" placeholder="Contraseña" required/>
        <p>Edad</p>
        <input type="number" name="edad" min="1" max="110" required/>
        <p>Sexo</p>
        <select name="sexo">
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
                <option value="I">Indiferente</option>
        </select>
        <br>
        <input type="submit" name="registrarse" action="Login.php" id="Registro" value="registrarse" placeholder="registrarse"><br>
        <p>¿Ya estás registrado? <a href="Login.php">Haz click aquí</a>.</p>
    </form>
    <?php
            include("registrar.php");
    ?>
</body>
</html>