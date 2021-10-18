
//función para aumentar en 1 el valor de los artículos

function agregarArticulo(){
    var valorAntiguo;
    var valorAntiguoConvertido;
    var cantidadProductos = document.getElementById("inputCantidadProductos");
    valorAntiguo = cantidadProductos.value;
    valorAntiguoConvertido = parseInt(valorAntiguo, 10);
    valorAntiguoConvertido += 1;
    cantidadProductos.value = valorAntiguoConvertido;


}

//función para disminuir en 1 el valor de los artículos


function disminuirArticulo(){

    var cantidadProductos = document.getElementById("inputCantidadProductos");

    if (cantidadProductos > 0)

        cantidadProductos.value -= 1;
    
    else

        cantidadProductos.value = 0;

}