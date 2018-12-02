/*=============================================
ELIMINAR EQUIPO
=============================================*/
var nombre = "";
$(".tablas").on("click", ".btnEliminarEquipo", function() {
    var idEquipo = $(this).attr("idEquipo");
    swal({
        title: '¿Está seguro de borrar el equipo?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar equipo!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=equipos&idEquipo=" + idEquipo;
        }
    })
})
$(".tablas").on("click", ".btnEditarEquipo", function() {
    debugger;
    var idEquipo = $(this).attr("idEquipo");
    var datos = new FormData();
    datos.append("idEquipo", idEquipo);
    $.ajax({
        url: "ajax/equipoAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            nombre = respuesta["nombreequipo"];
            $("#editarEquipo").val(respuesta["nombreequipo"]);
            $("#idEquipo").val(respuesta["idequipo"]);
            $("#editarEstado").val(respuesta["estadoequipo"]);
            $("#editarAmbienteEquipo").val(respuesta["idambiente"]);
            $("#editarCantidad").val(respuesta["numarticulosequipo"]);
            $("#editarObservacion").val(respuesta["observacionequipo"]);
            $("#agregados").val(respuesta["numarticulosagregados"]);
        }
    })
})

function equipoFuncion(sel) {
    $(".alert").remove();
    var idEquipo = sel;
    var datos = new FormData();
    datos.append("sel", idEquipo);
    $.ajax({
        url: "ajax/equipoAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // debugger;
            $("#equipo").val(respuesta["idequipo"]);
            if (respuesta["numarticulosagregados"] == respuesta["numarticulosequipo"]) {
                $("#nuevoEquipo").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE EQUIPO YA TIENE EL TOTAL DE ARTÍCULOS ASIGNADOS</strong></font></div>');
                $("#nuevoEquipo").val("");
            }
            // $("#editarEquipo").val(respuesta["NombreEquipo"]);
            // $("#idEquipo").val(respuesta["IdEquipo"]);
            // $("#editarEstado").val(respuesta["EstadoEquipo"]);
            // // $("#editarEstado").html(respuesta["EstadoEquipo"]);
            // $("#editarCantidad").val(respuesta["NumArticulosEquipo"]);
            // $("#editarObservacion").val(respuesta["ObservacionEquipo"]);
            // console.log(respuesta);
        }
    })
}

function equipoFuncion1(sel) {
    $("#actualizarArticulo").prop('disabled', false);
    $(".alert").remove();
    var idEquipo = sel;
    var datos = new FormData();
    datos.append("sel", idEquipo);
    $.ajax({
        url: "ajax/equipoAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta2) {
            // debugger;
            console.log(respuesta2);
            // console.log(nombre);
            // $("#equipo").val(respuesta2["idequipo"]);
            // if (respuesta2["numarticulosagregados"] == respuesta2["numarticulosequipo"]) {
            //     $("#editarEquipo").parent().parent().after('<div class="alert alert-warning">Este equipo ya tiene el total de artículos asignados</div>');
            //     $("#actualizarArticulo").prop('disabled', true);
            // }
            if (respuesta2 == false) {
                $("#editarEquipo").val("");
            } else {
                $("#equipo").val(respuesta2["idequipo"]);
                if (respuesta2["numarticulosagregados"] == respuesta2["numarticulosequipo"]) {
                    $("#editarEquipo").parent().parent().after('<div class="alert alert-warning">Este equipo ya tiene el total de artículos asignados</div>');
                    $("#actualizarArticulo").prop('disabled', true);
                }
            }
        }
    })
}
/*=========================
=    VALIDAR EQUIPO    =
=========================*/
$("#nuevoEquipo").change(function() {
    // debugger;   
    $(".alert").remove();
    var nombreEquipo = $(this).val();
    var datos = new FormData();
    datos.append("nombreEquipo", nombreEquipo);
    $.ajax({
        url: "ajax/equipoAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            if (respuesta) {
                $("#nuevoEquipo").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE EQUIPO YA SE ENCUENTRA REGISTRADO</strong></font></div>');
                $("#nuevoEquipo").val("");
            }
        }
    })
})