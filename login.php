<html>

<head>
  <meta charset="utf-8">
  <title>Projeto-Web | Login</title>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="css/estilo.css" />
</head>

<body>
  <div class="container mt-5 w-50">
    <h1>Login</h1>
    <form id="formulario" action="loginAutenticar.php" method="post">
      <div class="form-group">
        <div class="my-3">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control" id="email" placeholder="Insira seu email">
        </div>
        <div class="my-3">
          <label for="senha">Senha</label>
          <input type="password" name="senha" class="form-control" id="senha" placeholder="Insira sua senha">
        </div>

      </div>
      <a href="loginEsqueceuSenha.php"><small id="recuperarSenha" class="form-text text-primary">Esqueci a senha</small></a>
      <button type="submit" class="btn btn-primary float-right">Entrar</button>
    </form>
  </div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
</body>

</html>
