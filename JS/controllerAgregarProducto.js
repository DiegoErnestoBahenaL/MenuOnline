

function agregarArticulo(){

     var valorAntiguo;
    var valorAntiguoConvertido;
    var cantidadProductos = document.getElementById("inputCantidadProductos");
    valorAntiguo = cantidadProductos.value;
    valorAntiguoConvertido = parseInt(valorAntiguo, 10);
    valorAntiguoConvertido += 1;
    cantidadProductos.value = valorAntiguoConvertido;

}


function disminuirArticulo(){

    var cantidadProductos = document.getElementById("inputCantidadProductos");
   if (parseInt(cantidadProductos.value, 10) > 1)

        cantidadProductos.value -= 1;
    
    else

        cantidadProductos.value = 1;



}