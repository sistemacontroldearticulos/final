$(".tablas").on("click", ".btnVerAprendiz", function(){
    var ficha = $(this).attr("id");
    // console.log("numficha", numficha);
     // $("#nuevaFichaAprendiz").val(ficha);
     // $("#nuevaFichaAprendiz").html(ficha);
    var datos = new FormData();
    datos.append("ficha", ficha);
     $.ajax({
        url: "ajax/aprendiz.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta[0]);
            // $("#editarDocumentoAprendiz").val(respuesta[0]["numdocumentoaprendiz"]);
            // $("#editarAprendiz").val(respuesta[0]["nombreaprendiz"]);
            // $("#editarFichaAprendiz").val(respuesta[0]["numeroficha"]);
            // $("#editarTelefonoAprendiz").val(respuesta[0]["telefonoaprendiz"]);
            // $("#editarEmailAprendiz").val(respuesta[0]["emailaprendiz"]);
        }
    })



    window.location = "index.php?ruta=aprendiz&ficha=" + ficha;

});

$(".tablas").on("click", ".btnEliminarAprendiz", function(){
    var NumDocumentoAprendiz = $(this).attr("Documento");

    $("#documento").val(NumDocumentoAprendiz);


    swal({
        title: '¿Está seguro de borrar aprendiz?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar aprendiz!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=aprendiz&NumDocumentoAprendiz=" + NumDocumentoAprendiz;
        }
    })
})

/*=============================================
=            EDITAR APRENDIZ                  =
=============================================*/
$(".tablas").on("click", ".btnEditarAprendiz", function(){
    var idAprendiz = $(this).attr("Documento");
    var datos = new FormData();
    datos.append("idAprendiz", idAprendiz);
    $.ajax({
        url: "ajax/aprendiz.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta[0]);
            $("#editarDocumentoAprendiz").val(respuesta[0]["numdocumentoaprendiz"]);
            $("#editarAprendiz").val(respuesta[0]["nombreaprendiz"]);
            $("#editarFichaAprendiz").val(respuesta[0]["numeroficha"]);
            $("#editarTelefonoAprendiz").val(respuesta[0]["telefonoaprendiz"]);
            $("#editarEmailAprendiz").val(respuesta[0]["emailaprendiz"]);
        }
    })
})
