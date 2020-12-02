<?php

require_once('bancoDadosBiblioteca.php');

function salvarHistorico($idHistorico, $data, $estado, $idConta, $idMorador)
{
  try {
    $situacao = FALSE;
    $conexao = criarConexao();
    if ($estado == 1) {
      $novoEstado = 2;
      $sql = "INSERT INTO tbHistorico(data, estado, idConta, idMorador) VALUES(:data, :estado, :idConta, :idMorador);";
      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':data', $data);
      $resultado->bindValue(':estado', $novoEstado);
      $resultado->bindValue(':idConta', $idConta);
      $resultado->bindValue(':idMorador', $idMorador);
    } else {
      $novoEstado = 1;
      $sql = "INSERT INTO tbHistorico(data, estado, idConta, idMorador) VALUES(:data, :estado, :idConta, :idMorador);";
      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':data', $data);
      $resultado->bindValue(':estado', $novoEstado);
      $resultado->bindValue(':idConta', $idConta);
      $resultado->bindValue(':idMorador', $idMorador);
    }
    $resultado->execute();
    fecharConexao($conexao);
    if ($resultado->rowCount() > 0) {
      $situacao = TRUE;
    }
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $situacao;
}

function excluirHistorico($idHistorico)
{
  try {
    $situacao = FALSE;
    $sql = "DELETE FROM tbHistorico WHERE idHistorico = {$idHistorico};";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idHistorico', $idHistorico);
    $resultado->execute();
    fecharConexao($conexao);
    if ($resultado->rowCount() > 0) {
      $situacao = TRUE;
    }
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $situacao;
}

function listarHistorico()
{
  try {
    $sql = "SELECT * FROM tbHistorico;";
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

function buscarHistorico($idHistorico)
{
  try {
    $sql = "SELECT * FROM tbHistorico WHERE idHistorico = {$idHistorico};";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idHistorico', $idHistorico);
    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}

function listarHistoricoPorConta($idConta)
{
  try {
    $sql = "SELECT * FROM tbHistorico WHERE idConta = :idConta;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idConta', $idConta);
    $resultado->execute();
    $registros = $resultado->fetchAll();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registros;
}
