<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // include global
	include_once '../../../global/controller/conexao/conexao_pdo.php';
	include_once 'global/controller/conexao/conexao_pdo.php';
	include_once '../../../global/controller/config.php';
	include_once 'global/controller/config.php';
	include_once '../../../global/controller/functions.php';
	include_once 'global/controller/functions.php';

	include_once '../../../page-sistema/loja/function/loja.php';
	include_once 'page-sistema/loja/function/loja.php';

	fgb_atualizarusuariologado();
	$usu_id = $_SESSION[SS_PREFIX.'_USUARIO']->usu_id;

	header("Content-Type: text/plain; charset=utf-8");
	// header("Content-Type: application/json; charset=UTF-8");
	// print_r($_FILES); exit;
		// [loj_ambiente2-3] => Array
		// 	[name] => download.jpg
		// 	[type] => image/jpeg
		// 	[tmp_name] => C:\wamp64\tmp\php459D.tmp
		// 	[error] => 0
		// 	[size] => 8885

	if ( !is_array($_FILES) ) {
		echo "ERROGRAVE||Falha! Erro ao enviar informações!";
	}else{

		foreach ($_FILES as $key => $loj_ambiente) {

			// loj_ambiente2-3
			$arrDados 	= explode("-", $key);
			$campo		= $arrDados[0];
			$loj_id		= $arrDados[1];

			$getLoja = sc_getLoja( array('loj_id' => $loj_id ) );
		
			if ( $getLoja[0]!="SUCESSO" && $getLoja[1]!=1 ) {
				echo "ERROGRAVE||Loja não encontrada! Atualize e tente novamente!";
	            exit;
			}

			$_loja=$getLoja[2][0];

			foreach ($_loja as $coluna => $info) {
				if ( $coluna==$campo && !is_null($info) ) {
					$deletarImg = $info;
					break;
				}
			}

			// Cria a pasta se não existir
			if ( !file_exists('../media/')) {
				mkdir('../media/', 0755);
			}

			//  Gerar senha - caracteres utilizados
			$chars = 'acaicombobagenscreampurple';
			$max = strlen($chars)-1;
			$nome_aleatorio = "";
			// tamanho da senha
			$width = 8;
			for($i=0; $i < $width; $i++){
				$nome_aleatorio .= $chars{mt_rand(0, $max)};
			}

			$extensao = explode(".", $loj_ambiente['name']);
			$nome_aleatorio = $nome_aleatorio.'.'.$extensao[1];

			$s_loja = "UPDATE `acb_loja` SET `".$campo."`=:nome_aleatorio,  `loj_dtalter`=now(), `loj_usualter`=:usuario WHERE `loj_id`=:loj_id";

			try {
				$conexao->beginTransaction();
				$r_loja = $conexao->prepare($s_loja);
				$r_loja->bindParam(':nome_aleatorio', 		$nome_aleatorio );
				$r_loja->bindParam(':loj_id', 				$loj_id );
				$r_loja->bindParam(':usuario', 				$usu_id );

				if ( $r_loja->execute() ) {
					if( $loj_ambiente['tmp_name'] ){
						if (move_uploaded_file($loj_ambiente['tmp_name'], '../media/'.$nome_aleatorio)) {
							// Deletar imagem
							if ( file_exists('../media/'.$deletarImg)) {
								if ( unlink('../media/'.$deletarImg) ) {
									$log .= "Imagem [".$deletarImg."] deletada!";
								}
							}
							$conexao->commit();
							// TUDO OK
							echo "SUCESSO||Imagem atualizada!";
						}else{
							// Erro
							echo "ERROGRAVE||Erro ao salvar a imagem no diretório!";
							$conexao->rollBack();
						}

					}else{
						echo "ERROGRAVE||Erro ao salvar a imagem no diretório!||TMP_NAME: ".$loj_ambiente['tmp_name'].' - Count: '.count($loj_ambiente['tmp_name']);
						$conexao->rollBack();
					}
				}
			} catch (PDOException $e) {
				echo "ERROGRAVE||Erro ao salvar a imagem no banco de dados!||".$e;
				$conexao->rollBack();
			}
		}	
	}
?>