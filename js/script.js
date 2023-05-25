
// Add Record
function addRecord() {
    // get values
    var id = $("#id_r").val();
    var consecutivo = $("#cons_r").val();
    var ruta = $("#ruta_r").val();
    var fecha = $("#fecha_r").val();
    var cliente = $("#cli_r").val();
    var placa = $("#placa_r").val();
    var cisterna = $("#cis_r").val();
    var conductor = $("#cond_r").val();
    var cedula = $("#ced_r").val();
    var cantidad = $("#cant_r").val();
    var valor = $("#valor_r").val();


    // Add record
    $.post("ajax/addRecord.php", {
        id: id,
        consecutivo: consecutivo,
        ruta: ruta,
		fecha: fecha,
        cliente: cliente,
        placa: placa,
        cisterna: cisterna,
        conductor: conductor,
        cedula: cedula,
        cantidad: cantidad,
        valor: valor,

    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");
        // read records again
        readRecords();

        // clear fields from the popup
        $("#cons_r").val("");
        $("#ruta_r").val("");
        $("#fecha_r").val("");
        $("#cli_r").val("");
        $("#placa_r").val("");
        $("#cis_r").val("");
        $("#cond_r").val("");
        $("#ced_r").val("");
        $("#cant_r").val("");
        $("#valor_r").val("");
    });
}

// READ records
function readRecords() {
    $.get("ajax/readRecord.php", {}, function (data, status) {
        $("#records_content").html(data);
    });
}

//Delete Record
function DeleteUser(id) {
    var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
    if (conf == true) {
        alert ("Manifiesto eliminado");
        $.post("ajax/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#idu").val(user.id);
            $("#consu").val(user.consecutivo);
            $("#rutau").val(user.ruta);
            $("#fechau").val(user.fecha);
            $("#cliu").val(user.cliente);
            $("#placau").val(user.placa);
            $("#cisu").val(user.cisterna);
            $("#condu").val(user.conductor);
            $("#cedu").val(user.cedula);
            $("#cantu").val(user.cantidad);
            $("#valoru").val(user.valor);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values

    var id = $("#idu").val();
    var consecutivo = $("#consu").val();
    var ruta = $("#rutau").val();
    var fecha = $("#fechau").val();
    var cliente = $("#cliu").val();
    var placa = $("#placau").val();
    var cisterna = $("#cisu").val();
    var conductor = $("#condu").val();
    var cedula = $("#cedu").val();
    var cantidad = $("#cantu").val();
    var valor = $("#valoru").val();


    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
        id: id,
        consecutivo: consecutivo,
        ruta: ruta,
		fecha: fecha,
        cliente: cliente,
        placa: placa,
        cisterna: cisterna,
        conductor: conductor,
        cedula: cedula,
        cantidad: cantidad,
        valor: valor,
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            alert("¡Datos actualizados!");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}


//Busqueda en tiempo real
function obtener_registros(texto){
    $.ajax({
        url : "ajax/ReadRecord.php",
        type : 'POST',
        dataType : 'html',
        data : {manifiestos: texto}, 
    })

    .done(function(resultado){
        $("#records_content").html(resultado);
    })      
    .fail(function(){
        console.log("error en JS");
    })
}

$(document).on('dblclick','#txtbusca', function()
    {
        var valor=$(this).val();
        if (valor!="")
        {
            obtener_registros(valor);
        }
        else{
            obtener_registros();
        }
    });



    $(document).ready(function () {
        // READ recods on page load
        readRecords(); // calling function
    });
    