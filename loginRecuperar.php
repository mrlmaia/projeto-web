<?php
	require_once('moradorBiblioteca.php');	

	$email = $_POST["email"];
	$cpf = $_POST["cpf"];		
	
	$registro = verificarUsuario($email, $cpf);

	if($registro != NULL){		
		$novaSenha = geraSenha();

		$emailDestinatario = $email;
		$assunto = "Recuperação de senha";
		$mensagem = "Sua nova senha é: {$novaSenha}"; 
		$headers = "From: odilonco@h16.servidorhh.com"; 
		
		$envio = mail($emailDestinatario, $assunto, $mensagem, $headers); 

		if($envio){
			$idMorador = $registro['idMorador'];
			atualizarSenha($idMorador, $novaSenha);

			echo "<script>alert('Um email com sua senha foi enviado.'); location.href='login.php';</script>"; 

		}else{
			echo "<script>alert('Erro ao enviar email.');</script>";
		}
		
	}else{
		echo "<script>alert('Email ou CPF inválidos.'); location.href='loginEsqueceuSenha.php';</script>"; 		
	}		
?>