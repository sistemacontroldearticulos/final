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
$(".tablas").on("click", ".btnEditarUsuario", function(){
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
            console.log(respuesta);
            $("#editarNombre").html(respuesta["nombreusuario"]);
            $("#editarNombre").val(respuesta["nombreusuario"]);
            $("#editarDocumento").val(respuesta["numdocumentousuario"]);
            // $("#editarPerfil").html(respuesta["rolusuario"]);
            $("#editarPerfil").val(respuesta["rolusuario"]);
            $("#fotoActual").val(respuesta["fotousuario"]);
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
                    if (respuesta == false) {
                        $("#editarPrograma").prop('disabled', true)
                    } else {
                        // $("#editarPrograma").html(respuesta["nombreprograma"]);
                        $("#select2-editarPrograma-container").val(respuesta["idprograma"]);
                        $("#select2-editarPrograma-container").html(respuesta["nombreprograma"]);
                        $("#editarPrograma").val(respuesta["idprograma"]);
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
                $("#editarDocumento").parent().after('<div class="alert alert-warning">Este numero de documento ya existe en la base de datos</div>');
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
    if (sel == "Administrador") {
        $("#nuevoPrograma").prop('disabled', true);
    } else {
        $("#nuevoPrograma").prop('disabled', false);
    }
}

function rolUsuario2(sel) {
    // debugger;
    if (sel == "ADMINISTRADOR") {
        $("#editarPrograma").val("");
        $("#editarPrograma").prop('disabled', true);
    } else {
        $("#editarPrograma").prop('disabled', false);
    }
}


// $(".btnEditarUsuario1").change(function(){

//     debugger;
// })