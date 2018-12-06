/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function() {
    var imagen = this.files[0];
    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".nuevaFoto").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    } else if (imagen["size"] > 2000000) {
        $(".nuevaFoto").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })
    }
})
/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarUsuario", function() {
    // $(".btnEditarUsuario").click(function() {
    var idUsuario = $(this).attr("NumDocumentoUsuario");
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editarNombre").html(respuesta["nombreusuario"]);
            $("#editarNombre").val(respuesta["nombreusuario"]);
            $("#editarDocumento").val(respuesta["numdocumentousuario"]);
            // $("#editarPerfil").html(respuesta["rolusuario"]);
            $("#editarPerfil").val(respuesta["rolusuario"]);
            $("#fotoActual").val(respuesta["fotousuario"]);
            // EDITAR INSTRUCTOR O ESPECIAL
            $("#editarNombre1").html(respuesta["nombreusuario"]);
            $("#editarNombre1").val(respuesta["nombreusuario"]);
            $("#editarDocumento1").val(respuesta["numdocumentousuario"]);
            $("#editarPerfil1").val(respuesta["rolusuario"]);
            $("#fotoActual11").val(respuesta["fotousuario"]);
            $("#passwordActual1").val(respuesta["contraseniausuario"]);
            if (respuesta["rolusuario"] == "ADMINISTRADOR" || respuesta["rolusuario"] == "ESPECIAL") {
                $("#editarPrograma").prop('disabled', true);
            }
            //////////////////////////////////////////////////////////
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
                    console.log(respuesta);
                    if (respuesta == false) {
                        $("#editarPrograma").prop('disabled', true)
                    } else {
                        // $("#editarPrograma").html(respuesta["nombreprograma"]);
                        $("#select2-editarPrograma-container").val(respuesta["idprograma"]);
                        $("#select2-editarPrograma-container").html(respuesta["nombreprograma"]);
                        $("#editarPrograma").val(respuesta["idprograma"]);
                        // EDITAR INSTRUCTOR O ESPECIAL
                        $("#editarPrograma11").val(respuesta["idprograma"]);
                        ///////////////////////////////////////////
                    }
                }
            })
            $("#passwordActual").val(respuesta["contraseniausuario"]);
            if (respuesta["fotousuario"] != "") {
                $(".previsualizar").attr("src", respuesta["fotousuario"]);
            }
        }
    });
})
/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/
$("#nuevoDocumento").change(function() {
    $(".alert").remove();
    var NumDocumentoUsuario = $(this).val();
    var datos = new FormData();
    datos.append("ValidarDocumento", NumDocumentoUsuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta) {
                $("#nuevoDocumento").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE DOCUMENTO YA SE ENCUENTRA REGISTRADO EN LA BASE DE DATOS</strong></font></div>');
                $("#nuevoDocumento").val("");
            }
        }
    })
})
/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarUsuario", function() {
    var NumDocumentoUsuario = $(this).attr("NumDocumentoUsuario");
    var FotoUsuario = $(this).attr("FotoUsuario");
    var NombreUsuario = $(this).attr("NombreUsuario");
    swal({
        title: '¿Está seguro de borrar usuario?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=usuarios&NumDocumentoUsuario=" + NumDocumentoUsuario + "&nombreUsuario=" + NombreUsuario + "&FotoUsuario=" + FotoUsuario;
        }
    })
})

function rolUsuario(sel) {
    if (sel == "Administrador" || sel == "Especial") {
        $("#nuevoPrograma").prop('disabled', true);
        $("#nuevoPrograma").val("");
        $("#select2-nuevoPrograma-container").html("Seleccionar Programa");
        $("#select2-nuevoPrograma-container").val("");
        $("#nuevoPrograma").val("Seleccionar Programa");
        $
    } else {
        $("#nuevoPrograma").val("");
        $("#select2-nuevoPrograma-container").html("Seleccionar Programa");
        $("#select2-nuevoPrograma-container").val("");
        $("#nuevoPrograma").val("Seleccionar Programa");
        $("#nuevoPrograma").prop('disabled', false);
    }
}

function rolUsuario2(sel) {
    // debugger;
    if (sel == "ADMINISTRADOR" || sel == "ESPECIAL") {
        $("#editarPrograma").prop('disabled', true);
        $("#editarPrograma").val("");
        $("#select2-editarPrograma-container").html("Seleccionar Programa");
        $("#select2-editarPrograma-container").val("");
        $("#editarPrograma").val("Seleccionar Programa");
        $
    } else {
        $("#editarPrograma").val("");
        $("#select2-editarPrograma-container").html("Seleccionar Programa");
        $("#select2-editarPrograma-container").val("");
        $("#editarPrograma").val("Seleccionar Programa");
        $("#editarPrograma").prop('disabled', false);
    }
}
// $(".btnEditarUsuario1").click(function(){
//     debugger;
//     $("#modalEditarUsuario").modal("toggle");
// })
$(".btnEditarUsuario1").click(function() {
    var idUsuario = $(this).attr("NumDocumentoUsuario");
    console.log("idUsuario", idUsuario);
    // $('#modalEditarUsuario').modal('show');
    $(".nuevoArticulo").append('<div class="row" style="padding: 5px 30px">' + '<div class="col-xs-6" style="padding-left:0px;padding-right:7px">' + '<div class="input-group">' + '<span class="input-group-addon"><button type="button" class="btn btn-danger quitarNovedad btn-xs" idArticulo="' + $("#idArticulo").val() + '"><i class="fa fa-times"></i></button></span>' + '<input type="text" class="form-control agregarArticulo1" idArticulo="' + $("#idArticulo").val() + '" name="agregarArticulo" value="' + $("#agregarArticulo").val() + '" required readonly>' + '</div>' + '</div>' + '<div class="form-group col-xs-6"  style="padding-left:0px; padding-right: 0px">' + '<div class="input-group">' + '<span class="input-group-addon"><i class="fa fa-th"></i></span>' + '<input type="text" class="form-control tipoNovedadArticulo1" name="tipoNovedadArticulo1" placeholder="Descripción" readonly value="' + $(".tipoNovedadArticulo").val() + '"required>' + '</div>' + '</div> ' + '<br>' + '<div class="col-xs-12" style="padding-left:0px">' + '<div class="input-group">' + '<input type="text" class="form-control nuevaDescripcion1" name="nuevaDescripcion" placeholder="Descripción" readonly value="' + $(".nuevaDescripcion").val() + '"required style="width:416px">' + '<input type="hidden" id="articulo" name="articulo" value="' + $("#idArticulo").val() + '">' + '</div>' + '</div>' + '</div>' + '</div>');
});