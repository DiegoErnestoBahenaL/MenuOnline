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
        localStorage.setItem('pedidoDelComensal', "[]"); 
        location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${idMesa}`;
    }  
}

function insertarPedido (){

    var sumaMonto;

    var pedidoComensal = [];

    var pedidoRecuperado = localStorage.getItem('pedidoDelComensal');

    var pedidoParseado = JSON.parse(pedidoRecuperado);

    pedidoComensal = pedidoParseado;

    for (let i = 0; i < pedidoComensal.length; i++) {
        
        
        sumaMonto += (parseFloat(pedidoComensal[i].cantidadProducto) * parseFloat(pedidoComensal[i].precio));
        
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
        alert("Tu pedido ha sido enviado a la cocina");
    })
    .catch (error=>{

        console.error(error);
    });


}