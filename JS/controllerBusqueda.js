import {url, productos, myParent, crearListaDeProductos} from './controllerProductos.js'

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
                alert("No se encontró el producto");
            }
        })
        .catch (error=>{
            console.error(error);
        })
    }
    

}

function limpiarProductos (){
 var reactListDivs = document.querySelectorAll('.productos');

    if (reactListDivs) {
        reactListDivs.forEach(function(reactListDiv) {
             reactListDiv.remove();
        });
    }
}