<?php
    session_start();

    if((isset($_POST['titulo_dilema']) && !empty($_POST['titulo_dilema']))){
        $titulo_dilema = $_POST['titulo_dilema'];
        
        // Create connection
        $conn = new mysqli("localhost", "root", "admin", "tecnoticos");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if((isset($_POST['recurso_dilema']) && !empty($_POST['recurso_dilema']))){
            $recurso_dilema = $_POST['recurso_dilema'];
            
            if((isset($_POST['resumen_dilema']) && !empty($_POST['resumen_dilema']))){
                $resumen_dilema = $_POST['resumen_dilema'];
                
                if((isset($_POST['descripcion_dilema']) && !empty($_POST['descripcion_dilema']))){
                    $descripcion_dilema = $_POST['descripcion_dilema'];

                    $sql = "INSERT INTO dilema (titulo_dilema, recurso_dilema, resumen_dilema, descripcion_dilema) 
                    VALUES ('$titulo_dilema', '$recurso_dilema', '$resumen_dilema', '$descripcion_dilema')";
    
                    if ($conn->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    
                    // SEGUNDA CONEXION para añadir la actividad del dilema
                    if((isset($_POST['actividad_dilema']) && !empty($_POST['actividad_dilema']))){
                        $actividades = $_POST['actividad_dilema'];
                        
                        $ultimoID = 0;
                        
                        $consulta = "SELECT MAX(id_dilema) AS id_dilema FROM dilema";
                        if ($result = $conn->query($consulta)) {
                            while ($row = $result->fetch_row()) {
                                $ultimoID = $row[0]; 
                            }
                        }

                        //Extraemos cada una de las preguntas escritas y hacemos los INSERTS en la tabla PREGUNTA
                        $dom = new DOMDocument;
                        $dom->loadHTML($actividades);
                        insertsPreg($dom, '', $ultimoID);

                    }
                }
            }
        }
        $conn->close();
    }

    function insertsPreg(DOMNode $domNode, $tipo, $ultimoDilemaID) {
        $tipoNumeracion=$tipo;
         // Create connection
         $conn = new mysqli("localhost", "root", "admin", "tecnoticos");
         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }

        foreach ($domNode->childNodes as $node)
        {   
            if($node->nodeName=='ul'|| $node->nodeName=='li'||$node->nodeName=='ol' || $node->nodeName=='p'){
                
                if($node->nodeName=='ul'){
                    $tipoNumeracion = 'ul';
                }

                if($node->nodeName=='ol'){
                    $tipoNumeracion = 'ol';
                }

                if($node->nodeName=='li'){
                    //print $tipoNumeracion.'-'.$node->nodeName.':'.$node->nodeValue;
                    $sql = "INSERT INTO pregunta (texto_pregunta, tipo_numeracion, id_dilema)  
                        VALUES ('$node->nodeValue', '$tipoNumeracion', '$ultimoDilemaID')";
                        
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                }

                if($node->nodeName=='p'){
                    $tipoNumeracion = 'p';
                    //print $tipoNumeracion.'-'.$node->nodeName.':'.$node->nodeValue;
                    $sql = "INSERT INTO pregunta (texto_pregunta, tipo_numeracion, id_dilema)  
                        VALUES ('$node->nodeValue', '$tipoNumeracion', '$ultimoDilemaID')";
                        
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                }
            }
            // en caso de tener Hijos el Nodo vuelve a llamar a la funcion
            if($node->hasChildNodes()) {
                insertsPreg($node, $tipoNumeracion, $ultimoDilemaID);
            }
        }    
    }
?>
