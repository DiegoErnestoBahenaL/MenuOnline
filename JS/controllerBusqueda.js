import {url, productos, myParent, crearListaDeProductos, limpiarProductos} from './controllerProductos.js'

var botonBuscar = document.getElementById("barraBusquedaBoton");
var productosBuscados = [];
botonBuscar.onclick = function () {buscar();};





function buscar(){

    let productoBuscado = {

        producto: document.getElementById("barraBusquedaTexto").value,
        restaurante: document.getElementById('restaurante').value


    };
    
    if (!(productoBuscado.producto == '')){
      
         console.log(productoBuscado);
       
        axios({
            method: 'get',
            url: url + `?restaurante=${productoBuscado.restaurante}&productoBuscado=${productoBuscado.producto}`,
            responseType: 'json'
        })
        .then (res=>{
            console.log(res.data);
            
             if (res.data != null){
            
                productosBuscados = res.data;
                limpiarProductos();
                crearListaDeProductos(productosBuscados);
            }
            else{
                limpiarProductos();
                productoNoEncontrado();
            }
        })
        .catch (error=>{
            console.error(error);
        })
    }
    

}


function productoNoEncontrado (){

    var divProducto = document.createElement("div");
    divProducto.className = "productos";
    divProducto.style.backgroundColor = "transparent";
    myParent.appendChild(divProducto);

    var nombreProducto = document.createElement("p");
    nombreProducto.className = "productoNombre";
    nombreProducto.textContent = "No se encontró el producto";
    nombreProducto.style.textAlign = "center";
    divProducto.appendChild(nombreProducto);
        
}