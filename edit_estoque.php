<?php
require('conexao.php');

$id  = (isset($_GET['id'])) ? $_GET['id'] : '';

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM estoque where id = :id';
$stm = $conexao->prepare($sql);
$stm->bindValue(':id', $id);
$stm->execute();
$item = $stm->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Conveniencia 239</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php require('navbar.php') ?>
    <div class="d-flex flex-end" style="margin: 20px; justify-content: flex-end">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#CadastrarModal">Adicionar item</button>
    </div>
    <div class="card" style="margin: 20px;">
        <div class="card-body">
            <form enctype="multipart/form-data" action="action_estoque.php" method="post">
                <div class="form-group">
                    <label for="" class="col-form-label">Produto</label>
                    <input type="text" class="form-control" name="nome" value=<?= $item->nome ?>>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Quantidade</label>
                    <input type="text" class="form-control" name="quantidade" value=<?= $item->quantity ?>>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Código de barras</label>
                    <input type="text" class="form-control" name="cod_barra" value=<?= $item->cod_barra ?>>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Valor Fornecedor</label>
                    <input type="text" class="form-control" name="valor_fornecedor" value=<?= $item->valor_fornecedor ?>>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Valor</label>
                    <input type="text" class="form-control" name="valor" value=<?= $item->valor_unitario ?>>
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Data de Validade</label>
                    <input type="date" class="form-control" name="data_validade" value=<?= $item->data_validade ?>>
                </div>

                <input id="inputText3" type="hidden" name="id" value="<?= $item->id ?>" class="form-control">
                <input id="inputText3" type="hidden" name="acao" value="editar" class="form-control">

                <div class="form-group" style="margin-top: 16px">
                    <button type="submit" class="btn btn-rounded btn-primary">Editar</button>
                    <a href="estoque.php" class="btn btn-rounded btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>