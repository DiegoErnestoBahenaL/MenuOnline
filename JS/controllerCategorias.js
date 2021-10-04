const urlCategoriaProductos = 'https://daltysfood.com/menu_online/backend/api/categoriadeproductos.php';
const urlProductos = 'https://daltysfood.com/menu_online/backend/api/productos.php';




var categorias = [];
var productosPorCategoria = [];
var catergoriaSeleccionada;
var restaurante = document.getElementById('restaurante').value;
var myParent = document.body;

function obtenerCategorias (){

    axios ({

        method: 'get',
        url: urlCategoriaProductos + `?restaurante=${restaurante}`,
        responseType: 'json' 

    })
    .then (res=>{

        console.log(res.data);
        this.categorias = res.data;
        crearSeleccionCategorias();

    })
    .catch (error=>{
        console.error(error);
    });

}

obtenerCategorias();


function obtenerProductosPorCategoria(idCategoriaDeProducto){
    axios({
        method: 'get',
        url: urlProductos + `?restaurante=${restaurante}&idCategoriaDeProducto=${idCategoriaDeProducto}`,
        responseType: 'json'

    })
    .then (res =>{
        console.log(res.data);
        this.productosPorCategoria = res.data;
        crearListaDeProductosPorCategoria();
    })
    .catch (error=>{
        console.error(error);
    })
}





function crearListaDeProductosPorCategoria(){
    
    var reactListDivs = document.querySelectorAll('.productos');

    if (reactListDivs) {
        reactListDivs.forEach(function(reactListDiv) {
             reactListDiv.remove();
        });
    }
    
    

    for (let i = 0; i < productosPorCategoria.length; i++) {

        var divProducto = document.createElement("div");
        divProducto.className = "productos";
        document.getElementById("listaproductos").appendChild(divProducto);

        var nombreProducto = document.createElement("p");
        nombreProducto.className = "productoNombre";
        nombreProducto.textContent = productosPorCategoria[i].nombre;

        var descripcionProducto = document.createElement("p");
        descripcionProducto.className = "productoDescripcion";
        descripcionProducto.textContent = productosPorCategoria[i].descripcion;

        var precioProducto = document.createElement("p");
        precioProducto.className = "productoPrecio";
        precioProducto.textContent = productosPorCategoria[i].precio;


        var imagenProducto = document.createElement("img");
        imagenProducto.className = "productoImagen";
        imagenProducto.src = "data: image/jpeg;base64," + `${productosPorCategoria[i].imagen}`;
        divProducto.appendChild(imagenProducto);

        var agregarProducto = document.createElement("button");
        agregarProducto.textContent = "Agregar";
        divProducto.appendChild(agregarProducto);
        
    }      
        

        
    
   

}






function crearSeleccionCategorias (){
    
    var selectCategorias = document.createElement("select");
    selectCategorias.id = "categoriaDeProducto";
    selectCategorias.className = "selectorCategoria";
    selectCategorias.onchange = function(){obtenerProductosPorCategoria(this.value);};

    myParent.appendChild(selectCategorias);

    var option = document.createElement("option");
    option.text = "Categorías";
    option.selected = true;
    option.disabled = true;
    selectCategorias.appendChild(option);
    //Create and append the options
    for (var i = 0; i < categorias.length; i++) {
        var option = document.createElement("option");
        option.value = categorias[i].idCategoriaDeProducto;
        option.text = categorias[i].nombre;
        selectCategorias.appendChild(option);
    }
    
    
   
  
}