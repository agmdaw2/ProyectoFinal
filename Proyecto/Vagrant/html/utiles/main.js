
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
        inputDos.setAttribute('name', 'min');
        inputDos.setAttribute('min', '10');
        inputDos.setAttribute('max', '100');
        inputDos.setAttribute('placeholder', 'maximo');
        inputDos.setAttribute('name','filtro[edadMax]');
        input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.setAttribute('name', 'min');
        input.setAttribute('min', '10');
        input.setAttribute('max', '100');
        input.setAttribute('placeholder', 'minimo');
        input.setAttribute('name','filtro[edadMin]');
    }

    if(tipo=='S'){
        label.innerHTML='Elige la edad';
        input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.setAttribute('name', 'min');
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
