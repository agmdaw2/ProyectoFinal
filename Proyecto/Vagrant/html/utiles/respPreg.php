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
        echo "<form method='GET' action>";
        $contador = 1;
        $contadorActividades = 1;
        while ($row = $result->fetch()) {
            if($contador++ == 1){
                echo "<div id='titulo'>".$row['titulo_dilema']."</div>";
                echo "<div id='descripcion'>".$row['descripcion_dilema']."</div>";
                echo "<div id='recursos'>".$row['recurso_dilema']."</div>";
                if($estoyLogeado == false){
                    echo "<div id='actividad>";
                    echo "<div id='titulo_actividad'><h3>REFLEXIONEM?</h3></div>";
                }
                
            }
            // Al estar logeado podremos ver la Actividad y poder contestarlas
            if($estoyLogeado == false){
                // en el caso de encontrar un parrafo no tendra inputs pero si en caso de enumeraciones
                if($row['tipo_numeracion'] == 'p'){
                    echo "<div>Activitat.".$contadorActividades++."</div>";
                }

                echo "<div id='recursos_dilema'>".$row['texto_pregunta']."</div>";

                if($row['tipo_numeracion'] == 'ul' || $row['tipo_numeracion'] == 'ol'){
                    echo "<input name='' type='text' placeholder='Contesta aquí'>";
                }
            }

        }
        echo "</div>";
        echo "<input type='submit' value='Guarda y Envia' id='enviar'>";
        echo "</form>";
        echo "</div>";

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<input type='hidden'></input>";
    }
?>