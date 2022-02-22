$('body').on('click', '#formUser input[type="checkbox"]', function () {
    if ($(this).is(':checked')) {
        $(this).val('1');
    } else {
        $(this).val('0');
    }
});

$('body').on('change', 'input[name="u_status_sw"]', function (e) {
    e.preventDefault();
    if ($(this).is(':checked')) {
        var status = 1;
    } else {
        var status = 0;
    }

    var userid = $(this).val();

    updateStatus(status, userid);
});

function updateStatus(status, userid) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/editUser/edit.php',
        data: { updateStatus: true, status: status, userid: userid },
        dataType: 'json',

        success: function (response) {
            if (response.retorno == 'ok') {
                if (response.status == 1) {
                    $('label[for="u_status_sw_' + response.userid + '"]').text('Ativo');
                    $('#u_status_sw_' + response.userid).attr('checked', 'checked');
                } else {
                    $('label[for="u_status_sw_' + response.userid + '"]').text('Inativo');
                    $('#u_status_sw_' + response.userid).removeAttr('checked');
                }

            }
        }
    });
}

$('body').on('click', '.del-user', function (e) {
    e.preventDefault();
    var userid = $(this).attr('data-userid');

    deleteUser(userid);
});

function deleteUser(userid) {

    Swal.fire({
        title: 'Atenção!',
        text: "Todos os dados desse usuário serão apagados, deseja continuar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, prosseguir!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '/app/application/trigger/editUser/edit.php',
                data: { deleteUser: true, userid: userid },
                dataType: 'json',
                beforeSend: function () {
                    showBefore('Deletando usuário, aguarde...');
                },
                success: function (response) {
                    if (response.status == 'ok') {
                        showSuccess('Sucesso! Todos os dados foram apagados.', '/admin/usuario');
                    }else{
                        showError(response.status);
                    }
                }
            });
        }
    });

}

$('body').on('click', '.cad_new_user', function (e) {
    e.preventDefault();
    var form = $('#formUser').serialize();
    var cpf = $('#u_cpf').val();
    let checkbox = [];
    $('input[type="checkbox"]:checked').each(function () {

        switch ($(this).attr('id')) {
            case 'cl_permissao_viewer': var permissao = 'viewer'; var value = 1; break;
            case 'cl_permissao_edit': var permissao = 'edit'; var value = 1; break;
            case 'cl_permissao_del': var permissao = 'del'; var value = 1; break;
            case 'cl_permissao_sup': var permissao = 'supervisor'; var value = 1; break;
        }

        checkbox.push({
            'permissao': permissao,
            'value': value
        });


    });

    var formData = new FormData();
    formData.append('trigger', true);
    formData.append('form', form);

    if (!validarCPF(cpf)) {
        showError('Número de CPF inválido.');
    } else {
        if (checkbox.length > 0) {
            for (var i in checkbox) {
                formData.append('permissao[]', JSON.stringify(checkbox[i]));

            }
        }
        create(formData);
    }
});

/**
 * 
 * @param {dados serializados do formulário} form 
 */

function create(form) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/editUser/edit.php',
        data: form,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            showBefore('Salvando dados, aguarde...', 5000);
        },
        success: function (response) {
            if (response['status'] == 'ok') {
                showSuccess('Usuário criado com sucesso!', '/admin/usuario');
            } else {
                showError(response['status']);
            }
        }
    });
}

$('body').on('click', '.edit_user', function (e) {
    e.preventDefault();

    let form = $('#formEditUser').serialize();

    var cpf = $('#u_cpf').val();
    let checkbox = [];
    $('input[type="checkbox"]:checked').each(function () {

        switch ($(this).attr('id')) {
            case 'cl_permissao_viewer': var permissao = 'viewer'; var value = 1; break;
            case 'cl_permissao_edit': var permissao = 'edit'; var value = 1; break;
            case 'cl_permissao_del': var permissao = 'del'; var value = 1; break;
            case 'cl_permissao_sup': var permissao = 'supervisor'; var value = 1; break;
        }

        checkbox.push({
            'permissao': permissao,
            'value': value
        });

    });

    var formData = new FormData();
    formData.append('edit', true);
    formData.append('form', form);

    if (!validarCPF(cpf)) {
        showError('Número de CPF inválido.');
    } else {
        if (checkbox.length > 0) {
            for (var i in checkbox) {
                formData.append('permissao[]', JSON.stringify(checkbox[i]));

            }
        }
        userEdit(formData);
    }
});

/**
 * 
 * @param {dados serializados do formulário} form 
 */

function userEdit(form) {

    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/editUser/edit.php',
        data: form,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            showBefore('Salvando dados, aguarde...', 5000);
        },
        success: function (response) {
            if (response['status'] == 'ok') {
                showSuccess('Os dados foram salvos com sucesso!', '/admin/usuario');
            } else {
                showError(response['status']);
            }
        }
    });
}

/**
 * 
 * @param {campo CPF para validação} cpf 
 * @returns bool
 */

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
