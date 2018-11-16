function ficha(sel) {
    var idFicha1 = sel;
    var datosFichas = new FormData();
    datosFichas.append("sel", idFicha1);
    $.ajax({
        url: "ajax/fichasAjax.php",
        method: "POST",
        data: datosFichas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
            var idAmbiente = respuesta["idambiente"];
            var datosAmbiente = new FormData();
            datosAmbiente.append("idAmbiente", idAmbiente);
            $.ajax({
                url: "ajax/ambientesAjax.php",
                method: "POST",
                data: datosAmbiente,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    // console.log("respuesta", respuesta);
                    $("#nuevoAmbiente1").val(respuesta["nombreambiente"]);
                }
            });
        }
    });
}
// $(".tablas").on("click", ".btnBuscar", function(){
$(".btnBuscar").click(function() {
    $(".alert").remove();
    var idFicha = $("#nuevaFicha1").val();
    var datosFichas = new FormData();
    datosFichas.append("idFicha", idFicha);
    $.ajax({
        url: "ajax/fichasAjax.php",
        method: "POST",
        data: datosFichas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
            if (respuesta == false) {
                $("#nuevaFicha1").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTA FICHA NO ESTA REGISTRADA EN LA BASE DE DATOS</strong></font></div>');
                $("#nuevaFicha1").val("");
            } else if (respuesta["idambiente"] == null) {
                $("#nuevaFicha1").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>LA FICHA INGRESADA NO ESTÁ ASIGNADA A NINGÚN AMBIENTE</strong></font></div>');
                $("#nuevaFicha1").val("");
            } else {
                var idAmbiente = respuesta["idambiente"];
                var datosAmbiente = new FormData();
                datosAmbiente.append("idAmbiente", idAmbiente);
                $.ajax({
                    url: "ajax/ambientesAjax.php",
                    method: "POST",
                    data: datosAmbiente,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {
                        console.log("TIENE AMBIENTE");
                    }
                })
            }
        }
    });
});
//$(".tablas").on("click", ".btnBuscar1", function(){
$(".btnBuscar1").click(function() {
    var idFicha = $("#nuevaFicha1").val();
    var datosFichas = new FormData();
    datosFichas.append("idFicha", idFicha);
    $.ajax({
        url: "ajax/fichasAjax.php",
        method: "POST",
        data: datosFichas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);
            var idAmbiente1 = respuesta["idambiente"];
            var datosAmbiente1 = new FormData();
            $("#idAmbiente2").val(respuesta["idambiente"]);
            var idAmbiente = respuesta["idambiente"];
            datosAmbiente1.append("idAmbiente", idAmbiente);
            $.ajax({
                url: "ajax/ambientesAjax.php",
                method: "POST",
                data: datosAmbiente1,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    // console.log(respuesta["nombreambiente"]);
                    $(".inputAmbiente").val(respuesta["nombreambiente"]);
                    var e = $.Event("keyup", {
                        keyCode: 13
                    });
                    $('.inputAmbiente').focus();
                    $('.inputAmbiente').trigger(e);
                }
            });
            datosAmbiente1.append("idAmbiente1", idAmbiente1);
            $.ajax({
                url: "ajax/ambientesAjax.php",
                method: "POST",
                data: datosAmbiente1,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {}
            })
        }
    });
});
var table = $('.tablaArticulos').DataTable({
    "ajax": "ajax/datatable-articulosAjax.php",
    "columnDefs": [{
        "targets": -1,
        "data": null,
        "defaultContent": '<div class="btn-group"><button class="btn btn-primary btnAgregarArticulo recuperarBoton" idArticulo data-toggle="modal" id="btnAgregarArticulo" data-target="#modalAgregarArticulo1">Agregar</button></div>'
    }],
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
})
/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/
// $(".tablas").on("click", 'button.btnAgregarArticulo', function(){
$('.tablaArticulos tbody').on('click', 'button.btnAgregarArticulo', function() {
    // $('.tablaArticulos ').on('click', 'button.btnAgregarArticulo', function() {    
    var data = table.row($(this).parents('tr')).data();
    // console.log("data", data);
    $(this).attr("idArticulo", data[0]);
});
/*=============================================
AGREGAR NOVEVDAD
=============================================*/
$('.tablaArticulos tbody').on('click', 'button.btnAgregarArticulo', function() {
    // $('.tablaArticulos ').on('click', 'button.btnAgregarArticulo', function() {    
    var idArticulo = $(this).attr("idArticulo");
    console.log("idArticulo", idArticulo);
    $(this).removeClass("btn-primary btnAgregarArticulo");
    $(this).addClass("btn-default");
    var datos = new FormData();
    datos.append("idArticulo", idArticulo);
    $.ajax({
        url: "ajax/articulosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            var nombreArticulo = respuesta["tipoarticulo"];
            var articulo = respuesta["idarticulo"];
            $("#idArticulo").val(articulo);
            $("#agregarArticulo").val(nombreArticulo);
            $("button.recuperarBoton[idArticulo='" + idArticulo + "']").removeClass('btn-primary btnAgregarArticulo');
            $("button.recuperarBoton[idArticulo='" + idArticulo + "']").prop('disabled', true);
        }
    });
});
// QUITAR NOVEVDAD
$('.formularioNovedad').on('click', 'button.quitarNovedad', function() {
    // console.log("boton");
    $(this).parent().parent().parent().parent().remove();
    var idArticulo = $(this).attr("idArticulo");
    debugger;
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").prop('disabled', false);
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").removeClass('btn-default')
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").removeClass('disabled');
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").addClass('btn-primary btnAgregarArticulo');
    listaArticulos("eliminar");
});

