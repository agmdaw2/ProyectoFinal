<?php
  require 'utiles/modificar.php';

    $servername = "localhost";
    $username = "root";
    $password = "password";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=tecnoticos", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

   $idDilemaEscogido = $_POST["modificar"];
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

    <div id="contenido3">
      <form action="" method="post">
        <div class="form-group">
          <label for="titulo">Titulo: </label>
        </div>
        <textarea type="text" name="titulo_dilema" class="form-control input-sm editor" id="titulo" placeholder="Titulo dilema">
          <?php
            $result = $conn->prepare("SELECT dilema.titulo_dilema FROM dilema where dilema.id_dilema =$idDilemaEscogido");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            while ($row = $result->fetch()) {
              echo $row['titulo_dilema'];
            }
          ?> 
        </textarea>
        <div class="form-group">
          <label for="resumen">Resumen: </label>
        </div>
        <textarea name="resumen_dilema" class="form-control editor" id="resumen" cols="60" rows="3">
          <?php
            $result = $conn->prepare("SELECT dilema.resumen_dilema FROM dilema where dilema.id_dilema =$idDilemaEscogido");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            while ($row = $result->fetch()) {
              echo $row['resumen_dilema'];
            }
          ?> 
        </textarea>
        <div class="form-group">
          <label for="descripcion">Descripcion: </label>
        </div>
        <textarea name="descripcion_dilema" class="form-control editor" id="descripcion" cols="60" rows="6">
          <?php
              $result = $conn->prepare("SELECT dilema.descripcion_dilema FROM dilema where dilema.id_dilema =$idDilemaEscogido");
              $result->setFetchMode(PDO::FETCH_ASSOC);
              $result->execute();
              while ($row = $result->fetch()) {
                echo $row['descripcion_dilema'];
              }
          ?>
        </textarea>
        <div class="form-group">
          <label for="recursos">Recursos: </label>
        </div>
        <textarea name="recurso_dilema" class="form-control editor" id="recursos" cols="60" rows="5">
          <?php
              $result = $conn->prepare("SELECT dilema.recurso_dilema FROM dilema where dilema.id_dilema =$idDilemaEscogido");
              $result->setFetchMode(PDO::FETCH_ASSOC);
              $result->execute();
              while ($row = $result->fetch()) {
                echo $row['recurso_dilema'];
              }
          ?>
        </textarea>
        <div class="form-group">
          <label for="actividad">Actividad: </label>
        </div>
        <textarea name="actividad_dilema" class="form-control editor" id="actividad" cols="60" rows="6">
          <?php
              $result = $conn->prepare("SELECT pregunta.id_pregunta, pregunta.tipo_numeracion, pregunta.texto_pregunta FROM pregunta where pregunta.id_dilema =$idDilemaEscogido");
              $result->setFetchMode(PDO::FETCH_ASSOC);
              $result->execute();
              $anteriorEsLi = false;
              $tipodeLi = '';
              $contador = 0;
              $idPrimeraPregunta= 0;
              while ($row = $result->fetch()) {
                if ($contador == 0){
                  $idPrimeraPregunta = $row['id_pregunta'];
                }
                if($row['tipo_numeracion'] != 'p'){
                  if($anteriorEsLi == false){
                    $anteriorEsLi=true;
                    $tipodeLi = $row['tipo_numeracion'];
                    echo "<".$row['tipo_numeracion'].">";
                  }
                  echo "<li>".$row['texto_pregunta']."</li>";

                }else{
                  if($anteriorEsLi == true){
                    echo "</".$tipodeLi.">";
                    $anteriorEsLi = false;
                  }
                  echo "<p>".$row['texto_pregunta']."</p>";
                }
                $contador++;
              }
          ?>    
        </textarea>
        <?php
         echo "<input type='hidden' name='idDilemEscogido' value='". $idDilemaEscogido ."'>";
         echo "<input type='hidden' name='idPrimeraPregunta' value='". $idPrimeraPregunta ."'>";
        ?>
        <br>
        <div class="button-container-2">
          <span class="mas">Dilema</span>
          <button id="work" type="submit" name="Hover">Modificar</button>
        </div>
      </form>
    </div>
    <br>

    <div class="Footer">
      <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
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