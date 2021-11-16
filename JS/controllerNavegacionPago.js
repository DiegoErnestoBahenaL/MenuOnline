var urlProductosPedido = 'https://daltysfood.com/menu_online/backend/api/productos.php';
var urlPedido = 'https://daltysfood.com/menu_online/backend/api/pedidos.php';
var urlComensal = 'https://daltysfood.com/menu_online/backend/api/comensales.php';

var restaurante = document.getElementById('restaurante').value;
var idComensal = document.getElementById('idComensal').value;
var mesa = document.getElementById('mesa').value;
var divProductosDelComensal = document.getElementById("productosDelComensal");
var divComensales = document.getElementById("botonesDividir");
var divBotonesPago = document.getElementById("botonesPagar");


function mostrarProductosPedidos (){

    limpiarProductosPedidos();
    limpiarBotones();
    
     
    divProductosDelComensal.style.visibility="hidden";

    let productosPedidos = [];


    axios ({
        method: 'GET',
        url: urlProductosPedido + `?restaurante=${restaurante}&idComensal=${idComensal}`,
        responseType: 'json'
    })
    .then(res=>{
        console.log(res.data);
        productosPedidos = res.data;

        divProductosDelComensal.style.visibility="visible";


        let saldoDelCliente = 0;
        let saldoReal;
        for (let i = 0; i < productosPedidos.length; i++){
    
            var divProductoPedido = document.createElement("div");
            divProductoPedido.className = "itemsPedidos";
            divProductosDelComensal.appendChild(divProductoPedido);
    
            
            var divInfoProducto = document.createElement("div");
            divInfoProducto.className = "productoPedidoInfo";
            divProductoPedido.appendChild(divInfoProducto);
            
            //nombre del producto
            var nombreProductoPedido = document.createElement("p");
            nombreProductoPedido.className = "productoPedidoNombre";
            nombreProductoPedido.textContent = productosPedidos[i].nombre;
            divInfoProducto.appendChild(nombreProductoPedido);
            
            //cantidad del producto
            var cantidadProductoPedido = document.createElement("p");
            cantidadProductoPedido.className = "cantidadProductoPedido";
            cantidadProductoPedido.textContent = `x`+ productosPedidos[i].numeroDeProductos;
            divInfoProducto.appendChild(cantidadProductoPedido);
            
            //Precio
            var precioProductoPedido = document.createElement("p");
            var montoProductoPedido = parseFloat(productosPedidos[i].precio) * parseFloat(productosPedidos[i].numeroDeProductos)
            precioProductoPedido.className = "precioProductoPedido";

            precioProductoPedido.textContent = `$ `+ montoProductoPedido;
            divInfoProducto.appendChild(precioProductoPedido);
            

            saldoDelCliente += montoProductoPedido;
        }
        verificarSaldo(saldoDelCliente);
        
        //selector metodo de pago
        var selectMetodoPago = document.createElement("select");
        selectMetodoPago.id = "metodoDePago";
        selectMetodoPago.className = "metodoDePago botonesPago";
        divBotonesPago.appendChild(selectMetodoPago);
        //opcion default
        var option = document.createElement("option");
        option.text = "Selecciona un método de pago";
        option.selected = true;
        option.value = 0;
        option.disabled = "true";
        selectMetodoPago.appendChild(option);
        //opcion efectivo
        var option = document.createElement("option");
        option.text = "Efectivo";
        option.value = 1;
        selectMetodoPago.appendChild(option);
        //opcion debito/crédito
        var option = document.createElement("option");
        option.text = "Débito/Crédito";
        option.value = 2;
        selectMetodoPago.appendChild(option);
        
        //propina
        var inputPropina = document.createElement("input");
        inputPropina.type ="number";
        inputPropina.placeholder ="Propina";
        inputPropina.id = "propina";
        inputPropina.className ="propina botonesPago";
        divBotonesPago.appendChild(inputPropina);

        //boton confirmar pago
        var botonConfirmar = document.createElement("button");
        botonConfirmar.type = "button";
        botonConfirmar.className = "boton__confirmar botonesPago";
        botonConfirmar.textContent = "Confirmar Pago";
        botonConfirmar.onclick = function (){confirmarPago();};
        divBotonesPago.appendChild(botonConfirmar);
          
        
    })
    .catch(error=>{
        console.error(error);
    });

}

/**
 * 
 * @param {*} saldoDelCliente:  
 * 
 * regresa: El mismo saldo si coincide con el del pedido
 *          El saldo de pedido si hay diferencia por alguna
 *          division de productos
 * 
 */
