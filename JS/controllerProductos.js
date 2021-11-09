


const url = 'https://daltysfood.com/menu_online/backend/api/productos.php';
var productos = [];
var restaurante = document.getElementById('restaurante').value;
var idComensal = document.getElementById('idComensal').value;
var mesa = document.getElementById('mesa').value;
var myParent = document.body;


 
 function obtenerProductos(){

    axios ({
        method: 'get',
        url: url +`?restaurante=${restaurante}`,
        responseType: 'json'
    })
    .then (res=>{
        console.log(res.data);
        productos = res.data;
        crearListaDeProductos(productos);
        

    })
    .catch (error=>{
        console.error(error);

    });
}

 



obtenerProductos(); 





 function crearListaDeProductos(productos){
    
    
    var divProductos = document.getElementById("listaProductos");
    

    for (let i = 0; i < productos.length; i++) {

        var divProducto = document.createElement("div");
        divProducto.className = "productos";
        divProductos.appendChild(divProducto);

        var nombreProducto = document.createElement("p");
        nombreProducto.className = "productoNombre";
        nombreProducto.textContent = productos[i].nombre;
        divProducto.appendChild(nombreProducto);
        
        if (productos[i].descripcion !== null) {

            var descripcionProducto = document.createElement("p");
            descripcionProducto.className = "productoDescripcion";
            descripcionProducto.textContent = productos[i].descripcion;
            divProducto.appendChild(descripcionProducto);
        }
       

        var precioProducto = document.createElement("p");
        precioProducto.className = "productoPrecio";
        precioProducto.textContent = "$"+`${productos[i].precio}`;
        divProducto.appendChild(precioProducto);

        if (productos[i].imagen !== null){

            var imagenProducto = document.createElement("img");
            imagenProducto.className = "productoImagen";
            imagenProducto.src = productos[i].imagen;
            divProducto.appendChild(imagenProducto);

        }
        
        

        var agregarProducto = document.createElement("button");
        agregarProducto.textContent = "Agregar";
        agregarProducto.id = "botonAgregar";
        agregarProducto.value = productos[i].idProducto;
        agregarProducto.onclick = function (){redireccionarAProductoDetallado(this.value, productos[i].precio, productos[i].nombre, mesa);};
        divProducto.appendChild(agregarProducto);
        
    }      
        

      
    
   

}

function redireccionarAProductoDetallado (idProducto, precioProducto, nombreProducto, mesa){
    location.href=`productoDetallado.php?restaurante=${restaurante}&idComensal=${idComensal}&idProducto=${idProducto}&precio=${precioProducto}&nombre=${nombreProducto}&mesa=${mesa}`;


}


function limpiarProductos (){
    var reactListDivs = document.querySelectorAll('.productos');
   
       if (reactListDivs) {
           reactListDivs.forEach(function(reactListDiv) {
                reactListDiv.remove();
           });
       }
   }

export {url, productos, myParent, crearListaDeProductos, limpiarProductos } 
 