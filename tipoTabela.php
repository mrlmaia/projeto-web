<?php
session_start();
require('tipoBiblioteca.php');
$tipos = listarTipo();

?>

<html>

<head>
  <meta charset="utf-8" />
  <title> Projeto Web | Tipo </title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <?php
  $pagina = "tipo";
  require_once('menu.php');
  ?>

  <div class="container mt-5">
    <a class="btn btn-success float-right mb-2" href="tipoFormulario.php">Novo tipo +</a>

    <table class="table table-striped table-hover" id="tabela">
      <thead>
        <tr class="bg-info text-light">
          <th scope="col">Nome</th>
          <th scope="col"></th>

        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($tipos as $tipo) {
          echo "<td>{$tipo['nome']}</td>";
          echo "<td><a class='btn btn-warning float-right'
							             href='tipoFormulario.php?idTipo={$tipo['idTipo']}'>
										 Editar</a>";
          echo "<a class='btn btn-danger float-right mx-1'
							             href='tipoExcluir.php?idTipo={$tipo['idTipo']}'>
										 Excluir</a></td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/datatables.js"></script>
  <script type="text/javascript" src="js/tipoTabela.js"></script>

</body>

</html>
