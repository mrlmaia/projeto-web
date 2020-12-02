<?php

require_once('bancoDadosBiblioteca.php');

function salvarConta($idConta, $valor, $dataVencimento, $estado, $idMoradorResponsavel, $idTipo, $descricao, $observacao)
{
  try {
    $situacao = FALSE;
    $conexao = criarConexao();

    if ($idConta == 0) {
      $sql = "INSERT INTO tbConta(valor, dataVencimento, estado, idMoradorResponsavel, idTipo, descricao, observacao) VALUES(:valor, :dataVencimento, :estado, :idMoradorResponsavel, :idTipo, :descricao, :observacao);";
      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':valor', $valor);
      $resultado->bindValue(':dataVencimento', $dataVencimento);
      $resultado->bindValue(':estado', $estado);
      $resultado->bindValue(':idMoradorResponsavel', $idMoradorResponsavel);
      $resultado->bindValue(':idTipo', $idTipo);
      $resultado->bindValue(':descricao', $descricao);
      $resultado->bindValue(':observacao', $observacao);
    } else {
      $sql = "UPDATE tbConta SET valor = :valor, dataVencimento = :dataVencimento, estado = :estado, idMoradorResponsavel = :idMoradorResponsavel, idTipo = :idTipo, descricao =  :descricao, observacao = :observacao WHERE idConta = :idConta";

      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':idConta', $idConta);
      $resultado->bindValue(':valor', $valor);
      $resultado->bindValue(':dataVencimento', $dataVencimento);
      $resultado->bindValue(':estado', $estado);
      $resultado->bindValue(':idMoradorResponsavel', $idMoradorResponsavel);
      $resultado->bindValue(':idTipo', $idTipo);
      $resultado->bindValue(':descricao', $descricao);
      $resultado->bindValue(':observacao', $observacao);
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

function listarConta()
{
  try {
    $sql = "SELECT * FROM tbConta;";
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

function excluirConta($idConta)
{
  try {
    $situacao = FALSE;
    $sql = "DELETE FROM tbConta WHERE idConta = :idConta;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idConta', $idConta);
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

function buscarConta($idConta)
{
  try {
    $sql = "SELECT * FROM tbConta WHERE idConta = :idConta";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idConta', $idConta);
    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }

  return $registro;
}

function formatarMoeda($valor)
{
  try {
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", ".", $valor);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $valor;
}

function listarRateioPorConta($idConta)
{
  try {
    $sql = "SELECT * FROM tbRateio WHERE idConta = :idConta;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idConta', $idConta);
    $resultado->execute();
    fecharConexao($conexao);
    $registros = $resultado->fetchAll();
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registros;
}

function replicarConta($idConta)
{
  $novoIdConta = 0;
  try {
    $conexao = criarConexao();

    $sql = "INSERT INTO tbConta(valor, dataVencimento, estado, idMoradorResponsavel, idTipo, descricao, observacao) SELECT valor, dataVencimento, estado, idMoradorResponsavel, idTipo, descricao, observacao FROM tbConta WHERE idConta  = :idConta;";
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idConta', $idConta);
    $resultado->execute();
    $novoIdConta = $conexao->lastInsertId();

    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $novoIdConta;
}

function alterarEstadoConta($idConta, $estado)
{
  try {
    $situacao = FALSE;
    $conexao = criarConexao();

    if ($estado == 1) {
      $novoEstado = 2;
      $sql = "UPDATE tbConta SET estado = :estado WHERE idConta = :idConta;";
      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':estado', $novoEstado);
      $resultado->bindValue(':idConta', $idConta);
    } else {
      $novoEstado = 1;
      $sql = "UPDATE tbConta SET estado = :estado WHERE idConta = :idConta";
      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':estado', $novoEstado);
      $resultado->bindValue(':idConta', $idConta);
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