function verificarSaldo (saldoDelCliente){
    
    var areaPago = document.getElementById("areaPago");
    let saldoReal = 0;

    axios ({
        method: 'GET',
        url: urlPedido + `?restaurante=${restaurante}&idComensal=${idComensal}`,
        responseType: 'json'
    })
    .then (res=>{
        saldoReal = parseFloat (res.data.montoTotal);
        
        
        if (saldoReal === saldoDelCliente){
            var totalDelCliente = document.createElement("p");
            totalDelCliente.className = "itemsPedidos totalCliente";
            totalDelCliente.id ="totalCliente";
            totalDelCliente.value = saldoDelCliente;
            totalDelCliente.textContent = `Total: $ ` + saldoDelCliente;
            areaPago.appendChild(totalDelCliente);
        }
        if (saldoReal > saldoDelCliente) {

             //concepto division de productos
             var divisionDeProductos = document.createElement ("p");
             divisionDeProductos.className  = "itemsPedidos totalCliente";
             divisionDeProductos.textContent  =  `Total de productos divididos: $ ` + (saldoReal - saldoDelCliente);
             areaPago.appendChild(divisionDeProductos);
             

            var totalDelCliente = document.createElement("p");
            totalDelCliente.className = "itemsPedidos totalCliente";
            totalDelCliente.id ="totalCliente";
            totalDelCliente.value = saldoReal;
            totalDelCliente.textContent = `Total: $ ` + saldoReal;
            areaPago.appendChild(totalDelCliente);
        }
        if (saldoReal < saldoDelCliente){
            //concepto division de productos
            var divisionDeProductos = document.createElement ("p");
            divisionDeProductos.className  = "itemsPedidos totalCliente";
            divisionDeProductos.textContent  =  `Total de productos divididos: $ ` + (saldoReal - saldoDelCliente);
            areaPago.appendChild(divisionDeProductos);
            //total
              var totalDelCliente = document.createElement("p");
              totalDelCliente.className = "itemsPedidos totalCliente";
              totalDelCliente.id ="totalCliente";
              totalDelCliente.value = saldoReal;
              totalDelCliente.textContent = `Total: $ ` + saldoReal;
              areaPago.appendChild(totalDelCliente);
        }
    })
    .catch(error=>{

    });


}

//limpia los objetos pedidos por el usuario
function limpiarProductosPedidos (){
    var reactListDivs = document.querySelectorAll('.itemsPedidos');
   
       if (reactListDivs) {
           reactListDivs.forEach(function(reactListDiv) {
                reactListDiv.remove();
           });
       }
}

//limpia los botones de pago individual
function limpiarBotones (){
    var reactListDivs = document.querySelectorAll('.botonesPago');
   
       if (reactListDivs) {
           reactListDivs.forEach(function(reactListDiv) {
                reactListDiv.remove();
           });
       }
}

function confirmarPago(){

    
    
    var total = document.getElementById("totalCliente").value;
    var propina = document.getElementById("propina").value;
    var metodoDePago = document.getElementById("metodoDePago").value;
    
    if (metodoDePago != 0){

        if(propina == ""){
            propina = 0;
        }
        else{
            propina = parseFloat(propina);
        }
    
        if (confirm(`El total es de: $`+ total + ` más $`+propina + ` de propina` )){
            let solicitudPago = {
            restaurante: restaurante,
            idMedioDePago: metodoDePago,
            propina: propina,
            idComensal: idComensal
        }
    
            axios({
                method: 'PUT',
                url: urlPedido,
                responseType: 'json',
                data: solicitudPago
            })
            .then(res=>{
                if (res.data.message == 200){
                    alert("Un mesero pronto irá a cobrarte");
                }
                else{
                    alert ("Algo salió mal");
                }
    
            })
            .catch(error=>{
                console.error(error);
            });
    
        }
    }
    else{
        alert("Selecciona un método de pago");
    }

    
    
    
}

