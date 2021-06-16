<?php
    function datosUsuario(){
        $idUsuario = $_SESSION['user_id'];

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

        $result = $conn->prepare("SELECT edad, sexo, correo FROM usuario WHERE id_usuario = $idUsuario");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            echo "<p class='title'>".$row['correo']."</p>";
            echo "<p>Edad: ".$row['edad']." </p>";
            echo "<p>Sexo: ";
            if($row['sexo']== 'H'){
                echo "Hombre";
            }
            if($row['sexo']== 'M'){
                echo "Mujer";
            }
            if($row['sexo']== 'I'){
                echo "Indiferente";
            }
            echo  "</p>";
        }

        echo "<form method='POST'>
                <input type='hidden' name='idUsuario' value='". $idUsuario ."'>
                <input type='hidden' name='contraseña' value='false'>
                <input type='submit' value='Modificar Perfil' formaction='./modificarCuenta.php'>
            </form>";
        echo "<br><form method='POST'>
            <input type='hidden' name='idUsuario' value='". $idUsuario ."'>
            <input type='hidden' name='contraseña' value='true'>
            <input type='submit' value='Modificar Contraseña' formaction='./modificarCuenta.php'>
        </form> <br>"; 
        if($_SESSION['role'] == "usuario"){
            echo " <form method='POST'>
                <input type='hidden' name='borrar' value='". $idUsuario ."'>
                <input type='submit' value='Eliminar Cuenta' formaction='./eliminarCuenta.php'>
            </form>";  
        }
    }

    function modificarDatosUsuario($idUsuario, $esContraseña){

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
        
        if($esContraseña=='false'){
            $result = $conn->prepare("SELECT edad, sexo, correo FROM usuario WHERE id_usuario = $idUsuario");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            while ($row = $result->fetch()) {

                echo "<p class='title'><input name='correo' type='email' value ='".$row['correo']."'></input> </p>";

                echo "<p>Edad: <input name='edad' type='number' min='9' max='100' value ='".$row['edad']."'></input> </p>";

                echo "<label for='sexo'>Sexo:</label> ";
                echo "<select id='sexo' name='sexo'>";
                
                if($row['sexo']== 'M'){
                    echo "<option value='M' selected>Mujer</option>";
                    echo "<option value='H'>Hombre</option>";
                    echo "<option value='I'>Indiferente</option>";
                }
                if($row['sexo']== 'H'){
                    echo "<option value='M'>Mujer</option>";
                    echo "<option value='H' selected>Hombre</option>";
                    echo "<option value='I'>Indiferente</option>";
                }
                if($row['sexo']== 'I'){
                    echo "<option value='M'>Mujer</option>";
                    echo "<option value='H'>Hombre</option>";
                    echo "<option value='I' selected>Indiferente</option>";
                }
                echo "</select>";
            }
            echo "<br>";
            echo "<input type='hidden' name='idUsuario' value='". $idUsuario ."'>
                    <input type='submit' value='Guardar Cambios' formaction='./utiles/modCuenta.php'>";
        }

        if($esContraseña == 'true'){
            $consulta = $conn->prepare("SELECT contraseña FROM usuario WHERE id_usuario = $idUsuario");
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            $consulta->execute();

            while ($row = $consulta->fetch()) {
                echo "<label>Contraseña Nueva</label>";
                // echo "<input name='contraseña' type='password' value ='".$row['contraseña']."'></input>";
                echo "<div class='form-row'>
                    <div class='col'>
                        <input class='form-control' type='password' name='contraseña' id='password' value ='".$row['contraseña']."'>
                    </div>
                    <div class='col'>
                        <button id='txtBotonModPass' class='btn btn-primary' type='button' onclick='mostrarContrasena()'>Mostrar Contraseña</button>
                    </div>";
                echo "<input type='hidden' name='idUsuario' value='". $idUsuario ."'>
                    <input type='submit' value='Guardar Cambios' formaction='utiles/modCuenta.php'>";
            }
        }
    }
?>