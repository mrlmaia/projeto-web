<?php

require_once('bancoDadosBiblioteca.php');

function salvarTipo($idTipo, $nome)
{
  try {
    $situacao = FALSE;
    $conexao = criarConexao();

    if ($idTipo == 0) {
      $sql = "INSERT INTO tbTipo(nome) VALUES(:nome);";

      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':nome', $nome);
    } else {
      $sql = "UPDATE tbTipo SET nome = :nome WHERE idTipo = :idTipo;";

      $resultado = $conexao->prepare($sql);
      $resultado->bindValue(':idTipo', $idTipo);
      $resultado->bindValue(':nome', $nome);
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

function listarTipo()
{
  try {
    $sql = "SELECT * FROM tbTipo;";
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

function excluirTipo($idTipo)
{
  try {
    $situacao = FALSE;
    $sql = "DELETE FROM tbTipo WHERE idTipo = :idTipo;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idTipo', $idTipo);
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

function buscarTipo($idTipo)
{
  try {
    $sql = "SELECT * FROM tbTipo WHERE idTipo = :idTipo";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idTipo', $idTipo);
    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}

function verificarNome($nome, $idTipo)
{
  try {
    $sql = "SELECT * FROM tbTipo WHERE nome = :nome AND idTipo <> :idTipo;";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':nome', $nome);
    $resultado->bindValue(':idTipo', $idTipo);
    $resultado->execute();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $resultado->fetchColumn();
}
