<!DOCTYPE html>
<html>

<head>
    <title>PDV</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
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
                        <!-- <button class="btn btn-primary btn-lg btn-block" id="btnVender">Vender</button> -->
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
                        </select>
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
                    data: { total: total, produtosVendidos: produtosVendidos, formaPagamento: formaPagamento },
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

</html>