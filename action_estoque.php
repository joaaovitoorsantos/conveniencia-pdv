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

		$acao = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id = (isset($_POST['id'])) ? $_POST['id'] : '';

		$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
		$quantity = (isset($_POST['quantity'])) ? $_POST['quantity'] : '';
		$cod_barra = (isset($_POST['cod_barra'])) ? $_POST['cod_barra'] : '';
		$valor_unitario = (isset($_POST['valor_unitario'])) ? $_POST['valor_unitario'] : '';
		$valor_fornecedor = (isset($_POST['valor_fornecedor'])) ? $_POST['valor_fornecedor'] : '';
		$data_validade = (isset($_POST['data_validade'])) ? $_POST['data_validade'] : '';

		$acao1 = (isset($_GET['acao1'])) ? $_GET['acao1'] : '';
		$id1 = (isset($_GET['id1'])) ? $_GET['id1'] : '';

		$mensagem = '';
		if ($acao == 'editar' && $id == ''):
			$mensagem .= '<li>ID do registros desconhecido.</li>';
		endif;

		if ($acao == 'incluir'):




			if (!empty($data_validade)) {
				$sql = 'INSERT INTO estoque (nome,quantity,cod_barra,valor_unitario,valor_fornecedor,data_validade)
							   VALUES(:nome,:quantity,:cod_barra,:valor_unitario,:valor_fornecedor,:data_validade)';

				$stm = $conexao->prepare($sql);
				$stm->bindValue(':nome', $nome);
				$stm->bindValue(':quantity', $quantity);
				$stm->bindValue(':cod_barra', $cod_barra);
				$stm->bindValue(':valor_unitario', $valor_unitario);
				$stm->bindValue(':valor_fornecedor', $valor_fornecedor);
				$stm->bindValue(':data_validade', $data_validade);

				$retorno = $stm->execute();
			} else {
				$sql = 'INSERT INTO estoque (nome,quantity,cod_barra,valor_unitario,valor_fornecedor)
				VALUES(:nome,:quantity,:cod_barra,:valor_unitario,:valor_fornecedor)';

				$stm = $conexao->prepare($sql);
				$stm->bindValue(':nome', $nome);
				$stm->bindValue(':quantity', $quantity);
				$stm->bindValue(':cod_barra', $cod_barra);
				$stm->bindValue(':valor_unitario', $valor_unitario);
				$stm->bindValue(':valor_fornecedor', $valor_fornecedor);

				$retorno = $stm->execute();
			}


			if ($retorno):
				echo "<script>alert ('Registro inserido com sucesso!!');</script>";
			else:
				echo "<script>alert ('Erro ao inserir registro!!');</script>";
			endif;
			echo "<script>window.location.replace('estoque.php');</script>";
		endif;


		if ($acao == 'editar'):
			$sql = 'UPDATE estoque SET nome=:nome,quantity=:quantity,cod_barra=:cod_barra,valor_unitario=:valor_unitario,valor_fornecedor=:valor_fornecedor,data_validade=:data_validade WHERE id=:id';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':nome', $nome);
			$stm->bindValue(':quantity', $quantity);
			$stm->bindValue(':cod_barra', $cod_barra);
			$stm->bindValue(':valor_unitario', $valor_unitario);
			$stm->bindValue(':valor_fornecedor', $valor_fornecedor);
			$stm->bindValue(':data_validade', $data_validade);
			$stm->bindValue(':id', $id);
			$retorno = $stm->execute();



			if ($retorno):
				echo "<script>Swal.fire('Registro editado com sucesso!','Clique no botão abaixo','success');</script>";
			else:
				echo "<script>alert ('Erro ao editar registro!!');</script>";
			endif;
			echo "<script>window.location.replace('estoque.php');</script>";
		endif;


		if ($acao1 == 'excluir'):
			$sql = 'DELETE FROM estoque WHERE id = :id';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id', $id1);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<script>Swal.fire('Good job!','You clicked the button!','success');</script>";
			else:
				echo "<script>alert ('Erro ao excluir registro!!');</script>";
			endif;
			echo "<script>window.location.replace('estoque.php');</script>";

		endif;
		?>

	</div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>