//renderiza los elementos necesarios
//para poder dividir productos pedidos
function dividirProductos(){
    limpiarProductosPedidos();
    limpiarBotones ();
     
    divProductosDelComensal.style.visibility="hidden";

    let productosPedidos = [];


    axios ({
        method: 'GET',
        url: urlProductosPedido + `?restaurante=${restaurante}&idComensal=${idComensal}`,
        responseType: 'json'
    })
    .then(res=>{
        console.log(res.data);
        productosPedidos = res.data;

        divProductosDelComensal.style.visibility="visible";

        for (let i = 0; i < productosPedidos.length; i++){
            var montoProductoPedido = parseFloat(productosPedidos[i].precio) * parseFloat(productosPedidos[i].numeroDeProductos)


            var divProductoPedido = document.createElement("div");
            divProductoPedido.className = "itemsPedidos";
            divProductosDelComensal.appendChild(divProductoPedido);
    
            
            var divInfoProducto = document.createElement("div");
            divInfoProducto.className = "productoPedidoInfo";
            divProductoPedido.appendChild(divInfoProducto);

            //checkbox
            var checkBoxProducto = document.createElement("input");
            checkBoxProducto.type = "checkbox";
            checkBoxProducto.value = montoProductoPedido;
            checkBoxProducto.className = "checkBoxProducto";
            divProductoPedido.appendChild(checkBoxProducto);
            
            //nombre del producto
            var nombreProductoPedido = document.createElement("p");
            nombreProductoPedido.className = "productoPedidoNombre";
            nombreProductoPedido.textContent = productosPedidos[i].nombre;
            divInfoProducto.appendChild(nombreProductoPedido);
            
            //cantidad del producto
            var cantidadProductoPedido = document.createElement("p");
            cantidadProductoPedido.className = "cantidadProductoPedido";
            cantidadProductoPedido.textContent = `x`+ productosPedidos[i].numeroDeProductos;
            divInfoProducto.appendChild(cantidadProductoPedido);
            
            //Precio
            var precioProductoPedido = document.createElement("p");
            precioProductoPedido.className = "precioProductoPedido";
            precioProductoPedido.textContent = `$ `+ montoProductoPedido;
            divInfoProducto.appendChild(precioProductoPedido);
            

            
        }

        var comensalesEnMesa = [];
    axios({
        method: 'GET',
        url: urlComensal + `?idMesa=${mesa}&restaurante=${restaurante}`,
        responseType: 'json'
    }) 
    .then(res=>{
        comensalesEnMesa = res.data;
        console.log (comensalesEnMesa);
         
        for (let i = 0; i <comensalesEnMesa.length; i++) {
             
            //renderiza todos los clientes excepto el que trata
            //de dividir el pedido
            if (comensalesEnMesa[i].idComensal != idComensal){
                
                //div de cada comensal
                var divComensalEnMesa = document.createElement("div");
                divComensalEnMesa.className ="itemsPedidos comensalADividir";
            
                divComensales.appendChild(divComensalEnMesa);

                //nombre
                var nombreComensal = document.createElement("p");
                nombreComensal.className = "comensalNombre";
                nombreComensal.textContent = comensalesEnMesa[i].nombre;
                divComensalEnMesa.appendChild(nombreComensal);

                //checkbox

                var checkBoxComensal = document.createElement("input");
                checkBoxComensal.type = "checkbox";
                checkBoxComensal.className ="checkBoxComensal";
                checkBoxComensal.value = comensalesEnMesa[i].idComensal;
                divComensalEnMesa.appendChild(checkBoxComensal);
            }
          
            

        }

        var botonConfirmarDividir = document.createElement("button");
        botonConfirmarDividir.type = "button";
        botonConfirmarDividir.className = "boton__confirmarDivision botonesPago";
        botonConfirmarDividir.id = "botonConfirmar";
        botonConfirmarDividir.textContent = "Confirmar División";
        botonConfirmarDividir.onclick = function (){confirmarDividirProductos();};
        divComensales.appendChild(botonConfirmarDividir);


    })
    .catch(error=>{

    });

    })
    .catch(error=>{
        console.error(error);
    });

    
}

function confirmarDividirProductos(){
    var listaDeProductos = document.querySelectorAll('.checkBoxProducto');
    var listaDeComensales = document.querySelectorAll('.checkBoxComensal');
    let arregloComensales = [];
    let montoTotalDivision = 0;

    if (listaDeProductos){
        listaDeProductos.forEach(function(listaDeProductos){
          
            if (listaDeProductos.checked)
                montoTotalDivision += parseFloat(listaDeProductos.value);
        })
    }

    if (listaDeComensales){
        listaDeComensales.forEach(function(listaDeComensales){

            if (listaDeComensales.checked)
                arregloComensales.push(parseFloat(listaDeComensales.value));
        })
    }

    console.log(montoTotalDivision);
    console.log(arregloComensales.length);

    if (montoTotalDivision == 0 || arregloComensales.length == 0){

        alert ("No has seleccionado ningún producto o comensal");
    }
    else{
        if(confirm(`Se van a dividir $`+ montoTotalDivision+` entre ` + listaDeComensales.length +` personas`)){
            
            let arregloDivision = {
                restaurante: restaurante,
                idComensal: idComensal,
                comensalesSeleccionados: arregloComensales,
                totalProductos: montoTotalDivision
            }
            console.log(arregloComensales);
            console.log(arregloDivision);
            axios ({
                method: 'PUT',
                url: urlPedido,
                responseType: 'json',
                data: arregloDivision
            })
            .then(res=>{
                if (res.data.message == 200){
                    alert ("Productos Divididos exitosamente");
                }
                else{
                    alert ("algo salió mal");
                }
            })
            .catch(error=>{
                console.error(error);
            });
        }
    }


}