function agregar() {
    $(".alert").remove();
    if ($(".tipoNovedadArticulo").val() == "") {
        $(".tipoNovedadArticulo").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>INGRESE TIPO</strong></font></div>');
    } else {
        $("#modalAgregarArticulo1").modal('hide')
        // $(".skin-blue sidebar-collapse sidebar-mini login-page").focus();
        $(".nuevoArticulo").append('<div class="row" style="padding: 5px 15px">' + '<div class="col-xs-4" style="padding-right:0px">' + '<div class="input-group">' + '<span class="input-group-addon"><button type="button" class="btn btn-danger quitarNovedad btn-xs" idArticulo="' + $("#idArticulo").val() + '"><i class="fa fa-times"></i></button></span>' + '<input type="text" class="form-control agregarArticulo1" idArticulo="' + $("#idArticulo").val() + '" name="agregarArticulo" value="' + $("#agregarArticulo").val() + '" required readonly>' + '</div>' + '</div>' + '<div class="form-group col-xs-4"  style="padding-left:5px; padding-right: 0px">' + '<div class="input-group">' + '<span class="input-group-addon"><i class="fa fa-th"></i></span>' + '<input type="text" class="form-control tipoNovedadArticulo1" name="tipoNovedadArticulo1" placeholder="Descripción" readonly value="' + $(".tipoNovedadArticulo").val() + '"required>' + '</div>' + '</div> ' + '<div class="col-xs-4" style="padding-left:5px">' + '<div class="input-group">' + '<input type="text" class="form-control nuevaDescripcion1" name="nuevaDescripcion" placeholder="Descripción" readonly value="' + $(".nuevaDescripcion").val() + '"required>' + '<input type="hidden" id="articulo" name="articulo" value="' + $("#idArticulo").val() + '">' + '</div>' + '</div>' + '</div>');
        listaArticulos("agregar");
    }
}
// LISTA DE ARTICULOS
lista = 0;
var listaArticulosEliminar = [];

function listaArticulos(valor) {
    var listaArticulos1 = [];
    var keys = Object.keys(listaArticulos1);
    // var id =  $(".")
    if (valor == "agregar") {
        var descripcion = $(".nuevaDescripcion1");
        var tipo = $(".tipoNovedadArticulo1");
        var nombre = $(".agregarArticulo1");
        for (var i = 0; i <= lista; i++) {
            listaArticulos1.push({
                "id": $(nombre[i]).attr("idArticulo"),
                "nombre": $(nombre[i]).val(),
                "tipo": $(tipo[i]).val(),
                "descripcion": $(descripcion[i]).val()
            });
        }
        var hash = {};
        array = listaArticulos1.filter(function(current) {
            var exist = !hash[current.id] || false;
            hash[current.id] = true;
            return exist;
        });
        $("#listaArticulos").val(JSON.stringify(array));
    } else {
        var idArticulo = $("#idArticulo").val();
        // debugger;
        for (var i = 0; i < array.length; i++) {
            if ((array[i].id) == idArticulo) {
                array.splice(i, 1);
            }
        }
    }
    lista++;
    $("#tipoNovedadArticulo").val("");
    $(".nuevaDescripcion").val("");
}

function quitarNovedad() {
    // debugger;
    var idArticulo = $("#idArticulo").val();
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").removeClass('disabled');
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").removeClass('btn-default');
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").addClass('btn-primary btnAgregarArticulo');
    $("button.recuperarBoton[idArticulo='" + idArticulo + "']").prop('disabled', false);
}
// $(".tablas").on("click", ".btnBuscar1", function(){
$(".btnBuscar2").click(function() {
    var id = $(this).attr("idNovedad");
    var datos = new FormData();
    datos.append("id", id);
    $.ajax({
        url: "ajax/novedadAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta[0]["idnovedad"]);
            // debugger;
            $(".inputAmbiente").val(respuesta[0]["idnovedad"]);
            var e = $.Event("keyup", {
                keyCode: 13
            });
            $('.inputAmbiente').focus();
            $('.inputAmbiente').trigger(e);
        }
    });
});

function salir() {
    $(".inputAmbiente").val("");
    var e = $.Event("keyup", {
        keyCode: 13
    });
    $('.inputAmbiente').focus();
    $('.inputAmbiente').trigger(e);
}