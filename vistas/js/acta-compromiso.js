$(".tablas").on("click", ".btnCompromiso", function() {
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
                url: "ajax/aprendiz.ajax.php",
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
            // console.log("idEquipo", idEquipo);
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
            // EQUIPO ACTA
            $('#articulos').empty().append('<option selected="selected" value="whatever">Seleccione Articulos</option>');
            var p = "";
            var k = "";
            var datos1 = new FormData();
            datos1.append("idEquipo", idEquipo);
            $.ajax({
                url: "ajax/articulosAjax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    for (var i = 0; i < respuesta.length; i++) {
                        // console.log("respuesta", respuesta[i]["tipoarticulo"]);
                        var option = document.createElement("option");
                        $(option).val(respuesta[i]["idarticulo"]);
                        $(option).html(respuesta[i]["tipoarticulo"]);
                        $(option).appendTo("#articulos");
                    }
                }
            })
        }
    })
})
// IMPRIMIR ACTA COMPROMISO
$(".tablas").on("click", ".btnImprimirActaCompromiso", function() {
    var codigo = $(this).attr("codigo");
    window.open("extensiones/tcpdf/pdf/actaCompromiso.php?codigo=" + codigo, "_blank");
})
$("#articulos").change(function() {
    $(".alert").remove();
    var idArticuloActa = $("#articulos").val();
    console.log("idArticuloActa", idArticuloActa);
    var datos = new FormData();
    datos.append("idArticuloActa", idArticuloActa);
    $.ajax({
        url: "ajax/articulosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta == "") {
                $("#articulos").parent().after('<div class="alert" style="height: 50px; text-align="center"><font color="#f39c12"><strong>NO SE PUEDE CREAR EL ACTA DE COMPROMISO.<br> EL ARTÍCULO NO FUE REPORTADO ANTERIORMENTE</strong></font></div>');
                $("#articulos").val("whatever");
            }
        }
    })
})