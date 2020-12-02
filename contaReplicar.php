<?php
require('contaBiblioteca.php');
require('rateioBiblioteca.php');

$idConta = $_GET['idConta'];

$novoIdConta = replicarConta($idConta);

if ($novoIdConta > 0) {
	replicarRateio($idConta, $novoIdConta);
	echo "<script> alert('Conta duplicada com sucesso!'); </script>";
	echo "<script> location.href='contaFormulario.php?acao=editar&idConta={$novoIdConta}';</script>";
} else {
	echo "<script> alert('Erro ao replicar conta.'); </script>";
	echo "<script> location.href='contaTabela.php'; </script>";
}
?>

<?php
// require('treinoBiblioteca.php');
// require('treinoExercicioBiblioteca.php');

// $idTreino = $_GET["idTreino"];

// $novoIdTreino = duplicarTreino($idTreino);

// if($novoIdTreino > 0){
// 	duplicarTreinoExercicio($idTreino, $novoIdTreino);
// 	echo "<script> alert('Registro duplicado com sucesso!'); </script>";
// 	echo "<script> location.href='treinoFormulario.php?acao=editar&idTreino={$novoIdTreino}';</script>"; 
// }else{
// 	echo "<script> alert('Erro ao duplicar o registro'); </script>"; 
// 	echo "<script> location.href='treinoTabela.php'; </script>";
// }
?>