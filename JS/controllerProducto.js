 
var urlProductoDetallado = 'https://daltysfood.com/menu_online/backend/api/productos.php';

var productoDetallado;
var restaurante = document.getElementById('restaurante').value;
var idComensal = document.getElementById('idComensal').value;
var idProducto = document.getElementById('idProducto').value;

var divContenedorProducto = document.getElementById("contenedorProducto");


function obtenerProductoDetallado () {

    axios ({
        method: 'get',
        url: urlProductoDetallado +`?restaurante=${restaurante}&idProducto=${idProducto}`,
        responseType: 'json'
    })
    .then(res=>{
        console.log(res.data);
        productoDetallado = res.data;
        cargarProductoDetallado(productoDetallado);
    })
    .catch(error=>{

        console.error(error);
    })


}
obtenerProductoDetallado();

function cargarProductoDetallado (productoDetallado){

    var contenedorProducto = document.getElementById("contenedorProducto");

    var imagenProductoDetallado = document.createElement("img");
    imagenProductoDetallado.className = "imagenProductoDetallado";
    imagenProductoDetallado.src = "data: image/jpeg;base64," + `${productoDetallado.imagen}`
    contenedorProducto.appendChild(imagenProductoDetallado);
    
     var nombreProductoDetallado = document.createElement("h1");
    nombreProductoDetallado.textContent = productoDetallado.nombre;
    nombreProductoDetallado.className = "nombreProductoDetallado";
    contenedorProducto.appendChild(nombreProductoDetallado);
    
      var descripcionProductoDetallado = document.createElement("p");
    descripcionProductoDetallado.textContent = productoDetallado.descripcion;
    descripcionProductoDetallado.className = "descripcionProductoDetallado";
    contenedorProducto.appendChild(descripcionProductoDetallado);

    var precioProductoDetallado = document.createElement("h2");
    precioProductoDetallado.textContent = "$" + `${productoDetallado.precio}`;
    precioProductoDetallado.className = "precioProductoDetallado";
    contenedorProducto.appendChild(precioProductoDetallado);


}
