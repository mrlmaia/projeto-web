<?php

    require_once('tipoBiblioteca.php');
    $nome = $_POST['nome'];
    $idTipo = $_POST['idTipo'];

    $resultado = verificarNome($nome, $idTipo);

    if($resultado == 0){
        echo "true";
    } else{
        echo "false";
    }  

?>