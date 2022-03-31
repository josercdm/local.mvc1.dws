$(document).ready(function () {
    $('.summernote').summernote({
        height: '250'
    });

    $('#vnd_contrato_price').mask('#.##0,00', { reverse: true });


});



let clearTime;
let time = 5000;

$('body').on('keyup', '#searchCliente', function () {

    var texto = $(this).val();
    clearTimeout(clearTime);

    if (texto != '') {
        $('#select_cliente').removeClass('d-none');
        clearTime = setTimeout(changeClientes(texto), time);
    } else {
        $('#select_cliente').addClass('d-none');
        $('#select_cliente').html('');
    }

});

$('body').on('click', '.chanceCliente', function () {
    var clienteid = $(this).attr('data-clienteid');
    $('#searchCliente').val($(this).text());
    $('#vnd_cliente').val(clienteid);
    $('#select_cliente').html('').addClass('d-none');
});

function changeClientes(texto) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/vendas/actions.php',
        data: { change: true, texto: texto },
        dataType: 'json',
        success: function (response) {

            $('#select_cliente').html('');
            
            for (var i in response) {
                var element = '<a href="javascript:void(0);" class="list-group-item text-danger chanceCliente" data-clienteid="' + response[i].clienteid + '">' + response[i].cliente_nome + ' - ' + response[i].cliente_documento + '</a>';
                $('#select_cliente').append(element);
            }
        }
    });
}

$('body').on('click', '.cadastrar-venda', function (e) {
    e.preventDefault();
    var form = $('#formVendas').serialize();

    if ($('#vnd_produtos').val().length == 0) {
        showError('Selecione pelo menos um produto.');
    } else if ($('#vnd_vendedor').val() == '') {
        showError('Selecione o vendedor.');
    } else if ($('#vnd_cliente').val() == '') {
        showError('Selecione o cliente.');
    } else if ($('#vnd_fotografo').val() == '') {
        showError('Selecione o fotógrafo.');
    } else if ($('#vnd_contrato_price').val() == '') {
        showError('Informe o valor do contrato.');
    } else if ($('#vnd_pagamento').val() == '') {
        showError('Selecione o meio de pagamento.');
    } else {
        create(form);
    }
});


function create(form) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/vendas/actions.php',
        data: { create: true, form: form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Cadastrando venda...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Venda cadastrada com sucesso!', '/admin/vendas');
            } else {
                showError(response.status);
            }
        }
    });
}

$('body').on('click', '.update-venda', function (e) {
    e.preventDefault();
    var form = $('#formEditVendas').serialize();

    update(form);
});


function update(form) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/vendas/actions.php',
        data: { update: true, form: form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Atualizando venda...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Venda atualizada com sucesso!', '/admin/vendas');
            } else {
                showError(response.status);
            }
        }
    });
}

$('body').on('click', '.delete-venda', function (e) {
    e.preventDefault();
    var venda_id = $(this).attr('data-vendaid');

    Swal.fire({
        title: 'Atenção',
        text: 'Todos os dados serão excluídos permanentemente, deseja prosseguir?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, prossiga!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleta(venda_id);
        }
    });

});


function deleta(venda_id) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/vendas/actions.php',
        data: { delete: true, venda_id: venda_id },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Apagando dados da venda...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Venda deletada com sucesso!', '/admin/vendas');
            } else {
                showError(response.status);
            }
        }
    });
}