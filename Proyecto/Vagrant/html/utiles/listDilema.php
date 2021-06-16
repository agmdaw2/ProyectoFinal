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

        $idUsuario = $_SESSION['user_id'];

        while ($row = $result->fetch()) {
            echo "<tr>";
            $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
            $textoDilema = str_replace($aBorrar,"", $row['titulo_dilema']);
            echo "<td class='nombreDilemasListado';'>".$textoDilema."</td>";
            $idprueba = $row['id_dilema'];

            if($_SESSION['role'] == 'admin'){
                echo "<td>
                    <form method='POST'>
                        <input type='hidden' name='modificar' value=". $row['id_dilema'] .">
                        <input type='submit' value='Modificar' style='background-color:black;
                        display: block;
                        text-align: center;
                        border: 2px solid #2ecc71;
                        padding: 14px 40px;
                        outline: none;
                        color: white;
                        border-radius: 24px;
                        transition: 0.25s;
                        cursor: pointer;' formaction='./modificarDilema.php'>
                    </form>
                </td>";

                echo "<td>
                    <form method='POST'>
                        <input type='hidden' name='borrar' value=". $row['id_dilema'] .">
                        <input type='submit' value='Borrar' style='background-color:black;
                        display: block;
                        text-align: center;
                        border: 2px solid red;
                        padding: 14px 40px;
                        outline: none;
                        color: white;
                        border-radius: 24px;
                        transition: 0.25s;
                        cursor: pointer;' formaction='./borrar.php'>
                    </form>
                </td>";
            }

            if($_SESSION['role'] == 'usuario'){
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