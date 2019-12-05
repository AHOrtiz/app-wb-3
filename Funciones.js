
function imprimir(){
    //alert("Correcto");
    //alert(document.getElementById("txtNumero").value);
    document.getElementById("P").innerHTML=(document.getElementById("txtNumero").value)
    + (document.getElementById("txtNumero2").value);
    
}

var btnMostrar=document.getElementById("btnSumar");
btnMostrar.addEventListener("click",imprimir, false);

