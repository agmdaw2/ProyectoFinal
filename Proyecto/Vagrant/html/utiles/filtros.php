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

        echo "<form method='POST'>";
        echo "<div id='filtroInstituto'>";
        echo "</div>";

        //filtro EDAD
        echo "<div id='filtroEdad'>";
        echo "<label for='filtroEdad'>Elige la manera de edad:</label>";        
        echo "<select name='filtro[edad]' onchange='tipoSelectorEdad()' id='selectTipoEdad'>";
        echo "<option>Tipo</option>";
        echo "<option value='R' >Rango de Edad</option>";
        echo "<option value='S' >Seleccionar Edad</option>";
        echo "</select>";
        echo "</div>";
        echo "<br>";

        //filtro SEXO
        echo "<div id='filtroSexo'>";
        echo "<label for='filtro[edad]'>Elige el genero:</label>";        
        echo "<select name='filtro[edad]' id='selectSexo' required>";
        echo "<option value='I'>Indefinido</option>";
        echo "<option value='M'>Mujer</option>";
        echo "<option value='H'>Hombre</option>";
        echo "</select>";
        echo "</div>";
        echo "<br>";

        //filtro DILEMA
        echo "<div id='filtroDilema'>";
        echo "<label for='filtro[dilema]'>Elige el/los Dilemas: </label><br>";
        $result = $conn->prepare("SELECT dilema.titulo_dilema, dilema.id_dilema FROM dilema");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
       
        while ($row = $result->fetch()) {
            $aBorrar = array('<h2>','</h2>','<strong>','</strong>','<p>','</p>');
            $textoDilema = str_replace($aBorrar,"", $row['titulo_dilema']);
            echo "<input type='checkbox' id='tituloDilema".$row['id_dilema']."' name=filtro[dilema] value='".$row['id_dilema']."' onclick='preguntas(".$row['id_dilema'].")'>";
            echo "<label for='tituloDilema".$row['id_dilema']."'>".$textoDilema."</label>";
            echo "<br>";
        }
        echo "</div>";
        echo "<br>";

        //filtro PREGUNTA
        echo "<div id='filtroPregunta'>";
        echo "<label for='filtro[pregunta]'>Elige el/las Preguntas: </label><br>";
        $result = $conn->prepare("SELECT pregunta.texto_pregunta, pregunta.id_pregunta, pregunta.id_dilema FROM pregunta WHERE tipo_numeracion ='ul' OR tipo_numeracion ='ol'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        while ($row = $result->fetch()) {
            echo "<input type='checkbox' id='preguntaDilema".$row['id_dilema']."' name=filtro[pregunta] value='".$row['id_pregunta']."' style='display:none'>";
            echo "<label id='labelPreguntaDilema".$row['id_dilema']."' for='preguntaDilema".$row['id_pregunta']."' style='display:none'>".$row['texto_pregunta']."</label>";
        }
        echo "</div>";

        echo "<br>";

        imprimirBoton();
        echo "</form>";

        // EXPORTAR DATOS A EXCEL
        // if((isset($_POST['actividad_dilema']) && !empty($_POST['actividad_dilema']))){
        //     $hoy = date("d.m.y");
        //     $filename = "consulta.xls".$hoy;
        //     header(“Content-Type: application/vnd.ms-excel”);
        //     header(“Content-Disposition: attachment; filename=”.$filename);
        // }
    }

    function imprimirBoton(){
        echo "<div class='button-container-2'>";
        echo "<span class='mas'>Descargar</span>";
        echo "<button id='work' type=button' name='Hover'>Descargar</button>";
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