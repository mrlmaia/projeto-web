<?php			
	require('contaBiblioteca.php');

	$idConta = $_GET["idConta"];

	if(excluirConta($idConta)){
		echo "<script>alert('Conta excluída com sucesso!');</script>"; 
	}else{
		echo "<script>alert('Erro ao excluir conta.');</script>"; 
	}

	echo "<script>location.href='contaTabela.php';</script>"; 
?>	

	
	
	
	