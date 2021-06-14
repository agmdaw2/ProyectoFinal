<?php
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
    $idUsuario = $_POST["idUsuario"];

    //Cambiar datos
    if((isset($_POST['correo']) && !empty($_POST['correo']))){
        $correoUsuario = $_POST["correo"];
        $edadUsuario = $_POST["edad"];
        $sexoUsuario = $_POST["sexo"];

        $result = $conn->prepare("UPDATE usuario SET edad = $edadUsuario, correo = '$correoUsuario', 
                                                    sexo = '$sexoUsuario'
                                                        WHERE id_usuario = $idUsuario");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
    }

    // Cambiar Password
    if((isset($_POST['contraseña']) && !empty($_POST['contraseña']))){
        $idUsuario = $_POST["idUsuario"];

    }

    header("Location: ../perfilUsuario.php");
?>