//SE PASA A PONER UN SELECT PARA ESCOGER LOS APRENDICES QUE SE CARGA CON TODOS LOS APRENDICES DE LA FICHA
//ESCOGIDA. EL SELECT SE CARGA AL FINAL DE ESTA FUNCION
var ficha;
$("#ficha").change(function() {
    $(".alert").remove();
    var idFicha = $(this).val();
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
            ficha = respuesta["numeroficha"];
            if (respuesta == false) {
                $("#ficha").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTA FICHA NO SE ENCUENTRA REGISTRADA</strong></font></div>');
                $("#ficha").val("");
            } else {
                var idFicha = ficha;
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
                        var idAmbiente = respuesta["idambiente"];
                        var datos = new FormData();
                        datos.append("idAmbiente", idAmbiente);
                        $.ajax({
                            url: "ajax/articulosAjax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(respuesta) {
                                //CODIGO PARA LIMPIAR SELECT DE EQUIPO CADA VEZ QUE SE CAMBIA DE FICHA
                                $('#equipos').empty().append('<option selected="selected" value="whatever">Seleccione El Equipo</option>');
                                /////////////////////////////////////////////     
                                var indices = [];
                                indices.push("Seleccione Equipo");
                                indices.length = 0;
                                for (var i = 0; i < respuesta.length; i++) {
                                    if (respuesta[i][2] != null) {
                                        indices.push(respuesta[i][2]);
                                    }
                                }
                                var uniqueNames = [];
                                uniqueNames.length = 0;
                                $.each(indices, function(i, el) {
                                    if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                                });
                                var p = "";
                                var k = "";

                                // SE MUESTRA EN EL SELECT DE EQUIPO
                                for (var i = 0 ; i < uniqueNames.length; i++) {
                                     var idEquipo = uniqueNames[i];
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
                                            p = respuesta["nombreequipo"];
                                            k = respuesta["idequipo"];
                                            var option = document.createElement("option");
                                            $(option).html(p);
                                            $(option).val(k);
                                            $(option).appendTo("#equipos");
                                        }
                                    })
                                }
                            }
                        })
                        //CODIGO PARA LIMPIAR SELECT DE APRENDIZ CADA VEZ QUE SE CAMBIA DE FICHA
                        $('#aprendices').empty().append('<option selected="selected" value="whatever">Seleccione el Aprendiz</option>');
                        ///////////////////////////////////////////////////////////////
                        var ficha = idFicha;
                        console.log(ficha);
                        var datos = new FormData();
                        datos.append("ficha", ficha);
                        $.ajax({
                            url: "ajax/aprendiz.Ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(respuesta) {
                                console.log("respuesta", respuesta.length);
                                for (var i = 0; i < respuesta.length; i++) {
                                    var option = document.createElement("option");
                                    $(option).val(respuesta[i][0]);
                                    $(option).html(respuesta[i][2]);
                                    console.log(option);
                                    $(option).appendTo("#aprendices");
                                }
                            }
                        })
                    }
                })
            }
        }
    })
})
$("#equipos").change(function() {
    $(".alert").remove();
    var equipo = $(this).val();
    var datos = new FormData();
    datos.append("equipo", equipo);
    $.ajax({
        url: "ajax/actasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#equipos").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE EQUIPO SE ENCUENTRA REGISTRADO EN UN ACTA</strong></font></div>');
                $("#equipos").val("");
            }
        }
    })
})