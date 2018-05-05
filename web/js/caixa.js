$(document).ready(function () {

    var total = 0;
    $('#btn-add').click(function () {

        var dados = {
            codigo: $('#codigo').val()
        };

        $.post('/caixa/add', dados, function (success) {

            if (success.id === undefined) {

                alert('Produto não encontrado');

            } else {

                var li = '<li>' + success.nome + ' -- R$ ' + success.preco + ' </li>';
                $('#lista-produtos').append(li);

                total += parseFloat(success.preco);

                $('#total').html(total);
            }
        });//fim do post
    });//fim do click

    $('#btn-finalizar').click(function () {

        var dados = {
            itens: $('#lista-produtos').text(),
            total: total
        };

        $.post('/caixa/finalizar', dados, function (success) {

            if (success === 'ok') {
                alert('cadastrado com sucesso');
            } else {
                alert('ocorreu um erro');
            }

        });
    });
});