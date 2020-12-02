<?php			
	require('tipoBiblioteca.php');

	$idTipo= $_POST['idTipo'];
	$nome = $_POST['nome'];

	if(salvarTipo($idTipo, $nome)){
	    if($idTipo == 0){
	        echo "<script>alert('Tipo cadastrado com sucesso!');</script>"; 
	    }else{
	       	echo "<script>alert('Tipo alterado com sucesso!');</script>"; 
	    }
	}else{
		echo "<script>alert('Erro ao cadastrar tipo.');</script>"; 
	}

	echo "<script>location.href='tipoTabela.php';</script>"; 
?>	

	
	
	
	