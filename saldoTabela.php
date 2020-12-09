<?php
session_start();
require_once('saldoBiblioteca.php');

$idConta = $_SESSION['usuario']['idMorador'];

$registro = gerarSaldo($idConta);

echo $idConta;

$contas = $registro['contas'];
$total = $registro['total'];
?>

<!doctype html>
<html lang="en">

<head>
  <title>Projeto Web | Saldo</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link type="text/css" rel="stylesheet" href="css/estilo.css" />

</head>

<body>

  <?php
  $pagina = "saldo";
  require_once('menu.php');
  ?>

  <div class="container mt-5">
    <h3 class="mb-3 mx-auto">Contas não pagas</h3>
    <div class="card mb-4 w-50">
      <div class="card-body">
        <h5 class="card-title"><?php echo $_SESSION['usuario']['nome'] . " - CPF: " . $_SESSION['usuario']['CPF'] ?></h5>
        <p class="card-text">Total de rateios em aberto R$ <?php echo number_format($total, 2, ',', '.') ?></p>
        <a class="btn btn-success" type="button" href="saldoRelatorio.php" target="_blank">Baixar relatório</a>
      </div>
    </div>
    <table class="table table-striped table-hover" id="tabela">
      <thead>
        <tr class="bg-info text-light">
          <th scope="col">Descrição</th>
          <th scope="col">Tipo</th>
          <th scope="col">Valor da conta</th>
          <th scope="col">Vencimento</th>
          <th scope="col">Valor rateio</th>
        </tr>
      </thead>
      <tbody>
        <?php

        foreach ($contas as $conta) {
          echo "<tr>";
          echo "<td>{$conta['descricao']}</td>";
          echo "<td>{$conta['tipo']}</td>";

          $valor = number_format($conta['valor'], 2, ",", ".");

          echo "<td>{$valor}</td>";
          $dataDeVencimentoFormatada = date_format(date_create($conta['dataVencimento']), 'd/m/Y');
          echo "<td>{$dataDeVencimentoFormatada}</td>";

          $valorRateio = number_format($conta['valorRateio'], 2, ',', '.');
          echo "<td>{$valorRateio}</td>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
