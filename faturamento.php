<?php
require('conexao.php');

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM financeiro';
$stm = $conexao->prepare($sql);
$stm->execute();
$items = $stm->fetchAll(PDO::FETCH_OBJ);

$sql = 'SELECT sum(valor_total) as total FROM vendas';
$stm = $conexao->prepare($sql);
$stm->execute();
$valorTOTAL = $stm->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Conveniencia 239</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <?php require('navbar.php') ?>
    <div class="d-flex flex-end" style="margin: 20px; justify-content: flex-end">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#CadastrarModal">Adicionar
            item</button>
        <?= $valorTOTAL['total'] ?>
    </div>

    <div class="card" style="margin: 20px;">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered second" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Descricao</th>
                            <th>Valor Total</th>
                            <th>Data Entrada</th>
                            <th>Data Saida</th>
                            <th>Data Pagamento</th>
                            <th>Forma de Pagamento</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>

                            <tr>
                                <td>
                                    <?= $item->tipo ?>
                                </td>
                                <td>
                                    <?= $item->descricao ?>
                                </td>
                                <td class="money">
                                    <?= $item->valor_total ?>
                                </td>
                                <td>
                                    <?= $item->data_entrada ?>
                                </td>
                                <td>
                                    <?= $item->data_saida ?>
                                </td>
                                <td>
                                    <?= $item->data_pagamento ?>
                                </td>
                                <td>
                                    <?= $item->tipo_pagamento ?>
                                </td>
                                <td>
                                    <?= $item->status ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="CadastrarModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar item</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form enctype="multipart/form-data" id="itemPost" method="post">


                                <div class="form-group">
                                    <label for="preco" class="col-form-label">Produto</label>
                                    <input id="nome" type="text" name="nome" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="col-form-label">Quantidade</label>
                                    <input id="quantity" type="text" name="quantity" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="cod_barra" class="col-form-label">Cod. Barra</label>
                                    <input id="cod_barra" type="text" name="cod_barra" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="valor_unitario" class="col-form-label">Valor</label>
                                    <input id="valor_unitario" type="text" name="valor_unitario" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="valor_fornecedor" class="col-form-label">Valor Fornecedor</label>
                                    <input id="valor_fornecedor" type="text" name="valor_fornecedor"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="data_validade" class="col-form-label">Data de Validade</label>
                                    <input id="data_validade" type="date" name="data_validade" class="form-control"
                                        required>
                                </div>

                                <input id="acao" type="hidden" name="acao" value="incluir" class="form-control">


                                <div class="form-group">
                                    <button type="text" class="btn btn-rounded btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-rounded btn-warning">Adicionar item</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>
<script>
    $(function (e) {
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

    $("#itemPost").submit(function () {

        var nome = document.getElementById('nome').value;
        var quantity = document.getElementById('quantity').value;
        var cod_barra = document.getElementById('cod_barra').value;
        var valor_unitario = document.getElementById('valor_unitario').value;
        var valor_fornecedor = document.getElementById('valor_fornecedor').value;
        var data_validade = document.getElementById('data_validade').value;
        var acao = document.getElementById('acao').value;

        $.ajax({
            type: 'post',
            url: 'action_estoque.php',
            data: new FormData($('#itemPost')[0]),
            success: function (data) {
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