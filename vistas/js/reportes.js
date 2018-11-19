/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/
if (localStorage.getItem("capturarRango") != null) {
    $("#daterange-btn span").html(localStorage.getItem("capturarRango"));
} else {
    $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')
}
/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn').daterangepicker({
    ranges: {
        'Hoy': [moment(), moment()],
        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes': [moment().startOf('month'), moment().endOf('month')],
        'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate: moment()
}, function(start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    var fechaInicial = start.format('YYYY-M-D');
    var fechaFinal = end.format('YYYY-M-D');
    var capturarRango = $("#daterange-btn span").html();
    localStorage.setItem("capturarRango", capturarRango);
    window.location = "index.php?ruta=reportes&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;
})
/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/
$(".daterangepicker .range_inputs .cancelBtn").on("click", function() {
    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "reportes";
})
/*=============================================
CAPTURAR HOY
=============================================*/
$(".daterangepicker .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    debugger;
    if (textoHoy == "Hoy") {
        var d = new Date();
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
        localStorage.setItem("capturarRango", "Hoy");
        window.location = "index.php?ruta=reportes&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;
    }
})