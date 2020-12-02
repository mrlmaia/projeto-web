<?php
 session_start();
    require('moradorBiblioteca.php');
    require('historicoBiblioteca.php');
	require('contaBiblioteca.php');
    require('tipoBiblioteca.php');
    
    $idConta = $_GET['idConta'];

    $historicos = listarHistoricoPorConta($idConta);
    
?>

<html>
    <head>
		<meta charset="utf-8"/>
		<title> Projeto-Web | Conta | Histórico </title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
    </head>
    <body>
        <!-- BARRA DE  NAVEGACAO -->
        <?php	
            $pagina = "conta";				
            require_once('menu.php'); 
        ?>	

        <!-- MIGALHA DE PAO KKKKKKKKKKKKKKKK-->
            <div class="container mt-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="principal.php">Início</a></li>
                        <li class="breadcrumb-item"><a href="contaTabela.php">Conta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Histórico: Conta <?php echo $idConta?></li>
                    </ol>
                </nav>
            </div>


        <!-- TABELA -->
        <div class="container mt-3">
            <a class="btn btn-success" href="contaTabela.php">Voltar</a>
        </div>

        <div class="container mt-5">

            <table class="table table-striped table-hover" id="tabela">
                <thead>
                    <tr class="bg-primary text-light">
                    <th scope="col">Estado</th>
                    <th scope="col">Data</th>
                    <th scope="col">Conta</th>
                    <th scope="col">Morador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php	
						foreach($historicos as $historico){
                            $morador = buscarMorador($historico['idMorador']);
                            $conta = buscarConta($historico['idConta']);
                            $tipo = buscarTipo($conta['idTipo']);

                            $data = date_create($historico['data']);
                            $dataFormatada = date_format($data, 'd/m/Y H:i:s');
                            
                            if($historico['estado'] == 1){
                                $estado = "Aberta";
                            }else{
                                $estado = "Fechada";
                            }

                            echo "<td>{$estado}</td>";
							echo "<td>{$dataFormatada}</td>";
                            echo "<td>{$tipo['nome']}</td>";
                            echo "<td>{$morador['nome']}</td>";
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