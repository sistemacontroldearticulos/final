function duracion(sel) {
    if (sel == "TÉCNICO") {
        $("#nuevaDuracion").val("12 MESES");
        $("#nuevaDuracion").prop('readonly', true);
        $("#EditarDuracion").val("12 MESES");
        $("#EditarDuracion").prop('readonly', true);
    } else if (sel == "TECNÓLOGO") {
        $("#nuevaDuracion").val("24 MESES");
        $("#nuevaDuracion").prop('readonly', true);
        $("#EditarDuracion").val("24 MESES");
        $("#EditarDuracion").prop('readonly', true);
    } else if (sel == "COMPLEMENTARIO") {
        $("#nuevaDuracion").val("");
        $("#nuevaDuracion").prop('readonly', false);
        $("#EditarDuracion").val("");
        $("#EditarDuracion").prop('readonly', false);
    } else {
        $("#nuevaDuracion").val("");
        $("#nuevaDuracion").prop('readonly', true);
        $("#EditarDuracion").val("");
        $("#EditarDuracion").prop('readonly', true);
    }
}
// SE PASA LA VALIDACION DEL PROGRAMA DIRECTAMENTE AL EVENTO DE CAMBIO DE LA FECHA
// "var diaActual" se pasa a inicializar cada vez que se ejecuta la funcion
function tiempo(sel) {
    debugger;
    var idPrograma = $("#nuevoPrograma").val();
    console.log(idPrograma);
    var datos = new FormData();
    datos.append("idPrograma", idPrograma);
    $.ajax({
        url: "ajax/programas.Ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta[3]);
            // $("#nuevoAmbiente1").val(respuesta["nombreambiente"]);
            var diaActual = new Date(sel);
            // console.log("diaActual", diaActual);
            var day = diaActual.getDate();
            debugger;
            if (respuesta[3] == "TÉCNICO") {
                var month = diaActual.getMonth() + 1;
                var year = diaActual.getFullYear() + 1;
                fecha = month + '/' + day + '/' + year;
                $("#fin").val(fecha);
                $("#fin").prop('readonly', true);
            } else if (respuesta[3] == "TECNÓLOGO") {
                diaActual = new Date(sel);
                console.log("diaActual", diaActual);
                var day = diaActual.getDate();
                var month = diaActual.getMonth() + 1;
                var year = diaActual.getFullYear() + 2;
                fecha = month + '/' + day + '/' + year;
                $("#fin").val(fecha);
                $("#fin").html(fecha);
                $("#fin").prop('readonly', true);
            }
        }
    });
}
// LOS INPUT DE LAS FECHAS AL CARGAR EL MODAL ESTAN DESACTIVADOS, SE ACTIVAN AL ESCOGER PROGRAMA
function activarFechas() {
    debugger;
    $("#nuevaFechaFin").removeAttr('disabled');
    $("#nuevaFechaInicio").removeAttr('disabled');
}