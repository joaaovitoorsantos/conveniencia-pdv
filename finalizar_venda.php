<?php
//Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conveniencia";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Recuperar os dados da venda enviados pelo Ajax
$total = $_POST["total"];
$produtosVendidos = $_POST["produtosVendidos"];
$formaPagamento = $_POST["formaPagamento"];
$cliente_id = $_POST["cliente_id"];


if ($formaPagamento == "fiado") {
    // Adicionar a venda fiado na tabela "vendas_fiado"
    $sql = "INSERT INTO vendas_fiado (cliente_id, produtos_vendidos, valor_total) VALUES ('$cliente_id', '$produtosVendidos', '$total')";
    if ($conn->query($sql) === TRUE) {
        $status = "success";
        $message = "Venda fiado registrada com sucesso!";

        // Atualizar o campo "total_devido" na tabela "convenio"
        $sql = "UPDATE convenio SET total_devido = total_devido + $total WHERE id = $cliente_id";
        if ($conn->query($sql) !== TRUE) {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
            echo json_encode(array("status" => "error", "message" => $error_message));
            die();
        }

        // Atualizar o estoque
        $produtos = explode(";", $produtosVendidos);
        foreach ($produtos as $produto) {
            $dados_produto = explode(":", $produto);
            if (count($dados_produto) > 2) { // verificar se existem dados suficientes para o produto
                $nome_produto = $dados_produto[0];
                $quantidade_produto = $dados_produto[1];

                $sql = "UPDATE estoque SET quantity = quantity - $quantidade_produto WHERE nome = '$nome_produto'";
                if ($conn->query($sql) !== TRUE) {
                    $error_message = "Error: " . $sql . "<br>" . $conn->error;
                    echo json_encode(array("status" => "error", "message" => $error_message));
                    die();
                }
            }
        }
    } else {
        $status = "error";
        $message = "Erro ao registrar venda fiado: " . $conn->error;
    }
} else {
    //Inserir a venda na tabela "vendas"
    $sql = "INSERT INTO vendas (data, valor_total, produtos_vendidos,forma_pagamento) VALUES (NOW(), '$total', '$produtosVendidos','$formaPagamento')";
    if ($conn->query($sql) === TRUE) {
        $id_venda = $conn->insert_id; //Obter o ID da venda recém-inserida
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
        echo json_encode(array("status" => "error", "message" => $error_message));
        die();
    }

    //Inserir cada item vendido na tabela "itens_vendidos"
    $produtos = explode(";", $produtosVendidos);
    foreach ($produtos as $produto) {
        $dados_produto = explode(":", $produto);
        if (count($dados_produto) > 2) { // verificar se existem dados suficientes para o produto
            $nome_produto = $dados_produto[0];
            $quantidade_produto = $dados_produto[1];
            $valor_unitario_produto = $dados_produto[2];
            $valor_total_produto = $quantidade_produto * $valor_unitario_produto;
            $sql = "INSERT INTO itens_vendidos (id_venda, nome_produto, quantidade_produto, valor_unitario_produto, valor_total_produto) VALUES ('$id_venda', '$nome_produto', '$quantidade_produto', '$valor_unitario_produto', '$valor_total_produto')";
            if ($conn->query($sql) !== TRUE) {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
                echo json_encode(array("status" => "error", "message" => $error_message));
                die();
            }

            // Atualizar a quantidade no estoque
            $sql = "UPDATE estoque SET quantity = quantity - $quantidade_produto WHERE nome = '$nome_produto'";
            if ($conn->query($sql) !== TRUE) {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
                echo json_encode(array("status" => "error", "message" => $error_message));
                die();
            }
        }


    }
}

echo json_encode(array("status" => "success"));
$conn->close();
?>