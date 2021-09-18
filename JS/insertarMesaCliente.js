$(document).ready(function(){

    $('#botonEnviar').click(function (){
        var datos =$('#formAJAX').serialize();
        
         alert (datos.nombre);

         if (datos)
         return false;    

        $.ajax ({
           
            type: "POST",
            url: "insertar.php",
            data: datos,
            success: function(r){
                if (r==1){
                    location.href = 'list.php';
                }
                else{
                    alert ("fallo el servidor");
                }
            }
        });
        return false;
    });

});
