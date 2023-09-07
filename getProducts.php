<?php

require('conexao.php');

parse_str($_SERVER['QUERY_STRING'], $params);

$conexao = conexao::getInstance();
$sql = 'SELECT * FROM estoque where cod_barra=:cod_barra';
$stm = $conexao->prepare($sql);
$stm->bindValue(':cod_barra', $params['cod_barra']);
$stm->execute();
$items = $stm->fetchAll(PDO::FETCH_OBJ);

header('Content-type: application/json');
$array = json_encode($items);

if (count($items) > 0) {
    echo json_encode($items[0]);
} else {
    echo json_encode("produto nao encontrado");
}
?>