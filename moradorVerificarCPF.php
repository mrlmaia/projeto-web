<?php

    require_once('moradorBiblioteca.php');

    $cpf = $_POST['cpf'];
    $idMorador = $_POST['idMorador'];

    $resultado = verificarCPF($cpf, $idMorador);

    if($resultado == 0){
        echo "true";
    } else{
        echo "false";
    }  

?>