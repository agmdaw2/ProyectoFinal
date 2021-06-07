<?php
    session_start();
    if(isset($_SESSION["usuario"])){
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tecnoetica</title>
			<link rel="stylesheet" type="text/css" href="css/main.css"/>
            <link rel="stylesheet" type="text/css" href="js/js-image-slider.css"/>
            <script src="js/js-image-slider.js" type="text/javascript"></script>
	</head>
<body>
	<div id="pagina">
        <div id="cabecera">
            <img src="img/logotipo.png" alt="logo" width="300px" height="90px">
        </div>
        <div class="Login-Registro">
            <a href="Login.php"><img src="img/Perfil.png" alt="Perfil" width="50px" height="50px"></a>
            <?php
                if($_SESSION['role'] == "admin"){
                    echo'<a href="inicioAdmin.php"><img src="img/menu_adm.png" alt="Logout" width="80px" height="50px"></a>';
                  }
                if(isset($_SESSION["usuario"])){
                    echo'<a href="logout.php"><img src="img/logout.png" alt="Logout" width="50px" height="50px"></a>';
                }
            ?>
        </div>
        <div class="navbar">
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='Index.php'">Inicio <i class="fa fa-caret-down"></i></button>
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
        <hr><br>
        <h1 style="text-align: center">Contacto</h1>

        <br><hr><br>

        <img src="img/contacto.jpg" alt="Contacto" style="margin-left: 38%">
        <br>
        <p style="text-align:center; font-size:24px"><strong>Parlem-ne!</strong> Per més informació, dubtes, preguntes i/o suggeriments…<p>
        <br>
        <p style="text-align:center; font-size:24px; color:blue">eramire1@xtec.cat</p>
        
        <div class="Footer" style="margin-top: 4.6%">
                <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
                <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
                <div id="footerRedes" class="ContenidoFooter">Twitter</div>
        </div>
      </div>
      
      
</body>
</html>
