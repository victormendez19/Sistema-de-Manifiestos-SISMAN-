//Busqueda en tiempo real por rango de fechas
function obtener_registros_fecha(texto){
    $.ajax({
        url : "ajax/ReadRecord.php",
        type : 'POST',
        dataType : 'html',
        data : {fechadesde: texto}, 
    })

    .done(function(resultado){
        $("#records_content").html(resultado);
    })      
    .fail(function(){
        console.log("error en JS");
    })
}

$(document).on('change','#fechadesde', function()
    {
        var valor=$(this).val();
        if (valor!="")
        {
            obtener_registros_fecha(valor);
        }
        else{
            obtener_registros_fecha();
        }
    });
