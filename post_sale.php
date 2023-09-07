<?php
// Receba os dados da solicitação POST
$products = $_POST['products'];

// Processe a venda
// ...

// Envie a resposta em formato JSON
$response = array("success" => true);
echo json_encode($response);
?>
