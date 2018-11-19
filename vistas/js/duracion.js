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


// function programa(sel){
    
//     var idPrograma = sel;

//     var datos = new FormData();
//     datos.append("idPrograma", idPrograma);
//     $.ajax({
//         url: "ajax/programas.Ajax.php",
//         method: "POST",
//         data: datos,
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: "json",
//         success: function(respuesta) {
            
//             $("#nficha").val(respuesta[3]);
//         }
//     });
// }

// function tiempo(sel) {

//     var a = $("#nficha").val();

//     if (a == "TÉCNICO") {

//         diaActual = new Date(sel);

//         var day = diaActual.getDate();
//         var month = diaActual.getMonth()+1;
//         var year = diaActual.getFullYear()+1;

//         fecha  = month + '' + day + '' + year;

//         $("#fin").val(fecha);
//         $("#fin").prop('readonly', true);

//     }else if (a == "TECNÓLOGO") {

//         diaActual = new Date(sel);
//         console.log("diaActual", diaActual);

//         var day = diaActual.getDate();
//         var month = diaActual.getMonth()+1;
//         var year = diaActual.getFullYear()+2;

//         fecha  = month + '' + day + '' + year;

//         $("#fin").val(fecha);
//         $("#fin").prop('readonly', true);
//     }


// }
