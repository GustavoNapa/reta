<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

	function fd_getCliente($arr_where="", $_group=" ", $_order=" "){

        // include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $arrRetorno = array();

        if ($arr_where!="") {
        	foreach ($arr_where as $campo => $valor) {
        		if ($_where=="") {
        			$_where = " WHERE C.`".$campo."`=:".$campo;
        		} else {
        			$_where .= " AND C.`".$campo."`=:".$campo;
        		}
        		
        	}
        }

        $select_cli = "	SELECT C.`cli_id`, C.`cli_cpfcnpj`, C.`cli_nome`, C.`cli_idsexo`, C.`cli_idestadocivil`, C.`cli_dtnasc`, C.`cli_idmotivobloqueio`, C.`cli_dtbloqueio`, C.`cli_nomecartao`, C.`cli_email`, C.`cli_telefone`, C.`cli_celular`, C.`cli_contato`, R.`end_cep`, R.`end_logradouro`, R.`end_numero`, R.`end_complemento`, R.`end_bairro`, R.`end_cidade`, R.`end_estado`, R.`end_pais`, C.`cli_observacao`
        					FROM ".DB_PREFIX."_cliente C 
	            				INNER JOIN ".DB_PREFIX."_sexo S 
	            					ON S.`sex_id`=C.`cli_idsexo`
	            				INNER JOIN ".DB_PREFIX."_estadocivil E 
	            					ON E.`ecv_id`=C.`cli_idestadocivil`
	            				LEFT JOIN ".DB_PREFIX."_endereco R 
	            					ON R.`end_id`=C.`cli_idendereco`
	            				LEFT JOIN ".DB_PREFIX."_motivobloqueio M 
	            					ON M.`mtb_id`=C.`cli_idmotivobloqueio`
	                            LEFT JOIN ".DB_PREFIX."_cliente D ON D.`cli_iddependente`=C.`cli_id`
	                        	".$_where."
	                        	".$_group."
	                        	".$_order;

		try{ 
			$r_cliente = $conexao->prepare($select_cli);

			if ($_where!="") {
				foreach ($arr_where as $campo => $valor) {
					$r_cliente->bindParam(":".$campo, $valor);
				}
			}

			if ($r_cliente->execute()) {
				array_push($arrRetorno, "SUCESSO");
				array_push($arrRetorno, $r_cliente->rowCount());
				array_push($arrRetorno, $r_cliente->fetchAll(PDO::FETCH_OBJ));
			}

		}catch(PDOException $e){
			array_push($arrRetorno, "ERROGRAVE");
			array_push($arrRetorno, $e);
		} // se nao der certo faça isso

        return $arrRetorno;
    }
	
	function fd_getBasicoCliente($basic_status=""){

        // include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $arrRetorno = array();

        if ( $basic_status!="" ) {
        	$w_sexo 			= " WHERE `sex_status`=:basic_status";
        	$w_estadocivil 		= " WHERE `ecv_status`=:basic_status";
        	$w_motivobloqueio	= " WHERE `mtb_status`=:basic_status";
        }else{
        	$w_sexo 			= "";
        	$w_estadocivil 		= "";
        	$w_motivobloqueio	= "";
        }


        $s_sexo 			= "	SELECT * FROM ".DB_PREFIX."_sexo ".$w_sexo;
		$s_estadocivil 		= "	SELECT * FROM ".DB_PREFIX."_estadocivil ".$w_estadocivil;
		$s_motivobloqueio 	= "	SELECT * FROM ".DB_PREFIX."_motivobloqueio ".$w_motivobloqueio;
		

		try{ 
			$r_sexo = $conexao->prepare($s_sexo);
			$r_estadocivil = $conexao->prepare($s_estadocivil);
			$r_motivobloqueio = $conexao->prepare($s_motivobloqueio);

			if ( $basic_status!="" ) {
				$r_sexo->bindParam(":basic_status", $basic_status);
				$r_estadocivil->bindParam(":basic_status", $basic_status);
				$r_motivobloqueio->bindParam(":basic_status", $basic_status);
			}

			if ( $r_sexo->execute() ) {
				if ( $r_estadocivil->execute() ) {
					if ( $r_motivobloqueio->execute() ) {
						array_push($arrRetorno, "SUCESSO");

						$arrRetorno[DB_PREFIX."_sexo"] = array(
							'total' => $r_sexo->rowCount(), 
							'resultado' => $r_sexo->fetchAll(PDO::FETCH_OBJ), 
						);

						$arrRetorno[DB_PREFIX."_estadocivil"] = array(
							'total' => $r_estadocivil->rowCount(), 
							'resultado' => $r_estadocivil->fetchAll(PDO::FETCH_OBJ), 
						);

						$arrRetorno[DB_PREFIX."_motivobloqueio"] = array(
							'total' => $r_motivobloqueio->rowCount(), 
							'resultado' => $r_motivobloqueio->fetchAll(PDO::FETCH_OBJ), 
						);
					}
				}
			}

		}catch(PDOException $e){
			array_push($arrRetorno, "ERROGRAVE");
			array_push($arrRetorno, $e);
		} // se nao der certo faça isso

        return $arrRetorno;
    }

?>