<?php
ob_start();

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
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link type="text/css" rel="stylesheet" href="css/extratoRelatorio.css" />
</head>

<body>
  <h1 class="titulo">Extrato</h1>
  <div class="info">
    <p id="left"><b>Tipo: </b><?php echo $tipo['nome'] ?></p>

    <p id="right"><b>Período: </b><?php echo date_format(date_create($inicio), 'd/m/Y') . ' - ' . date_format(date_create($termino), 'd/m/Y') ?></p>
  </div>
  <hr>
  <table class="tabela">
    <thead>
      <tr>
        <th>Descrição</th>
        <th>Tipo</th>
        <th>Vencimento</th>
        <th>Valor da conta</th>
      </tr>
    </thead>
    <tbody>

      <?php
      foreach ($contasTipo as $contaTipo) {
        echo "<tr>";
        echo "<td>{$contaTipo['descricao']}</td>";
        echo "<td>{$contaTipo['tipo']}</td>";

        $dataDeVencimentoFormatada = date_format(date_create($contaTipo['vencimento']), 'd/m/Y');
        echo "<td>{$dataDeVencimentoFormatada}</td>";

        $valor = number_format($contaTipo['valor'], 2, ",", ".");
        echo "<td>{$valor}</td>";
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td></td>
        <td></td>
        <td>Total:</td>
        <td>R$ <?php echo $total ?></td>
      </tr>
    </tfoot>
  </table>
</body>

</html>
