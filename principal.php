<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');
$inicio = date("Y-m-d", strtotime("first day of this month"));
$fim = date("Y-m-d", strtotime("last day of this month"));

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
    <div class="col-md-3">
      <form action="#" id="fomulario">
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
      <table>
        <thead></thead>
        <tbody></tbody>
      </table>
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- ChartJs -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha256-t9UJPrESBeG2ojKTIcFLPGF7nHi2vEc7f5A2KpH/UBU=" crossorigin="anonymous"></script>

  <script src="js/dashboard.js"></script>
</body>

</html>
