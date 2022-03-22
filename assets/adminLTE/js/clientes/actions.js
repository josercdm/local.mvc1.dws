$(document).ready(function () {
    /** MASCARAS INPUTS */

    $('#cl_celular, #cl_celular_op').mask('(00) 0 0000-0000');
    $('#cl_telefone_comercial').mask('(00) 0 0000-0000');
    $('#cl_cep').mask('00000-000');

    let count = 0;
    $('#cl_telefone_comercial').blur(function () {
        count = $(this).val().length;
        if (count == 15) {
            $(this).mask('(00) 0000-0000');
        }
    });

    $('#cl_telefone_comercial').mousedown(function () {
        $(this).val('');
        $(this).mask('(00) 0 0000-0000');
    });


    $('#cl_cpf').mask('000.000.000-00');
    $('#cl_cnpj').mask('00.000.000/0000-00');


    if ($('.formStep1').hasClass('active')) {
        $('.cl_prev').attr('disabled', true);
    }

    $('body').on('click', '.cl_next', function () {

        if ($('#cl_vendedor').val() == '') {
            showError('Selecione o vendedor para esse cliente.');
        } else if ($('#cl_nome').val() == '') {
            showError('Informe o nome do cliente.');
        } else if ($('#cl_email').val() == '') {
            showError('Informe o e-mail do cliente.');
        } else if ($('#cl_celular').val() == '') {
            showError('Informe um número de telefone.');
        } else if ($('#cl_cpf').val() == '') {
            showError('Informe o CPF do cliente.');
        } else if (!validarCPF($('#cl_cpf').val())) {
            showError('Este CPF é inválido.');
        } else if ($('#cl_data_nascimento').val() == '') {
            showError('Informe a data de nascimento do cliente.');
        } else {

            if (!$('.formStep2').hasClass('active')) {
                $('.formStep1').removeClass('active');
                $('.formStep2').addClass('active');
                $('.formStep1').animate({
                    opacity: '0'
                }, 800);

                $('.formStep2').animate({
                    opacity: '1'
                }, 1000);
                $('.cl_prev').attr('disabled', false);
                $('#cl_nome_fantasia').focus();
            } else {
                if (!$('.formStep3').hasClass('active')) {
                    $('.formStep2').removeClass('active');
                    $('.formStep3').addClass('active');
                    $('.formStep2').animate({
                        opacity: '0'
                    }, 800);

                    $('.formStep3').animate({
                        opacity: '1'
                    }, 1000);
                    $('.cl_prev').attr('disabled', false);
                }
            }
        }

    });

    $('body').on('click', '.cl_prev', function () {

        if (!$('.formStep1').hasClass('active')) {
            if ($('.formStep2').hasClass('active')) {
                $('.formStep1').addClass('active');
                $('.formStep2').removeClass('active');
                $('.formStep1').animate({
                    opacity: '1'
                }, 800);

                $('.formStep2').animate({
                    opacity: '0'
                }, 1000);
                $('.cl_prev').attr('disabled', true);
            } else if ($('.formStep3').hasClass('active')) {
                $('.formStep2').addClass('active');
                $('.formStep3').removeClass('active');
                $('.formStep2').animate({
                    opacity: '1'
                }, 800);

                $('.formStep3').animate({
                    opacity: '0'
                }, 1000);
            }
        }
    });

    if ($('#cl_user_cpf').is(':checked')) {
        $('#cl_cnpj').attr('disabled', true);
        $('#empresa_use_cpf').val('Sim');
    } else {
        $('#cl_cnpj').attr('disabled', false);
        $('#empresa_use_cpf').val('Não');
    }

    $('body').on('change', '#cl_user_cpf', function (e) {
        if ($('#cl_user_cpf').is(':checked')) {
            $('#cl_cnpj').attr('disabled', true);
            $('#cl_cnpj').css('cursor', 'not-allowed');
            $(this).attr('checked', true)
            $('#empresa_use_cpf').val('Sim');
        } else {
            $('#cl_cnpj').attr('disabled', false);
            $('#cl_cnpj').css('cursor', 'text');
            $(this).attr('checked', false)
            $('#empresa_use_cpf').val('Não');
        }
    });

    $('body').on('click', '.cadastrar-cliente', function (e) {
        e.preventDefault();

        if ($('#cl_cep').val() == '') {
            showError('Informe o CEP da empresa.');
        } else if ($('#cl_rua').val() == '') {
            showError('Informe o nome da rua.');
        } else if ($('#cl_numero').val() == '') {
            showError('Informe o número.');
        } else if ($('#cl_complemento').val() == '') {
            showError('Informe o complemento.');
        } else if ($('#cl_bairro').val() == '') {
            showError('Informe o bairro.');
        } else if ($('#cl_cidade_estado').val() == '') {
            showError('Informe a cidade/estado.');
        } else {
            var form = $('#formCliente').serialize();

            cadastrarCliente(form);
        }

        if (!$('#cl_user_cpf').is(':checked')) {
            if ($('#cl_nome_fantasia').val() == '') {
                showError('Informe o nome fantasia.');
            } else if ($('#cl_cnpj').val() == '') {
                showError('Informe o CNPJ da empresa.');
            } else if ($('#cl_email_comercial').val() == '') {
                showError('Informe o e-mail da empresa.');
            } else if ($('#cl_telefone_comercial').val() == '') {
                showError('Informe um número de telefone.');
            }
        }
    });
});

