
var productosPedidos = [];
var restaurante = document.getElementById('restaurante').value;
var idComensal = document.getElementById('idComensal').value;
var mesa = document.getElementById('mesa').value;

crearListaProductosPedidos();

function crearListaProductosPedidos(){


    var pedidoRecuperado = localStorage.getItem("pedidoDelComensal");
    productosPedidos = JSON.parse(pedidoRecuperado);

    if (productosPedidos.length < 1) {

        alert ("No hay ningún artículo en pedido");
        location.href=`list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${mesa}`;
    }
    else {

        var divProductosPedidos = document.getElementById("productosPedidos");

        for (let i = 0; i < productosPedidos.length; i++){
    
            var divProductoPedido = document.createElement("div");
            divProductoPedido.className = "itemsPedidos";
            divProductosPedidos.appendChild(divProductoPedido);
    
            
            var divInfoProducto = document.createElement("div");
            divInfoProducto.className = "productoPedidoInfo";
            divProductoPedido.appendChild(divInfoProducto);
    
            var nombreProductoPedido = document.createElement("p");
            nombreProductoPedido.className = "productoPedidoNombre";
            nombreProductoPedido.textContent = productosPedidos[i].nombre;
            divInfoProducto.appendChild(nombreProductoPedido);
            
            var cantidadProductoPedido = document.createElement("p");
            cantidadProductoPedido.className = "cantidadProductoPedido";
            cantidadProductoPedido.textContent = `x`+ productosPedidos[i].cantidadProducto;
            divInfoProducto.appendChild(cantidadProductoPedido);
    
            var precioProductoPedido = document.createElement("p");
            precioProductoPedido.className = "precioProductoPedido";
            precioProductoPedido.textContent = `$ `+ (parseFloat(productosPedidos[i].precio) * parseFloat(productosPedidos[i].cantidadProducto));
            divInfoProducto.appendChild(precioProductoPedido);
    
            var divBotonProducto = document.createElement("div");
            divBotonProducto.className = "botonProducto";
            divProductoPedido.appendChild(divBotonProducto);
    
            var eliminarProducto = document.createElement("button");
            eliminarProducto.textContent = "Eliminar";
            eliminarProducto.id = "botonEliminar";
            eliminarProducto.className = "botonEliminar";
            eliminarProducto.value = i;
            eliminarProducto.onclick = function (){eliminarProductoDePedido(this.value);};
            divBotonProducto.appendChild(eliminarProducto);
    
        }
    

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
