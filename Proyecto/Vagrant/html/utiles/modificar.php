<?php
    session_start();

    if((isset($_POST['titulo_dilema']) && !empty($_POST['titulo_dilema']))){
        $titulo_dilema = $_POST['titulo_dilema'];
        
        // Create connection
        $conn = new mysqli("localhost", "root", "password", "tecnoticos");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if((isset($_POST['recurso_dilema']) && !empty($_POST['recurso_dilema']))){
            $recurso_dilema = $_POST['recurso_dilema'];
            $idDilemaEscogido = $_POST['idDilemEscogido'];
            $idPrimeraPregunta = $_POST['idPrimeraPregunta'];
            if((isset($_POST['resumen_dilema']) && !empty($_POST['resumen_dilema']))){
                $resumen_dilema = $_POST['resumen_dilema'];
                
                if((isset($_POST['descripcion_dilema']) && !empty($_POST['descripcion_dilema']))){
                    $descripcion_dilema = $_POST['descripcion_dilema'];

                    $sql = "UPDATE dilema SET titulo_dilema = '$titulo_dilema', recurso_dilema = '$recurso_dilema',
                                                resumen_dilema = '$resumen_dilema', descripcion_dilema = '$descripcion_dilema'
                                                    WHERE id_dilema = $idDilemaEscogido";

                    if ($conn->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    
                    // SEGUNDA CONEXION para añadir la actividad del dilema
                    if((isset($_POST['actividad_dilema']) && !empty($_POST['actividad_dilema']))){
                        $actividades = $_POST['actividad_dilema'];

                        // cuantas preguntas hay del dilema?
                        $cantidadPreguntas = 0;
                        $sql = "SELECT COUNT (*) pregunta WHERE id_dilema = $idDilemaEscogido";
                        if ($result = $conn->query($sql)) {
                            while ($row = $result->fetch_row()) {
                                $cantidadPreguntas = $row[0]; 
                            }
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                        $tipoNumeracion='p';
                        // Averiguaremos de que tipo de Enumeracion sera
                        if(strlen(strstr($actividades,'<ul>'))>0){
                            $tipoNumeracion= 'ul';
                        }

                        if(strlen(strstr($actividades,'<ol>'))>0){
                            $tipoNumeracion= 'ol';
                        }

                        //Extraemos cada una de las preguntas escritas y hacemos los INSERTS en la tabla PREGUNTA
                        $dom = new DOMDocument;
                        $dom->loadHTML($actividades);

                        if($li = $dom->getElementsByTagName('li')){
                            foreach($li as $list){
                                //echo $list->nodeValue, PHP_EOL;
                                $sql = "UPDATE pregunta SET texto_pregunta = '$list->nodeValue', tipo_numeracion = '$tipoNumeracion',
                                                            id_dilema = $idDilemaEscogido
                                                                WHERE id_pregunta = $idPrimeraPregunta";
                                if ($conn->query($sql) === TRUE) {
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                        }

                        if($p = $dom ->getElementsByTagName('p')){
                            foreach($p as $list){
                                // echo $list->nodeValue, PHP_EOL;
                                $sql = "UPDATE pregunta SET texto_pregunta = '$list->nodeValue', tipo_numeracion = '$tipoNumeracion',
                                                            id_dilema = $idDilemaEscogido
                                                                WHERE id_pregunta = $idPrimeraPregunta";
                                if ($conn->query($sql) === TRUE) {
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                        }

                    }
                }
            }
        }
        $conn->close();
        header("Location: ./listarDilemas.php");
    }
?>
