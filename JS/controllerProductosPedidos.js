
var productosPedidos = [];
var restaurante = document.getElementById('restaurante').value;
var idComensal = document.getElementById('idComensal').value;

crearListaProductosPedidos();

function crearListaProductosPedidos(){

    var pedidoRecuperado = localStorage.getItem("pedidoDelComensal");
    productosPedidos = JSON.parse(pedidoRecuperado);

    // var productosRecuperados = localStorage.getItem("informacionProductos");
    // productosRestaurante = JSON.parse(productosRecuperados);

    var divProductosPedidos = document.getElementById("productosPedidos");

    for (let i = 0; i < productosPedidos.length; i++){

        var divProductoPedido = document.createElement("div");
        divProductoPedido.className = "itemsPedidos";
        divProductosPedidos.appendChild(divProductoPedido);

        var nombreProductoPedido = document.createElement("p");
        nombreProductoPedido.className = "productoPedidoNombre";
        nombreProductoPedido.textContent = productosPedidos[i].nombre;
        divProductoPedido.appendChild(nombreProductoPedido);
        
        var cantidadProductoPedido = document.createElement("p");
        cantidadProductoPedido.className = "cantidadProductoPedido";
        cantidadProductoPedido.textContent = productosPedidos[i].cantidadProducto;
        divProductoPedido.appendChild(cantidadProductoPedido);

        var precioProductoPedido = document.createElement("p");
        precioProductoPedido.className = "precioProductoPedido";
        precioProductoPedido.textContent = `$ `+ (parseFloat(productosPedidos[i].precio) * parseFloat(productosPedidos[i].cantidadProducto));
        divProductoPedido.appendChild(precioProductoPedido);

        var eliminarProducto = document.createElement("button");
        eliminarProducto.textContent = "Eliminar";
        eliminarProducto.id = "botonEliminar";
        eliminarProducto.value = i;
        eliminarProducto.onclick = function (){eliminarProductoDePedido(this.value);};
        divProductoPedido.appendChild(eliminarProducto);

    }

}

function eliminarProductoDePedido(idProducto){

    productosPedidos.splice(idProducto, 1);

    var jsonString = JSON.stringify(productosPedidos);
        
    localStorage.setItem('pedidoDelComensal', jsonString);

    limpiarProductosPedidos();

    
    crearListaProductosPedidos();

}

function limpiarProductosPedidos (){
    var reactListDivs = document.querySelectorAll('.itemsPedidos');
   
       if (reactListDivs) {
           reactListDivs.forEach(function(reactListDiv) {
                reactListDiv.remove();
           });
       }
   }
