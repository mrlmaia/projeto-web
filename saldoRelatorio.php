<?php
// ob_start();

require_once "mpdf/mpdf.php";
require_once('saldoBiblioteca.php');
require_once('moradorBiblioteca.php');

$idMorador = $_GET['idMorador'];

$morador = buscarMorador($idMorador);

$registro = gerarSaldo($idMorador);

$contas = $registro['contas'];
$total = $registro['total'];


$mpdf = new mPDF();
$mpdf->SetDisplayMode("fullpage");

$css = file_get_contents('css/saldoRelatorio.css');
$mpdf->WriteHTML($css, 1);

$html = "
<h1 class=\"titulo\">Relatório de saldo</h1>
<h2>Morador {$morador['nome']} - CPF: {$morador['CPF']}</h2>
<hr />
<div class=\"container\">
  <h3 id=\"total\">Total em débito R$  {$total}</h3>
  <table class=\"tabela\">
    <thead>
      <tr>
        <th scope=\"col\">Descrição</th>
        <th scope=\"col\">Tipo</th>
        <th scope=\"col\">Valor da conta</th>
        <th scope=\"col\">Vencimento</th>
        <th scope=\"col\">Valor rateio</th>
      </tr>
    </thead>
    <tbody>
";

foreach ($contas as $conta) {
  $html = $html . "<tr>";
  $html = $html . "<td>{$conta['descricao']}</td>";
  $html = $html . "<td>{$conta['tipo']}</td>";

  $valor = number_format($conta['valor'], 2, ",", ".");

  $html = $html . "<td>{$valor}</td>";
  $dataDeVencimentoFormatada = date_format(date_create($conta['dataVencimento']), 'd/m/Y');
  $html = $html . "<td>{$dataDeVencimentoFormatada}</td>";

  $valorRateio = number_format($conta['valorRateio'], 2, ',', '.');
  $html = $html . "<td>{$valorRateio}</td>";
}

$html = $html . "  </tbody>
</table>
</div>";

date_default_timezone_set('America/Sao_Paulo');
$dataEmissao = date("d/m/Y H:i:s");
$mpdf->SetHeader("Projeto Web | | Emissão: {$dataEmissao}");
$mpdf->setFooter("{PAGENO} de {nb}");
$mpdf->WriteHTML($html, 2);
$mpdf->Output('exemplo03.pdf', 'I');
exit();
