<!DOCTYPE html>
<html>

<head>
    <title>Ponto de Venda</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <h1>Ponto de Venda</h1>
    <form id="productForm">
        <label for="cod_barra">Código de barras:</label>
        <input type="text" id="cod_barra" name="cod_barra">
        <input type="submit" value="Adicionar">
    </form>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody id="tableProduct">
        </tbody>
    </table>
    <p id="totalValue">Total: R$ 0.00</p>


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
                        if (data) {
                            var alreadyExists = false;
                            for (var i = 0; i < products.length; i++) {
                                if (products[i].cod_barra == cod_barra) {
                                    products[i].quantity++;
                                    alreadyExists = true;
                                    break; // sair do loop se encontrar o produto
                                }
                            }
                            if (!alreadyExists) {
                                data.quantity = 1;
                                products.push(data);
                            }
                            var row = "<tr><td>" + data.nome + "</td><td>" + (data.quantity || 1) + "</td><td>R$ " + data.valor_unitario + "</td><td>R$ " + ((data.quantity || 1) * data.valor_unitario) + "</td></tr>";
                            $("#tableProduct").append(row);
                            totalValue += data.valor_unitario;
                            $("#totalValue").html("Total: R$ " + totalValue);
                        }
                        $("#cod_barra").val("");
                        $("#cod_barra").focus();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Erro na solicitação AJAX: " + textStatus, errorThrown);
                    }
                });
            });
        });

    </script>
</body>

</html>