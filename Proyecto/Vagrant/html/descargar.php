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
        <div id="contenidoFiltros">
            <?php
                filtrar();
                imprimirScript();
            ?>
        </div>   

        <!-- <div id="consulta" class="form-group">
            <h3 style="text-align: center;">Consulta</h3>
            <form>
                <label for="sexo">Sexo</label><br><br>
                <input type="checkbox" id="todos" class="form-control" name="sexo" value="Todos">Todos<br>
                <input type="checkbox" id="masculino" class="form-control" name="sexo" value="Masculino">Masculino<br>
                <input type="checkbox" id="femenino" class="form-control" name="sexo" value="Femenino">Femenino<br>
                <input type="checkbox" id="otros" class="form-control" name="sexo" value="Otros">Otros
            </form>

            <form id="cedad">
                <label for="edad">Edad</label><br><br>
                <input type="checkbox" id="todos" class="form-control" name="sexo" value="Todos">Todos<br>
                <input type="checkbox" id="masculino" class="form-control" name="sexo" value="Masculino">Masculino<br>
                <input type="checkbox" id="femenino" class="form-control" name="sexo" value="Femenino">Femenino<br>
                <input type="checkbox" id="otros" class="form-control" name="sexo" value="Otros">Otros
            </form>

            <form id="cinstituto">
                <label for="instituto">Instituto</label><br><br>
                <select id="cars" name="cars" size="1">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="fiat">Fiat</option>
                    <option value="audi">Audi</option>
                  </select>
            </form>
        </div>

        <div id="dilema" class="form-group">
            <h3 style="text-align: center;">Dilemas</h3>
            <form id="cdilema">
                <label for="dilema">Dilema</label><br><br>
                <select id="cars" name="cars" size="1">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="fiat">Fiat</option>
                    <option value="audi">Audi</option>
                  </select>
            </form>
            <form id="cpregunta">
                <label for="pregunta">Pregunta</label><br><br>
                <select id="cars" name="cars" size="1">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="fiat">Fiat</option>
                    <option value="audi">Audi</option>
                  </select>
            </form>
        </div> -->

        <div class="Footer">
            <div id="footerContacto" class="ContenidoFooter">Correo:</div>
            <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
            <div id="footerRedes" class="ContenidoFooter">Twitter</div>
        </div>
    </div>
</body>
</html>