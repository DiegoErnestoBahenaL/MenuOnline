


const url = 'https://daltysfood.com/menu_online/backend/api/productos.php';
var productos = [];
var restaurante = document.getElementById('restaurante').value;
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
    
    
  
    

    for (let i = 0; i < productos.length; i++) {

        var divProducto = document.createElement("div");
        divProducto.className = "productos";
        myParent.appendChild(divProducto);

        var nombreProducto = document.createElement("p");
        nombreProducto.className = "productoNombre";
        nombreProducto.textContent = productos[i].nombre;
        divProducto.appendChild(nombreProducto);
        
        var descripcionProducto = document.createElement("p");
        descripcionProducto.className = "productoDescripcion";
        descripcionProducto.textContent = productos[i].descripcion;
        divProducto.appendChild(descripcionProducto);

        var precioProducto = document.createElement("p");
        precioProducto.className = "productoPrecio";
        precioProducto.textContent = "$"+`${productos[i].precio}`;
        divProducto.appendChild(precioProducto);

        var imagenProducto = document.createElement("img");
        imagenProducto.className = "productoImagen";
        imagenProducto.src = "data: image/jpeg;base64," + `${productos[i].imagen}`;
        divProducto.appendChild(imagenProducto);

        var agregarProducto = document.createElement("button");
        agregarProducto.textContent = "Agregar";
        divProducto.appendChild(agregarProducto);
        
    }      
        

      
    
   

}
export {url, productos, myParent, crearListaDeProductos } 
 