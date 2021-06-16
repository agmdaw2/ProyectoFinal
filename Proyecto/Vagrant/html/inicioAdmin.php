<?php
    session_start();
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
    <hr>
    <!-- <div class="search-container">
            <form action="/action_page.php">
              <input type="text" placeholder="Search.." name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div> -->
        <div id="contenidoUsuario">
          <div class="button-container-2">
            <span class="mas">Dilema</span>
            <button onclick="window.location.href='/crearDilema.php'" id="work" type="button" name="Hover">Crear</button>
          </div> 

          <div class="button-container-2">
            <span class="mas">Consulta</span>
            <button onclick="window.location.href='/descargar.php'" id="work" type="button" name="Hover">Consulta</button>
          </div> 
          <div class="button-container-2">
            <span class="mas">Dilemas</span>
            <button onclick="window.location.href='/listarDilemas.php'" id="work" type="button" name="Hover">Listar</button>
          </div>
          <div class="button-container-2" >
            <span class="mas">Perfil</span>
            <button onclick="window.location.href='/perfilUsuario.php'" id="work" type="button" name="Hover">Perfil</button>
          </div> 
        </div>
    </div>

    <div class="Footer">
      <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
      <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
      <div id="footerRedes" class="ContenidoFooter">Twitter</div>
    </div>
  </div>
</body>

</html>