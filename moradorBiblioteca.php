<?php

require_once('bancoDadosBiblioteca.php');

function salvarMorador($idMorador, $nome, $cpf, $email, $celular, $dataNascimento, $contato, $foto, $senha)
{
  try {
    $situacao = FALSE;
    $conexao = criarConexao();

    $nomeFoto = armazenarFotoMorador($foto);

    if ($idMorador == 0) {
      $sql = "INSERT INTO tbMorador(nome, CPF, email, celular, dataNascimento, contato, foto, senha) VALUES(:nome, :cpf, :email, :celular, :dataNascimento, :contato, :nomeFoto, :senha);";

      $resultado = $conexao->prepare($sql);
      //$resultado->bindValue(':idMorador', $idMorador);
      $resultado->bindValue(':nome', $nome);
      $resultado->bindValue(':cpf', $cpf);
      $resultado->bindValue(':email', $email);
      $resultado->bindValue(':celular', $celular);
      $resultado->bindValue(':dataNascimento', $dataNascimento);
      $resultado->bindValue(':contato', $contato);
      $resultado->bindValue(':nomeFoto', $nomeFoto);
      $resultado->bindValue(':senha', $senha);
    } else {
      $sql = "UPDATE tbMorador SET nome = :nome, CPF = :cpf, email = :email, celular = :celular, dataNascimento = :dataNascimento, contato =  :contato, foto = :nomeFoto, senha = :senha WHERE idMorador = :idMorador";
      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':idMorador', $idMorador);
      $resultado->bindValue(':nome', $nome);
      $resultado->bindValue(':cpf', $cpf);
      $resultado->bindValue(':email', $email);
      $resultado->bindValue(':celular', $celular);
      $resultado->bindValue(':dataNascimento', $dataNascimento);
      $resultado->bindValue(':contato', $contato);
      $resultado->bindValue(':nomeFoto', $nomeFoto);
      $resultado->bindValue(':senha', $senha);
    }

    $resultado->execute();

    fecharConexao($conexao);

    if ($resultado->rowCount() == 1) {
      $situacao = TRUE;
    }
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $situacao;
}

function listarMorador()
{
  try {
    $sql = "SELECT * FROM tbMorador;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->execute();
    $registros = $resultado->fetchAll();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registros;
}

function excluirMorador($idMorador)
{
  try {
    $situacao = FALSE;
    $sql = "DELETE FROM tbMorador WHERE idMorador = :idMorador;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->execute();
    fecharConexao($conexao);

    if ($resultado->rowCount() == 1) {
      $situacao = TRUE;
    }
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }

  return $situacao;
}

function buscarMorador($idMorador)
{
  try {
    $sql = "SELECT * FROM tbMorador WHERE idMorador = :idMorador";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}

function armazenarFotoMorador($arquivo)
{
  try {
    $nomeArquivo = $arquivo["name"];
    $extensaoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
    $novoNome = md5(uniqid($nomeArquivo)) . "." . $extensaoArquivo;
    $caminhoArquivo = "imagens/" . $novoNome;
    move_uploaded_file($arquivo["tmp_name"], $caminhoArquivo);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $caminhoArquivo;
}

function autenticarUsuario(String $email, String $senha)
{
  $registro = null;
  try {
    $sql = "SELECT * FROM tbMorador WHERE email = :email AND senha = :senha;";
    $conexao = criarConexao();

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':email', $email);
    $resultado->bindValue(':senha', $senha);

    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}

function verificarUsuario($email, $cpf)
{
  try {
    $sql = "SELECT * FROM tbMorador WHERE email = :email AND CPF = :cpf;";
    $conexao = criarConexao();

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':email', $email);
    $resultado->bindValue(':cpf', $cpf);

    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}

function geraSenha()
{

  try {
    $tamanho = 8;
    $maiusculas = true;
    $numeros = true;
    $simbolos = true;

    // Caracteres de cada tipo
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';

    // Variáveis internas
    $retorno = '';
    $caracteres = '';

    // Agrupamos todos os caracteres que poderão ser utilizados
    $caracteres .= $lmin;
    if ($maiusculas) {
      $caracteres .= $lmai;
    }
    if ($numeros) {
      $caracteres .= $num;
    }
    if ($simbolos) {
      $caracteres .= $simb;
    }

    // Calculamos o total de caracteres possíveis
    $len = strlen($caracteres);

    for ($n = 1; $n <= $tamanho; $n++) {
      // Criamos um número aleatório de 1 até $len para pegar um dos caracteres
      $rand = mt_rand(1, $len);
      // Concatenamos um dos caracteres na variável $retorno
      $retorno .= $caracteres[$rand - 1];
    }
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $retorno;
}

function atualizarSenha($idMorador, $senha)
{
  try {
    $situacao = FALSE;
    $sql = "UPDATE tbMorador SET senha = :senha WHERE idMorador = :idMorador";
    $conexao = criarConexao();

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->bindValue(':senha', $senha);

    $resultado->execute();
    fecharConexao($conexao);

    if ($resultado->rowCount() == 1) {
      $situacao = TRUE;
    }
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $situacao;
}

function verificarEmail($email, $idMorador)
{
  try {
    $sql = "SELECT * FROM tbMorador WHERE email = :email AND idMorador <> :idMorador;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':email', $email);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->execute();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $resultado->fetchColumn();
}

function verificarCPF($cpf, $idMorador)
{
  try {
    $sql = "SELECT * FROM tbMorador WHERE cpf = :cpf AND idMorador <> :idMorador;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':cpf', $cpf);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->execute();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $resultado->fetchColumn();
}
