<?php

function criarConexao()
{

  $conexao = null;

  try {
    $conexao = new PDO('mysql:host=127.0.0.1; dbname=ProjetoWeb', 'root', 'root');
    // $conexao = new PDO('mysql:host=localhost; dbname=id15566093_projetoweb', 'id15566093_root', 'Root@Password-1');
    $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $erro) {
    criarArquivo($erro);
    die();
  }
  return $conexao;
}

function fecharConexao($conexao)
{
  $conexao = null;
}

function criarArquivo($erro)
{
  echo "<script>alert('Ocorreu um erro durante a execução do sistema');</script>";
  date_default_timezone_set('America/Sao_Paulo');
  $dataErro = date('d/m/Y H:i:s');
  $arquivo = fopen('log.txt', 'a+');
  $texto = "Data: {$dataErro} \n";
  $texto = $texto . "\t Arquivo: {$erro->getFile()} - Linha: {$erro->getLine()} \n";
  $texto = $texto . "\t Erro: {$erro->getMessage()} \n";
  fwrite($arquivo, $texto);
  fclose($arquivo);
}
