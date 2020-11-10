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

	include_once '../../../page-sistema/produto/function/produto.php';
	include_once 'page-sistema/produto/function/produto.php';

	fgb_atualizarusuariologado();
	$usu_id = $_SESSION[SS_PREFIX.'_USUARIO']->usu_id;

	header("Content-Type: text/plain; charset=utf-8");
	// header("Content-Type: application/json; charset=UTF-8");
	// print_r($_FILES); exit;
		// [pro_ambiente2-3] => Array
		// 	[name] => download.jpg
		// 	[type] => image/jpeg
		// 	[tmp_name] => C:\wamp64\tmp\php459D.tmp
		// 	[error] => 0
		// 	[size] => 8885

	if ( !is_array($_FILES) ) {
		echo "ERROGRAVE||Falha! Erro ao enviar informações!";
	}else{

		foreach ($_FILES as $key => $pro_ambiente) {

			// pro_ambiente2-3
			$arrDados 	= explode("-", $key);
			$campo		= $arrDados[0];
			$pro_id		= $arrDados[1];

			$getLoja = sc_getLoja( array('pro_id' => $pro_id ) );
		
			if ( $getLoja[0]!="SUCESSO" && $getLoja[1]!=1 ) {
				echo "ERROGRAVE||Loja não encontrada! Atualize e tente novamente!";
	            exit;
			}

			$_produto=$getLoja[2][0];

			foreach ($_produto as $coluna => $info) {
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

			$extensao = explode(".", $pro_ambiente['name']);
			$nome_aleatorio = $nome_aleatorio.'.'.$extensao[1];

			$s_produto = "UPDATE `acb_produto` SET `".$campo."`=:nome_aleatorio,  `pro_dtalter`=now(), `pro_usualter`=:usuario WHERE `pro_id`=:pro_id";

			try {
				$conexao->beginTransaction();
				$r_produto = $conexao->prepare($s_produto);
				$r_produto->bindParam(':nome_aleatorio', 		$nome_aleatorio );
				$r_produto->bindParam(':pro_id', 				$pro_id );
				$r_produto->bindParam(':usuario', 				$usu_id );

				if ( $r_produto->execute() ) {
					if( $pro_ambiente['tmp_name'] ){
						if (move_uploaded_file($pro_ambiente['tmp_name'], '../media/'.$nome_aleatorio)) {
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
						echo "ERROGRAVE||Erro ao salvar a imagem no diretório!||TMP_NAME: ".$pro_ambiente['tmp_name'].' - Count: '.count($pro_ambiente['tmp_name']);
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