const urlPedidos = 'https://daltysfood.com/menu_online/backend/api/pedidos.php';
const urlPedidoProducto = 'https://daltysfood.com/menu_online/backend/api/pedidoproducto.php';

var restaurante = document.getElementById("restaurante").value;
var idComensal = document.getElementById("idComensal").value;
var idMesa = document.getElementById("mesa").value;

//Redirecciona a la pagina con los productos
function regresarAProductos (){

    location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;

}

//Si el usuario confirma que ese es el pedido que va a realizar
//se llama a la función para insertar el pedido
function confirmarPedido () {

    if (confirm("¿Estás seguro de que este es el pedido?")) {
    
        insertarPedido();        
        
        
    }  
}

//Esta función va a recuperar y procesar la información
//del pedido en un JSON para realizar la petición POST
function insertarPedido (){

    var sumaMonto = 0;

    var pedidoComensal = [];

    var pedidoRecuperado = localStorage.getItem('pedidoDelComensal');

    var pedidoParseado = JSON.parse(pedidoRecuperado);

    pedidoComensal = pedidoParseado;

    for (let i = 0; i < pedidoComensal.length; i++) {
        
        
        sumaMonto += (Number(pedidoComensal[i].cantidadProducto) * Number(pedidoComensal[i].precio));
        
    }

    
    if (localStorage.getItem('montoTotal') == null){
        
        localStorage.setItem('montoTotal', sumaMonto);
   
    }

    let pedido = {
        idMesa: idMesa,
        idComensal: idComensal,
        montoTotal: sumaMonto,
        restaurante: restaurante

    };

    console.log(pedido);
    axios ({

        method: 'POST',
        url: urlPedidos,
        responseType: 'json',
        data: pedido
    })
    .then(res=>{
        console.log(res.data);

       
        //Si el estado es 400, significa que no se insertó otra row en pedido
        //y se va a evaluar si se actualiza el monto del pedido o se informa 
        //al usuario que espere a que pueda hacer otro pedido
        if (res.data.message == 400){
            if (res.data.idEstadoPedido == 2){

               
                let montoActual = sumaMonto; 
                let montoRecuperado = localStorage.getItem ('montoTotal');
                let montoAnterior = parseFloat(montoRecuperado);
                    
                montoActual += montoAnterior;
            
                localStorage.setItem('montoTotal', montoActual);
                
                insertarProductos(res.data.numeroDePedido);


                actualizarPedido(res.data.numeroDePedido, montoActual);
                

            }
            else{
                alert("Espera a que entreguen tus productos anteriores");
                location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;

            }
        }

        else{
            insertarProductos(res.data.numeroDePedido);
           
            alert("Tu pedido ha sido enviado a la cocina"); 
            localStorage.setItem('pedidoDelComensal', "[]"); 

            location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;
        }

        
    })
    .catch (error=>{

        console.error(error);
    });


}

//Recibe: El numero de pedido a actualizar y el monto
//Función: Actualiza el montoTotal del pedido dependiendo de la suma
//de los precios de los nuevos items.
//Retorna: Limpia el localStorage de pedidoDelComensal y redirecciona a 
//la pagina con los productos

function actualizarPedido(numeroDePedido, montoActual){

    axios ({

        method: 'PUT',
        url: urlPedidos +`?restaurante=${restaurante}&numeroDePedido=${numeroDePedido}&montoTotal=${montoActual}`,
        responseType: 'json'
    })
    .then (res=>{
        console.log(res.data);
        alert("Tu pedido ha sido enviado a la cocina"); 
        localStorage.setItem('pedidoDelComensal', "[]"); 
        location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;


    })
    .catch (error=>{

        console.error(error);

    });


}
//Recibe: El numero de pedido como referencia para insertar los productos
//Función: inserta todos los productos correspondientes en Pedido_Producto
//Retorna: Los  mensajes de respuesta de las peticiones.
function insertarProductos (pedido){

    
    let pedidoComensal = [];

    let pedidoRecuperado = localStorage.getItem('pedidoDelComensal');

    let pedidoParseado = JSON.parse(pedidoRecuperado);

    pedidoComensal = pedidoParseado;

    
    for (let i = 0; i < pedidoComensal.length; i++) {
        
        let pedidoAInsertar = {

            numeroDePedido: pedido,
            idProducto: pedidoComensal[i].idProducto,
            numeroDeProductos: pedidoComensal[i].cantidadProducto,
            comentario: pedidoComensal[i].comentario,
            restaurante: restaurante
        }

        axios({
            method: 'POST',
            url: urlPedidoProducto,
            responseType: 'json',
            data: pedidoAInsertar

        })
        .then(res=>{
            console.log(res.data);
        })
        .catch (error=>{
            console.error(error);
        });
    }
    
   
}