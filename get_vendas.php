<?php
require('conexao.php');

$conexao = conexao::getInstance();
$clientId = $_GET['id'];
$sql = "SELECT * FROM vendas_fiado WHERE cliente_id = $clientId";
$stm = $conexao->prepare($sql);
$stm->execute();
$vendas = $stm->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($vendas);
