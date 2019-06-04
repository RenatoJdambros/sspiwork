$(document).ready(function () {
    $('.js-example-basic-multiple').select2();


});

$('.chk1').prop('indeterminate', true)


$(document).ready(function () {
    $('.js-example-basic-single').select2();
});

function removerCheckbox(value) {
    if (value != '' && value != null) {
        $('input[name=origemMotivo]').attr('checked', false);
        $('input[name=origemMotivo]').attr('disabled', true);
    } else {
        $('input[name=origemMotivo]').attr('disabled', false);
    }
}