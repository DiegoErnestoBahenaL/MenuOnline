var urlPedidos = 'https://daltysfood.com/menu_online/backend/api/pedidos.php';
var urlComensal = 'https://daltysfood.com/menu_online/backend/api/comensales.php';
var restaurante = document.getElementById('restaurante').value;
var idComensal = document.getElementById('idComensal').value;
var mesa = document.getElementById('mesa').value;

function enviarValoracion(){
    

    axios ({
        method: 'GET',
        url: urlPedidos + `?restaurante=${restaurante}&idComensal=${idComensal}`,
        responseType: 'json'
    })
    .then(res=>{
        if (res.data.estadoPedido == 5){

            var atencion = document.getElementById("atencion").getAttribute('value');

            var comentario = document.getElementById("comentario").value;

            let valoracion = {
                restaurante: restaurante,
                comentario: comentario,
                atencion: atencion,
                idComensal: idComensal
            }
            
            axios ({
                method: 'PUT',
                url: urlPedidos,
                responseType:  'json',
                data: valoracion
            })
            .then (res=>{
                if (res.data.message == 200){
                    alert ("Se ha enviado tu comentario. Agradecemos tu visita");
                    actualizarEstadoComensal();
                    localStorage.clear();
                    location.href = "valoracion.php?close=1";
                }
                else{
                    alert ("algo salio mal");
                }
            })
            .catch (error =>{
                console.error(error);
            });

          
        }
        else{
            alert ("Aun no se ha cobrado tu pedido, espera un momento");
        }
    })  
    .catch(error=>{
        console.error(error);
    });


}

function regresarAProductos(){
    axios ({
        method: 'GET',
        url: urlPedidos + `?restaurante=${restaurante}&idComensal=${idComensal}`,
        responseType: 'json'
    })
    .then(res=>{
        if (res.data.estadoPedido == 5){

            location.href = `list.php?restaurante=${restaurante}&idComensal=${idComensal}&mesa=${mesa}`;
          
        }
        else{
            alert ("Aun no se ha cobrado tu pedido, espera un momento");
        }
    })  
    .catch(error=>{
        console.error(error);
    });

}
 

function actualizarEstadoComensal (){

    axios ({
        method: 'PUT',
        url: urlComensal + `?idComensal=${idComensal}&restaurante=${restaurante}`,
        responseType: 'json'
    })
    .then(res=>{
        console.log(res);
    })  
    .catch(error=>{
        console.error(error);
    });

}