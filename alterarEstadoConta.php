<?php
	session_start();
	require_once('historicoBiblioteca.php');	
	require_once('contaBiblioteca.php');	

	date_default_timezone_set('America/Sao_Paulo');
	$data =  date('Y-m-d H:i:s');
	$estado = $_GET['estado'];
	$idConta = $_GET['idConta'];
	$idMorador = $_GET['idMorador'];
	
    if(alterarEstadoConta($idConta, $estado)){
        salvarHistorico(NULL, $data, $estado, $idConta, $idMorador);
        echo "<script>alert('Estado da conta alterado com sucesso!'); location.href='contaTabela.php';</script>"; 			
    }
        echo "<script>location.href='contaTabela.php';</script>"; 			
    	
?>