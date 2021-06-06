<?php
session_start();
require 'utiles/filtros.php';
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
            <a href="Login.php"><img src="img/Perfil.png" alt="Perfil" width="50px" height="50px"></a>
                <?php
                    if(isset($_SESSION["usuario"])){
                        echo'<a href="logout.php"><img src="img/logout.png" alt="Logout" width="50px" height="50px"></a>';
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

        <!-- <table id="tblData">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>john@gmail.com</td>
                <td>USA</td>
            </tr>
            <tr>
                <td>Michael Addison</td>
                <td>michael@gmail.com</td>
                <td>UK</td>
            </tr>
            <tr>
                <td>Sam Farmer</td>
                <td>sam@gmail.com</td>
                <td>France</td>
            </tr>
        </table> -->

        <div id="contenidoFiltros">
            <?php
                filtrar();
                imprimirScript();
            ?>
        </div>   
        <div class='button-container-2' style="display:none">
        <span class='mas'>Descargar</span>
        <button id='work' type=button' name='Hover' onclick="exportTableToExcel('tablaContenido', 'consulta')">Descargar</button>
        </div>
        <div class="Footer">
            <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
            <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
            <div id="footerRedes" class="ContenidoFooter">Twitter</div>
        </div>
    </div>
</body>
</html>