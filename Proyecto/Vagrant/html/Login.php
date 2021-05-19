<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="css/login-registro.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <title>Login - Tecnoetica</title>
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
        <h1>Login</h1>
    </div>
    
    <form id="Form-Login" action="Login.php" method="post">
        <div id="LogoLogin">
            <img src="img/logotipo.png" alt="Logo" width="100px" height="45px">
            
        </div>
        <p>Correo</p>
        <input type="email" name="t1" placeholder="Correo electronico" required>
        <p>Contraseña</p>
        <input type="password" name="t2" placeholder="Contraseña" required><br><br><br>
        <button type="submit" id="Login" name="" value="Ingresar">Entrar</button>
        <input type="button" id=Registro onclick="window.location.href='Registro.php';" value="Registrarse" />
        <p>¿Quieres volver al Inicio? <a href="index.html">Haz click aquí</a>.</p>
        
    </form>
    <div class="Footer">
        <div id="footerContacto" class="ContenidoFooter">Correo:</div>
        <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
        <div id="footerRedes" class="ContenidoFooter">Twitter</div>
</div>
</body>
<?php
        if($_POST){
            session_start();
            require('conexion.php');
            $u = $_POST['t1'];
            $p = $_POST['t2'];
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $conn -> prepare("SELECT * FROM usuario where correo= :u AND contraseña = :p");

            $query ->bindParam(":u", $u);
            $query ->bindParam(":p", $p);

            $query ->execute();
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            if($usuario){
                $_SESSION['usuario'] = $usuario['correo'];
                $_SESSION['user_id'] = $usuario['id_usuario'];
                
                if($usuario['rol'] == "admin"){
                    header("location:index.html");
                }
                else if($usuario['rol'] == "usuario"){
                    header("location:index.html");
                }
            }
            else {
                echo "Usuario o Contraseña son incorrectos";
            }
        }
        ?>
</html>