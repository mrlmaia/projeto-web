<?php

    require_once('bancoDadosBiblioteca.php');

    function salvarRateio($idRateio, $valor, $situacao, $idMorador, $idConta){
        try {
            $situacaoConexao = FALSE;
            $conexao = criarConexao();

            if($idRateio == 0){
                $sql = "INSERT INTO tbRateio(valor, situacao, idMorador, idConta) VALUES(:valor, :situacao, :idMorador, :idConta);";

                $resultado = $conexao->prepare($sql);
                $resultado->bindValue(':valor', $valor);
                $resultado->bindValue(':situacao', $situacao);
                $resultado->bindValue(':idMorador', $idMorador);
                $resultado->bindValue(':idConta', $idConta);

            }else{
                $sql = "UPDATE tbRateio SET valor = :valor, situacao = :situacao, idMorador = :idMorador, idConta = :idConta";
                $resultado = $conexao->prepare($sql);
                $resultado->bindValue(':idRateio', $idRateio);
                $resultado->bindValue(':valor', $valor);
                $resultado->bindValue(':situacao', $situacao);
                $resultado->bindValue(':idMorador', $idMorador);
                $resultado->bindValue(':idConta', $idConta);
            }

            $resultado->execute();

            fecharConexao($conexao);

            if($resultado->rowCount() == 1){
                $situacaoConexao = TRUE;

            }

        } catch (PDOException $erro){
            criarArquivo($erro);
        }
        return $situacaoConexao;

    }

    function listarContaPorRateio($idConta){
        try{
            $sql = "SELECT * FROM tbRateio WHERE idConta = :idConta";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':idConta', $idConta);
            $resultado->execute();
            $registros = $resultado->fetchAll();
            fecharConexao($conexao);
        } catch (PDOException $erro){
            criarArquivo($erro);
        }
        return $registros;
    }

    function listarRateio(){
        try{
            $sql = "SELECT * FROM tbRateio;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->execute();
            $registros = $resultado->fetchAll();
            fecharConexao($conexao);

        } catch (PDOException $erro){
            criarArquivo($erro);
        }
        return $registros;
    }

    function excluirRateio($idRateio){
        try{
            $situacao = FALSE;
            $sql = "DELETE FROM tbRateio WHERE idRateio = :idRateio;";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':idRateio', $idRateio);
            $resultado->execute();
            fecharConexao($conexao);

            if($resultado->rowCount() == 1){
                $situacao = TRUE;
            }

        } catch (PDOException $erro){
            criarArquivo($erro);
        }
        return $situacao;
    }

    function buscarRateio($idRateio){
        try {
            $sql = "SELECT * FROM tbRateio WHERE idRateio = :idRateio";
            $conexao = criarConexao();
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':idRateio', $idRateio);
            $resultado->execute();
            $registro = $resultado->fetch();
            fecharConexao($conexao);

        } catch (PDOException $erro){
            criarArquivo($erro);
        }
        return $registro;
    }

    function replicarRateio($idConta, $novoIdConta){
        $situacao = FALSE;
        try{
            $conexao = criarConexao();
            $sql = "INSERT INTO tbRateio(valor, situacao, idMorador, idConta) SELECT valor, situacao, idMorador, :novoIdConta FROM tbRateio WHERE idConta = :idConta;";
            $resultado = $conexao->prepare($sql);
            $resultado->bindValue(':novoIdConta', $novoIdConta);
            $resultado->bindValue(':idConta', $idConta);
            $resultado->execute();
            fecharConexao($conexao);
            if($resultado->rowCount() > 0){
                $situacao = TRUE;
            }
        }catch (PDOException $erro){
            criarArquivo($erro);
        }
        return $situacao;
    }
