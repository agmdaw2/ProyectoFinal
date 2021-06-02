<!DOCTYPE html>

<html>

<head>
  <title>Tecnoetica</title>
  <link rel="stylesheet" type="text/css" href="css/main2.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
    <hr>
    <div class="search-container">
      <form action="/action_page.php">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <div id="contenido" class="scroll">

      <?php
      $mysqli = new mysqli("localhost", "root", "password", "tecnoticos");
      if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      }

      $sql = "SELECT titulo_dilema FROM dilema;";


      if ($result = $mysqli->query($sql)) {
        $count = 1;
        while ($row = $result->fetch_row()) {
          echo ('<div id="dilema' . $count . '" class="titulo" onMouseEnter="mouseOver('. $count++ .')">' . $row[0] . '</div>');
        }
      }
      $mysqli->close();
      ?>
    </div>

    <div id="dilemaSeleccionado">
      <div id="resumenes">
        <?php
        $mysqli = new mysqli("localhost", "root", "password", "tecnoticos");
        if ($mysqli->connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli->connect_error;
          exit();
        }

        $sql = "SELECT resumen_dilema FROM dilema";
        $sql2 = "SELECT id_dilema FROM dilema";

        $resultResumen = $mysqli->query($sql);
        if ($result = $mysqli->query($sql)) {
          while ($row = $result->fetch_row()) {
            //echo ('<div id="resumenDilema"><p>' . $row[0] . '<p></div>');   
            echo ($row[0] . "\n");
          }
        }
        $mysqli->close();
        ?>
      </div>
    </div>

    <script>
      var divs = document.getElementsByClassName("titulo");
      var numero = 0

      for (var i = 0; i < divs.length; i++) {
      //  var a = i;
      //  divs[i].addEventListener("mouseenter", function() {
      //    mouseOver(a);
      //  });
          divs[i].addEventListener("mouseleave", function() {
            mouseOut();
          });
      }

      function mouseOver(numero) {
        document.getElementById("resumenes").style.backgroundColor = "black";
        document.getElementById("resumenes").style.color = "white";
        document.getElementById("dilemaSeleccionado").style.backgroundColor = "black";
        document.getElementById("dilemaSeleccionado").style.color = "white";

        document.getElementById("dilemaSeleccionado").innerHTML = '<div id="resumenes" display="none">' +
          document.getElementById("resumenes").innerHTML +
          '</div>' +
          document.getElementById("resumenes").innerHTML.split("\n")[numero];
      }

      function mouseOut() {
        document.getElementById("resumenes").style.backgroundColor = "white";
        document.getElementById("resumenes").style.color = "black";
        document.getElementById("dilemaSeleccionado").style.backgroundColor = "white";
        document.getElementById("dilemaSeleccionado").style.color = "black";
      }
    </script>

    <div class="Footer" style="margin-top: 10%;">
      <div id="footerContacto" class="ContenidoFooter">Correo:</div>
      <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
      <div id="footerRedes" class="ContenidoFooter">Twitter</div>
    </div>
  </div>
</body>

</html>