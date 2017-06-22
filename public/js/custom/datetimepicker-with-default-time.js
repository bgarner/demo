$('.datetimepicker-start').datetimepicker({
    format: 'YYYY-MM-DD 05:00:00'
});
$('.datetimepicker-end').datetimepicker({
    format: 'YYYY-MM-DD 23:59:59',
    useCurrent: false 
});
 $(".datetimepicker-start").on("dp.change", function (e) {
    $('.datetimepicker-end').data("DateTimePicker").minDate(e.date);
});
$(".datetimepicker-end").on("dp.change", function (e) {
    $('.datetimepicker-start').data("DateTimePicker").maxDate(e.date);
});
$(".datetimepicker-start").data('DateTimePicker').defaultDate(new Date());