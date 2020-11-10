<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

	function getTotalCadastroBasico($_tabela) {
		// include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $s_count = "SELECT COUNT(*) as total FROM ".DB_PREFIX."_".$_tabela;

        try{ 
			$r_count 		= $conexao->prepare($s_count);

			if ($r_count->execute()) {
				// array_push($arrRetorno, "SUCESSO");
				// array_push($arrRetorno, $r_count->rowCount());
				// array_push($arrRetorno, $r_count->fetchAll(PDO::FETCH_OBJ));
				return $r_count->fetchAll(PDO::FETCH_OBJ)[0]->total;
			}

		}catch(PDOException $e){
			// array_push($arrRetorno, "ERROGRAVE");
			// array_push($arrRetorno, $e);
			return $e;
		} // se nao der certo faça isso

		// return $arrRetorno;
	}

	function getCadastroBasico($_tabela, $arr_where="", $_param=""){

        // include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $arrRetorno = array();

        if ($arr_where!="") {
        	foreach ($arr_where as $campo => $valor) {
        		if ($_where=="") {
        			$_where = " WHERE `".$campo."`=:".$campo;
        		} else {
        			$_where .= " AND `".$campo."`=:".$campo;
        		}
        	}
        }

        $s_tabela = "SELECT * FROM ".DB_PREFIX."_".$_tabela."
                    	".$_where."
                    	".$_param;

        try{ 
			$r_tabela = $conexao->prepare($s_tabela);

			if ($_where!="") {
				foreach ($arr_where as $campo => $valor) {
					$r_tabela->bindParam(":".$campo, $valor);
				}
			}

			if ($r_tabela->execute()) {
				array_push($arrRetorno, "SUCESSO");
				array_push($arrRetorno, $r_tabela->rowCount());
				array_push($arrRetorno, $r_tabela->fetchAll(PDO::FETCH_OBJ));
				array_push($arrRetorno, $s_tabela);
			}

		}catch(PDOException $e){
			array_push($arrRetorno, "ERROGRAVE");
			array_push($arrRetorno, $e);
		} // se nao der certo faça isso

        return $arrRetorno;
    }
?>