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
        			$_where = " WHERE L.`".$campo."`=:".$campo;
        		} else {
        			$_where .= " AND L.`".$campo."`=:".$campo;
        		}
        		
        	}
        }

        $select_emp = "	SELECT * FROM ".DB_PREFIX."_loja L 
	            				LEFT JOIN ".DB_PREFIX."_endereco D 
	            					ON D.`end_id`=L.`loj_idendereco`
	            				LEFT JOIN ".DB_PREFIX."_usuario U 
	            					ON U.`usu_id`=L.`loj_usualter`
	                        	".$_where."
	                        	".$_group."
	                        	".$_order;

		try{ 
			$r_loja 		= $conexao->prepare($select_emp);

			if ($_where!="") {
				foreach ($arr_where as $campo => $valor) {
					$r_loja->bindParam(":".$campo, $valor);
				}
			}

			if ($r_loja->execute()) {
				array_push($arrRetorno, "SUCESSO");
				array_push($arrRetorno, $r_loja->rowCount());
				array_push($arrRetorno, $r_loja->fetchAll(PDO::FETCH_OBJ));
				// array_push($arrRetorno, $select_emp);
			}

		}catch(PDOException $e){
			array_push($arrRetorno, "ERROGRAVE");
			array_push($arrRetorno, $e);
		} // se nao der certo faça isso

        return $arrRetorno;
    }

    function getTotalCadastroBasicoLoja($_tabela) {
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

	function getCadastroBasicoLoja($_tabela, $arr_where="", $_param=""){

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
					$r_tabela->bindValue(":".$campo, $valor);
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

    function getRegiao($reg_idloja){

        // include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $arrRetorno = array();

        $s_tabela = "SELECT r.reg_id, r.reg_status, r.reg_valordelivery, b.bai_id, b.bai_nome, c.cid_id, c.cid_nome, e.est_id, e.est_nome  FROM ".DB_PREFIX."_regiao r
        				INNER JOIN acb_bairro b  ON r.`reg_idbairro`=b.`bai_id`, 
        			acb_bairro b2 INNER JOIN acb_cidade c  ON b2.`bai_idcidade`=c.`cid_id`, 
        			acb_cidade d INNER JOIN acb_estado e  ON d.`cid_idestado`=e.`est_id` 
        			WHERE r.reg_idloja=:reg_idloja group by b.bai_id ";

        try{ 
			$r_tabela = $conexao->prepare($s_tabela);

			$r_tabela->bindValue(":reg_idloja", $reg_idloja);

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