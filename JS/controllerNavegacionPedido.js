var restaurante = document.getElementById("restaurante").value;
var idComensal = document.getElementById("idComensal").value;

function regresarAProductos (){

    location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}`;

}

function confirmarPedido () {

    if (confirm("¿Estás seguro de que este es el pedido?")) {
    
        alert("Tu pedido ha sido enviado a la cocina");
        
        localStorage.setItem('pedidoDelComensal', "[]"); 
        location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}`;
    }  
}