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
    if (strlen($_POST['edad']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['pw']) >= 1 && strlen($_POST['sexo']) >= 1)  
    {
        $edad = trim($_POST['edad']);
        $email = trim($_POST['email']);
        $pw = trim($_POST['pw']);
        $sexo = trim($_POST['sexo']);

        $dominio= explode("@", $email );
        $instituto = explode(".", $dominio[1]);
        array_pop($instituto);
        $instituto_clean = implode("",$instituto);

        $connex = new mysqli("localhost", "root", "password", "tecnoticos");
        // Check connection
        if ($connex->connect_error) {
            die("Connection failed: " . $connex->connect_error);
        }
        //CON ESTO COMPROVAMOS SI EL DOMINIO EXISTE, SI NO ES ASI, CREAREMOS UNO NUEVO
        $sql = "SELECT id_instituto FROM instituto WHERE dominio_instituto = $instituto_clean";
        if ($connex->query($sql) === TRUE) {
        } else {
            $sql2 = "INSERT INTO instituto(nombre_instituto, dominio_instituto) VALUES('$instituto_clean','$instituto_clean')";
            if ($connex->query($sql2) === TRUE) {
                $id_max = "SELECT MAX(id_instituto) AS id_instituto FROM instituto";
                if($resultado = $connex->query($id_max)){
                    while($row = $resultado->fetch_row()){
                        $id_instituto = $row[0];
                    }
                }
            } else {
                echo "Error: " . $sql2 . "<br>" . $connex->error;
            }
        }
        
        //CREAS EL INSERT
        $consulta = "INSERT INTO usuario(edad,correo,contraseña,sexo,id_instituto) VALUES(:edad,:email,:pw,:sexo,:instituto)";
        //PREPARAS LA CONEXION
        $consulta = $conn->prepare($consulta);  
        //DAS VALOR A LOS VALUES
        $consulta->bindParam(':edad',$edad,PDO::PARAM_STR);
        $consulta->bindParam(':email',$email,PDO::PARAM_STR);
        $consulta->bindParam(':pw',$pw,PDO::PARAM_STR);
        $consulta->bindParam(':sexo',$sexo,PDO::PARAM_STR);
        $consulta->bindParam(':instituto',$id_instituto,PDO::PARAM_STR);
        $consulta->execute();

        if($consulta){
            ?>
            <h3> "Registro correcto" </h3>
            <?php
            
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
