$(function () {
    $('.js-mask-cpf').mask('999.999.999-99', { autoclear: false });
    $('.js-mask-cnpj').mask('99.999.999/9999-99', { autoclear: false });
    $('.js-mask-data').mask('99/99/9999', { autoclear: false });
    $('.js-mask-cep').mask('99999-999', { autoclear: false });
    $('.js-mask-telefone').mask('(99) 9999-9999', { autoclear: false });
    $('.js-mask-celular').mask('(99) 9 9999-9999', { autoclear: false });
    $('.js-mask-orgao').mask('aaa\/aa', { autoclear: false });
    $('.js-mask-placa').mask('aaa - 9999', { autoclear: false });
    $('.js-mask-mesano').mask('99/9999', { autoclear: false });
    $(".js-mask-percent").mask("99,99%");

    $(".js-mask-percent").on("blur", function () {
        var value = ($(this).val().length == 1) ? $(this).val() + '%' : $(this).val();
        $(this).val(value);
    })

    //$('.js-mask-valor').priceFormat({
    //    prefix: 'R$ ',
    //    centsSeparator: ',',
    //    thousandsSeparator: '.'
    //});

});
