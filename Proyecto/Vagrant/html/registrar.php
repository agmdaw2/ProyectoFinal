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


if(isset($_POST['registrarse'])){
    if (strlen($_POST['edad']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['pw']) >= 1 && strlen($_POST['email']) >= 1)  
    {
        $edad = trim($_POST['edad']);
        $email = trim($_POST['email']);
        $pw = trim($_POST['pw']);
        $sexo = trim($_POST['sexo']);
        
        //CREAS EL INSERT
        $consulta = "INSERT INTO usuario(edad,correo,contraseña,sexo) VALUES(:edad,:email,:pw,:sexo)";
        //PREPARAS LA CONEXION
        $consulta = $conn->prepare($consulta);  
        //DAS VALOR A LOS VALUES
        $consulta->bindParam(':edad',$edad,PDO::PARAM_STR);
        $consulta->bindParam(':email',$email,PDO::PARAM_STR);
        $consulta->bindParam(':pw',$pw,PDO::PARAM_STR);
        $consulta->bindParam(':sexo',$sexo,PDO::PARAM_STR);
        $consulta->execute();

        if($consulta){
            ?>
            <h3> "Registro correcto" </h3>
            <?php
            header("location: login.php");
        } else {
            ?>
            <h3> "Registro no ha sido posible, intente de nuevo" </h3>
            <?php
    }}
        else {
            ?>
            <h3> "Completa todos los campos!" </h3>
            <?php
        }

    }

?>
