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
