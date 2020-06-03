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
                echo "INSERTSUCESSO";
                exit;
            } 
            
        }catch(PDOException $e){
            echo 'ERRO: '.$e;
            exit;
        }
    }
?>