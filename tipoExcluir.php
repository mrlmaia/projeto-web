<?php			
	require('tipoBiblioteca.php');

	$idTipo = $_GET["idTipo"];

	if(excluirTipo($idTipo)){
		echo "<script>alert('Tipo excluído com sucesso!');</script>"; 
	}else{
		echo "<script>alert('Erro ao excluir tipo.');</script>"; 
	}

	echo "<script>location.href='tipoTabela.php';</script>"; 
?>	

	
	
	
	