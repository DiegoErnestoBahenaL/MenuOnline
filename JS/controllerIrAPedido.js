
function irAPedido(){

   if (localStorage.getItem('pedidoDelComensal') == null || localStorage.getItem('pedidoDelComensal') == "[]"){

        alert ("Aún no agregas nada a pedido");
    }
    else {

         var restaurante = document.getElementById("restaurante").value;
        var idComensal = document.getElementById("idComensal").value;
        var mesa = document.getElementById('mesa').value;
        location.href = `pedido.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${mesa}`;
    }
    
}