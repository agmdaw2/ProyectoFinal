<?php
    session_start();
    if(isset($_SESSION["usuario"])){
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tecnoetica</title>
			<link rel="stylesheet" type="text/css" href="css/main.css"/>
            <link rel="stylesheet" type="text/css" href="js/js-image-slider.css"/>
            <script src="js/js-image-slider.js" type="text/javascript"></script>
            <meta charset="UTF-8">
	</head>
<body>
	<div id="pagina">
        <div id="cabecera">
            <a href="Login.html"><img src="img/logotipo.png" alt="logo" width="300px" height="90px"></a>
        </div>
        <div class="Login-Registro">
            <img src="img/Perfil.png" alt="Perfil" width="50px" height="50px">
        </div>
        <div class="navbar">
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='Inicio.html'">Inicio <i class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='Productes.html'">Dilemas Tecnoeticos<i class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='Nosotros.html'">Propuesta Didactica<i class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='Exercicis.html'">Tecnoetica Futura<i class="fa fa-caret-down"></i></button>
            </div>
            <div class="subnav">
                <button class="subnavbtn" onclick="window.location.href='Blabla.html'">Contacto<i class="fa fa-caret-down"></i></button>
            </div>
          </div>
        <hr><br>

        <h1 id="propuestaDidactica" style="font-size: 40px;">Tecnoetica futura</h1> <br>
        <hr id="hrPropuesta">

        <li id="parrafoTF">
        Actualment s’estan elaborant nous materials didàctics per ampliar la proposta didàctica al 
        segon cicle de l’ESO de la mà de la Nora Martínez en l’elaboració del seu Treball de Fi de 
        Màster digirit per Antoni Hernández.
        </li>

        <li id="parrafoTF">
        A l’Institut Arnau Cadell de Sant Cugat del Vallès, s’està realitzant la posada en pràctica 
        i prova pilot d’aquesta proposta didàctica. Els resultats seran avaluats per realitzar canvis 
        i millores que garanteixin l’èxit en la seva aplicació.
        </li>

        <li id="parrafoTF3">
        A l’Institut Arnau Cadell i seguint amb la Tecnoètica com a eix vertebrador, s’ha dissenyat 
        un Treball de Recerca per aplicar al quart curs de l’ESO. Aquest treball té per objectiu fer 
        reflexionar als alumnes sobre aspectes relacionats amb l’estalvi energètic dins l’àmbit domèstic.
        </li>
        
        <div class="Footer">
                <div id="footerContacto" class="ContenidoFooter">Correo:</div>
                <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
                <div id="footerRedes" class="ContenidoFooter">Twitter</div>
        </div>
      </div>
</body>
</html>






