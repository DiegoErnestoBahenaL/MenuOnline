
function guardarEnPedido (){
    let pedidoComensal = [];
    let productoDePedido;

    var restaurante = document.getElementById('restaurante').value;
    var idComensal = document.getElementById('idComensal').value;
    var mesa = document.getElementById('mesa').value;


    var idProducto = document.getElementById("idProducto").value;
    var cantidadProducto = document.getElementById("inputCantidadProductos").value;
    var comentario = document.getElementById("comentario").value;
    var nombre = document.getElementById("nombre").value;
    var precio = document.getElementById("precio").value;

    productoDePedido = {

        idProducto: idProducto,
        cantidadProducto: cantidadProducto,
        comentario: comentario,
        nombre: nombre,
        precio: precio
    }

    console.log(restaurante);
    console.log(idComensal);
     if (localStorage.getItem('pedidoDelComensal') == null){
        
        pedidoComensal.push(productoDePedido);

        var jsonString = JSON.stringify(pedidoComensal);
        
        localStorage.setItem('pedidoDelComensal', jsonString);

    }
    else{

        var pedidoRecuperado = localStorage.getItem('pedidoDelComensal');

        var pedidoParseado = JSON.parse(pedidoRecuperado);

        pedidoComensal = pedidoParseado;

        pedidoComensal.push(productoDePedido);
        
        jsonString = JSON.stringify(pedidoComensal);

        localStorage.setItem('pedidoDelComensal', jsonString);

    }

    alert("Producto añadido");

    location.href= `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${mesa}`;


}