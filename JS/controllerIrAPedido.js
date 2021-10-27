
function irAPedido(){

    var restaurante = document.getElementById("restaurante").value;
    var idComensal = document.getElementById("idComensal").value;

    location.href = `pedido.php?restaurante=${restaurante}&idComensl=${idComensal}`;

}