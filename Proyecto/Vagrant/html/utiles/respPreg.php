<?php
    session_start();
    // Create connection

    function  respPreg($id, $estoyLogeado){
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

        $result = $conn->prepare("SELECT dilema.titulo_dilema, dilema.descripcion_dilema, dilema.recurso_dilema, 
                                        pregunta.texto_pregunta, pregunta.id_pregunta, pregunta.tipo_numeracion 
                                        FROM dilema, pregunta where dilema.id_dilema ='$id' 
                                                                AND pregunta.id_dilema ='$id'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        echo "<div id='dilemaAll'>";
        //HAY QUE borrar la linea siguiente
        //$estoyLogeado = true;
        if($estoyLogeado == true){
            echo "<form method='POST' action>";
        }
        $contador = 1;
        $contadorActividades = 1;

        while ($row = $result->fetch()) {
            if($contador++ == 1){
                echo "<div id='parrafoPD'>".$row['titulo_dilema']."</div>";
                echo "<div id='parrafoPD'>".$row['descripcion_dilema']."</div>";
                echo "<div id='parrafoLink'>".$row['recurso_dilema']."</div>";
                if($estoyLogeado == true){
                    echo "<div id='parrafoPD'>";
                    echo "<div id='titulo_actividad'><h3>REFLEXIONEM?</h3></div>";
                }
            }
            // Al estar logeado podremos ver la Actividad y poder contestarlas
            if($estoyLogeado == true){
                // en el caso de encontrar un parrafo no tendra inputs pero si en caso de enumeraciones
                if($row['tipo_numeracion'] == 'p'){
                    echo "<div>Activitat.".$contadorActividades++."</div>";
                }
                echo "<div id='parrafoLink'>".$row['texto_pregunta']."</div>";
                if($row['tipo_numeracion'] == 'ul' || $row['tipo_numeracion'] == 'ol'){
                    echo "<input name='texto_respuesta[".$row['id_pregunta']."][respuesta]' type='text' placeholder='Contesta aquí'>";
                    echo "<input name='texto_respuesta[".$row['id_pregunta']."][respuesta_id]' type='hidden' value='".$row['id_pregunta']."'>";
                }
            }
        }

        echo "</div>";
        if($estoyLogeado == true){
            echo "<!--<input type='submit' value='Guarda y Envia' id='enviar'>-->
            <div class='button-container-2'>
          <span class='mas'>y envia</span>
          <button id='work' type='submit' name='Hover'>Guarda</button>
        </div>";
            echo "</form>";
        }
 
        echo "</div>";

        if(isset($_POST['texto_respuesta']) && !empty($_POST['texto_respuesta'])){

            $idUsuario = $_SESSION['idUsuario'];
            //$idUsuario = 1;

            foreach ($_POST['texto_respuesta'] as $key => $values){
                $txt_Respuesta = $values['respuesta'];
                $id_preg = $values['respuesta_id'];

                $query = "INSERT INTO respuesta(texto_respuesta, id_usuario, id_pregunta, id_dilema)
                                VALUES (:respuesta, :idUsuario, :idPreg, :idDilema)";
                $query = $conn->prepare($query);
            
                $query->bindParam(':respuesta',$txt_Respuesta);
                $query->bindParam(':idPreg',$id_preg);
                $query->bindParam(':idDilema',$id);
                $query->bindParam(':idUsuario',$idUsuario);

                $query->execute();
            }
            echo'<script type="text/javascript"> 
                    alert("Tarea Guardada Correctamente");
                    window.location.href="index.php";
                </script>';
        }


        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<input type='hidden'></input>";
    }
?>