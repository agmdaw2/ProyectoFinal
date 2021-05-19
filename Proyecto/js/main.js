var num=1;

function adelante() {
    num++;
    if(num>3)
        num=1;
    var imatge=document.getElementById("imagen");
    imatge.src="img/imagen"+num+".jpg";
};

function atras() {
    num--;
    if(num<1)
        num=3;
    var imatge=document.getElementById("imagen");
    imatge.src="img/imagen"+num+".jpg";
};



