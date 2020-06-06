<?php
    $acao = $_POST['acao'];

    include_once "../../config/database.php";

    if($acao == "salvar"){
        try{
            $query = "INSERT INTO CLIENTES (`NAME`, `INTERESSE`) VALUES (:nome, :interesse)";

            $resultado = $conexao->prepare($query);

            $resultado->bindParam(':nome' , $_POST['nome']);
            $resultado->bindParam(':interesse' , $_POST['interesse']);

            if($resultado->execute()){
                $idconexao = $conexao->lastInsertId();

                $query_telefone = "INSERT INTO TELEFONES (`ID_CLIENTE`, `NUMBER`, `WHATSAPP`) VALUES (:idcliente, :numero, 0)";
                
                $resultado_telefone = $conexao->prepare($query_telefone);

                $resultado_telefone->bindParam(':idcliente', $idconexao);
                $resultado_telefone->bindParam(':numero', $_POST['celular']);

                if($resultado_telefone->execute()){
                    echo "INSERTSUCESSO";
                    exit;
                }
            } 
            
        }catch(PDOException $e){
            echo 'ERRO: '.$e;
            exit;
        }
    
    
    }
    if($acao == "salvar_telefone"){
        try{
            $idconexao = $_POST['idCliente'];

            $query_telefone = "INSERT INTO TELEFONES (`ID_CLIENTE`, `NUMBER`, `WHATSAPP`) VALUES (:idcliente, :numero, 0)";
            
            $resultado_telefone = $conexao->prepare($query_telefone);

            $resultado_telefone->bindParam(':idcliente', $idconexao);
            $resultado_telefone->bindParam(':numero', $_POST['celular']);

            if($resultado_telefone->execute()){
                echo "INSERTSUCESSO";
                exit;
            }            
        }catch(PDOException $e){
            echo 'ERRO: '.$e;
            exit;
        }
    
    
    }
?>