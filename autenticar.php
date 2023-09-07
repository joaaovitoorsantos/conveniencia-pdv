<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
require ('conexao.php');	
	 // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    
    
    $email  = (isset($_POST['email'])) ? $_POST['email'] : '';
    $senha  = (isset($_POST['senha'])) ? $_POST['senha'] : '';

    if (empty($email) OR empty($senha)) {
        header("Location: index.php"); exit;
    }
    
    // $senha = md5($senha);
		

    $conexao = conexao::getInstance();
    $sql = 'SELECT * FROM usuario where email = :email and senha=:senha limit 1';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':email', $email);
    $stm->bindValue(':senha', $senha);
    $stm->execute();
    $usuario = $stm->fetch(PDO::FETCH_OBJ);

 
    if(empty($usuario)){
        ob_start(); 
        echo "<script> window.location='index.php'; </SCRIPT>\n";
        var_dump(ob_get_clean()); 
    exit; 
    } else {

        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();
      
        // Salva os dados encontrados na sessão
		$_SESSION['id'] = $usuario->id;
		$_SESSION['nome'] = $usuario->nome;
		$_SESSION['email'] = $usuario->email;

	  
        // Redireciona o visitante
        header("Location: home.php"); exit;
    }

      
        
		
    



			
		
		
?>