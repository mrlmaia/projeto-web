<?php
session_start();
require('contaBiblioteca.php');
require('tipoBiblioteca.php');
require('moradorBiblioteca.php');
require('rateioBiblioteca.php');

$moradores = listarMorador();
$tipos = listarTipo();
$listarRateio = listarRateio();
$rateiosConta = [];

$idConta = 0;
$valor = "";
$descricao = "";
$idTipo = "";
$idMoradorResponsavel = "";
$dataVencimento = "";
$estado = "";
$observacao = "";
$valorRateio = "";
$nomeResponsavel = "";

if (isset($_GET["acao"])) {
  $acao = $_GET["acao"];
} else {
  echo "<script>alert('Erro de acesso.');</script>";
  echo "<script>location.href='contaTabela.php';</script>";
}

if (isset($_GET["idConta"])) {
  $registro = buscarConta($_GET["idConta"]);
  $idConta = $registro['idConta'];
  $valor = str_replace('.', ',', $registro['valor']);
  $descricao = $registro['descricao'];
  $observacao = $registro['observacao'];
  $idTipo = $registro['idTipo'];
  $idMoradorResponsavel = $registro['idMoradorResponsavel'];
  $dataVencimento = $registro['dataVencimento'];
  $estado = $registro['estado'];
  $idMorador = $registro['idMoradorResponsavel'];

  $rateiosConta = listarRateioPorConta($idConta);
}
?>

<html>

