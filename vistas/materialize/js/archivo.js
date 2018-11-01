  $(document).ready(function() {
    $('select').material_select();
  

  $('.datepicker').pickadate({
  labelMonthNext: 'Next month',
  labelMonthPrev: 'Previous month',
  labelMonthSelect: 'Select a month',
  labelYearSelect: 'Select a year',
  monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
  monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
  weekdaysFull: [ 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo' ],
  weekdaysShort: [ 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom' ],
  weekdaysLetter: [ 'L', 'M', 'M', 'J', 'V', 'S', 'D' ],
  today: 'HOY',
  clear: 'LIMPIAR',
  close: 'CERRAR'
});
 

   
  });
