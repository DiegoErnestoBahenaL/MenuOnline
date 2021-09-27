const urlProductos = 'https://daltysfood.com/menu_online/backend/api/categoriadeproductos.php';
var categorias = [];
var catergoriaSeleccionada;
var restaurante = document.getElementById('restaurante').value;
var myParent = document.body;

function obtenerCategorias (){

    axios ({

        method: 'get',
        url: urlProductos + `?restaurante=${restaurante}`,
        responseType: 'json', 

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


function crearSeleccionCategorias (){
    
    var selectCategorias = document.createElement("select");
    selectCategorias.id = "categoriaDeProducto";
    selectCategorias.className = "selectorCategoria";
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