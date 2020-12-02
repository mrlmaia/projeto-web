<?php
session_start();
require('tipoBiblioteca.php');
$idTipo = 0;
$nome = "";

if (isset($_GET["idTipo"])) {
  $registro = buscarTipo($_GET["idTipo"]);
  $idTipo = $registro['idTipo'];
  $nome = $registro['nome'];
}

?>

<html>

<head>
  <meta charset="utf-8" />
  <title> Projeto-Web | Tipo </title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <?php
  $pagina = "tipo";
  require_once('menu.php');
  ?>
  <div class="container mt-4">
    <h3 class="my-3">Informações do tipo</h3>
    <form id="formulario" action="tipoSalvar.php" method="post">
      <div>
        <div class="row form-group">
          <div class="col-md-12">
            <input class="form-control" id="idTipo" name="idTipo" value="<?php echo $idTipo ?>" type="hidden">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-12">
            <input class="form-control" id="nome" name="nome" value="<?php echo $nome ?>" type="text" placeholder="Informe um nome">
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-12">
            <a class="btn btn-primary" href="tipoTabela.php">Voltar</a>
            <button type="submit" class="btn btn-success float-right mx-1">Salvar</button>
            <button type="reset" class="btn btn-danger float-right">Cancelar</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script type="text/javascript" src="js/tipoFormulario.js"></script>
</body>

</html>
