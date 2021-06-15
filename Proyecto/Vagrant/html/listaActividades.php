<?php
session_start();
?>
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

    <div id="contenido" class="scroll">

      <?php
      $mysqli = new mysqli("localhost", "root", "password", "tecnoticos");
      if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      }

      $sql = "SELECT id_dilema, titulo_dilema FROM dilema;";


      if ($result = $mysqli->query($sql)) {
        $count = 1;
        while ($row = $result->fetch_row()) {
          echo ('<div id="dilema' . $count . '" class="titulo" onMouseEnter="mouseOver('. $count++ .')"><a class="links" href="respPreguntas.php?dilema='. $row[0] .'">' . $row[1] . '</a></div>');
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

    <div class="FooterLA" style="margin-top: 10%;">
      <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
      <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
      <div id="footerRedes" class="ContenidoFooter">Twitter</div>
    </div>
  </div>
</body>

</html>