$(".tablas").on("click", ".btnCompromiso", function(){
    
    var idActa = $(this).attr("codigoActa");

    $("#idActaResponsabilidad").val(idActa);

    var datos = new FormData();
    datos.append("idActa", idActa);
    $.ajax({
        url: "ajax/actasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idAprendiz").val(respuesta["numdocumentoaprendiz"]);
            $("#idEquipo").val(respuesta["idequipo"]);

            // APRENDIZ ACTA
            var idAprendiz = respuesta["numdocumentoaprendiz"];
            var datos = new FormData();
            datos.append("idAprendiz", idAprendiz);
             $.ajax({
                url: "ajax/aprendiz.Ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    $("#aprendizActa").val(respuesta[0]["nombreaprendiz"]);

                }
            })

            // EQUIPO ACTA
            var idEquipo = respuesta["idequipo"];
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
                    $("#equipoActa").val(respuesta["nombreequipo"]);
                }
            })
        }
    })
})


// IMPRIMIR ACTA COMPROMISO
$(".tablas").on("click", ".btnImprimirActaCompromiso", function(){

    var codigo = $(this).attr("codigo");

    window.open("extensiones/tcpdf/pdf/actaCompromiso.php?codigo="+codigo, "_blank");

})