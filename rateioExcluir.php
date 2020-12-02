<?php			
	require('rateioBiblioteca.php');

	$idRateio = $_GET["idRateio"];
	$idConta = $_GET["idConta"];

	if(excluirRateio($idRateio)){
		echo "<script>alert('Rateio excluído com sucesso!');</script>"; 
	}else{
		echo "<script>alert('Erro ao excluir rateio.');</script>"; 
	}

	echo "<script>location.href='contaFormulario.php?acao=editar&idConta={$idConta}';</script>";
?>	

	
	
	
	