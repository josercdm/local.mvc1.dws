$('body').on('click', '.cadastrar-produtos', function (e) {
    e.preventDefault();

    var form = $('#formProdutos').serialize();

    if ($('#produto').val() == '') {
        showError('Informe o nome do produto.');
    } else {

        cadastrarProdutos(form);
    }
});

function cadastrarProdutos(form) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/produtos/actions.php',
        data: { cadastrarProdutos: true, form: form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Cadastrando produto...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Produto cadastrado com sucesso.', '/admin/produtos');
            } else {
                showError(response.status);
            }
        }
    });
}

$('body').on('click', '.editar-produto', function (e) {
    e.preventDefault();

    var form = $('#formEditProduto').serialize();

    if ($('#produto').val() == '') {
        showError('Informe o nome do produto.');
    } else {

        editarProduto(form);
    }
});

function editarProduto(form) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/produtos/actions.php',
        data: { editarProduto: true, form: form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Salvando alterações...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('As alterações foram salvas.', '/admin/produtos');
            } else {
                showError(response.status);
            }
        }
    });
}

$('body').on('click', '.del-produto', function (e) {
    e.preventDefault();

    var produtoid = $(this).attr('data-produtoid');

    Swal.fire({
        title: 'Atenção!',
        text: 'Esses dados serão apagados permanentemente! Deseja continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, continuar.'
    }).then((result) => {
        if (result.isConfirmed) {
            delProduto(produtoid);
        }
    });
    
});

function delProduto(produtoid) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/produtos/actions.php',
        data: { delProduto: true, produtoid: produtoid },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Deletando produto...', 10000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Produto deletado com sucesso.', '/admin/produtos');
            }
        }
    });
}