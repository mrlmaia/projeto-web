<?php			
	require('moradorBiblioteca.php');

	$idMorador = $_GET["idMorador"];

	if(excluirMorador($idMorador)){
		echo "<script>alert('Morador excluído com sucesso!');</script>"; 
	}else{
		echo "<script>alert('Erro ao excluir morador.');</script>"; 
	}

	echo "<script>location.href='moradorTabela.php';</script>"; 
?>	

	
	
	
	