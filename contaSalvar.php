<?php			
	require('contaBiblioteca.php');

	$idConta = $_POST['idConta'];
	$valor =  $_POST['valor'];
	$dataVencimento = $_POST['dataVencimento'];
	$descricao = $_POST['descricao'];
	$observacao = $_POST['observacao'];
	$estado = $_POST['estado'];
	$idTipo = $_POST['idTipo'];
	$idMoradorResponsavel = $_POST['idMoradorResponsavel'];

	$valor = formatarMoeda($valor);

	if(salvarConta($idConta, $valor, $dataVencimento, $estado, $idMoradorResponsavel, $idTipo, $descricao, $observacao)){
	    if($idConta == 0){
	      echo "<script>alert('Conta cadastrada com sucesso!');</script>";   
	    }else{
	        echo "<script>alert('Conta alterada com sucesso!');</script>"; 
	    }
	}else{
		echo "<script>alert('Erro ao cadastrar conta.');</script>"; 
	}

	echo "<script>location.href='contaTabela.php';</script>"; 
?>	

	
	
	
	