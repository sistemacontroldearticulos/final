/*=============================================
=            EDITAR FICHAS                  =
=============================================*/
$(".tablas").on("click", ".btnEditarFicha", function(){
    $("#editarFechaInicio").removeAttr('disabled');
    $("#editarFechaFin").removeAttr('readonly');
    var idFicha = $(this).attr("idFicha");
    var datos = new FormData();
    datos.append("idFicha", idFicha);
    $.ajax({
        url: "ajax/fichasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
            $("#editarFicha").val(respuesta["numeroficha"]);
            $("#editarFechaInicio").val(respuesta["fechainicio"]);
            $("#editarFechaFin").val(respuesta["fechafin"]);
            $("#editarJornada").val(respuesta["jornadaficha"]);
            $("#editarJornada").html(respuesta["jornadaficha"]);
            var idPrograma = $(this).attr("idPrograma");
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
                    console.log("respuesta", respuesta);
                    
                    $("#editarPrograma").val(respuesta["idprograma"]);
                    // $(".select2-selection__rendered").val(respuesta["idprograma"]);
                    // $(".select2-selection__rendered").html(respuesta["nombreprograma"]);
                }
            })
            var idAmbiente = $(this).attr("idAmbiente");
            var datosAmbiente = new FormData();
            datosAmbiente.append("idAmbiente", respuesta["idambiente"]);
            $.ajax({
                url: "ajax/ambientesAjax.php",
                method: "POST",
                data: datosAmbiente,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    console.log("respuesta", respuesta);
                    // $("#editarAmbiente").val(respuesta["idambiente"]);
                    // $("#editarAmbiente").html(respuesta["nombreambiente"]);
                    $("#editarAmbiente").val(respuesta["idambiente"]);
                    $(".select2-selection__rendered").val(respuesta["idambiente"]);
                    $(".select2-selection__rendered").html(respuesta["nombreambiente"]);

                }
            })
        }
    })
})
/*=============================================
=            ELIMINAR FICHA                  =
=============================================*/
$(".tablas").on("click", ".btnEliminarFicha", function(){
    var idFicha = $(this).attr("idFicha");
    swal({
        title: '¿Desea eliminar la ficha?',
        text: "Si no está seguro puede cancerlar la acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar ficha'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=fichas&idFicha=" + idFicha;
        }
    })
})
/*=============================================
REVISAR SI LA FICHA YA ESTÁ REGISTRADO
=============================================*/
$("#nuevaFicha").change(function() {
    $(".alert").remove();
    var ficha = $(this).val();
    var datos = new FormData();
    datos.append("validarFicha", ficha);
    $.ajax({
        url: "ajax/fichasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#nuevaFicha").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTA FICHA YA EXISTE EN LA BASE DE DATOS</strong></font></div>');
                $("#nuevaFicha").val("");
            }
        }
    })
})
$("#nuevoExcel").change(function() {
    var documento = this.files[0];
    // console.log("documento", documento);
    var datosExcel = new FileReader;
    // console.log(datosExcel);
    datosExcel.readAsDataURL(documento);
    $(datosExcel).on("load", function(event) {
        var rutaExcel = event.target.result;
    })
    // var url = event.target.result;
})

$(".nuevoExcel").change(function(){
    var excel = this.files[0];
    // var a = excel["type"];
    // console.log("a", a);
    // console.log("excel", excel);

    if (excel["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {

        $(".nuevoExcel").val("");

        swal({
            title: 'Error al subir documento Excel',
            text: "Formato no valido",
            type: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: '¡Cerrar!'
        })
    }
})