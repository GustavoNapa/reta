<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // include conexão
	include_once '../../../global/controller/conexao/conexao_pdo.php';
	include_once 'global/controller/conexao/conexao_pdo.php';
	include_once '../../../global/controller/config.php';
	include_once 'global/controller/config.php';
	include_once '../../../page-sistema/include/functions/functions.php';
	include_once 'page-sistema/include/functions/functions.php';
	include_once '../../../page-sistema/cadastrobasico/function/cadastrobasico.php';
	include_once 'page-sistema/cadastrobasico/function/cadastrobasico.php';

	switch ($_POST['acao']) {

		case 'validarcampo':
			if ( $_POST['id']=="" ) {
				$getUsuario = fd_getProcedimento( array($_POST['campo'] => $_POST['valor'] ) );
			}else{
				$getUsuario = fd_getProcedimento( array($_POST['campo'] => $_POST['valor']), ' AND P.`prc_id`!='.$_POST['id'] );
			}

			if ( $getUsuario[0]=="SUCESSO" && $getUsuario[1]>0 ) {
				echo "INDISPONIVEL||Controle de duplicidade";
			}else{
				echo "DISPONIVEL||Controle de duplicidade";
			}
		break;

		case 'salvarcadastro':

			// print_r($_POST);
			// exit;

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarbasico!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar cadastro básico!";
				exit;
			}

			$campoId 	= $_POST['prefixo']."_id";
			$campoNome 	= $_POST['prefixo']."_nome";

			if ( $_POST['id']=="" ) {
				$valida_nome = getCadastroBasico( $_POST['tabela'], array( $campoNome => $_POST['nome'] ) );
			}else{
				$valida_nome = getCadastroBasico( $_POST['tabela'], array( $campoNome => $_POST['nome']), ' AND '.$campoId.'!='.$_POST['id'] );
			}

			if ( $valida_nome[0]=="SUCESSO" && $valida_nome[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Este registro já existe no sistema!";
			}

			if ( $_POST['modal']=="basico" ) {
				if ( $_POST['id']=="0" ) {
					$s_cadastro = "INSERT INTO `".DB_PREFIX."_".$_POST['tabela']."` ( `".$_POST['prefixo']."_status`, `".$_POST['prefixo']."_nome`, `".$_POST['prefixo']."_dtcad`,  `".$_POST['prefixo']."_dtalter`, `".$_POST['prefixo']."_usualter`) VALUES ( :_status, :_nome, now(), now(), :usuario )";
				} else {
					$s_cadastro = "UPDATE `".DB_PREFIX."_".$_POST['tabela']."` SET `".$_POST['prefixo']."_status`=:_status, `".$_POST['prefixo']."_nome`=:_nome, `".$_POST['prefixo']."_dtalter`=now(), `".$_POST['prefixo']."_usualter`=:usuario WHERE `".$_POST['prefixo']."_id`=:_id";
				}
				
			}else{
				print_r("NÃO ESTÁ PRONTO!");
				exit;
			}

			try {
				$conexao->beginTransaction();

				$r_cadastro = $conexao->prepare($s_cadastro);

				if ( $_POST['modal']!="basico" ) {
					print_r("NÃO ESTÁ PRONTO!");
					exit;
				}
				
				if ( $_POST['id']!="0" ) {
					$r_cadastro->bindParam(':_id',	$_POST['id'] );
				}

				// tem em todos!
				$r_cadastro->bindParam(':_status', 	$_POST['status'] );
				$r_cadastro->bindParam(':_nome', 	$_POST['nome'] );
				$r_cadastro->bindParam(':usuario', 	$_SESSION[SS_PREFIX.'_USUARIO']->usu_id );

				if ( $r_cadastro->execute() ) {

					$_idCadastro = $conexao->lastInsertId();
					
					if ( $_POST['id']=="0" ) {
						echo "SUCESSO||Novo registro cadastrado||".$_idCadastro;
					} else {
						echo "SUCESSO||Registro atualizado!";
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;
		
		default:
			echo "ERROGRAVE||Ação desconhecida";
	    	exit;
		break;
	} // fim so switch post acao

?>