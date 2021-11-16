const productosURL = 'https://daltysfood.com/menu_online/backend/api/productos.php';

var restaurante = document.getElementById("restaurante").value;
var idComensal = document.getElementById("idComensal").value;
var mesa = document.getElementById("mesa").value;

function irAPagos(){
    

    axios ({
        method: 'GET',
        url: productosURL + `?restaurante=${restaurante}&idComensal=${idComensal}`,
        responseType: 'json'
    })
    .then(res=>{

        console.log(res.data);

        if (res.data != null){
            location.href = `pagos.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${mesa}`;
        }
        else{
            alert ("Aún no tienes productos por pagar o algún producto no ha sido entregado");
        }


    })
    .catch(error=>{
        console.error(error);
    });

}