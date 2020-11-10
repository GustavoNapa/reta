<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

	function sc_getLoja($arr_where="", $_group=" ", $_order=" "){

        // include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $arrRetorno = array();

        if ($arr_where!="") {
        	foreach ($arr_where as $campo => $valor) {
        		if ($_where=="") {
        			$_where = " WHERE P.`".$campo."`=:".$campo;
        		} else {
        			$_where .= " AND P.`".$campo."`=:".$campo;
        		}
        		
        	}
        }

        $select_pro = "	SELECT * FROM ".DB_PREFIX."_produto P 
	                        	".$_where."
	                        	".$_group."
	                        	".$_order;

		try{ 
			$r_produto 		= $conexao->prepare($select_pro);

			if ($_where!="") {
				foreach ($arr_where as $campo => $valor) {
					$r_produto->bindParam(":".$campo, $valor);
				}
			}

			if ($r_produto->execute()) {
				array_push($arrRetorno, "SUCESSO");
				array_push($arrRetorno, $r_produto->rowCount());
				array_push($arrRetorno, $r_produto->fetchAll(PDO::FETCH_OBJ));
				// array_push($arrRetorno, $select_pro);
			}

		}catch(PDOException $e){
			array_push($arrRetorno, "ERROGRAVE");
			array_push($arrRetorno, $e);
		} // se nao der certo faça isso

        return $arrRetorno;
    }
?>