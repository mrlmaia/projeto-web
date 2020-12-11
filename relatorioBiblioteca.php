<?php
require_once("bancoDadosBiblioteca.php");

function gerarSaldo($idMorador)
{
  try {
    $conexao = criarConexao();

    $sql = "SELECT tc.descricao, tt.nome as tipo ,tc.valor, tc.dataVencimento, tr.valor as valorRateio
    FROM tbRateio tr inner join tbConta tc on tc.idConta = tr.idConta
    inner join tbTipo tt on tt.idTipo = tc.idTipo where tr.idMorador = :idMorador and tr.situacao = 2;";

    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idMorador', $idMorador);

    $resultado->execute();

    $contas = $resultado->fetchAll();

    $total = _gerarTotal($idMorador, $conexao);

    fecharConexao($conexao);

    $registro = array(
      'contas' => $contas,
      'total' => $total
    );

    return $registro;
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
}

function _gerarTotal($id, $conexao)
{
  try {
    // $conexao = criarConexao();

    $sql = "SELECT sum(tr.valor) as total FROM tbRateio tr inner join tbConta tc on tc.idConta = tr.idConta where tr.idMorador = :id and tr.situacao = 2;";
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':id', $id);

    $resultado->execute();

    $saldo = $resultado->fetch();

    return $saldo['total'];
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
}

function gerarExtratoContaTipo($inicio, $termino, String $idTipo = null)
{
  try {
    $conexao = criarConexao();

    $sql = "SELECT descricao, nome as tipo, dataVencimento as vencimento, valor FROM tbConta tc
    inner join tbTipo tt on tt.idTipo = tc.idTipo
    where dataVencimento BETWEEN :inicio and :termino";

    $sql = $idTipo == null ? $sql . ";" : $sql . " and tt.idTipo = :idTipo" . ";";

    $resultado = $conexao->prepare($sql);

    $resultado->bindValue(':inicio', $inicio);
    $resultado->bindValue(':termino', $termino);

    if ($idTipo != null) $resultado->bindValue(':idTipo', $idTipo);

    $resultado->execute();

    $contasTipo = $resultado->fetchAll();

    return $contasTipo;
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
}

function emitirExtratoMoradorPago($idMorador, $idTipo, $dataInicial, $dataFinal)
{
  try {
    $sql = "SELECT SUM(tr.valor) pago FROM tbConta tc INNER JOIN tbTipo tt on tt.idTipo = tc.idTipo INNER JOIN tbRateio tr ON tr.idConta = tc.idConta INNER JOIN tbMorador tm on tr.idMorador = tm.idMorador where tr.situacao = 1 AND tm.idMorador = :idMorador and tc.dataVencimento BETWEEN :dataInicial AND :dataFinal AND tt.idTipo = :idTipo";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idTipo', $idTipo);
    $resultado->bindValue(':dataInicial', $dataInicial);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->bindValue(':dataFinal', $dataFinal);
    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}

function emitirExtratoMoradorDebito($idMorador, $idTipo, $dataInicial, $dataFinal)
{
  try {
    $sql = "SELECT SUM(tr.valor) debito FROM tbConta tc INNER JOIN tbTipo tt on tt.idTipo = tc.idTipo INNER JOIN tbRateio tr ON tr.idConta = tc.idConta INNER JOIN tbMorador tm on tr.idMorador = tm.idMorador where tr.situacao = 2 AND tm.idMorador = :idMorador and tc.dataVencimento BETWEEN :dataInicial AND :dataFinal AND tt.idTipo = :idTipo";
    $conexao = criarConexao();
    $resultado = $conexao->prepare($sql);
    $resultado->bindValue(':idTipo', $idTipo);
    $resultado->bindValue(':dataInicial', $dataInicial);
    $resultado->bindValue(':idMorador', $idMorador);
    $resultado->bindValue(':dataFinal', $dataFinal);
    $resultado->execute();
    $registro = $resultado->fetch();
    fecharConexao($conexao);
  } catch (PDOException $erro) {
    criarArquivo($erro);
  }
  return $registro;
}
