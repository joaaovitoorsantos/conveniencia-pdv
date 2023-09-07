<?php
require 'conexao.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Painel | Conveniencia</title>
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/libs/css/style.css">
	<link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
	<link rel="stylesheet" href="assets/vendor/inputmask/css/inputmask.css" />
</head>

<body>
	<div class='container box-mensagem-crud'>
		<?php
		$conexao = conexao::getInstance();

		$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id    = (isset($_POST['id'])) ? $_POST['id'] : '';

		$item  = (isset($_POST['item'])) ? $_POST['item'] : '';
		$descricao  = (isset($_POST['descricao'])) ? $_POST['descricao'] : '';
		$quantidade  = (isset($_POST['quantidade'])) ? $_POST['quantidade'] : '';
		$pagamento  = (isset($_POST['pagamento'])) ? $_POST['pagamento'] : '';
		$cod_barra  = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';
		$valor  = (isset($_POST['valor'])) ? $_POST['valor'] : '';
		$valor_fornecedor  = (isset($_POST['valor_fornecedor'])) ? $_POST['valor_fornecedor'] : '';

		$acao1  = (isset($_GET['acao1'])) ? $_GET['acao1'] : '';
		$id1   = (isset($_GET['id1'])) ? $_GET['id1'] : '';

		$mensagem = '';
		if ($acao == 'editar' && $id == '') :
			$mensagem .= '<li>ID do registros desconhecido.</li>';
		endif;

		if ($acao == 'incluir') :

			date_default_timezone_set('America/Sao_Paulo');
			$data_venda = date('Y-m-d H:i:s');
			$valor_total = $quantidade * $valor;

			$sql = 'INSERT INTO vendas (item,pagamento,descricao,quantidade,valor,valor_total,data_venda)
							   VALUES(:item,:pagamento,:descricao,:quantidade,:valor,:valor_total,:data_venda)';



			$stm = $conexao->prepare($sql);
			$stm->bindValue(':item', $item);
			$stm->bindValue(':descricao', $descricao);
			$stm->bindValue(':pagamento', $pagamento);
			$stm->bindValue(':quantidade', $quantidade);
			$stm->bindValue(':valor', $valor);
			$stm->bindValue(':valor_total', $valor_total);
			$stm->bindValue(':data_venda', $data_venda);

			$retorno = $stm->execute();

			$sql = 'UPDATE estoque SET quantidade = quantidade - :quantidade WHERE id=:id';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id);
			$stm->bindValue(':quantidade', $quantidade);
			$retorno = $stm->execute();

			if ($retorno) :
				echo "<script>alert ('Registro inserido com sucesso!!');</script>";
			else :
				echo "<script>alert ('Erro ao inserir registro!!');</script>";
			endif;
			echo "<script>window.location.replace('estoque.php');</script>";
		endif;


		if ($acao == 'editar') :
			$sql = 'UPDATE estoque SET item=:item,descricao=:descricao,quantidade=:quantidade,cod_barra=:cod_barra,valor=:valor,valor_fornecedor=:valor_fornecedor WHERE id=:id';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':item', $item);
			$stm->bindValue(':descricao', $descricao);
			$stm->bindValue(':quantidade', $quantidade);
			$stm->bindValue(':cod_barra', $cod_barra);
			$stm->bindValue(':valor', $valor);
			$stm->bindValue(':valor_fornecedor', $valor_fornecedor);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();



			if ($retorno) :
				echo "<script>Swal.fire('Registro editado com sucesso!','Clique no botão abaixo','success');</script>";
			else :
				echo "<script>alert ('Erro ao editar registro!!');</script>";
			endif;
			echo "<script>window.location.replace('estoque.php');</script>";
		endif;


		if ($acao1 == 'excluir') :
			$sql = 'DELETE FROM estoque WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id1);
			$retorno = $stm->execute();

			if ($retorno) :
				echo "<script>Swal.fire('Good job!','You clicked the button!','success');</script>";
			else :
				echo "<script>alert ('Erro ao excluir registro!!');</script>";
			endif;
			echo "<script>window.location.replace('estoque.php');</script>";

		endif;
		?>

	</div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>