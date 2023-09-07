<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os dados do formulário
    $cod_barra = $_POST["cod_barra"];
    $quantity = $_POST["quantity"];

    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "conveniencia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi bem sucedida
    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Obtém a quantidade atual do produto no estoque
    $sql = "SELECT quantity, nome FROM estoque WHERE cod_barra = '$cod_barra'";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity_atual = $row["quantity"];
        $nome_produto = $row["nome"];

        // Atualiza a quantity do produto no estoque
        $nova_quantity = $quantity_atual + $quantity;
        $sql = "UPDATE estoque SET quantity = '$nova_quantity' WHERE cod_barra = '$cod_barra'";

        if ($conn->query($sql) === TRUE) {
            echo "Entrada de estoque registrada com sucesso!";

            $data_hora = date("Y-m-d H:i:s");
            $sql = "INSERT INTO entrada_estoque (cod_barra, quantity, data_hora, nome) VALUES ('$cod_barra', '$quantity', '$data_hora', '$nome_produto')";
            if ($conn->query($sql) === TRUE) {
                echo "Registro de entrada de estoque adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar registro de entrada de estoque: " . $conn->error;
            }
        } else {
            echo "Erro ao registrar entrada de estoque: " . $conn->error;
        }
    } else {
        echo "Produto não encontrado no estoque.";
    }

    $conn->close();
}

require('conexao.php');

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM entrada_estoque';
$stm = $conexao->prepare($sql);
$stm->execute();
$items = $stm->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Adicionar entrada de estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <?php require("navbar.php") ?>
    <div class="card" style="margin: 20px; padding: 10px;">
        <h1>Adicionar entrada de estoque</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="cod_barra" class="form-label">Código de barras:</label>
                <input type="text" class="form-control" id="cod_barra" name="cod_barra" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar entrada de estoque</button>
        </form>
    </div>


    <div class="card" style="margin: 20px;">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered second" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Cod. Barra</th>
                            <th>Valor Fornecedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>

                            <tr>
                                <td>
                                    <?= $item->nome ?>
                                </td>
                                <td>
                                    <?= $item->quantity ?>
                                </td>
                                <td>
                                    <?= $item->cod_barra ?>
                                </td>
                                <?php
                                date_default_timezone_set('America/Sao_Paulo');
                                $data = date(('d/m/Y'), strtotime($item->data_hora))
                                    ?>
                                <td>
                                    <?= $data ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>