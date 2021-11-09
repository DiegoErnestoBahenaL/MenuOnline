const urlPedidos = 'https://daltysfood.com/menu_online/backend/api/pedidos.php';


var restaurante = document.getElementById("restaurante").value;
var idComensal = document.getElementById("idComensal").value;
var idMesa = document.getElementById("mesa").value;

function regresarAProductos (){

    location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;

}

function confirmarPedido () {

    if (confirm("¿Estás seguro de que este es el pedido?")) {
    
        insertarPedido();        
        
        location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;
    }  
}

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
            if (res.data.idEstadoPedido == 2 || res.data.idEstadoPedido == 5 ){

               
                let montoActual = sumaMonto; 
                let montoRecuperado = localStorage.getItem ('montoTotal');
                let montoAnterior = parseFloat(montoRecuperado);
                    
                montoActual += montoAnterior;
            
                localStorage.setItem('montoTotal', montoActual);
                
                actualizarPedido(res.data.numeroDePedido, montoActual);
                

            }
            else{
                alert("Espera a que entreguen tus productos anteriores");
            }
        }

        else{

           alert("Tu pedido ha sido enviado a la cocina"); 
           localStorage.setItem('pedidoDelComensal', "[]"); 
        }

        
    })
    .catch (error=>{

        console.error(error);
    });


}

//Actualiza el montoTotal del pedido dependiendo de la suma
//de los precios de los nuevos items.

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

    })
    .catch (error=>{

        console.error(error);

    });


}
