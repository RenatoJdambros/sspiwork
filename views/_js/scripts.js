$(document).ready(function () {
    $('.js-example-basic-multiple').select2();


    

    /* $('.origemText').change(function() {
        $('.origemRadio').attr('checked', false);
        $('.origemRadio').attr('disabled', true);
    }); */

});

$('.chk1').prop('indeterminate', true)


$(document).ready(function () {
    $('.js-example-basic-single').select2();
});

/* function removerCheckbox(value) {
    if (value != '' && value != null) {
        $('input[name=origem][type=radio]').attr('checked', false);
        $('input[name=origem][type=radio]').attr('disabled', true);
    } else {
        $('input[name=origem][type=text]').attr('disabled', false);
    }
} */

$('.outros').click(function()
{
    $('#origemText').removeAttr("disabled");
});
    
$('.origemRadio').click(function()
{
    //$('#origemText').val("");
    $('#origemText').attr("disabled","disabled");
});

// $("#cliente_telefone").mask("(00) 00000-0000");