<?php
    session_start();
    require 'utiles/datosUser.php';
    if(isset($_SESSION["usuario"])){
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
    
    <div id="contenido2">
        <h2 style="text-align:center">Perfil Usuario</h2>
        <div class="card" style="text-align:center">
          <form method='POST'>
            <?php
              $idUsuario = $_SESSION['user_id'];
              $esContraseña = $_POST["contraseña"];
              modificarDatosUsuario($idUsuario, $esContraseña);
            ?>
          </form>
        </div>
    </div>
    

    <div class="Footer">
      <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
      <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
      <div id="footerRedes" class="ContenidoFooter">Twitter</div>
    </div>
  </div>
</body>
  <script type="text/javascript">
    function mostrarContrasena(){
      var tipo = document.getElementById("password");
      var boton = document.getElementById("txtBotonModPass");
      if(tipo.type == "password"){
          tipo.type = "text";
          boton.innerHTML="Ocultar Contraseña";
      }else{
          tipo.type = "password";
          boton.innerHTML="Mostrar Contraseña";
      }
  }
</script>
</html>