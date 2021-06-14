<?php
    session_start();
// Create connection
$conn = new mysqli("localhost", "root", "password", "tecnoticos");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
Global $contadorPreguntas;

    if((isset($_POST['titulo_dilema']) && !empty($_POST['titulo_dilema']))){
        $titulo_dilema = $_POST['titulo_dilema'];
        
        if((isset($_POST['recurso_dilema']) && !empty($_POST['recurso_dilema']))){
            $recurso_dilema = $_POST['recurso_dilema'];
            $idDilemaEscogido = $_POST['idDilemEscogido'];
            $idPregunta = $_POST['idPrimeraPregunta'];
            $contadorPreguntas = $idPregunta;
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

                        //ID ULTIMA PREGUNTA del DILEMA
                        $ultimoIDPregunta = 0;
                        $consulta = "SELECT MAX(id_pregunta) FROM pregunta WHERE id_dilema =$idDilemaEscogido";
                        if ($result = $conn->query($consulta)) {
                            while ($row = $result->fetch_row()) {
                                $ultimoIDPregunta = $row[0]; 
                            }
                        }
                        $ultimoIDPregunta++;

                        //Extraemos cada una de las preguntas escritas y hacemos los INSERTS en la tabla PREGUNTA
                        $dom = new DOMDocument;
                        $dom->loadHTML($actividades);
                        insertsPreg($dom, '', $idDilemaEscogido, $ultimoIDPregunta, $conn);
                    }

                }
            }
        }
        $conn->close();
        header("Location: ./listarDilemas.php");
    }

    function insertsPreg(DOMNode $domNode, $tipo, $idDilemaEscogido, $ultimoIDPregunta) {
        $tipoNumeracion=$tipo;
        // Create connection
        $conn = new mysqli("localhost", "root", "admin", "tecnoticos");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        foreach ($domNode->childNodes as $node){   
            
            if($node->nodeName=='li'|| $node->nodeName=='p'){
                
                if($node->nodeName=='li'){
                    $tipoNumeracion = 'ol';
                    $GLOBALS['contadorPreguntas'];
                    // print "Dilema:".$idDilemaEscogido.", Pregunta: ". $GLOBALS['contadorPreguntas'].", Numer: ". $tipoNumeracion.'-'.$node->nodeValue;
                    // echo "<br>";
                    // $GLOBALS['contadorPreguntas']= $GLOBALS['contadorPreguntas']+1;
                    $idPregunta = $GLOBALS['contadorPreguntas'];
                    if($idPregunta<$ultimoIDPregunta){
                        $sql = "UPDATE pregunta SET texto_pregunta = '$node->nodeValue', tipo_numeracion = '$tipoNumeracion'
                                                    WHERE id_pregunta = $idPregunta";
                        if ($conn->query($sql) === TRUE) {
                            $GLOBALS['contadorPreguntas']= $GLOBALS['contadorPreguntas']+1;
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $sql = "INSERT INTO pregunta (texto_pregunta, tipo_numeracion, id_dilema)  
                                    VALUES ('$node->nodeValue', '$tipoNumeracion', '$idDilemaEscogido')";
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }

                if($node->nodeName=='p'){
                    $tipoNumeracion = 'p';
                    // print "Dilema:".$idDilemaEscogido.", Pregunta: ". $GLOBALS['contadorPreguntas'].", Numer: ". $tipoNumeracion.'-'.$node->nodeValue;
                    // echo "<br>";
                    // $GLOBALS['contadorPreguntas']= $GLOBALS['contadorPreguntas']+1;
                    $idPregunta = $GLOBALS['contadorPreguntas'];
                    if($idPregunta<$ultimoIDPregunta){
                        $sql = "UPDATE pregunta SET texto_pregunta = '$node->nodeValue', tipo_numeracion = '$tipoNumeracion'
                                                    WHERE id_pregunta = $idPregunta";
                        if ($conn->query($sql) === TRUE) {
                            $GLOBALS['contadorPreguntas']= $GLOBALS['contadorPreguntas']+1;
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    if($idPregunta>$ultimoIDPregunta){
                        $sql = "INSERT INTO pregunta (texto_pregunta, tipo_numeracion, id_dilema)  
                        VALUES ('$node->nodeValue', 'p', '$idDilemaEscogido')";
                        
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
            }
            // en caso de tener Hijos el Nodo vuelve a llamar a la funcion
            if($node->hasChildNodes()) {
                insertsPreg($node, $tipoNumeracion, $idDilemaEscogido, $ultimoIDPregunta);
            }
        }    
    }
?>