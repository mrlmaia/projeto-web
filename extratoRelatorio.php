<?php
ob_start();
require_once "mpdf/mpdf.php";
require_once('./tipoBiblioteca.php');
require_once('./relatorioBiblioteca.php');


$idTipo = $_POST['idTipo'];
$inicio = $_POST['inicio'];
$termino = $_POST['termino'];

$tipo = $idTipo != 'todos' ? buscarTipo($idTipo) : array('nome' => 'Todos');
$idTipo = $idTipo != 'todos' ?: null;
$contasTipo = gerarExtratoContaTipo($inicio, $termino, $idTipo);

$total = 0;
foreach ($contasTipo as $contaTipo) {
  $total += $contaTipo['valor'];
}

require('moradorBiblioteca.php');
require('rateioBiblioteca.php');


$tipos = listarTipo();

$dataInicial = date_format(date_create($inicio), 'd/m/Y');
$dataFinal = date_format(date_create($termino), 'd/m/Y');


$mpdf = new mPDF();
$mpdf->SetDisplayMode("fullpage");

$css = file_get_contents('css/saldoRelatorio.css');
$mpdf->WriteHTML($css, 1);

$p = date_format(date_create($inicio), 'd/m/Y') . ' - ' . date_format(date_create($termino), 'd/m/Y');
$html = "<h1 class=\"titulo\">Extrato</h1>
<div class=\"info\">
  <p id=\"left\"><b>Tipo: </b> {$tipo['nome']}</p>

  <p id=\"right\"><b>Período: </b>{$p}</p>
</div>
<hr>
<table class=\"tabela\">
  <thead>
    <tr>
      <th>Descrição</th>
      <th>Tipo</th>
      <th>Vencimento</th>
      <th>Valor da conta</th>
    </tr>
  </thead>
  <tbody>

";

foreach ($contasTipo as $contaTipo) {
  $html .= "<tr>";
  $html .= "<td>{$contaTipo['descricao']}</td>";
  $html .= "<td>{$contaTipo['tipo']}</td>";

  $dataDeVencimentoFormatada = date_format(date_create($contaTipo['vencimento']), 'd/m/Y');
  $html .= "<td>{$dataDeVencimentoFormatada}</td>";

  $valor = number_format($contaTipo['valor'], 2, ",", ".");
  $html .= "<td>{$valor}</td>";
}

$html .= "
</tbody>
<tfoot>
  <tr>
    <td></td>
    <td></td>
    <td>Total:</td>
    <td>R$ {$total}</td>
    </tr>
    </tfoot>
    </table>
    <hr>";

$html .=  "<table class='tabela'> <thead> <tr> <th>Morador</th><th>CPF</th> <th>Pago</th><th>Em débito</th></tr></thead><tbody>";

$moradores = listarMorador();

foreach ($moradores as $morador) {
  $pago = 0;
  $debito = 0;
  foreach ($tipos as $tipo) {
    $extratoPag = emitirExtratoMoradorPago($morador['idMorador'], $tipo['idTipo'], $inicio, $termino);
    $pago += $extratoPag['pago'];
    $extratoDeb =  emitirExtratoMoradorDebito($morador['idMorador'], $tipo['idTipo'], $inicio, $termino);
    $debito += $extratoDeb['debito'];
  }
  if ($pago != 0 || $debito != 0) {
    $html .= "<tr> <td>{$morador['nome']}</td> <td>{$morador['CPF']}</td> <td>{$pago}</td> <td>{$debito}</td> </tr>";
  }
}

$html .= "</tbody></table></div>";


date_default_timezone_set('America/Sao_Paulo');
$dataEmissao = date("d/m/Y H:i:s");
$mpdf->SetHeader("Projeto Web | | Emissão: {$dataEmissao}");
$mpdf->setFooter("{PAGENO} de {nb}");
$mpdf->WriteHTML($html, 2);
$mpdf->Output('extratoRepublica.pdf', 'D');
exit();
