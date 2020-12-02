<?php			
	require('rateioBiblioteca.php');
	require('contaBiblioteca.php');

    $idRateio = $_POST['idRateio'];
	$idMorador = $_POST['idMorador'];
	$valor = $_POST['valor'];
	$situacao = $_POST['situacao'];
	$idConta = $_POST['idConta'];
	
	$valor = formatarMoeda($valor);

	if(salvarRateio($idRateio, $valor, $situacao, $idMorador, $idConta)){
	    if($idRateio == 0){
	        echo "<script>alert('Rateio cadastrado com sucesso!');</script>"; 
	    }else{
	        echo "<script>alert('Rateio alterado com sucesso!');</script>"; 
	    }
	}else{
		echo "<script>alert('Erro ao cadastrar rateio.');</script>"; 
	}
	
	echo "<script>location.href='rateioTabela.php';</script>";

?>	

	
	
	
	