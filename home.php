<?php
require('conexao.php');

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM estoque';
$stm = $conexao->prepare($sql);
$stm->execute();
$items = $stm->fetchAll(PDO::FETCH_OBJ);

// Nova consulta para obter a lista de clientes
$sqlClientes = 'SELECT * FROM convenio';
$stmClientes = $conexao->prepare($sqlClientes);
$stmClientes->execute();
$clientes = $stmClientes->fetchAll(PDO::FETCH_OBJ);

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <?php require('navbar.php') ?>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>PDV</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <form id="productForm">
          <div class="form-group">
            <label for="cod_barra">Código / Produto</label>
            <input type="text" class="form-control" name="cod_barra" id="cod_barra">
          </div>
          <button type="submit" class="btn btn-primary adicionar">Adicionar</button>
        </form>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5>Sub-total: <span id="totalValue">0.00</span></h5>
            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal"
              data-target="#modalPagamento">
              Vender
            </button>
            <button class="btn btn-danger btn-lg btn-block" id="btnCancel">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalPagamento" tabindex="-1" role="dialog" aria-labelledby="modalPagamentoLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPagamentoLabel">Escolha a forma de pagamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <select class="form-control" id="formaPagamento">
              <option value="dinheiro">Dinheiro</option>
              <option value="cartao">Cartão</option>
              <option value="pix">PIX</option>
              <option value="fiado">Fiado</option>
            </select>

            <div id="cliente-select">
              <label for="cliente">Cliente:</label>
              <select class="form-control" id="cliente" name="cliente">
                <?php foreach ($clientes as $cliente): ?>
                  <option value="<?php echo $cliente->id ?>"><?php echo $cliente->nome ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnFinalizarVenda">Finalizar Venda</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Produto</th>
              <th>Quantidade</th>
              <th>Valor Unitário</th>
              <th>Valor Total</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="tableProduct">
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script>


    $(document).ready(function () {

      // esconde o campo de seleção de cliente inicialmente
      $("#cliente-select").hide();

      // verifica quando o campo de seleção de pagamento é alterado
      $("#formaPagamento").change(function () {
        if ($(this).val() == "fiado") {
          // exibe o campo de seleção de cliente
          $("#cliente-select").show();
        } else {
          // oculta o campo de seleção de cliente
          $("#cliente-select").hide();
        }
      });

      var products = [];
      var totalValue = 0;

      $("#productForm").submit(function (event) {
        event.preventDefault();
        var cod_barra = $("#cod_barra").val();
        $.ajax({
          url: "get_product.php",
          method: "GET",
          data: { cod_barra: cod_barra },
          dataType: "json",
          success: function (data) {
            if (data) { // Adiciona a verificação diretamente em data
              var alreadyExists = false;
              for (var i = 0; i < products.length; i++) {
                if (products[i].cod_barra == data.cod_barra) {
                  products[i].quantity++;
                  alreadyExists = true;
                  break; // sair do loop se encontrar o produto
                }
              }
              if (!alreadyExists) {
                data.quantity = 1;
                products.push(data);
              }
              var row;
              if (alreadyExists) {
                row = $("#tableProduct tr[data-cod='" + data.cod_barra + "']");
                row.find(".product-quantity").text(products[i].quantity);
                row.find(".product-total").text("R$ " + (products[i].quantity * data.valor_unitario).toFixed(2));
              } else {
                row = $("<tr data-cod='" + data.cod_barra + "'><td>" + data.nome + "</td><td class='product-quantity'>" + (data.quantity || 1) + "</td><td>R$ " + parseFloat(data.valor_unitario).toFixed(2) + "</td><td class='product-total'>R$ " + ((data.quantity || 1) * data.valor_unitario).toFixed(2) + "</td><td><button class='btn btn-sm btn-secondary increaseProductButton' data-cod-barra='" + data.cod_barra + "'>+</button></td><td><button class='btn btn-sm btn-secondary decreaseProductButton' data-cod-barra='" + data.cod_barra + "'>-</button></td><td><button class='removeProductButton btn btn-sm btn-danger' data-cod-barra='" + data.cod_barra + "'>Remover</button></td></tr>");


                $("#tableProduct").append(row);
              }
              totalValue += parseFloat(data.valor_unitario);
              $("#totalValue").html("R$ " + totalValue.toFixed(2));


            }
            $("#cod_barra").val("");
            $("#cod_barra").focus();
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log("Erro na solicitação AJAX: " + textStatus, errorThrown);
          }
        });
      });

      // Aumentar quantidade do produto
      $("#tableProduct").on("click", ".increaseProductButton", function () {
        var cod_barra = $(this).data("cod-barra");
        for (var i = 0; i < products.length; i++) {
          if (products[i].cod_barra == cod_barra) {
            products[i].quantity++;
            var row = $(this).closest("tr");
            row.find(".product-quantity").text(products[i].quantity);
            row.find(".product-total").text("R$ " + (products[i].quantity * products[i].valor_unitario).toFixed(2));
            totalValue += parseFloat(products[i].valor_unitario);
            $("#totalValue").html("R$ " + totalValue.toFixed(2));
            break;
          }
        }
      });

      // Diminuir quantidade do produto
      $("#tableProduct").on("click", ".decreaseProductButton", function () {
        var cod_barra = $(this).data("cod-barra");
        for (var i = 0; i < products.length; i++) {
          if (products[i].cod_barra == cod_barra) {
            if (products[i].quantity > 1) {
              products[i].quantity--;
              var row = $(this).closest("tr");
              row.find(".product-quantity").text(products[i].quantity);
              row.find(".product-total").text("R$ " + (products[i].quantity * products[i].valor_unitario).toFixed(2));
              totalValue -= parseFloat(products[i].valor_unitario);
              $("#totalValue").html("R$ " + totalValue.toFixed(2));
            }
            break;
          }
        }
      });

      $("#tableProduct").on("click", ".removeProductButton", function () {
        var cod_barra = $(this).data("cod-barra");
        for (var i = 0; i < products.length; i++) {
          if (products[i].cod_barra == cod_barra) {
            console.log('valor_unitario:', products[i].valor_unitario);
            console.log('quantity:', products[i].quantity);
            totalValue -= products[i].valor_unitario * products[i].quantity;
            console.log('totalValue:', totalValue);
            products.splice(i, 1);
            break;
          }
        }
        $(this).closest("tr").remove();
        $("#totalValue").html("R$ " + totalValue.toFixed(2));
      });




      // Quando o botão "Finalizar Venda" do modal for clicado
      $("#btnFinalizarVenda").click(function () {

        if (products.length == 0) {
          alert("Não há itens no carrinho. Adicione pelo menos um produto para concluir a venda.");
          return;
        }
        // Obtenha a forma de pagamento selecionada
        var formaPagamento = $("#formaPagamento").val();

        // Obter o valor do cliente selecionado
        var cliente_id = $('#cliente').val();

        // Obtenha os dados da venda
        var total = totalValue.toFixed(2);
        var produtosVendidos = "";
        for (var i = 0; i < products.length; i++) {
          produtosVendidos += products[i].nome + ":" + products[i].quantity + ":" + products[i].valor_unitario + ";";
        }

        // Envie os dados da venda e a forma de pagamento para o PHP
        $.ajax({
          url: "finalizar_venda.php",
          method: "POST",
          data: { total: total, produtosVendidos: produtosVendidos, formaPagamento: formaPagamento, cliente_id: cliente_id },
          dataType: "json",
          success: function (data) {
            if (data.status == "success") {
              alert("Venda finalizada com sucesso!");
              window.location.reload();
            } else {
              alert("Erro ao finalizar venda: " + data.message);
            }
          },
          error: function () {
            alert("Erro ao finalizar venda.");
          }
        });

        // Feche o modal
        $("#modalPagamento").modal("hide");
      });






      $("#btnCancel").click(function () {
        window.location.reload();
      });

    });

  </script>
</body>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>

</html>