function cadastrarCliente(form) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/clientes/actions.php',
        data: { 'cadastrarCliente': true, 'form': form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Analisando os dados...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Os dados foram cadastrados.', '/admin/clientes/novo');
            } else {
                showError('Erro ao cadastrar esses dados!');
            }
        }
    });

}

$('body').on('click', '.update-cliente', function (e) {
    e.preventDefault();

    if ($('#cl_cep').val() == '') {
        showError('Informe o CEP da empresa.');
        return false;
    } else if ($('#cl_rua').val() == '') {
        showError('Informe o nome da rua.');
        return false;
    } else if ($('#cl_numero').val() == '') {
        showError('Informe o número.');
        return false;
    } else if ($('#cl_complemento').val() == '') {
        showError('Informe o complemento.');
        return false;
    } else if ($('#cl_bairro').val() == '') {
        showError('Informe o bairro.');
        return false;
    } else if ($('#cl_cidade_estado').val() == '') {
        showError('Informe a cidade/estado.');
        return false;
    } else if ($('#cl_nome_fantasia').val() == '') {
        showError('Informe o nome fantasia.');
        return false;
    } else if ($('#cl_email_comercial').val() == '') {
        showError('Informe o e-mail da empresa.');
        return false;
    } else if ($('#cl_telefone_comercial').val() == '') {
        showError('Informe um número de telefone.');
        return false;
    } else {
        var form = $('#formCliente').serialize();

        if (!$('#cl_user_cpf').is(':checked')) {
            if ($('#cl_cnpj').val() == '') {
                showError('Informe o CNPJ da empresa.');
                return false;
            } 
        } 
        editarCliente(form);
        return true;
    }
});

function editarCliente(form) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/clientes/actions.php',
        data: { 'editarCliente': true, 'form': form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Analisando os dados...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Os dados foram atualizados.', '/admin/clientes/');
            } else {
                showError('Erro ao atualizar esses dados!');
            }
        }
    });

}

$('body').on('click', '.del-cliente', function (e) {
    var clienteid = $(this).attr('data-clienteid');

    Swal.fire({
        title: 'Atenção!',
        text: 'Os dados desse cliente serão apagados permanentemente! Deseja continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, continuar.'
    }).then((result) => {
        if (result.isConfirmed) {
            deletarCliente(clienteid);
        }
    });

});

function deletarCliente(clienteid) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/clientes/actions.php',
        data: { 'deletarCliente': true, 'clienteid': clienteid },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Deletando os dados...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Os dados foram deletados.', '/admin/clientes/');
            } else {
                showError('Erro ao deletar esses dados!');
            }
        }
    });

}

$("#cl_cnpj").blur(function () {
    var cnpj = $(this).val();
    cnpj = cnpj.replace(/\.|\-|\//g, '');

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/clientes/actions.php',
        data: { 'validaCNPJ': true, 'cnpj': cnpj },
        dataType: 'json',
        success: function (response) {

            if (response.status == 'ERROR') {
                showError(response.message);
            } else {

                $('#cl_email_comercial').val(response.email);
                $('#cl_nome_fantasia').val(response.fantasia);
                $('#cl_telefone_comercial').val(response.telefone);
                // $('#cl_categoria').val(response.);
                $('#cl_cep').val(response.cep);
                $('#cl_rua').val(response.logradouro);
                $('#cl_numero').val(response.numero);
                $('#cl_complemento').val(response.complemento);
                $('#cl_bairro').val(response.bairro);
                $('#cl_cidade_estado').val(response.municipio + '/' + response.uf);
            }
        }
    });
});

$("#cl_cep").blur(function () {


    var cep = $(this).val().replace(/\D/g, '');

    if (cep != "") {

        var validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {

            $("#cl_rua").val("...");
            $("#cl_bairro").val("...");
            $("#cl_cidade_estado").val("...");

            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {

                    $("#cl_rua").val(dados.logradouro);
                    $("#cl_bairro").val(dados.bairro);
                    $("#cl_cidade_estado").val(dados.localidade + '/' + dados.uf);

                } else {

                    limpa_formulário_cep();
                    $("#cl_cep").parent().next('small').html('Cep não encontrado.').removeClass('hide');
                }
            });
        } else {

            limpa_formulário_cep();
            showError('Cep não encontrado!');
        }
    } else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
});

function limpa_formulário_cep() {

    showError('Preencha o campo com o CEP.');
    $("#cl_cep").val("");
    $("#cl_rua").val("");
    $("#cl_bairro").val("");
    $("#cl_cidade_estado").val("");
}

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '')
        return false;
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;

    add = 0;
    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}