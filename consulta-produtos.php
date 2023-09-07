<?php
require('conexao.php');

$conexao = conexao::getInstance();
$query = $_POST['query'];

$sql = 'SELECT * FROM estoque WHERE nome LIKE :query';
$stm = $conexao->prepare($sql);
$stm->bindValue(':query', '%' . $query . '%');
$stm->execute();
$produtos = $stm->fetchAll(PDO::FETCH_OBJ);

echo json_encode($produtos);
?>
