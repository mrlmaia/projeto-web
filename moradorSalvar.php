<?php			
	require('moradorBiblioteca.php');

	$idMorador = $_POST['idMorador'];
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf']; 
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $dataNascimento = $_POST['dataNascimento'];
    $contato = $_POST['contato'];
	$foto = $_FILES['foto'];
	$senha = geraSenha();
	
	if(!empty( $arquivo["name"])){
		$foto =  armazenarFotoMorador($arquivo);
	}

	if(salvarMorador($idMorador, $nome, $cpf, $email, $celular, $dataNascimento, $contato, $foto, $senha)){
		if($idMorador == 0){
		    echo "<script>alert('Morador cadastrado com sucesso!');</script>"; 
		    
    		$emailDestinatario = $email;
    		$assunto = "Senha de login";
    		$mensagem = "Sua senha para logar no Projeto-Web é: {$senha}"; 
    		$headers = "From: odilonco@h16.servidorhh.com"; 
    		
    
    		$envio = mail($emailDestinatario, $assunto, $mensagem, $headers); 
    
    		if($envio){
    			atualizarSenha($idMorador, $senha);
    
    			echo "<script>alert('Um email com senha foi enviado.');</script>"; 
    
    		}else{
    			echo "<script>alert('Erro ao enviar email.');</script>";
    		}
		}else{
		  echo "<script>alert('Morador alterado com sucesso.');</script>";
		}
	}else{
		echo "<script>alert('Erro ao cadastrar morador.');</script>"; 
	}

	echo "<script>location.href='moradorTabela.php';</script>"; 
?>	

	
	
	
	