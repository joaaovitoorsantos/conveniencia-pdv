<?php
require('conexao.php');

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM convenio';
$stm = $conexao->prepare($sql);
$stm->execute();
$items = $stm->fetchAll(PDO::FETCH_OBJ);

$sql = 'SELECT sum(total_devido) as total FROM convenio';
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

    <div class="modal fade" id="modalVendas" tabindex="-1" aria-labelledby="modalVendasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVendasLabel">Vendas do cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- as vendas do cliente serão exibidas aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card" style="margin: 20px;">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered second" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>CPF</th>
                            <th>Endereco</th>
                            <th>Telefone</th>
                            <th>Total Devido</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>

                            <tr>
                                <td>
                                    <?= $item->nome ?>
                                </td>
                                <td>
                                    <?= $item->cpf ?>
                                </td>
                                <td>
                                    <?= $item->endereco ?>
                                </td>
                                <td>
                                    <?= $item->telefone ?>
                                </td>
                                <td class="money">
                                    <?= $item->total_devido ?>
                                </td>

                                <td style="width: 10%;">
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 3px;">
                                        <a href="action_estoque.php?id1=<?= $item->id ?>&acao1=excluir"
                                            onclick="return Swal.fire('Despesa deletada com sucesso!','Clique no botão abaixo','success')"
                                            class="btn btn-rounded btn-danger btn-xs" data-toggle="tooltip"
                                            title="Excluir"><i class="fa-regular fa-trash-can"></i></a>
                                        <a href="edit_estoque.php?id=<?= $item->id ?>"
                                            class="editar btn btn-rounded btn-warning btn-xs" data-toggle="tooltip"
                                            title="Editar"><i class="fa-regular fa-pen-to-square"></i></i></a>

                                        <button class="btn btn-primary verVendas" data-bs-toggle="modal"
                                            data-bs-target="#modalVendas" data-bs-id="<?= $item->id ?>"><i
                                                class="fa-solid fa-eye"></i></button>


                                    </div>
                                </td>
                            </tr>

                            <script>
                                document.querySelectorAll('.verVendas').forEach(button => {
                                    button.addEventListener('click', async () => {
                                        const { bsId: clientId } = button.dataset;
                                        const response = await fetch(`get_vendas.php?id=${clientId}`);
                                        const vendas = await response.json();
                                        const modalBody = document.querySelector('#modalBody');
                                        modalBody.innerHTML = `
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Produtos</th>
                            <th>Valor</th>
                            <th>Data da Venda</th>
                          </tr>
                        </thead>
                        <tbody>
                          ${vendas.map(venda => `
                            <tr>
                              <td>${venda.produtos_vendidos}</td>
                              <td class="money">${venda.valor_total}</td>
                              <td>${venda.data_venda}
                            </tr>
                          `).join('')}
                        </tbody>
                      </table>
                    `;
                                    });
                                });

                            </script>
                        <?php endforeach; ?>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>
                                <span class="money">
                                    <?= $valorTOTAL['total'] ?>
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
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

</script>

</html>