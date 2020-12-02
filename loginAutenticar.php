<?php
session_start();
require('moradorBiblioteca.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$registro = autenticarUsuario($email, $senha);

if ($registro != NULL) {
  $_SESSION['usuario'] = $registro;
  echo "<script>location.href='principal.php';</script>";
} else {
  echo "<script>alert('E-mail ou senha inválidos.'); location.href='login.php';</script>";
}
