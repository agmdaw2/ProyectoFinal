<?php
    $conn = new mysqli("localhost", "root", "password", "tecnoticos");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Cambiar datos
    if((isset($_POST['correo']) && !empty($_POST['correo']))){

        $idUsuario = $_POST["idUsuario"];
        $correoUsuario = $_POST["correo"];
        $edadUsuario = $_POST["edad"];
        $sexoUsuario = $_POST["sexo"];

        $sql = "UPDATE usuario SET edad = $edadUsuario, correo = '$correoUsuario', sexo = '$sexoUsuario'
                                                            WHERE id_usuario = $idUsuario";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }

    // Cambiar Password
    if((isset($_POST['contraseña']) && !empty($_POST['contraseña']))){
        $idUsuario = $_POST["idUsuario"];
        $nuevaPassword = $_POST['contraseña'];

        $sql = "UPDATE usuario SET contraseña = '$nuevaPassword' WHERE id_usuario = $idUsuario";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    //     $result = $conn->prepare("UPDATE usuario SET contraseña = '$nuevaPassword'
    //         WHERE id_usuario = $idUsuario");
    //     $result->setFetchMode(PDO::FETCH_ASSOC);
    //     $result->execute();
    }
    $conn->close();

    header("Location: ../perfilUsuario.php");
?>
