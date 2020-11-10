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
	
	function fd_getBasicoUsuarioOLD($basic_status=""){

        // include conexao
        include '../../../global/controller/conexao/conexao_pdo.php';
		include 'global/controller/conexao/conexao_pdo.php';
		include '../../../global/controller/config.php';
		include 'global/controller/config.php';

        $arrRetorno = array();

        if ( $basic_status!="" ) {
        	$w_nivelacesso 		= " WHERE `nva_status`=:basic_status";
        	$w_sexo 			= " WHERE `sex_status`=:basic_status";
        	$w_estadocivil 		= " WHERE `ecv_status`=:basic_status";
        	$w_setor 			= " WHERE `set_status`=:basic_status";
        }else{
        	$w_nivelacesso 		= "";
        	$w_sexo 			= "";
        	$w_estadocivil 		= "";
        	$w_setor 			= "";
        }


        $s_nivelacesso 		= "	SELECT * FROM ".DB_PREFIX."_nivelacesso ".$w_nivelacesso;
        $s_sexo 			= "	SELECT * FROM ".DB_PREFIX."_sexo ".$w_sexo;
		$s_estadocivil 		= "	SELECT * FROM ".DB_PREFIX."_estadocivil ".$w_estadocivil;		
		$s_setor 			= "	SELECT * FROM ".DB_PREFIX."_setor ".$w_setor;		

		try{ 
			$r_nivelacesso 		= $conexao->prepare($s_nivelacesso);
			$r_sexo 			= $conexao->prepare($s_sexo);
			$r_estadocivil 		= $conexao->prepare($s_estadocivil);
			$r_setor 			= $conexao->prepare($s_setor);

			if ( $basic_status!="" ) {
				$r_nivelacesso->bindParam(":basic_status", $basic_status);
				$r_sexo->bindParam(":basic_status", $basic_status);
				$r_estadocivil->bindParam(":basic_status", $basic_status);
				$r_setor->bindParam(":basic_status", $basic_status);
			}

			if ( $r_nivelacesso->execute() ) {
				if ( $r_sexo->execute() ) {
					if ( $r_estadocivil->execute() ) {
						if ( $r_setor->execute() ) {
							array_push($arrRetorno, "SUCESSO");

							$arrRetorno[DB_PREFIX."_nivelacesso"] = array(
								'total' => $r_nivelacesso->rowCount(), 
								'resultado' => $r_nivelacesso->fetchAll(PDO::FETCH_OBJ), 
							);

							$arrRetorno[DB_PREFIX."_sexo"] = array(
								'total' => $r_sexo->rowCount(), 
								'resultado' => $r_sexo->fetchAll(PDO::FETCH_OBJ), 
							);

							$arrRetorno[DB_PREFIX."_estadocivil"] = array(
								'total' => $r_estadocivil->rowCount(), 
								'resultado' => $r_estadocivil->fetchAll(PDO::FETCH_OBJ), 
							);

							$arrRetorno[DB_PREFIX."_setor"] = array(
								'total' => $r_setor->rowCount(), 
								'resultado' => $r_setor->fetchAll(PDO::FETCH_OBJ), 
							);
						}
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