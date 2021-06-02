
function tipoSelectorEdad(){
    var tipo = document.getElementById("selectTipoEdad").value;
    var nodoPadre = document.getElementById('filtroEdad');
    var label = null;
    document.getElementById('filtroEdad').innerHTML='';
    label = document.createElement('label');
    label.setAttribute('for', 'filtroEdad');
    var input = null;
    var inputDos = null;

    if(tipo=='R'){
        label.innerHTML='Elige el rango de edad';
        inputDos = document.createElement('input');
        inputDos.setAttribute('type', 'number');
        inputDos.setAttribute('name', 'filtro[R][edadmax]');
        inputDos.setAttribute('min', '10');
        inputDos.setAttribute('max', '100');
        inputDos.setAttribute('placeholder', 'maximo');

        input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.setAttribute('name', 'filtro[R][edadmin]');
        input.setAttribute('min', '10');
        input.setAttribute('max', '100');
        input.setAttribute('placeholder', 'minimo');
    }

    if(tipo=='S'){
        label.innerHTML='Elige la edad';
        input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.setAttribute('name', 'filtro[S][edad]');
        input.setAttribute('min', '10');
        input.setAttribute('max', '100');
        input.setAttribute('placeholder', 'edad');
    }

    nodoPadre.appendChild(label);
    nodoPadre.appendChild(input);
    nodoPadre.appendChild(inputDos);
}

function preguntas(idDilema){
    var nodoPadrePregunta = document.getElementById('filtroPregunta');
    var dilema = document.getElementById('tituloDilema'+idDilema);

    if(nodoPadrePregunta.hasChildNodes()){
        const hijos = nodoPadrePregunta.childNodes;
        for (let i = 0; i < hijos.length; i++) {
            if(hijos[i].id === 'preguntaDilema'+idDilema) {
                if(dilema.checked){
                    hijos[i].style.display = "block";
                }else{
                    hijos[i].style.display = "none";
                }
            }

            if(hijos[i].id === 'labelPreguntaDilema'+idDilema) {
                if(dilema.checked){
                    hijos[i].style.display = "block";
                }else{
                    hijos[i].style.display = "none";
                }
            }
          }
    }
}

function exportTableToExcel(tableID, nombreArchivo){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Especificar fecha
    n =  new Date();
        //Año
    y = n.getFullYear();
        //Mes
    m = n.getMonth() + 1;
        //Día
    d = n.getDate();
    nombreArchivo = nombreArchivo+"."+d+"/"+m+"/"+y;
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, nombreArchivo);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = nombreArchivo;
        
        //triggering the function
        downloadLink.click();
    }
}

