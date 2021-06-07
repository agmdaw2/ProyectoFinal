<?php
require 'utiles/respPreg.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tecnoticos</title>
        <link rel="stylesheet" type="text/css" href="css/main2.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <div id="pagina">
            <div id="cabecera">
                <a href="index.php"><img src="img/logotipo.png" alt="logo" width="300px" height="90px"></a>
            </div>
            <div class="Login-Registro">
                <a href="Login.php"><img src="img/Perfil.png" alt="Perfil" width="50px" height="50px"></a>
                    <?php
                        if($_SESSION['role'] == "admin"){
                            echo'<a href="inicioAdmin.php"><img src="img/menu_adm.png" alt="Logout" width="80px" height="50px"></a>';
                        }
                        $estoyLogeado = false;
                        if(isset($_SESSION["usuario"])){
                            echo'<a href="logout.php"><img src="img/logout.png" alt="Logout" width="50px" height="50px"></a>';
                            $estoyLogeado = true;
                        }
                    ?>
            </div>
            <div class="navbar">
                <div class="subnav">
                    <button class="subnavbtn" onclick="window.location.href='index.php'">Inicio <i class="fa fa-caret-down"></i></button>
                </div>
                <div class="subnav">
                    <button class="subnavbtn" onclick="window.location.href='listaActividades.php'">Dilemas Tecnoeticos<i class="fa fa-caret-down"></i></button>
                </div>
                <div class="subnav">
                    <button class="subnavbtn" onclick="window.location.href='propuestaDidactica.php'">Propuesta Didactica<i class="fa fa-caret-down"></i></button>
                </div>
                <div class="subnav">
                    <button class="subnavbtn" onclick="window.location.href='tecnoeticaFutura.php'">Tecnoetica Futura<i class="fa fa-caret-down"></i></button>
                </div>
                <div class="subnav">
                    <button class="subnavbtn" onclick="window.location.href='contacto.php'">Contacto<i class="fa fa-caret-down"></i></button>
                </div>
            </div>
            <hr>
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div id="contenido4">
                <?php
                    $idDilema = $_GET["dilema"];
                    //http://localhost/m12/respPreguntas.php?dilema=1
                    
                    respPreg($idDilema, $estoyLogeado);

                ?>
            </div>
            <div class="Footer">
                <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
                <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
                <div id="footerRedes" class="ContenidoFooter">Twitter</div>
            </div>
        </div>
    </body>
</html>