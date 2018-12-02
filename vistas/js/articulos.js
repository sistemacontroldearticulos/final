$(".tablas").on("click", ".btnEliminarArticulo", function(){
    // debugger;
    var idArticulo = $(this).attr("idArticulo");
    swal({
        title: '¿Desea eliminar el articulo?',
        text: "Si no está seguro puede cancerlar la acción",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText:  'Si, borrar articulo!'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=articulos&idArticulo=" + idArticulo;
        }
    })
})
/*=============================================
=            EDITAR ARTICULOS                  =
=============================================*/
$(".tablas").on("click", ".btnEditarArticulo", function(){
    var idArticulo = $(this).attr("idArticulo");
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
            // console.log(respuesta);
            $("#idArticulo").val(respuesta["idarticulo"]);
            $("#editarTipo").val(respuesta["tipoarticulo"]);
            $("#editarModelo").val(respuesta["modeloarticulo"]);
            $("#editarMarca").val(respuesta["marcaarticulo"]);
            $("#editarInventario").val(respuesta["numinventariosena"]);
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
                    $("#editarAmbiente").val(respuesta["idambiente"]);
                    // $("#editarAmbiente").html(respuesta["nombreambiente"]);
                }
            })
            var idEquipo = $(this).attr("idEquipo");
            var datosEquipo = new FormData();
            datosEquipo.append("idEquipo", respuesta["idequipo"]);
            $.ajax({
                url: "ajax/equipoAjax.php",
                method: "POST",
                data: datosEquipo,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    // console.log("respuesta", respuesta);
                    $("#editarEquipo").val(respuesta["idequipo"]);
                    // $("#editarEquipo").html(respuesta["nombreequipo"]);
                }
            })
            var idCategorias = $(this).attr("idCategoria");
            var datosCategoria = new FormData();
            datosCategoria.append("idCategoria", respuesta["idcategoria"]);
            $.ajax({
                url: "ajax/categoriasAjax.php",
                method: "POST",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    $("#editarCategoria").val(respuesta["idcategoria"]);
                    // $("#editarCategoria").html(respuesta["nombrecategoria"]);
                }
            })
            $("#editarInventario").val(respuesta["numinventariosena"]);
            $("#editarSerial").val(respuesta["serialarticulo"]);
            $("#editarEstado").val(respuesta["estadoarticulo"]);
            // $("#editarEstado").html(respuesta["estadoarticulo"]);
            $("#editarCaracteristica").val(respuesta["caracteristicaarticulo"]);
        }
    })
})

/*=========================
=    VALIDAR SERIAL ARTICULO    =
=========================*/
$("#nuevoSerial").change(function() {
    // debugger;   
    $(".alert").remove();
    var serialArticulo = $(this).val();
    var datos = new FormData();
    datos.append("serialArticulo", serialArticulo);
    $.ajax({
        url: "ajax/articulosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            if (respuesta) {
                $("#nuevoSerial").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE SERIAL YA SE ENCUENTRA REGISTRADO</strong></font></div>');
                $("#nuevoSerial").val("");
            }
        }
    })
})

/*=========================
=    VALIDAR INEVTARIO SENA ARTICULO    =
=========================*/
$("#nuevoInventario").change(function() {
    // debugger;   
    $(".alert").remove();
    var numInventario = $(this).val();
    var datos = new FormData();
    datos.append("numInventario", numInventario);
    $.ajax({
        url: "ajax/articulosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            if (respuesta) {
                $("#nuevoInventario").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE NUMERO DE INVENTARIO YA SE ENCUENTRA REGISTRADO</strong></font></div>');
                $("#nuevoInventario").val("");
            }
        }
    })
})


// CARGAR EQUIPOS EN ambientes
$("#nuevoAmbiente").change(function() {
    // debugger;   
    $(".alert").remove();

    var idAmbiente = $(this).val();
    var datos = new FormData();
    datos.append("idAmbiente", idAmbiente);

    $.ajax({

        url: "ajax/equipoAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);

            $('#nuevoEquipo').empty().append('<option selected="selected" value="whatever">Seleccionar Equipo</option>');

            


            for (var i = 0; i < respuesta.length; i++) {

                var option = document.createElement("option");
                $(option).html(respuesta[i]["nombreequipo"]);
                $(option).val(respuesta[i]["idequipo"]);
                $(option).appendTo("#nuevoEquipo");
                // console.log("respuesta", respuesta[i]["nombreequipo"]);
            }
        }
    })
})