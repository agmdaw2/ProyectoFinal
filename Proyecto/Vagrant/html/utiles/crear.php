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
                    
                    $conn->close();
                }
            }
        }
}
?>