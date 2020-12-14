<?php
session_start();
require_once("./contaBiblioteca.php");

date_default_timezone_set('America/Sao_Paulo');
if (isset($_GET["inicio"]) && isset($_GET["fim"])) {
  $inicio = $_GET["inicio"];
  $fim = $_GET["fim"];
} else {
  $inicio = date("Y-m-d", strtotime("first day of this month"));
  $fim = date("Y-m-d", strtotime("last day of this month"));
}

$contas = listarContasPorPeriodo($inicio, $fim);
?>
<!doctype html>
<html lang="en">

<head>
  <title>Home</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />

</head>

<body>
  <?php
  $pagina = "principal";
  require_once('menu.php');
  ?>

  <div class="container mt-5">
    <div class="row mb-4">
      <div class="col-md-3">
        <form action="principal.php" method="get" id="fomulario">
          <div class="row form-group">
            <div class="col-md-12">
              <label for="inicio">Inicio</label>
              <input class="form-control" id="inicio" name="inicio" value="<?php echo $inicio ?>" type="date">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label for="fim">Fim</label>
              <input class="form-control" id="fim" name="fim" value="<?php echo $fim ?>" type="date">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <button type="submit" class="btn btn-success float-right">Atualizar painel</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-9">
        <table class="table table-striped table-hover">
          <thead>
            <tr class="bg-info text-light">

              <th scope="col">Descrição</th>
              <th scope="col">Tipo</th>
              <th scope="col">Responsável</th>
              <th scope="col">Vencimento</th>
              <th scope="col">Estado</th>
              <th scope="col">Valor</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($contas as $conta) {
              if ($conta['estado'] == 1) {
                $estado = "Aberta";
              } else {
                $estado = "Fechada";
              }
              $valorFormatado = number_format($conta['valor'], 2, ",", ".");
              $d = date_create($conta["vencimento"]);
              $vencimento = date_format($d, "d/m/Y");

              echo "<tr>";
              echo "<td>{$conta['descricao']}</td>";
              echo "<td>{$conta['tipo']}</td>";
              echo "<td>{$conta['responsavel']}</td>";
              echo "<td>{$vencimento}</td>";
              echo "<td>{$estado}</td>";
              echo "<td>{$conta['valor']}</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="gastos-por-tipo col-md-6">
          <canvas id="gastos-por-tipo"></canvas>
        </div>
        <div class="gastos-por-morador col-md-6">
          <canvas id="gastos-por-morador"></canvas>
        </div>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- ChartJs -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha256-t9UJPrESBeG2ojKTIcFLPGF7nHi2vEc7f5A2KpH/UBU=" crossorigin="anonymous"></script>

  <script src="js/dashboard.js"></script>
</body>

</html>
