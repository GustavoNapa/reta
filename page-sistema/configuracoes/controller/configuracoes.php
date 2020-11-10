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

			// [acao] => salvarcadastro
			// [id] => 2
			// [tabela] => estadocivil
			// [prefixo] => ecv
			// [nome] => Casado
			// [status] => 1
			// getCadastroBasico($_tabela, $arr_where="", $_param="")

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

		case 'pesquisarprocedimento':
			// buscar usuarioS
			$contexto = '%'.$_POST['prc_pesquisar'].'%';

			$like = " P.`prc_id` LIKE '".$contexto."' OR  P.`prc_nome` LIKE '".$contexto."' OR T.`tpc_nome` LIKE '".$contexto."'";

			$getProcedimento = fd_getProcedimento( '' , 'WHERE '.$like.' ORDER BY P.`prc_dtalter` DESC LIMIT '.$_POST['prc_quantidade'] );

			if ( $getProcedimento[0]=="SUCESSO" ) {
				if ($getProcedimento[1]>0 ) {
					echo "SUCESSO||";

					$_procedimentos=$getProcedimento[2];

					foreach ($_procedimentos as $key => $procedimento) {
						$text_status = $procedimento->prc_status==1?'success':'dark';
						$prc_valorcusto = number_format($procedimento->prc_valorcusto, 2, ',', '.');
						echo
						"<tr class='row'>
							<td class='col-12'>
								<div class='row'>
									<div class='col-5 text-left'>
										<i class=\"fas fa-circle text-".$text_status."\"></i>
										".$procedimento->prc_nome."
									</div>
									<div class='col-3 text-left'>
										".$procedimento->tpc_nome."
									</div>
									<div class='col-2 text-left'>
										".$prc_valorcusto."
									</div>
									<div class='col-2 text-right'>
										<a class='btn btn-primary open_cpfcnpj' type='button' href='procedimento?view=formprocedimento&prc_id=".$procedimento->prc_id."'><i class='fas fa-eye'></i></a>
									</div>
								</div>
							</td>
						</tr>";
					}

				} else {
					echo "SUCESSO||";
				}
			} else {
				echo "ERROGRAVE||";
				echo $getProcedimento[1]." \n";
				echo $getProcedimento[2]." \n";
			}
			// echo "LOG: \n";
			// echo $contexto." \n";
		break;
		
		default:
			echo "ERROGRAVE||Ação desconhecida";
	    	exit;
		break;
	} // fim so switch post acao

?>