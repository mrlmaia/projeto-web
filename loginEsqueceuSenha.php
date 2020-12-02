<html>
    <head>
		<meta charset="utf-8">
		<title>Projeto-Web | Esqueci a senha</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
    </head>

    <body>	
		<div class="container mt-5">
            <div class="card mb-3 mt-3">
                <div class="card-header">Login | Recuperar senha </div>
                    <div class="card-body">
                    <div class="row d-flex justify-content-center">
                            <img class='fotoLogo' src='logo.png'>
                        </div>
                        <h5 class="mt-2 mb-3" id="border">Para recuperar a senha, informe:</h5>
                        <form id="formulario" action="loginRecuperar.php" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Informe seu email">
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Informe seu CPF">
                            </div>
                            <a class="btn btn-primary" href="index.php">Voltar</a>
                            <button type="submit" class="btn btn-success float-right">Recuperar</button>

                        </form>
			
		            </div>	
                </div>
            </div>
        </div>    

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/loginEsqueceuSenha.js"></script>
    </body>
</html>