<head>
  <meta charset="utf-8" />
  <title> Projeto Web | Conta </title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <?php
  $pagina = "conta";
  require_once('menu.php');
  ?>

  <div class="container my-4 ">

    <h3>Informações da conta</h3>

    <form id="formulario" action="contaSalvar.php" method="post">

      <?php
      if ($acao == "visualizar") {
        echo "<fieldset disabled='disabled'>";
      } else {
        echo "<fieldset>";
      }
      ?>
      <div class="row form-group">
        <input class="form-control" id="idConta" name="idConta" value="<?php echo $idConta ?>" type="hidden">
      </div>

      <div class="row form-group mb-2">
        <div class="col-md-4">
          <label for="idMoradorResponsavel">Morador responsável</label>
          <select class="form-control" name="idMoradorResponsavel" id="idMoradorResponsavel">
            <?php
            if ($idMoradorResponsavel == 0) {
              echo "<option value='' disabled selected>Selecione um morador responsável</option>";
              foreach ($moradores as $morador) {
                echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";
              }
            } else {
              foreach ($moradores as $morador) {
                if ($morador['idMorador'] != $idMorador) {
                  echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";
                } else {
                  echo "<option selected value='{$morador['idMorador']}'>{$morador['nome']}</option>";
                }
              }
            }

            ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="idTipo">Tipo</label>
          <select class="form-control" name="idTipo" id="idTipo">
            <?php
            if ($idTipo == 0) {
              echo "<option value='' disabled selected>Selecione um tipo de conta</option>";
              foreach ($tipos as $tipo) {
                echo "<option value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
              }
            } else {
              foreach ($tipos as $tipo) {
                if ($tipo['idTipo'] != $idTipo) {
                  echo "<option value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
                } else {
                  echo "<option selected value='{$tipo['idTipo']}'>{$tipo['nome']}</option>";
                }
              }
            }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="valor">Valor</label>
          <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $valor ?>" placeholder="Informe o valor">
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-4">
          <label for="dataVencimento">Data de vencimento</label>
          <input type="date" class="form-control" id="dataVencimento" name="dataVencimento" value="<?php echo $dataVencimento ?>">
        </div>
        <div class="col-md-4">
          <label for="estado">Estado</label>
          <select class="form-control" name="estado" id="estado">
            <?php
            if ($estado == 0) {
              echo "<option selected value='0'>Aberta</option>";
              echo "<option value='1'>Fechada</option>";
            } else {
              echo "<option selected value='1'>Fechada</option>";
              echo "<option value='0'>Aberta</option>";
            }
            ?>

          </select>
        </div>
        <div class="col-md-4">
          <label for="descricao">Descrição</label>
          <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Informe uma descrição" value="<?php echo $descricao ?>">
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-12">
          <label for="observacao">Observação</label>
          <textarea type="text" class="form-control" id="observaçao" rows="4" name="observacao" placeholder="Adicione uma observação"><?php echo $observacao ?></textarea>
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-12">
          <a class="btn btn-primary" href="contaTabela.php">Voltar</a>

          <button type="submit" class="btn btn-success float-right mx-1">Salvar</button>
          <button type="reset" class="btn btn-danger float-right">Cancelar</button>
        </div>
      </div>
  </div>
  </fieldset>
  </form>


  <?php
  if ($acao == "cadastrar") {
    echo "<div hidden>";
  } else {
    echo "<div>";
  }
  ?>
  <div class="container">
    <div class="card mb-5">
      <div class="card-header">Rateios dessa conta</div>
      <div class="card-body">
        <form id="formularioRateioConta" action="rateioContaSalvar.php" method="post">
          <?php
          if ($acao == "visualizar") {
            echo "<fieldset disabled='disabled'>";
          } else {
            echo "<fieldset>";
          }
          ?>

          <div class="row form-group">
            <div class="col-md-12">
              <input class="form-control" id="idRateio" name="idRateio" value="<?php echo $idRateio ?>" type="hidden">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input class="form-control" id="idConta" name="idConta" value="<?php echo $idConta ?>" type="hidden">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-4">
              <label for="idMorador">Morador</label>
              <select class="form-control" name="idMorador" id="idMorador">
                <?php
                if ($idMorador == 0) {
                  echo "<option value='' disabled selected>Selecione um morador</option>";
                  foreach ($moradores as $morador) {
                    echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";
                  }
                } else {
                  foreach ($moradores as $morador) {
                    if ($morador['idMorador'] != $idMorador) {
                      echo "<option value='{$morador['idMorador']}'>{$morador['nome']}</option>";
                    } else {
                      echo "<option selected value='{$morador['idMorador']}'>{$morador['nome']}</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-md-3">
              <label for="valorRateio">Valor</label>
              <input type="text" class="form-control" id="valorRateio" name="valorRateio" value="" placeholder="Informe o valor">
            </div>
            <div class="col-md-4">
              <label for="situacao">Situação</label>
              <select class="form-control" name="situacao" id="situacao">
                <option disabled selected value="">Selecione a situação do rateio</option>
                <option value="1">Pago</option>
                <option value="2">Em débito</option>
              </select>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-success btn-lg my-4">+</button>
            </div>
            <div>
              </fieldset>
        </form>

        <table class="table table-hover" id="tabela">
          <thead class='m-2'>
            <tr class="bg-primary text-light">
              <th scope="col">Morador</th>
              <th scope="col">Valor (R$)</th>
              <th scope="col">Situação</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($rateiosConta as $rateioConta) {
              $morador = buscarMorador($rateioConta['idMorador']);

              if ($rateioConta['situacao'] == 1) {
                $estado = "Pago";
              } else {
                $estado = "Em débito";
              }

              $valorFormatado = number_format($rateioConta['valor'], 2, ",", ".");

              echo "<tr>";
              echo "<td>{$morador['nome']}</td>";
              echo "<td>{$valorFormatado}</td>";
              echo "<td>{$estado}</td>";
              if ($acao == "visualizar") {
                echo "<td><a class='btn btn-danger float-right mx-2 disabled' href='rateioExcluir.php?idRateio={$rateioConta['idRateio']}&idConta={$rateioConta['idConta']}'>Excluir</a>
                                            </td>";
              } else {
                echo "<td><a class='btn btn-danger float-right mx-2' href='rateioExcluir.php?idRateio={$rateioConta['idRateio']}&idConta={$rateioConta['idConta']}'>Excluir</a>
                                                </td>";
              }
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script type="text/javascript" src="js/contaFormulario.js"></script>
</body>

</html>
