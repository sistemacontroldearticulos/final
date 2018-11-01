$(".tablas").on("click", ".btnEditarPrograma", function(){
// $(".btnEditarPrograma").click(function() {
    var idPrograma = $(this).attr("idPrograma");
    var datos = new FormData();
    datos.append("idPrograma", idPrograma);
    $.ajax({
        url: "ajax/programas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);
            $("#EditarPrograma").val(respuesta["nombreprograma"]);
            $("#EditarTipoPrograma").val(respuesta["tipoprograma"]);
            //$("#EditarTipoPrograma2").val(respuesta["tipoprograma"]);
            $("#EditarDuracion").val(respuesta["duracionprograma"]);
            $("#EditarDuracion").prop('readolny', true);
            $("#idPrograma").val(respuesta["idprograma"]);
        }
    })
})

$(".tablas").on("click", ".btnEliminarPrograma", function(){
// $(".btnEliminarPrograma").click(function() {
    var idPrograma = $(this).attr("idPrograma");
    swal({
        title: '¿Desea eliminar el programa?',
        text: "Si no está seguro puede cancerlar la acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar programa!'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=programas&idPrograma=" + idPrograma;
        }
    })
})
/*=========================
=    VALIDAR PROGRAMA     =
=========================*/
$("#NuevoPrograma").change(function() {
    $(".alert").remove();
    var programa = $(this).val();
    var datos = new FormData();
    datos.append("validarPrograma", programa);
    $.ajax({
        url: "ajax/programas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#NuevoPrograma").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE PROGRAMA YA SE ENCUENTRA REGISTRADO</strong></font></div>');
                $("#NuevoPrograma").val("");
            }
            // console.log(respuesta);
            
        }
    })
})