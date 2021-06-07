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
                    echo'<a href="inicioAdmin.php"><img src="img/menu_adm.png" alt="menuAdm" width="80px" height="50px"></a>';
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
        <div class="search-container">
            <form action="/action_page.php">
              <input type="text" placeholder="Buscar.." name="search">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        <br><br>

        <div id="sliderFrame">
            <div id="slider">
                <img src="img/Imagen1 - copia.jpg" />
                <img src="img/Imagen2 - copia.jpg" />
                <img src="img/Imagen3 - copia.jpg" />
            </div>
            <!--Custom navigation buttons on both sides-->
            <div class="group1-Wrapper">
                <a onclick="imageSlider.previous()" class="group1-Prev"></a>
                <a onclick="imageSlider.next()" class="group1-Next"></a>
            </div>
            <!--nav bar-->
            <div style="text-align:center;padding:20px;z-index:20;height: 0px;">
                <a onclick="imageSlider.previous()" class="group2-Prev"></a>
                <a id='auto' onclick="switchAutoAdvance()"></a>
                <a onclick="imageSlider.next()" class="group2-Next"></a>
            </div>
        </div>

        <!-- Slider Imagenes 1 -->
        <!-- <form>
            <input id="botonAtras" class="arrows prev" type="button" value="" onclick="atras()">
            <img src="img/Imagen1.jpg" width="100vw" height="350px" id="imagen">
            <input id="botonAdelante" class="arrows next" type="button" value="" onclick="adelante()">
        </form> -->
        <br>
        <hr>
        <?php
                $mysqli = new mysqli("localhost", "root", "password", "tecnoticos");
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    exit();
                }
                $id_dilema_max;
                $id_max = "SELECT MAX(id_dilema) AS id_dilema FROM dilema";
                if($resultado = $mysqli->query($id_max)){
                    while($row = $resultado->fetch_row()){
                        $id_dilema_max = $row[0];
                    }
                }
                echo "<a href='respPreguntas.php?dilema=".$id_dilema_max."'>";

        ?>
            <div class="Flip-cards">

            <?php
                $mysqli = new mysqli("localhost", "root", "password", "tecnoticos");
                if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                exit();
                }
            ?>
                <div class="front-face">
                    <div class="contents front">
                        <p><?php
                            
                            $sql2 = "SELECT titulo_dilema FROM dilema WHERE id_dilema = $id_dilema_max";
                            
                            if($resultado = $mysqli->query($sql2)){
                                while($row = $resultado->fetch_row()){
                                    $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
                                    $textoDilema = str_replace($aBorrar,"", $row[0]);
                                    
                                }
                            }
                            echo $textoDilema;
                        ?></p>
                    </div>
                </div>
            
                <div class="back-face" >
                    <div class="contents back">
                        <h2><?php
                            
                            $id_max = "SELECT MAX(id_dilema) AS id_dilema FROM dilema";
                            if($resultado = $mysqli->query($id_max)){
                                while($row = $resultado->fetch_row()){
                                    $id_dilema_max = $row[0];
                                }
                            }
                            
                            $sql2 = "SELECT titulo_dilema FROM dilema WHERE id_dilema = $id_dilema_max";
                            
                            if($resultado = $mysqli->query($sql2)){
                                while($row = $resultado->fetch_row()){
                                    $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
                                    $textoDilema = str_replace($aBorrar,"", $row[0]);
                                    
                                }
                            }
                            echo $textoDilema;
                        ?></h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </a>
        <?php
            $id_dilema_max = $id_dilema_max -1;
            echo "<a href='respPreguntas.php?dilema=".$id_dilema_max."'>";
        ?>
            <div class="Flip-cards2" >
                <div class="front-face">
                    <div class="contents front">
                        <p><?php 
                            $sql2 = "SELECT titulo_dilema FROM dilema WHERE id_dilema = $id_dilema_max";
                            
                            if($resultado = $mysqli->query($sql2)){
                                while($row = $resultado->fetch_row()){
                                    $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
                                    $textoDilema = str_replace($aBorrar,"", $row[0]);
                                    
                                }
                            }
                            echo $textoDilema;
                        ?></p>
                        <span></span>
                    </div>
                </div>
                <div class="back-face">
                    <div class="contents back">
                        <h2><?php 
                            
                            $sql2 = "SELECT titulo_dilema FROM dilema WHERE id_dilema = $id_dilema_max";
                            
                            if($resultado = $mysqli->query($sql2)){
                                while($row = $resultado->fetch_row()){
                                    $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
                                    $textoDilema = str_replace($aBorrar,"", $row[0]);
                                    
                                }
                            }
                            echo $textoDilema;
                        ?></h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </a>
        <?php
            $id_dilema_max = $id_dilema_max -1;
            echo "<a href='respPreguntas.php?dilema=".$id_dilema_max."'>";
        ?>
            <div class="Flip-cards3">
                <div class="front-face">
                    <div class="contents front">
                        <p><?php 
                            
                            $sql2 = "SELECT titulo_dilema FROM dilema WHERE id_dilema = $id_dilema_max";
                            
                            if($resultado = $mysqli->query($sql2)){
                                while($row = $resultado->fetch_row()){
                                    $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
                                    $textoDilema = str_replace($aBorrar,"", $row[0]);
                                    
                                }
                            }
                            echo $textoDilema;
                        ?></p>
                        <span></span>
                    </div>
                </div>
                <div class="back-face">
                    <div class="contents back">
                        <h2><?php 
                            
                            $sql2 = "SELECT titulo_dilema FROM dilema WHERE id_dilema = $id_dilema_max";
                            
                            if($resultado = $mysqli->query($sql2)){
                                while($row = $resultado->fetch_row()){
                                    $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
                                    $textoDilema = str_replace($aBorrar,"", $row[0]);
                                    
                                }
                            }
                            echo $textoDilema;
                        ?></h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </a>
        <br>
        
        <div class="Footer" style="margin-top: 25%">
                <div id="footerContacto" class="ContenidoFooter">Correo: eramire1@xtec.cat</div>
                <div id="footerCopy" class="ContenidoFooter">2021-2022 &copy; Tecnoetica</div>
                <div id="footerRedes" class="ContenidoFooter">Twitter</div>
        </div>
      </div>
      
      <script type="text/javascript">
        //The following script is for the group 2 navigation buttons.
        function switchAutoAdvance() {
            imageSlider.switchAuto();
            switchPlayPauseClass();
        }
        function switchPlayPauseClass() {
            var auto = document.getElementById('auto');
            var isAutoPlay = imageSlider.getAuto();
            auto.className = isAutoPlay ? "group2-Pause" : "group2-Play";
            auto.title = isAutoPlay ? "Pause" : "Play";
        }
        switchPlayPauseClass();
    </script>
</body>
</html>
