<?php
    function crearListadoDilemas(){
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

        $result = $conn->prepare("SELECT dilema.titulo_dilema, dilema.id_dilema FROM dilema");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        while ($row = $result->fetch()) {
            $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
            $textoDilema = str_replace($aBorrar,"", $row['titulo_dilema']);
            echo "<tr><td>".$textoDilema."</td>";

            echo "<td>
                <form method='POST'>
                    <input type='hidden' name='modificar' value=". $row['id_dilema'] .">
                    <input type='submit' value='Modificar' formaction='./modificarDilema.php'>
                </form>
              </td>";

            echo "<td>
                <form method='POST'>
                    <input type='hidden' name='borrar' value=". $row['id_dilema'] .">
                    <input type='submit' value='Borrar' formaction='./borrar.php'>
                </form>
              </td>";
        }
    }

?>