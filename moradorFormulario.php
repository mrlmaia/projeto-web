<?php
session_start();
require('moradorBiblioteca.php');
$idMorador = 0;
$nome = "";
$cpf = "";
$email = "";
$celular = "";
$dataNascimento = "";
$contato = "";
$foto = "";
$senha = "";

if (isset($_GET["idMorador"])) {
  $registro = buscarMorador($_GET["idMorador"]);
  $idMorador = $registro['idMorador'];
  $nome = $registro['nome'];
  $cpf = $registro['CPF'];
  $email = $registro['email'];
  $celular = $registro['celular'];
  $dataNascimento = $registro['dataNascimento'];
  $contato = $registro['contato'];
  $foto = $registro['foto'];
  $senha = $registro['senha'];
}
$moradores = listarMorador();
?>

<html>

<head>
  <meta charset="utf-8" />
  <title> Projeto-Web | Morador </title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <?php
  $pagina = "morador";
  require_once('menu.php');
  ?>

  <div class="container mt-4">
    <h3 class="my-3">Informações do morador</h3>
    <form id="formulario" action="moradorSalvar.php" method="post" enctype="multipart/form-data">
      <div>
        <div class="row form-group">
          <div class="col-md-12">
            <input class="form-control" id="idMorador" name="idMorador" value="<?php echo $idMorador ?>" type="hidden">
          </div>
          <div class="col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome ?>" placeholder="Informe seu nome">
          </div>
          <div class="col-md-6">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf ?>" placeholder="Informe seu CPF">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" placeholder="Informe seu email">
          </div>
          <div class="col-md-6">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" value="<?php echo $senha ?>" placeholder="Sua senha será enviada no email cadastrado nesse formulário." readonly>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-4">
            <label for="dataNascimento">Data de nascimento</label>
            <input type="date" class="form-control" name="dataNascimento" value="<?php echo $dataNascimento ?>" id="dataNascimento">
          </div>
          <div class="col-md-4">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $celular ?>" placeholder="Informe seu celular">
          </div>
          <div class="col-md-4">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" value="<?php echo $foto ?>"></input>
          </div>

        </div>
        <div class="row form-group">
          <div class="col-md-12">
            <label for="contato">Contatos</label>
            <textarea type="text" class="form-control" id="contato" rows="4" name="contato" placeholder="Informe um contato"><?php echo $contato ?></textarea>
          </div>
        </div>
        <div class="row form-group">
        </div>

        <div class="row form-group">
          <div class="col-md-12">
            <a class="btn btn-primary" href="moradorTabela.php">Voltar</a>
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
  <script type="text/javascript" src="js/moradorFormulario.js"></script>
</body>

</html>
