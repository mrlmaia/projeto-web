<?php
session_start();
require('moradorBiblioteca.php');
$moradores = listarMorador();

?>

<html>

<head>
  <meta charset="utf-8" />
  <title> Projeto Web | Morador </title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <?php
  $pagina = "morador";
  require_once('menu.php');
  ?>

  <div class="container mt-5">
    <a class="btn btn-success float-right mb-2" href="moradorFormulario.php">Novo morador +</a>
    <table class="table table-striped table-hover" id="tabela">
      <thead>
        <tr class="bg-info text-light">
          <th scope="col"></th>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Email</th>
          <th scope="col">Celular</th>
          <th scope="col"></th>

        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($moradores as $morador) {
          $imagem = $morador['foto'];
          echo "<tr>";
          echo "<td>
                                    <img class='rounded-circle' width='50' height='50' src='$imagem'</img>
                                  </td>";
          echo "<td>{$morador['nome']}</td>";
          echo "<td>{$morador['CPF']}</td>";
          echo "<td>{$morador['email']}</td>";
          echo "<td>{$morador['celular']}</td>";

          echo "<td><a class='btn btn-warning float-right'
							             href='moradorFormulario.php?idMorador={$morador['idMorador']}'>
										 Editar</a>";
          echo "<a class='btn btn-danger float-right mx-1'
							             href='moradorExcluir.php?idMorador={$morador['idMorador']}'>
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
  <script type="text/javascript" src="js/moradorTabela.js"></script>

</body>

</html>
