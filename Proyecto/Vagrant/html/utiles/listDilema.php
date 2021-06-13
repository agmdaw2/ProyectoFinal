<?php
    function crearListadoDilemas(){
        $servername = "localhost";
        $username = "root";
        $password = "admin";
    
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

        // $_SESSION['user_id'] = $usuario['id_usuario'];
        // $_SESSION['role'] = $usuario['rol'];

        //ESTATICO HAY QUE CAMBIARLO CON LAS SESSION DE ARRIBA
        $rol = 'admin';
        $rol2 = 'usuario';
        $user = $rol2;
        $idUsuario = 2;

        while ($row = $result->fetch()) {
            echo "<tr>";
            
            $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
            $textoDilema = str_replace($aBorrar,"", $row['titulo_dilema']);
            echo "<td>".$textoDilema."</td>";
            $idprueba = $row['id_dilema'];
            // if($_SESSION['rol'] == 'admin'){
            if($user == 'admin'){
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

            // if($_SESSION['rol'] == 'usuario'){
                if($user == 'usuario'){
                    $consulta = $conn->prepare("SELECT CASE WHEN EXISTS(SELECT 1 FROM respuesta  WHERE id_usuario = $idUsuario AND id_dilema = $idprueba)
                                                    THEN 'true'
                                                    ELSE 'false'
                                                END AS 'boolean'");
                    $consulta->setFetchMode(PDO::FETCH_ASSOC);
                    $consulta->execute();
                    while ($row = $consulta->fetch()){
                        if($row['boolean'] == 'true'){
                            echo "<td>
                                <a><img src='img/activado.png'></a>
                            </td>";
                        }else{
                            echo "<td>
                                <a href='respPreguntas.php?dilema=".$idprueba."'><img src='img/noactivado.png'></a>
                            </td>";
                        }
                    }
                }

        }
    }

?>