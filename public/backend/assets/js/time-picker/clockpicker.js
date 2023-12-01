'use strict';
/*$('.clockpicker').clockpicker()
    .find('input').change(function () {
        console.log(this.value);
    });*/
$('.clockpicker').clockpicker({
    placement: 'bottom',
    align: 'right',
    autoclose: true,
    twelvehour: true,
    'default': '20:48'
});
if (/Mobile/.test(navigator.userAgent)) {
    $('input').prop('readOnly', true);
}