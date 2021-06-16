<?php
    
    function filtrar(){
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
        echo "<div class='divDes'>";
        echo "<form method='POST'>";

        echo "<div class='filtros3'><div id='filtroInstituto' class='filtroI'>";
        echo "<label>Elige el/los Institutos: </label><br>";
        $result = $conn->prepare("SELECT instituto.nombre_instituto, instituto.id_instituto FROM instituto");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            echo "<input type='checkbox' id='instituto".$row['id_instituto']."' name='filtro[instituto".$row['id_instituto']."][instituto]' value='".$row['id_instituto']."'>";
            echo "<label>".$row['nombre_instituto']."</label>";
            echo "<br>"; 
        }
        echo "</div>";
        echo "<br>";

        //filtro EDAD
        echo "<div id='filtroEdad' class='filtroE'>";
        echo "<label>Elige el formato de edad:</label>";        
        echo "<select onchange='tipoSelectorEdad()' id='selectTipoEdad'>";
        echo "<option selected='selected' disabled='disabled'>Tipo</option>";
        echo "<option value='R'>Rango de Edad</option>";
        echo "<option value='S'>Seleccionar Edad</option>";
        echo "</select>";
        echo "</div>";
        echo "<br>";

        //filtro SEXO
        echo "<div id='filtroSexo' class='filtroG'>";
        echo "<label>Elige el genero:</label>";        
        echo "<select name='filtro[sexo]' id='selectSexo' required>";
        echo "<option selected='selected' disabled='disabled'>Tipo</option>";
        echo "<option value='I'>Indefinido</option>";
        echo "<option value='M'>Mujer</option>";
        echo "<option value='H'>Hombre</option>";
        echo "</select>";
        echo "</div>";
        echo "<br></div>";

        //filtro DILEMA
        echo "<div class='filtros2'><div id='filtroDilema' class='filtroD'>";
        echo "<label>Elige el/los Dilemas: </label><br>";
        $result = $conn->prepare("SELECT dilema.titulo_dilema, dilema.id_dilema FROM dilema");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
       
        while ($row = $result->fetch()) {
            $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
            $textoDilema = str_replace($aBorrar,"", $row['titulo_dilema']);
            echo "<input type='checkbox' id='tituloDilema".$row['id_dilema']."' name='filtro[dilema".$row['id_dilema']."][dilema]' value='".$row['id_dilema']."' onclick='preguntas(".$row['id_dilema'].")'>";
            echo "<label>".$textoDilema."</label>";
            echo "<br>";
        }
        echo "</div>";
        echo "<br>";

        //filtro PREGUNTA
        echo "<div id='filtroPregunta' class='filtroP'>";
        echo "<label>Elige el/las Preguntas: </label><br>";
        $result = $conn->prepare("SELECT pregunta.texto_pregunta, pregunta.id_pregunta, pregunta.id_dilema FROM pregunta WHERE tipo_numeracion ='ul' OR tipo_numeracion ='ol'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            echo "<input type='checkbox' id='preguntaDilema".$row['id_dilema']."' name='filtro[pregunta".$row['id_pregunta']."][pregunta]' value='".$row['id_pregunta']."' style='display:none'>";
            echo "<label id='labelPreguntaDilema".$row['id_dilema']."' style='display:none'>".$row['texto_pregunta']."</label>";
        }
        echo "</div></div>";

        echo "<br>";
        echo "<input type='submit' value='Guarda los filtros' id='enviar' name='submit'>";

        echo "</form>";
        echo "</div>";

        $arrayInstitutosId=[]; 
        $edad='';
        $edadMin='';
        $edadMax='';
        $genero='';
        $arrayDilemaId=[];
        $arrayPreguntaId=[];

        //RECORRER $POST para recoger valores y enviarlos a la tabla ficticia
        if(isset($_POST['filtro']) && !empty($_POST['filtro'])){
            //var_dump ($_POST['filtro']);
            $array = $_POST['filtro'];
            foreach($array as $key => $values){
                if (is_array($values)){
                    foreach($values as $filtro => $id){
                        if($filtro == 'instituto'){
                            array_push($arrayInstitutosId, $id);
                        }
                        if($filtro == 'dilema'){
                            array_push($arrayDilemaId, $id);

                        }
                        if($filtro == 'pregunta'){
                            array_push($arrayPreguntaId, $id);
                        }
                        // echo $filtro.' tiene  de ID: '.$id;
                        // echo "<br>";
                    }

                }else{
                    if($key == 'edad'){
                        $edad = $values;
                        // echo "<br>";);
                    }

                    if($key == 'edadmax'){
                        $edadMax = $values;
                        // echo "<br>";);
                    }

                    if($key == 'edadmin'){
                        $edadMin = $values;
                        // echo "<br>";);
                    }

                    if($key == 'sexo'){
                        $genero = $values;
                        // echo "<br>";);
                    }
                    // echo $key.' es '.$values;
                    // echo "<br>";
                }
            }
            $edadBien = intval($edad);
            $edadMaxBien = intval($edadMax);
            $edadMinBien = intval($edadMin);

            imprimirTablaHead();

            //Array +1 Institutos
            if(count($arrayInstitutosId)==0 || count($arrayInstitutosId)>1 ){
                for($contadorInstitutos=0; $contadorInstitutos<(count($arrayInstitutosId)); $contadorInstitutos++){
                     //Array +1 Inst, +1 Dilema
                    if(count($arrayDilemaId)==0 || count($arrayDilemaId)>1 ){
                        for($contadorDilema=0; $contadorDilema<(count($arrayDilemaId)); $contadorDilema++){
                            for($contadorPreg=0; $contadorPreg<(count($arrayPreguntaId)); $contadorPreg++){
                                if(consultaExiste($arrayPreguntaId[$contadorPreg], $arrayDilemaId[$contadorDilema], $arrayInstitutosId[$contadorInstitutos], $genero, $edad )!=''){
                                    $result = $conn->prepare(prepareConsulta($genero, $edadBien, $arrayInstitutosId[$contadorInstitutos], $arrayDilemaId[$contadorDilema], $arrayPreguntaId[$contadorPreg], $edadMaxBien, $edadMinBien));
                                    //var_dump($result);
                                    imprimirTablaConsulta($result);
                                }
                            }
                        }
                    }
                    //Array +1 Inst, 1 Dilema
                    if(count($arrayDilemaId)==1){
                        //Array +1 Inst, 1 Dilema, +1Preg
                        if(count($arrayPreguntaId)==0 || count($arrayPreguntaId)>1 ){
                            for($contadorPreg=0; $contadorPreg<count($arrayPreguntaId); $contadorPreg++){
                                $result = $conn->prepare(prepareConsulta($genero, $edadBien, $arrayInstitutosId[$contadorInstitutos], $arrayDilemaId[0], $arrayPreguntaId[$contadorPreg], $edadMaxBien, $edadMinBien));
                                //var_dump($result);
                                imprimirTablaConsulta($result);
                            }
                        }
                        //Array +1 Inst, 1 Dilema, 1Preg
                        if(count($arrayPreguntaId)==1){
                            $result = $conn->prepare(prepareConsulta($genero, $edadBien, $arrayInstitutosId[$contadorInstitutos], $arrayDilemaId[0], $arrayPreguntaId[0], $edadMaxBien, $edadMinBien));
                            //var_dump($result);
                            imprimirTablaConsulta($result);
                        }
                    }
                }
            }

            // Array 1 Instituto
            if(count($arrayInstitutosId)==1){
                //Array 1 Inst, +1 Dilema, +1 Preg
                if(count($arrayDilemaId)==0 || count($arrayDilemaId)>1 ){
                    for($contadorDilema=0; $contadorDilema<(count($arrayDilemaId)); $contadorDilema++){
                        for($contadorPreg=0; $contadorPreg<(count($arrayPreguntaId)); $contadorPreg++){
                            if(consultaExiste($arrayPreguntaId[$contadorPreg], $arrayDilemaId[$contadorDilema], 0,'','')!=''){
                                $result = $conn->prepare(prepareConsulta($genero, $edadBien, $arrayInstitutosId[0], $arrayDilemaId[$contadorDilema], $arrayPreguntaId[$contadorPreg], $edadMaxBien, $edadMinBien));
                                //var_dump($result);
                                imprimirTablaConsulta($result);
                            }
                        }
                    }
                }
                //Array 1 Inst, 1 Dilema
                if(count($arrayDilemaId)==1){
                    //Array 1 Inst, 1 Dilema, +1 Preg
                    if(count($arrayPreguntaId)==0 || count($arrayPreguntaId)>1 ){
                        for($contadorPreg=0; $contadorPreg<count($arrayPreguntaId); $contadorPreg++){
                            $result = $conn->prepare(prepareConsulta($genero, $edadBien, $arrayInstitutosId[0], $arrayDilemaId[0], $arrayPreguntaId[$contadorPreg], $edadMaxBien, $edadMinBien));
                            //var_dump($result);
                            imprimirTablaConsulta($result);
                        }
                    }
                    //Array 1 Inst, 1 Dilema, 1 Preg
                    if(count($arrayPreguntaId)==1){
                        $result = $conn->prepare(prepareConsulta($genero, $edadBien, $arrayInstitutosId[0], $arrayDilemaId[0], $arrayPreguntaId[0], $edadMaxBien, $edadMinBien));
                        //var_dump($result);
                        imprimirTablaConsulta($result);
                    }
                }
            }
            
        }

        // else{
        //     echo'<script type="text/javascript"> 
        //     alert("Te ha faltado seleccionar el Instituto");
        //     window.location.href="descargar.php";
        //     </script>';
        // }

        //imprimirBR();
    }
    function imprimirBR(){
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
    }
    function imprimirTablaHead(){
        echo "<table id='tablaContenido' style='display:none'>";
        echo "<tr>";
        echo "<th>Instituto</th>";
        echo "<th>Edad</th>";
        echo "<th>Genero</th>";
        echo "<th>Dilema</th>";
        echo "<th>Pregunta</th>";
        echo "<th>Respuestas</th>";
        echo "</tr>";
    }
    function imprimirBoton(){
        echo "<div class='button-container-2'>";
        echo "<span class='mas'>Tabla</span>";
        echo "<button id='work' type=button' name='Hover' >Crear</button>";
        echo "</div>";
    }
    function imprimirScript(){
        echo "<script src='utiles/main.js'></script>";
    }

    function consultaExiste($idPregunta, $idDilema, $idInstituto, $genero, $edad){
        $existe = false;
        $dato ='';
        // Create connection
        $conn = new mysqli("localhost", "root", "password", "tecnoticos");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if($idInstituto==0){
            $consulta = "SELECT id_dilema FROM pregunta WHERE id_pregunta = $idPregunta 
                                        AND EXISTS (SELECT id_dilema FROM pregunta WHERE id_pregunta = $idPregunta AND id_dilema = $idDilema )";
            if ($result = $conn->query($consulta)) {
                while ($row = $result->fetch_row()) {
                    $dato = $row[0]; 
                }
                if($dato !=''){
                    $existe = true;
                }
            }
        }

        if($idInstituto>0){
            
            $consulta = "SELECT id_dilema FROM pregunta WHERE id_pregunta = $idPregunta 
            AND EXISTS (SELECT id_dilema FROM pregunta WHERE id_pregunta = $idPregunta AND id_dilema = $idDilema )";
            if ($result = $conn->query($consulta)) {
                while ($row = $result->fetch_row()) {
                    $dato = $row[0]; 
                }
                if($dato !=''){
                    $existe = true;
                }
            }
        }

        return $existe;
    }

    function prepareConsulta($genero, $edadBien, $institutoId, $dilemaId, $preguntaId, $edadMaxBien, $edadMinBien){
        // echo "edad: ".$edadBien."<br>";
        // echo "edadMIN: ".$edadMinBien."<br>";
        // echo "edadMAX: ".$edadMaxBien."<br>";
        if($edadBien!=0){
            if($genero=='I'){
                $return ="SELECT instituto.nombre_instituto, usuario.edad, usuario.sexo,
                        dilema.titulo_dilema, pregunta.texto_pregunta, respuesta.texto_respuesta 
                        FROM usuario, instituto, dilema, pregunta, respuesta
                        WHERE (usuario.sexo = '$genero'
                            OR usuario.sexo = 'M'
                            OR usuario.sexo = 'H')
                            AND usuario.edad = $edadBien
                            AND instituto.id_instituto = '$institutoId'
                            AND dilema.id_dilema = '$dilemaId'
                            AND pregunta.id_pregunta = '$preguntaId'
                            AND pregunta.id_dilema = '$dilemaId'
                            AND respuesta.id_pregunta = '$preguntaId'
                            AND respuesta.id_usuario = usuario.id_usuario";
            }else{
                $return ="SELECT instituto.nombre_instituto, usuario.edad, usuario.sexo,
                        dilema.titulo_dilema, pregunta.texto_pregunta, respuesta.texto_respuesta 
                        FROM usuario, instituto, dilema, pregunta, respuesta
                        WHERE usuario.sexo = '$genero'
                            AND usuario.edad = $edadBien
                            AND instituto.id_instituto = '$institutoId'
                            AND dilema.id_dilema = '$dilemaId'
                            AND pregunta.id_pregunta = '$preguntaId'
                            AND pregunta.id_dilema = '$dilemaId'
                            AND respuesta.id_pregunta = '$preguntaId'
                            AND respuesta.id_usuario = usuario.id_usuario";
            }
        }
        if($edadMinBien!=0){
            if($genero=='I'){
                $return ="SELECT instituto.nombre_instituto, usuario.edad, usuario.sexo,
                                dilema.titulo_dilema, pregunta.texto_pregunta, respuesta.texto_respuesta 
                                FROM usuario, instituto, dilema, pregunta, respuesta
                                WHERE (usuario.sexo = '$genero'
                                    OR usuario.sexo = 'M'
                                    OR usuario.sexo = 'H')
                                    AND usuario.edad >= $edadMinBien
                                    AND usuario.edad <= $edadMaxBien
                                    AND instituto.id_instituto = '$institutoId'
                                    AND dilema.id_dilema = '$dilemaId'
                                    AND pregunta.id_pregunta = '$preguntaId'
                                    AND pregunta.id_dilema = '$dilemaId'
                                    AND respuesta.id_pregunta = '$preguntaId'
                                    AND respuesta.id_usuario = usuario.id_usuario";
            }else{
                $return ="SELECT instituto.nombre_instituto, usuario.edad, usuario.sexo,
                                        dilema.titulo_dilema, pregunta.texto_pregunta, respuesta.texto_respuesta 
                                        FROM usuario, instituto, dilema, pregunta, respuesta
                                        WHERE usuario.sexo = '$genero'
                                            AND usuario.edad >= $edadMinBien
                                            AND usuario.edad <= $edadMaxBien
                                            AND instituto.id_instituto = '$institutoId'
                                            AND dilema.id_dilema = '$dilemaId'
                                            AND pregunta.id_pregunta = '$preguntaId'
                                            AND pregunta.id_dilema = '$dilemaId'
                                            AND respuesta.id_pregunta = '$preguntaId'
                                            AND respuesta.id_usuario = usuario.id_usuario";
            }

        }
        return $return;
    }

    function imprimirTablaConsulta($result){
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            //var_dump($row);
            echo "<tr>";
            echo "<td>".$row['nombre_instituto']."</td>";
            echo "<td>".$row['edad']."</td>";
            echo "<td>".$row['sexo']."</td>";
            echo "<td>".strip_tags($row['titulo_dilema'])."</td>";
            echo "<td>".strip_tags($row['texto_pregunta'])."</td>";
            echo "<td>".$row['texto_respuesta']."</td>";
            echo "</tr>";
        }
    }

?>