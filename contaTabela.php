<?php
session_start();
require('contaBiblioteca.php');
require('moradorBiblioteca.php');
require('tipoBiblioteca.php');
$contas = listarConta();

$registro = $_SESSION['usuario'];

?>

<html>

<head>
  <meta charset="utf-8" />
  <title> Projeto-Web | Conta </title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <?php
  $pagina = "conta";
  require_once('menu.php');
  ?>

  <div class="container mt-5">
    <a class="btn btn-success float-right mb-2" href="contaFormulario.php?acao=cadastrar">Nova conta +</a>

    <table class="table table-striped table-hover" id="tabela">
      <thead>
        <tr class="bg-info text-light">
          <th scope="col">Morador responsável</th>
          <th scope="col">Tipo</th>
          <th scope="col">Valor (R$)</th>
          <th scope="col">Vencimento</th>
          <th scope="col">Estado</th>
          <th scope="col">Descrição</th>
          <th scope="col"></th>

        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($contas as $conta) {
          $morador = buscarMorador($conta['idMoradorResponsavel']);
          $tipo = buscarTipo($conta['idTipo']);

          $dataVencimento = date_create($conta['dataVencimento']);
          $dataVencimentoFormatada = date_format($dataVencimento, 'd/m/Y');

          $valorFormatado = number_format($conta['valor'], 2, ",", ".");

          if ($conta['estado'] == 1) {
            $estado = "Aberta";
          } else {
            $estado = "Fechada";
          }

          echo "<tr>";
          echo "<td>{$morador['nome']}</td>";
          echo "<td>{$tipo['nome']}</td>";
          echo "<td>{$valorFormatado}</td>";
          echo "<td>{$dataVencimentoFormatada}</td>";
          echo "<td>{$estado}</td>";
          echo "<td>{$conta['descricao']}</td>";

          if ($conta['estado'] == 1) {
            echo "<td>";
            echo "<div class='btn-group float-right' role='group'>
                                        <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Outros
                                        </button>";
            echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
            echo "<a class='dropdown-item' href='contaFormulario.php?acao=visualizar&idConta={$conta['idConta']}'>Visualizar</a>";
            echo "<a class='dropdown-item' href='contaFormulario.php?acao=editar&idConta={$conta['idConta']}'>Editar</a>";
            echo "<a class='dropdown-item' href='contaExcluir.php?idConta={$conta['idConta']}'>Excluir</a>";
            echo "<a class='dropdown-item' href='historicoTabela.php?idConta={$conta['idConta']}'>Histórico da conta</a>";
            echo "</div>";
            echo "</div>";
            echo "<a class='btn btn-warning float-right mx-1' href='contaReplicar.php?idConta={$conta['idConta']}'>
                                        Replicar
                                     </a>";
            echo "<a class='btn btn-danger float-right mx-1'
                                     href='alterarEstadoConta.php?idConta={$conta['idConta']}&idMorador={$registro['idMorador']}&estado={$conta['estado']}'>Fechar</a>";
            echo "</td>";
          } else {
            echo "<td>";
            echo "<div class='btn-group float-right' role='group'>
                                        <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Outros
                                        </button>";
            echo "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
            echo "<a class='dropdown-item' href='contaFormulario.php?acao=visualizar&idConta={$conta['idConta']}'>Visualizar</a>";
            echo "<a class='dropdown-item disabled' href='contaFormulario.php?acao=editar&idConta={$conta['idConta']}'>Editar</a>";
            echo "<a class='dropdown-item' href='contaExcluir.php?idConta={$conta['idConta']}'>Excluir</a>";
            echo "<a class='dropdown-item' href='historicoTabela.php?idConta={$conta['idConta']}'>Histórico da conta</a>";
            echo "</div>";
            echo "</div>";
            echo "<a class='btn btn-warning float-right mx-1' href='contaReplicar.php?idConta={$conta['idConta']}'>
                                     Replicar
                                     </a>";
            echo "<a class='btn btn-info float-right mx-1'
                                     href='alterarEstadoConta.php?idConta={$conta['idConta']}&idMorador={$registro['idMorador']}&estado={$conta['estado']}'>Abrir</a>";
            echo "</td>";
          }
        }
        ?>
      </tbody>
    </table>

  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/datatables.js"></script>
  <script type="text/javascript" src="js/moradorTabela.js"></script>

</body>

</html>
