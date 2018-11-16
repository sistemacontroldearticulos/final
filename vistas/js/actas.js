var ficha;
$("#ficha").change(function(){
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
            }else{
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
                                // ELIMINAR ID REPETIDOS DE EQUIPOS
                                var indices = [];
                                for (var i = 0 ; i < respuesta.length; i++) {
                                    if (respuesta[i][2] != null) {
                                        indices.push(respuesta[i][2]);
                                    }
                                }
                                var uniqueNames = [];
                                $.each(indices, function(i, el){
                                    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                                });

                                var p = "";
                                var k = "";
                                // SE MUESTRA EN EL SELEC DE EQUIPO
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
                    }
                })
            }
        }
    })
})

$("#documentoAprendiz").change(function(){
    
    $(".alert").remove();
    var idAprendiz = $(this).val();
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
        	// console.log("respuesta", respuesta);

        	if (respuesta == false) {
        		$("#documentoAprendiz").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE APRENDIZ NO SE ENCUENTRA REGISTRADO </strong></font></div>');
                $("#documentoAprendiz").val("");
        	
        	}else if (respuesta[0][1] != ficha) {
        		$("#documentoAprendiz").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE APRENDIZ NO SE ENCUENTRA REGISTRADO EN ESTA FICHA</strong></font></div>');
                $("#documentoAprendiz").val("");
        	
        	}
        }
    })

    // VALIDAR APRENDIZ EN ACTAS
    var aprendiz = $(this).val();
    var datos = new FormData();
    datos.append("aprendiz", aprendiz);
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
                $("#documentoAprendiz").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE APRENDIZ SE ENCUENTRA REGISTRADO EN UN ACTA</strong></font></div>');
                $("#documentoAprendiz").val("");
            }
        }
    })
})

$("#equipos").change(function(){

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