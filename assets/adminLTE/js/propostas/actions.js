
$('body').on('click', '.cadastrar-proposta', function (e) {
    e.preventDefault();

    var form = $('#formPropostas').serialize();

    if ($('#cliente').val() == '') {
        showError('Informe o nome do cliente.');
    } else if ($('#valor').val() == '') {
        showError('Informe o valor da proposta.');
    } else if ($('input[name="produto[]"]:checked').length == 0) {
        showError('Selecione algum item para a proposta.');
    } else {
        create(form);
    }
});

function create(form) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/propostas/actions.php',
        data: { create: true, form: form },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Criando proposta, aguarde...', 20000);
        },
        success: function (response) {

            var binary = atob(response.replace(/\s/g, ''));
            var len = binary.length;
            var buffer = new ArrayBuffer(len);
            var view = new Uint8Array(buffer);
            for (var i = 0; i < len; i++) {
                view[i] = binary.charCodeAt(i);
            }

            // create the blob object with content-type "application/pdf"               
            var blob = new Blob([view], { type: "application/pdf" });
            var url = URL.createObjectURL(blob);

            setTimeout(() => {
                Swal.fire({
                    title: 'Proposta criada com sucesso!',
                    icon: 'success',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Visualizar agora.',
                    denyButtonText: 'Baixar PDF'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(url, '_blank');
                    } else if (result.isDenied) {
                        saveFile('Proposta comercial.pdf', 'application/pdf', view);
                    }
                });
            }, 5000);
        }
    });
}

$('body').on('click', '.view-proposta', function (e) {
    e.preventDefault();

    var propostaid = $(this).attr('data-propostaid');

    viewPDF(propostaid, 'view');

});

$('body').on('click', '.download-proposta', function (e) {
    e.preventDefault();

    var propostaid = $(this).attr('data-propostaid');

    viewPDF(propostaid, 'download');

});

function viewPDF(propostaid, trigger) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/propostas/actions.php',
        data: { view: true, propostaid: propostaid },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Abrindo proposta, aguarde...', 20000);
        },
        success: function (response) {

            var binary = atob(response.base64.replace(/\s/g, ''));
            var len = binary.length;
            var buffer = new ArrayBuffer(len);
            var view = new Uint8Array(buffer);
            for (var i = 0; i < len; i++) {
                view[i] = binary.charCodeAt(i);
            }

            // create the blob object with content-type "application/pdf"               
            var blob = new Blob([view], { type: "application/pdf" });
            var url = URL.createObjectURL(blob);
            Swal.close();
            if (trigger == 'view') {
                var a = $("<a style='display: none;'/>");
                a.attr("href", url);
                a.attr("target", '_blank');
                $("body").append(a);
                a[0].click();
                a.remove();
                // window.open(url, '_blank', response.arquivo_name);
            }

            if (trigger == 'download') {
                saveFile(response.arquivo_name, 'application/pdf', view);
            }
        }
    });
}

function saveFile(name, type, data) {
    if (data !== null && navigator.msSaveBlob)
        return navigator.msSaveBlob(new Blob([data], { type: type }), name);
    
    var url = window.URL.createObjectURL(new Blob([data], { type: type }));
    var a = $("<a style='display: none;'/>");
    a.attr("href", url);
    a.attr("download", name);
    $("body").append(a);
    a[0].click();
    window.URL.revokeObjectURL(url);
    a.remove();
}

$('body').on('click', '.send-proposta', function (e) {
    e.preventDefault();

    var propostaid = $(this).attr('data-propostaid');

    Swal.fire({
        title: 'Informe o e-mail de destino!',
        icon: 'warning',
        html: '<input type="email" id="emailProposta" class="form-control">',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Enviar proposta.'
    }).then((result) => {
        if (result.isConfirmed) {
            var email = $("#emailProposta").val();
            sendEmailProposta(propostaid, email);
        }
    });

});

function sendEmailProposta(propostaid, email) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/propostas/actions.php',
        data: { sendProposta: true, propostaid: propostaid, email: email },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Enviando proposta, aguarde...', 20000);
        },
        success: function (response) {

            if (response == 'ok') {
                showSuccess('A proposta foi encaminhada.', '/admin/propostas');
            } else {
                showError(response);
            }

        }
    });
}

$('body').on('click', '.del-proposta', function (e) {
    e.preventDefault();

    var propostaid = $(this).attr('data-propostaid');

    Swal.fire({
        title: 'Atenção!',
        text: 'Todos os dados serão perdidos. Deseja continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir proposta.'
    }).then((result) => {
        if (result.isConfirmed) {
            delProposta(propostaid);
        }
    });
});

function delProposta(propostaid) {
    $.ajax({
        type: 'POST',
        url: '/app/application/trigger/propostas/actions.php',
        data: { delete: true, propostaid: propostaid },
        dataType: 'json',
        beforeSend: function () {
            showBefore('Deletando proposta, aguarde...', 20000);
        },
        success: function (response) {
            if (response.status == 'ok') {
                showSuccess('Proposta deletada com sucesso.', '/admin/propostas');
            }
        }
    });
}