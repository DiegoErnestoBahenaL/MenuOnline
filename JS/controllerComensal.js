const url = 'https://daltysfood.com/menu_online/backend/api/comensales.php';


function enviar(){



    let comensal = {

        nombre: document.getElementById('nombre').value,
        idMesa: document.getElementById('idMesa').value,
        restaurante: document.getElementById('restaurante').value

    };

    console.log(comensal);

    axios ({
        method: 'post',
        url: url,
        reponseType: 'json',
        data: comensal

    })
    .then (res=>{
        console.log(res.data);
        location.href=`list.php?restaurante=${comensal.restaurante}`;

    })
    .catch (error=>{

        console.error(error);

    });

}

   

   