<?php
session_start();

require_once('./tipoBiblioteca.php');
$tipos = listarTipo();

?>

<!doctype html>
<html lang="en">

<head>
  <title>Projeto Web | Relatório</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link type="text/css" rel="stylesheet" href="css/estilo.css" />

</head>

<body>

  <?php
  $pagina = "extrato";
  require_once('menu.php');
  ?>

  <div class="container mt-5">
    <h3 class="mb-3 mx-auto">Gerar relatório</h3>

    <form id="formulario" action="extratoRelatorio.php" method="post">
      <div>
        <div class="row form-group">
          <div class="col-md-6">
            <label for="idTipo">Tipo</label>
            <select class="form-control" name="idTipo" id="idTipo">
              <option value='' disabled selected>Selecione um tipo de conta</option>
              <option value="todos">Todos</option>
              <?php
              foreach ($tipos as $tipo) {
                echo "<option value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
              }

              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="inicio">Início</label>
            <input class="form-control" type="date" name="inicio" id="inicio ">
          </div>
          <div class="col-md-3">
            <label for="termino">Termíno</label>
            <input class="form-control" type="date" name="termino" id="termino ">
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-12">
            <button type="submit" class="btn btn-success float-right mx-1">Gerar</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script type="text/javascript" src="js/relatorioFormulario.js"></script>
</body>

</html>
