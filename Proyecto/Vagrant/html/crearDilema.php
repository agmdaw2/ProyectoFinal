<?php
require 'utiles/crear.php';
?>

<!DOCTYPE html>

<html>

<head>
  <title>Tecnoetica</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/main2.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
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
        <button class="subnavbtn" onclick="window.location.href='listaActividades.php'">Dilemas Tecnoeticos<i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='propuestaDidactica.php'">Propuesta Didactica<i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='tecnoeticaFutura.php'">Tecnoetica Futura<i class="fa fa-caret-down"></i></button>
      </div>
      <div class="subnav">
        <button class="subnavbtn" onclick="window.location.href='Blabla.html'">Contacto<i class="fa fa-caret-down"></i></button>
      </div>
    </div>
    <hr>

    <div id="contenido3">
      <form action="" method="post">
        <div class="form-group">
          <label for="titulo">Titulo: </label>
        </div>
        <textarea type="text" name="titulo_dilema" class="form-control input-sm editor" id="titulo" placeholder="Titulo dilema"></textarea>
        <div class="form-group">
          <label for="resumen">Resumen: </label>
        </div>
        <textarea name="resumen_dilema" class="form-control editor" id="resumen" cols="60" rows="3"></textarea>
        <div class="form-group">
          <label for="descripcion">Descripcion: </label>
        </div>
        <textarea name="descripcion_dilema" class="form-control editor" id="descripcion" cols="60" rows="6"></textarea>
        <div class="form-group">
          <label for="recursos">Recursos: </label>
        </div>
        <textarea name="recurso_dilema" class="form-control editor" id="recursos" cols="60" rows="5"></textarea>
        <div class="form-group">
          <label for="actividad">Actividad: </label>
        </div>
        <textarea class="form-control editor" id="actividad" cols="60" rows="6"></textarea>
        <br>
        <div class="button-container-2">
          <span class="mas">Crear</span>
          <button id="work" type="submit" name="Hover">Crear dilema</button>
        </div>
      </form>
    </div>
    <br>

    <div class="Footer">
      <div id="footerContacto" class="ContenidoFooter">Correo:</div>
      <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
      <div id="footerRedes" class="ContenidoFooter">Twitter</div>
    </div>
  </div>
  <script>
    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor
        .create(allEditors[i]);
    }
  </script>



</body>

</html>