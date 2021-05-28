<?php
    session_start();

    if((isset($_POST['titulo_dilema']) && !empty($_POST['titulo_dilema']))){
        $titulo_dilema = $_POST['titulo_dilema'];
        
        // Create connection
        $conn = new mysqli("localhost", "root", "admin123", "tecnoticos");
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
                        
                        //Separar las preguntas para hacer posteriormente su INSERT individual

                        $tipoNumeracion='<p>';

                        // Averiguaremos de que tipo de Enumeracion sera
                        if(strlen(strstr($actividades,'<ul>'))>0){
                            $tipoNumeracion= '<ul>';
                        }

                        if(strlen(strstr($actividades,'<ol>'))>0){
                            $tipoNumeracion= '<ol>';
                        }

                        //Extraemos cada una de las preguntas escritas y hacemos los INSERTS en la tabla PREGUNTA
                        $dom = new DOMDocument;
                        $dom->loadHTML($actividades);

                        if($li = $dom->getElementsByTagName('li')){
                            foreach($li as $list){
                                //echo $list->nodeValue, PHP_EOL;
                                $cadena = $list->nodeValue;
                                echo $cadena;
                                for($i=0;$i<strlen($cadena);$i++){
                                    if($cadena[$i]=="'"){
                                        $cadena[$i]=="\'";
                                    }
                                }
                                $sql = "INSERT INTO pregunta (texto_pregunta, tipo_numeracion, id_dilema)  
                                VALUES ('$cadena', '$tipoNumeracion', '$ultimoID')";
                                
                                if ($conn->query($sql) === TRUE) {
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                        }

                        if($p = $dom ->getElementsByTagName('p')){
                            foreach($p as $list){
                                //echo $list->nodeValue, PHP_EOL;
                                $cadena = $list->nodeValue;
                                echo $cadena;
                                for($i=0;$i<strlen($cadena);$i++){
                                    if($cadena[$i]=="'"){
                                        $cadena[$i]=="\'";
                                    }
                                }
                                $sql = "INSERT INTO pregunta (texto_pregunta, tipo_numeracion, id_dilema)  
                                VALUES ('$cadena', '$tipoNumeracion', '$ultimoID')";
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
    }
?>