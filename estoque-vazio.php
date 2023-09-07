<?php
require('conexao.php');

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM estoque';
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
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Cod. Barra</th>
                            <!-- <th>Valor Fornecedor</th>
                            <th>Valor</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item) : ?>
                            <?php if ($item->quantity < 3) : ?>
                                <tr>
                                    <td><?= $item->nome ?></td>
                                    <td><?= $item->quantity ?> <span class="badge text-bg-danger">Pouco estoque</span></td>
                                    <td><?= $item->cod_barra ?></td>
                                    <!-- <td class="money"><?= $item->valor_fornecedor ?></td>
                                    <td class="money"><?= $item->valor ?></td> -->
                                    <!-- <td style="width: 10%;">
                                        <a href="action_estoque.php?id1=<?= $item->id ?>&acao1=excluir" onclick="return Swal.fire('Despesa deletada com sucesso!','Clique no botão abaixo','success')" class="btn btn-rounded btn-danger btn-xs" data-toggle="tooltip" title="Excluir">Excluir</a>
                                        <a href="edit_estoque.php?id=<?= $item->id ?>" class="editar btn btn-rounded btn-warning btn-xs" data-toggle="tooltip" title="Editar">Editar</i></a>
                                    </td> -->
                                </tr>
                           
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

</script>

</html>