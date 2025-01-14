<?php
session_start();
require 'utiles/filtros.php';
if($_SESSION['role'] == 'usuario' || $_SESSION['role'] !== 'admin') {
    //block user access
    die("No tienes permisos para acceder a esta pagina.");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tecnoetica</title>
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <div id="pagina">
        <div id="cabecera">
            <a href="index.php"><img src="img/logotipo.png" alt="logo" width="300px" height="90px"></a>
        </div>
        <div class="Login-Registro">
            <?php
                if(isset($_SESSION["usuario"])){
                    if($_SESSION['role'] == "admin"){
                        echo'<a href="inicioAdmin.php"><img src="img/menu_adm.png" alt="menuAdm" width="60px" height="50px"></a>';
                        }
                    if($_SESSION['role'] == "usuario"){
                        echo'<a href="inicioUser.php"><img src="img/menu_adm.png" alt="menuAdm" width="60px" height="50px"></a>';
                    }
                    echo'<a href="logout.php"><img src="img/logout.png" alt="Logout" width="50px" height="50px"></a>';
                }else{
                    echo "<a href='Login.php'><img src='img/Perfil.png' alt='Perfil' width='50px' height='50px'></a>";
                }
            ?>
        </div>
        <div class="navbar">
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='index.php'">Inicio <i
                        class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='listaActividades.php'">Dilemas Tecnoeticos<i
                        class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='propuestaDidactica.php'">Propuesta Didactica<i
                        class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='tecnoeticaFutura.php'">Tecnoetica Futura<i
                        class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='contacto.php'">Contacto<i
                        class="fa fa-caret-down"></i></button>
            </div>
        </div>
        <div id="contenidoFiltros">
            <?php
                filtrar();
                imprimirScript();
            ?>
        </div>   
        <div class='button-container-2' style="display:block">
        <span class='mas'>Excel</span>
        <button id='work' type='button' name='Hover' onclick="exportTableToExcel('tablaContenido')">Descargar</button> -->
        </div>

        <!-- <div class="Footer">
            <div id="footerContacto" class="ContenidoFooter">Correo:</div>
            <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
            <div id="footerRedes" class="ContenidoFooter">Twitter</div>
        </div> -->
        
    </div>
    <script src='utiles/main.js'></script>
</body>
</html>