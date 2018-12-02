/*=============================================
=            EDITAR AMBIENTE                  =
=============================================*/
$(".tablas").on("click", ".btnEditarAmbiente", function() {
    var idAmbiente = $(this).attr("idAmbiente");
    var datos = new FormData();
    datos.append("idAmbiente", idAmbiente);
    $.ajax({
        url: "ajax/ambientesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);
            $("#editarAmbiente").val(respuesta["nombreambiente"]);
            $("#editarUbicacion").val(respuesta["ubicacionambiente"]);
            $("#editarAmbiente").html(respuesta["nombreambiente"]);
            $("#editarUbicacion").html(respuesta["ubicacionambiente"]);
            $("#idAmbiente").val(respuesta["idambiente"]);
            var datosPrograma = new FormData();
            datosPrograma.append("idPrograma", respuesta["idprograma"]);
            $.ajax({
                url: "ajax/programas.ajax.php",
                method: "POST",
                data: datosPrograma,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    $(".select2-selection__rendered").val(respuesta["idprograma"]);
                    $(".select2-selection__rendered").html(respuesta["nombreprograma"]);
                    $("#idPrograma").val(respuesta["idprograma"]);
                    // $("#EditarPrograma").html(respuesta["nombreprograma"]);
                }
            })
        }
    })
})
/*=============================================
=            ELIMINAR AMBIENTE                  =
=============================================*/
$(".tablas").on("click", ".btnEliminarAmbiente", function() {
    var idAmbiente = $(this).attr("idAmbiente");
    swal({
        title: '¿Desea eliminar el ambiente?',
        text: "Si no está seguro puede cancerlar la acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar ambiente!'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=ambientes&idAmbiente=" + idAmbiente;
        }
    })
})
/*=========================
=    VALIDAR AMBIENTE     =
=========================*/
$("#nuevoAmbiente").change(function() {
    // debugger;   
    $(".alert").remove();
    var nombreAmbiente = $(this).val();
    console.log("nombreAmbiente", nombreAmbiente);
    var datos = new FormData();
    datos.append("nombreAmbiente", nombreAmbiente);
    $.ajax({
        url: "ajax/ambientesAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            if (respuesta) {
                $("#nuevoAmbiente").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE AMBIENTE YA SE ENCUENTRA REGISTRADO</strong></font></div>');
                $("#nuevoAmbiente").val("");
            }
        }
    })
})