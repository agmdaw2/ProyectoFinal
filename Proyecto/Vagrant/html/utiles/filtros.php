<?php

    function filtrar(){
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
        echo "<div>";
        echo "<form method='POST'>";

        echo "<div id='filtroInstituto'>";
        echo "<label>Elige el/los Institutos: </label><br>";
        $result = $conn->prepare("SELECT instituto.nombre_instituto, instituto.id_instituto FROM instituto");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            echo "<input type='checkbox' id='instituto".$row['id_instituto']."' name='filtro[".$row['id_instituto']."][instituto]' value='".$row['id_instituto']."'>";
            echo "<label>".$row['nombre_instituto']."</label>";
            echo "<br>"; 
        }
        echo "</div>";
        echo "<br>";

        //filtro EDAD
        echo "<div id='filtroEdad'>";
        echo "<label>Elige la manera de edad:</label>";        
        echo "<select onchange='tipoSelectorEdad()' id='selectTipoEdad'>";
        echo "<option>Tipo</option>";
        echo "<option value='R'>Rango de Edad</option>";
        echo "<option value='S'>Seleccionar Edad</option>";
        echo "</select>";
        echo "</div>";
        echo "<br>";

        //filtro SEXO
        echo "<div id='filtroSexo'>";
        echo "<label>Elige el genero:</label>";        
        echo "<select name='filtro[tiposexo][sexo]' id='selectSexo' required>";
        echo "<option>Tipo</option>";
        echo "<option value='I'>Indefinido</option>";
        echo "<option value='M'>Mujer</option>";
        echo "<option value='H'>Hombre</option>";
        echo "</select>";
        echo "</div>";
        echo "<br>";

        //filtro DILEMA
        echo "<div id='filtroDilema'>";
        echo "<label>Elige el/los Dilemas: </label><br>";
        $result = $conn->prepare("SELECT dilema.titulo_dilema, dilema.id_dilema FROM dilema");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
       
        while ($row = $result->fetch()) {
            $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
            $textoDilema = str_replace($aBorrar,"", $row['titulo_dilema']);
            echo "<input type='checkbox' id='tituloDilema".$row['id_dilema']."' name='filtro[".$row['id_dilema']."][dilema]' value='".$row['id_dilema']."' onclick='preguntas(".$row['id_dilema'].")'>";
            echo "<label for='filtro[".$row['id_dilema']."][dilema]'>".$textoDilema."</label>";
            echo "<br>";
        }
        echo "</div>";
        echo "<br>";

        //filtro PREGUNTA
        echo "<div id='filtroPregunta'>";
        echo "<label>Elige el/las Preguntas: </label><br>";
        $result = $conn->prepare("SELECT pregunta.texto_pregunta, pregunta.id_pregunta, pregunta.id_dilema FROM pregunta WHERE tipo_numeracion ='ul' OR tipo_numeracion ='ol'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            echo "<input type='checkbox' id='preguntaDilema".$row['id_dilema']."' name='filtro[".$row['id_pregunta']."][pregunta]' value='".$row['id_pregunta']."' style='display:none'>";
            echo "<label id='labelPreguntaDilema".$row['id_dilema']."' for='filtro[".$row['id_pregunta']."][pregunta]' style='display:none'>".$row['texto_pregunta']."</label>";
        }
        echo "</div>";

        echo "<br>";
        echo "<input type='submit' value='Guarda y Envia' id='enviar' name='submit'>";
        //imprimirBoton();
        echo "</form>";
        echo "</div>";

        //CREAR TABLA PARA PODER ENVIARLA AL EXCEL
        if(isset($_POST['submit'])){
            if(isset($_POST['submit']) && !empty($_POST['submit'])){
                foreach($_POST['filtro']as $key => $values){
                    echo 'instituto: '.$values['instituto'];
                    echo 'sexo: '.$values['sexo'];
                    echo 'edad: '.$values['edad'];
                    echo 'dilema: '.$values['dilema'];
                }
            }
            // imprimirTablaHead();
            // $result = $conn->prepare("SELECT instituto.nombre_instituto FROM instituto WHERE");
            // $result->setFetchMode(PDO::FETCH_ASSOC);
            // $result->execute();
            // while ($row = $result->fetch()) {
            //     echo "<input type='checkbox' id='instituto".$row['id_instituto']."' name='filtro[".$row['id_instituto']."][instituto]' value='".$row['id_instituto']."'>";
            //     echo "<label for='filtro[".$row['id_instituto']."][instituto]'>".$row['nombre_instituto']."</label>";
            //     echo "<br>"; 
            // }
        }else{
            
        }
        // else{
        //     echo'<script type="text/javascript"> 
        //     alert("Te ha faltado seleccionar el Instituto");
        //     window.location.href="descargar.php";
        //     </script>';
        // }
        
    }
    function imprimirTablaHead(){
        echo "<table id='tablaContenido'>";
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

//   <form action="/action_page.php">
//      <label for="cars">Choose a car:</label>
//          <select name="cars" id="cars">
//             <option value="volvo">Volvo</option>
//             <option value="saab">Saab</option>
//             <option value="opel">Opel</option>
 //            <option value="audi">Audi</option>
//          </select>
//      <br><br>
//      <input type="submit" value="Submit">
// </form>
?>