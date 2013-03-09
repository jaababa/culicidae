$(document).ready(function() {
for (i=0; i<5; i++)
  {
    $("#datepicker"+i).Zebra_DatePicker();
  }
//Month - Year
    $('#month-year').Zebra_DatePicker({
        format: 'm-Y'
    });
});