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
                $query_telefone = "INSERT INTO TELEFONES (`NUMBER`, `WHATSAPP`) VALUES (:numero, 0)";

                $resultado_telefone = $conexao->prepare($query_telefone);

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
?>