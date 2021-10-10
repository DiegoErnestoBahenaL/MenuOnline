import {url, productos, myParent, crearListaDeProductos, limpiarProductos} from './controllerProductos.js'


const urlCategoriaProductos = 'https://daltysfood.com/menu_online/backend/api/categoriadeproductos.php';





var categorias = [];
var productosPorCategoria = [];
var catergoriaSeleccionada;
var restaurante = document.getElementById('restaurante').value;
var divCategorias = document.getElementById("componenteSelector");




function obtenerCategorias (){

    axios ({

        method: 'get',
        url: urlCategoriaProductos + `?restaurante=${restaurante}`,
        responseType: 'json' 

    })
    .then (res=>{

        console.log(res.data);
        categorias = res.data;
        crearSeleccionCategorias();

    })
    .catch (error=>{
        console.error(error);
    });

}
 obtenerCategorias();


function obtenerProductosPorCategoria(idCategoriaDeProducto){
   
   if (idCategoriaDeProducto == 0){
   
     axios({
        method: 'get',
        url: urlProductos + `?restaurante=${restaurante}`,
        responseType: 'json'

    })
    .then (res =>{
        console.log(res.data);
        productosPorCategoria = res.data;
        limpiarProductos();
        crearListaDeProductos(productosPorCategoria);
    })
    .catch (error=>{
        console.error(error);
    })
   
   }
   else{
        axios({
        method: 'get',
        url: url + `?restaurante=${restaurante}&idCategoriaDeProducto=${idCategoriaDeProducto}`,
        responseType: 'json'

    })
    .then (res =>{
        console.log(res.data);
        productosPorCategoria = res.data;
        limpiarProductos();
        crearListaDeProductos(productosPorCategoria);
    })
    .catch (error=>{
        console.error(error);
    })
   }
   
   
}


function crearSeleccionCategorias (){
    
    var selectCategorias = document.createElement("select");
    selectCategorias.id = "categoriaDeProducto";
    selectCategorias.className = "selectorCategoria";
    selectCategorias.onchange = function(){obtenerProductosPorCategoria(this.value);};

    divCategorias.appendChild(selectCategorias);

    var option = document.createElement("option");
    option.text = "Todos";
    option.selected = true;
    option.value = 0;
    selectCategorias.appendChild(option);
    //Create and append the options
    for (var i = 0; i < categorias.length; i++) {
        var option = document.createElement("option");
        option.value = categorias[i].idCategoriaDeProducto;
        option.text = categorias[i].nombre;
        selectCategorias.appendChild(option);
    }
    
}