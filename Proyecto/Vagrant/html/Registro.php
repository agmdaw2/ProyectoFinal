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
    <div id="Form-idiomas">
        <form>
            <p>Idiomas:
            <select name="Idioma">
                <option value="ES">Español</option>
                <option value="CAT">Catalán</option>
                <option value="EN">Inglés</option>
                </select></p>
        </form>
    </div>
    <div id="menu">
        <h1>Registro</h1>
    </div>
    
    <form method="POST" id="Form-Registro">
        <div id="LogoLogin">
            <img src="img/Logotipo.png" alt="Logo" width="100px" height="50px">
        </div>
        <p>Correo</p>
        <input type="email" name="email" placeholder="Correo electronico" required/>
        <p>Contraseña</p>
        <input type="password" name="pw" placeholder="Contraseña" required/>
        <p>Edad</p>
        <input type="number" name="edad" required/>
        <p>Sexo</p>
        <select name="sexo">
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
                <option value="I">Indiferente</option>
        </select>
        <br><br><br>
        <input type="submit" name="registrarse" action="Login.php" id="Registro" value="Registrarse" placeholder="Registrarse"><br>
        <p>¿Ya estás registrado? <a href="Login.php">Haz click aquí</a>.</p>
    </form>
    <?php
            include("registrar.php");
    ?>
    <div class="Footer">
        <div id="footerContacto" class="ContenidoFooter">Correo:</div>
        <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
        <div id="footerRedes" class="ContenidoFooter">Twitter</div>
</div>
</body>
</html>