<?php
require('conexao.php');

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM vendas order by data desc';
$stm = $conexao->prepare($sql);
$stm->execute();
$items = $stm->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Conveniencia 239</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php require('navbar.php') ?>
    <div class="card" style="margin: 20px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Venda</th>
                            <th>Quantidade de produtos</th>
                            <th>Tipo de Pagamento</th>
                            <th>Valor Total</th>
                            <th>Data</th>
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><?= $item->produtos_vendidos ?></td>
                                <td><?= $item->forma_pagamento ?></td>
                                <?php $data = date(('d/m/Y H:i:s'), strtotime($item->data)) ?>
                                <td class="money"><?= $item->valor_total ?></td>
                                <td><?= $data ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>

</body>
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    $(function(e) {
        "use strict";

        $(".money").inputmask('currency', {
            autoUnmask: true,
            radixPoint: ",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            unmaskAsNumber: true,
            rightAlign: false
        });


    });

    $("#itemPost").submit(function() {

        var item = document.getElementById('item').value;
        var descricao = document.getElementById('descricao').value;
        var quantidade = document.getElementById('quantidade').value;
        var cod_barra = document.getElementById('cod_barra').value;
        var valor = document.getElementById('valor').value;
        var valor_fornecedor = document.getElementById('valor_fornecedor').value;
        var acao = document.getElementById('acao').value;
        $.ajax({
            type: 'post',
            url: 'action_estoque.php',
            data: new FormData($('#itemPost')[0]),
            success: function(data) {
                Swal.fire('O item foi adicionado com sucesso!', '', 'success').then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

            },
            cache: false,
            contentType: false,
            processData: false

        });
        return false;
    });
</script>

</html>