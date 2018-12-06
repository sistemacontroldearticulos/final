function duracion2(sel) {

    if (sel == "TECNICO") {
        $("#EditarDuracion").val("12 MESES");
        $("#EditarDuracion").prop('readonly', true);
    } else if (sel == "TECNOLOGO") {
        $("#EditarDuracion").val("24 MESES");
        $("#EditarDuracion").prop('readonly', true);
    } else if (sel == "COMPLEMENTARIO") {
        $("#EditarDuracion").val("");
        $("#EditarDuracion").prop('disabled', false);
    } else {
        $("#EditarDuracion").val("");
        $("#EditarDuracion").prop('disabled', true);
    }
}

