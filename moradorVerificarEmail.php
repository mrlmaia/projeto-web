<?php

    require_once('moradorBiblioteca.php');

    $email = $_POST['email'];
    $idMorador = $_POST['idMorador'];

    $resultado = verificarEmail($email, $idMorador);

    if($resultado == 0){
        echo "true";
    } else{
        echo "false";
    }    

?>