$(function () {

    $("#u_cep").blur(function () {


        var cep = $(this).val().replace(/\D/g, '');

        if (cep != "") {

            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {

                $("#u_rua").val("...");
                $("#u_bairro").val("...");
                $("#u_cidade").val("...");
                $("#u_estado").val("...");


                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {

                        $("#u_rua").val(dados.logradouro);
                        $("#u_bairro").val(dados.bairro);
                        $("#u_cidade").val(dados.localidade);
                        $("#u_estado").val(dados.uf);

                    } else {

                        limpa_formulário_cep();
                        $("#u_cep").parent().next('small').html('Cep não encontrado.').removeClass('hide');
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
        $("#u_cep").val("");
        $("#u_rua").val("");
        $("#u_bairro").val("");
        $("#u_cidade").val("");
        $("#u_estado").val("");
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

    /**
     * função de formatação das mascaras dos inputs
     */
    maskUsers();
    function maskUsers() {
        $('#u_cep').mask('00000-000');
        $('#u_cpf').mask('000.000.000-00');
        $('#u_telefone').mask('(00) 0000-0000');
        $('#u_celular').mask('(00) 0 0000-0000');

        $('#valor').mask('#.##0,00', {reverse: true});

        
    }

    /**
     * configurações da tabela na pagina configurações
     */
    $("#tableConfiguracoes").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "info": false,
        "lengthChange": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "language": {
            "search": "Buscar:",
            "zeroRecords": "Nenhum dado à exibir!",
            "paginate": {
                "first": "Início",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "emptyTable": "Nenhum dado à exibir!",
        }

    });

    /**
     * configurações para a tabela na pagina usuarios
     */
    $("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "info": false,
        "lengthChange": false,
        "language": {
            "search": "Buscar:",
            "zeroRecords": "Nenhum dado à exibir!",
            "paginate": {
                "first": "Início",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "emptyTable": "Nenhum dado à exibir!",
        }

    });

    /**
     * configurações para a tabela na pagina produtos
     */
    $("#tableProdutos").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "info": false,
        "lengthChange": false,
        "language": {
            "search": "Buscar:",
            "zeroRecords": "Nenhum dado à exibir!",
            "paginate": {
                "first": "Início",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            },
            "emptyTable": "Nenhum dado à exibir!"
        },
        columnDefs: [
            { width: 200, targets: 1 }
        ],


    });

    /**
     * configurações para a tabela de horários semanais
     */
    $("#tableHour").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "info": false,
        "lengthChange": false,
        "searching": false,
        "paginate": false,
        "order": false,
        "bSort": false
    });

});

// $('.select2bs4').select2({
//     theme: 'bootstrap4'
// })
/**
 * 
 * @param {titulo do response} title 
 * @param {url de redirecionamento após confirmar} url 
 */
function showSuccess(title, url) {
    Swal.fire({
        title: title,
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = url;
        }
    });
}

/**
 * 
 * @param {titulo do response à exibir na janela} title 
 * @param {tempo em milisegundos para exibição da janela} timer 
 */
function showBefore(title, timer) {
    Swal.fire({
        title: title,
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false
    });
}

/**
 * 
 * @param {titulo para janela de error} title 
 */
function showError(title) {
    Swal.fire({
        title: title,
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Tentar novamente.'
    });
}