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
      $novoEstado = 0;
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

function listarGastosPorPeriodo($inicio, $fim)
{
  try {
    $conexao = criarConexao();

    $sql = "SELECT tt.nome as tipos, sum(tc.valor) as gastos
    from tbConta tc inner join tbTipo tt on tc.idTipo = tt.idTipo
    where tc.dataVencimento BETWEEN :inicio and :fim
    GROUP BY tt.idTipo
    order by tt.nome ;
    ";

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':inicio', $inicio);
    $resultado->bindValue(':fim', $fim);
    $resultado->execute();

    $registro = $resultado->fetchAll();
    fecharConexao($conexao);

    return $registro;
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
}

function listarGastosPorMorador($inicio, $fim)
{
  try {
    $conexao = criarConexao();

    $sql = "SELECT tm.nome as moradores, sum(tr.valor) as gastos
      from tbRateio tr inner join tbMorador tm on tr.idMorador = tm.idMorador
      inner join tbConta tc on tr.idConta = tc.idConta
      where dataVencimento BETWEEN :inicio and :fim
      group by tm.nome;";

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':inicio', $inicio);
    $resultado->bindValue(':fim', $fim);
    $resultado->execute();

    $registro = $resultado->fetchAll();
    fecharConexao($conexao);

    return $registro;
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
}

function listarContasPorPeriodo($inicio, $fim)
{
  try {
    $conexao = criarConexao();

    $sql = "SELECT descricao, tt.nome as tipo, tm.nome as responsavel, dataVencimento as vencimento, estado, tc.valor
    from tbConta tc inner join tbTipo tt on tc.idTipo = tt.idTipo
    inner join tbMorador tm on tc.idMoradorResponsavel = tm.idMorador
    where tc.dataVencimento BETWEEN :inicio and :fim
    and tc.estado = 1;
    ";

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':inicio', $inicio);
    $resultado->bindValue(':fim', $fim);
    $resultado->execute();

    $registro = $resultado->fetchAll();
    fecharConexao($conexao);

    return $registro;
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
}
