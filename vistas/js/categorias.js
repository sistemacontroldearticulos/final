/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCategoria", function(){
    var idCategoria = $(this).attr("idCategoria");
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
    $.ajax({
        url: "ajax/categoriasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editarCategoria").val(respuesta["nombrecategoria"]);
            $("#idCategoria").val(respuesta["idcategoria"]);
        }
    })
})
/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function(){
    var idCategoria = $(this).attr("idCategoria");
    swal({
        title: '¿Está seguro de borrar la categoría?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar categoría!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;
        }
    })
})

/*=========================
=    VALIDAR CATEGORIA    =
=========================*/
$("#nuevaCategoria").change(function() {
    // debugger;   
    $(".alert").remove();
    var nombreCategoria = $(this).val();
    var datos = new FormData();
    datos.append("nombreCategoria", nombreCategoria);
    $.ajax({
        url: "ajax/categoriasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            if (respuesta) {
                $("#nuevaCategoria").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTA CATEGORIA YA SE ENCUENTRA REGISTRADA</strong></font></div>');
                $("#nuevaCategoria").val("");
            }
        }
    })
})


/*=========================
=    VALIDAR EDITAR CATEGORIA    =
=========================*/
var categoriaAntes;
function capturar2(a) {
    // console.log("sel",a);
    categoriaAntes = a;
    $("#editarCategoria").removeAttr('onclick');
}

$("#editarCategoria").change(function() {
    // debugger;   
    $(".alert").remove();
    var nombreCategoria = $(this).val();
    var datos = new FormData();
    datos.append("nombreCategoria", nombreCategoria);
    $.ajax({
        url: "ajax/categoriasAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);

            if (categoriaAntes == nombreCategoria.toUpperCase()) {
            
            }else if (respuesta["nombrecategoria"] == nombreCategoria.toUpperCase()){

                $("#editarCategoria").parent().after('<div class="alert" style="height: 20px; text-align="center"><font color="#f39c12"><strong>ESTE PROGRAMA YA SE ENCUENTRA REGISTRADO</strong></font></div>');
                $("#editarCategoria").val("");

            }else{

            }   
        }
    })
})
