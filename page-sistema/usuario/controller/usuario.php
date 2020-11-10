<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // include conexão
	include_once '../../../global/controller/conexao/conexao_pdo.php';
	include_once 'global/controller/conexao/conexao_pdo.php';
	include_once '../../../global/controller/config.php';
	include_once 'global/controller/config.php';
	include_once '../../../global/controller/functions.php';
	include_once 'global/controller/functions.php';

	include_once '../../../page-sistema/usuario/function/usuario.php';
	include_once 'page-sistema/usuario/function/usuario.php';

	fgb_atualizarusuariologado();
	$usu_id = $_SESSION[SS_PREFIX.'_USUARIO']->usu_id;

	switch ($_POST['acao']) {

		case 'validarcampo':
			if ( $_POST['usu_id']=="" ) {
				$getUsuario = acb_getUsuario( array($_POST['campo'] => $_POST['valor'] ) );
			}else{
				$getUsuario = acb_getUsuario( array($_POST['campo'] => $_POST['valor']), ' AND U.`usu_id`!='.$_POST['usu_id'] );
			}

			if ( $getUsuario[0]=="SUCESSO" && $getUsuario[1]>0 ) {
				echo "INDISPONIVEL||Controle de duplicidade||".$getUsuario[2][0]->usu_id;
			}else{
				echo "DISPONIVEL||Controle de duplicidade||";
			}
		break;

		case 'validarnivelacesso':
			if ( $_POST['nva_id']=="" ) {
				$getNivelAcesso = acb_getNivelAcesso( array($_POST['campo'] => $_POST['valor'] ) );
			}else{
				$getNivelAcesso = acb_getNivelAcesso( array($_POST['campo'] => $_POST['valor']), ' AND N.`nva_id`!='.$_POST['nva_id'] );
			}

			if ( $getNivelAcesso[0]=="SUCESSO" && $getNivelAcesso[1]>0 ) {
				echo "INDISPONIVEL||Controle de duplicidade";
			}else{
				echo "DISPONIVEL||Controle de duplicidade";
			}
		break;

		case 'salvaracesso':

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarusuario!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar usuário!";
				exit;
			}

			if ( $_POST['nva_id']=="" ) {
				$getNivelAcesso = acb_getNivelAcesso( array($_POST['campo'] => $_POST['valor'] ) );
			}else{
				$getNivelAcesso = acb_getNivelAcesso( array($_POST['campo'] => $_POST['valor']), ' AND N.`nva_id`!='.$_POST['nva_id'] );
			}

			if ( $getNivelAcesso[0]=="SUCESSO" && $getNivelAcesso[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Este nome já está sendo utilizado!";
				exit;
			}

			// $_POST['nva_permitirdesconto'] = $_POST['nva_permitirdesconto']=="on"?1:0;
			// $_POST['nva_abrircaixa'] = $_POST['nva_abrircaixa']=="on"?1:0;

			// // converter em money/float
			// 	$_POST['nva_limitesangria'] = str_replace(".", "", $_POST['nva_limitesangria'] );
			// 	$_POST['nva_limitesangria'] = str_replace(",", ".", $_POST['nva_limitesangria'] );
			// 	$_POST['nva_limitesangria'] = floatval($_POST['nva_limitesangria']);

			// vazio == insert
			if ( $_POST['nva_id']=="" ) {
				$s_acesso = "INSERT INTO `".DB_PREFIX."_nivelacesso`(`nva_status`, `nva_nome`, `nva_gerenciarbasico`, `nva_gerenciarconfiguracao`, `nva_gerenciarcliente`, `nva_gerenciarproduto`, `nva_gerenciarusuario`, `nva_gerenciarloja`, `nva_dtcad`, `nva_dtalter`, `nva_usualter`) VALUES ( :nva_status, :nva_nome, :nva_gerenciarbasico, :nva_gerenciarconfiguracao, :nva_gerenciarcliente, :nva_gerenciarproduto, :nva_gerenciarusuario, :nva_gerenciarloja, now(), now(), :usuario )";
			}else{
				$s_acesso = "UPDATE `".DB_PREFIX."_nivelacesso` SET `nva_status`=:nva_status, `nva_nome`=:nva_nome, `nva_gerenciarbasico`=:nva_gerenciarbasico, `nva_gerenciarconfiguracao`=:nva_gerenciarconfiguracao, `nva_gerenciarcliente`=:nva_gerenciarcliente, `nva_gerenciarproduto`=:nva_gerenciarproduto, `nva_gerenciarusuario`=:nva_gerenciarusuario, `nva_gerenciarloja`=:nva_gerenciarloja, `nva_dtalter`=now(), `nva_usualter`=:usuario WHERE `nva_id`=:nva_id";
			}

			try {
				$conexao->beginTransaction();

				$r_acesso = $conexao->prepare($s_acesso);
				if ( $_POST['nva_id']!="" ) {
					$r_acesso->bindParam(':nva_id', 				$_POST['nva_id'] );
				}
				$r_acesso->bindParam(':nva_status', 				$_POST['nva_status'] );
				$r_acesso->bindParam(':nva_nome', 					$_POST['nva_nome'] );
				$r_acesso->bindParam(':nva_gerenciarbasico', 		$_POST['nva_gerenciarbasico'] );
				$r_acesso->bindParam(':nva_gerenciarconfiguracao', 	$_POST['nva_gerenciarconfiguracao'] );
				$r_acesso->bindParam(':nva_gerenciarcliente', 		$_POST['nva_gerenciarcliente'] );
				$r_acesso->bindParam(':nva_gerenciarproduto', 		$_POST['nva_gerenciarproduto'] );
				$r_acesso->bindParam(':nva_gerenciarusuario', 		$_POST['nva_gerenciarusuario'] );
				$r_acesso->bindParam(':nva_gerenciarloja', 			$_POST['nva_gerenciarloja'] );
				$r_acesso->bindParam(':usuario', 					$_SESSION[SS_PREFIX.'_USUARIO']->usu_id );

				if ( $r_acesso->execute() ) {
					if ( $_POST['nva_id']=="" ) {
						$_idAcesso = $conexao->lastInsertId();
						echo "SUCESSO||Novo Nível de Acesso cadastrado||".$_idAcesso;
					} else {
						echo "SUCESSO||Nível de Acesso atualizado!||".$_POST['nva_id'];
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'salvarusuario':

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarusuario!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar usuário!";
				exit;
			}

			if ( $_POST['usu_id']=="" ) {
				$valida_email = acb_getUsuario( array('usu_email' => $_POST['usu_email'] ) );
				$valida_username = acb_getUsuario( array('usu_username' => $_POST['usu_username'] ) );
			}else{
				$valida_email = acb_getUsuario( array('usu_email' => $_POST['usu_email']), ' AND U.`usu_id`!='.$_POST['usu_id'] );
				$valida_username = acb_getUsuario( array('usu_username' => $_POST['usu_username']), ' AND U.`usu_id`!='.$_POST['usu_id'] );
			}

			if ( $valida_email[0]=="SUCESSO" && $valida_email[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Este email já está sendo utilizado por um usuário!";
			}

			if ( $valida_username[0]=="SUCESSO" && $valida_username[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Este nomde de usuário já está sendo utilizado!";
			}

			// controle_usuario
			if ( $_POST['controle_usuario']=="" ) {
				$_POST['usu_status']		= 0; 
				$_POST['usu_username']		= NULL; 
				$_POST['usu_idnivelacesso']	= NULL; 
				$_POST['usu_senha']			= NULL; 
			}

			// converter em money/float
				$_POST['usu_remuneracao'] = str_replace(".", "", $_POST['usu_remuneracao'] );
				$_POST['usu_remuneracao'] = str_replace(",", ".", $_POST['usu_remuneracao'] );
				$_POST['usu_remuneracao'] = floatval($_POST['usu_remuneracao']);

			$_POST['usu_whatsapp']=$_POST['usu_whatsapp']=="on"?1:0;

			// vazio == insert
			if ( $_POST['usu_id']=="" ) {
				$s_usuario = "INSERT INTO `acb_usuario`( `usu_status`, `usu_idnivelacesso`, `usu_cpf`, `usu_nome`, `usu_dtnasc`, `usu_email`, `usu_emailacb`, `usu_corporativo`, `usu_cargo`, `usu_telefone`, `usu_celular`, `usu_whatsapp`, `usu_idsexo`, `usu_idestadocivil`, `usu_idsetor`, `usu_remuneracao`, `usu_idendereco`, `usu_username`, `usu_senha`, `usu_dtcad`, `usu_dtalter`, `usu_usualter` ) VALUES ( :usu_status, :usu_idnivelacesso, :usu_cpf, :usu_nome, :usu_dtnasc, :usu_email, :usu_emailacb, :usu_corporativo, :usu_cargo, :usu_telefone, :usu_celular, :usu_whatsapp, :usu_idsexo, :usu_idestadocivil, :usu_idsetor, :usu_remuneracao, :usu_idendereco, :usu_username, :usu_senha, now(), now(), :usuario )";

				$s_endereco = "INSERT INTO `acb_endereco`(`end_cep`, `end_logradouro`, `end_numero`, `end_complemento`, `end_bairro`, `end_cidade`, `end_estado`, `end_pais`, `end_dtcad`, `end_dtalter`, `end_usualter`) VALUES ( :end_cep, :end_logradouro, :end_numero, :end_complemento, :end_bairro, :end_cidade, :end_estado, :end_pais, now(), now(), :usuario )";
			}else{

				if ( $_POST['controle_usuario']=="ATIVO" ) {
					// UPDATE DADOS E USUARIO
					$s_usuario = "UPDATE `acb_usuario` SET `usu_status`=:usu_status, `usu_idnivelacesso`=:usu_idnivelacesso, `usu_cpf`=:usu_cpf, `usu_nome`=:usu_nome, `usu_dtnasc`=:usu_dtnasc, `usu_email`=:usu_email, `usu_emailacb`=:usu_emailacb, `usu_corporativo`=:usu_corporativo, `usu_cargo`=:usu_cargo, `usu_telefone`=:usu_telefone, `usu_celular`=:usu_celular, `usu_whatsapp`=:usu_whatsapp, `usu_idsexo`=:usu_idsexo, `usu_idestadocivil`=:usu_idestadocivil, `usu_idsetor`=:usu_idsetor, `usu_remuneracao`=:usu_remuneracao, `usu_username`=:usu_username, `usu_senha`=:usu_senha, `usu_dtalter`=now(), `usu_usualter`=:usuario WHERE `usu_id`=:usu_id";
				}else{
					// UPDATE SÓ DADOS
					$s_usuario = "UPDATE `acb_usuario` SET `usu_cpf`=:usu_cpf, `usu_nome`=:usu_nome, `usu_dtnasc`=:usu_dtnasc, `usu_email`=:usu_email, `usu_emailacb`=:usu_emailacb, `usu_corporativo`=:usu_corporativo, `usu_cargo`=:usu_cargo, `usu_telefone`=:usu_telefone, `usu_celular`=:usu_celular, `usu_whatsapp`=:usu_whatsapp, `usu_idsexo`=:usu_idsexo, `usu_idestadocivil`=:usu_idestadocivil, `usu_idsetor`=:usu_idsetor, `usu_remuneracao`=:usu_remuneracao, `usu_dtalter`=now(), `usu_usualter`=:usuario WHERE `usu_id`=:usu_id";
				}

				$s_endereco = "UPDATE `acb_endereco` SET  `end_cep`=:end_cep, `end_logradouro`=:end_logradouro, `end_numero`=:end_numero, `end_complemento`=:end_complemento, `end_bairro`=:end_bairro, `end_cidade`=:end_cidade, `end_estado`=:end_estado, `end_pais`=:end_pais, `end_dtalter`=now(), `end_usualter`=:usuario WHERE `end_id`=:end_id";
			}

			try {
				$conexao->beginTransaction();

				$r_endereco = $conexao->prepare($s_endereco);
				if ( $_POST['usu_id']!="" && $_POST['end_id']!="" ) {
					$r_endereco->bindValue(':end_id', 	$_POST['end_id'] );
				}
				$r_endereco->bindValue(':end_cep', 				$_POST['end_cep'] );
				$r_endereco->bindValue(':end_logradouro', 		$_POST['end_logradouro'] );
				$r_endereco->bindValue(':end_numero', 			$_POST['end_numero'] );
				$r_endereco->bindValue(':end_complemento', 		$_POST['end_complemento'] );
				$r_endereco->bindValue(':end_bairro', 			$_POST['end_bairro'] );
				$r_endereco->bindValue(':end_cidade', 			$_POST['end_cidade'] );
				$r_endereco->bindValue(':end_estado', 			$_POST['end_estado'] );
				$r_endereco->bindValue(':end_pais', 			$_POST['end_pais'] );
				$r_endereco->bindValue(':usuario', 				$usu_id );

				if ( $r_endereco->execute() ) {

					$_idendereco = $conexao->lastInsertId();

					$r_usu = $conexao->prepare($s_usuario);
					if ( $_POST['usu_id']!="" ) {
						$r_usu->bindParam(':usu_id', 			$_POST['usu_id'] );

						if ( $_POST['controle_usuario']=="ATIVO" ) {
							$r_usu->bindParam(':usu_status', 		$_POST['usu_status'] );
							$r_usu->bindParam(':usu_idnivelacesso', $_POST['usu_idnivelacesso'] );
							$r_usu->bindParam(':usu_username', 		$_POST['usu_username'] );
							$r_usu->bindParam(':usu_senha', 		$_POST['usu_senha'] );
						}
					}else{
						$r_usu->bindParam(':usu_status', 		$_POST['usu_status'] );
						$r_usu->bindParam(':usu_idnivelacesso', $_POST['usu_idnivelacesso'] );
						$r_usu->bindParam(':usu_username', 		$_POST['usu_username'] );
						$r_usu->bindParam(':usu_senha', 		$_POST['usu_senha'] );
						$r_usu->bindParam(':usu_idendereco', 	$_idendereco );
					}
					
					$r_usu->bindParam(':usu_cpf', 			$_POST['usu_cpf'] );
					$r_usu->bindParam(':usu_nome', 			$_POST['usu_nome'] );
					$r_usu->bindParam(':usu_dtnasc', 		$_POST['usu_dtnasc'] );
					$r_usu->bindParam(':usu_email', 		$_POST['usu_email'] );
					$r_usu->bindParam(':usu_emailacb', 		$_POST['usu_emailacb'] );
					$r_usu->bindParam(':usu_cargo', 		$_POST['usu_cargo'] );
					$r_usu->bindParam(':usu_corporativo', 	$_POST['usu_corporativo'] );
					$r_usu->bindParam(':usu_telefone', 		$_POST['usu_telefone'] );
					$r_usu->bindParam(':usu_celular', 		$_POST['usu_celular'] );
					$r_usu->bindParam(':usu_whatsapp', 		$_POST['usu_whatsapp'] );
					$r_usu->bindParam(':usu_idsexo', 		$_POST['usu_idsexo'] );
					$r_usu->bindParam(':usu_idestadocivil', $_POST['usu_idestadocivil'] );
					$r_usu->bindParam(':usu_idsetor', 		$_POST['usu_idsetor'] );
					$r_usu->bindParam(':usu_remuneracao', 	$_POST['usu_remuneracao'] );
					$r_usu->bindParam(':usuario', 			$_SESSION[SS_PREFIX.'_USUARIO']->usu_id );

					if ( $r_usu->execute() ) {

						if ( $_POST['usu_id']=="" ) {
							$_idusuario = $conexao->lastInsertId();
							echo "SUCESSO||Novo usuário cadastrado||".$_idusuario;
						} else {
							echo "SUCESSO||Usuário atualizado!||".$_POST['usu_id'];
						}
					}
				} // fim execute endereco

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'pesquisarusuario':
			// buscar usuarioS
			$contexto = '%'.$_POST['usu_pesquisar'].'%';

			$like = " U.`usu_id` LIKE '".$contexto."' OR  U.`usu_nome` LIKE '".$contexto."' OR U.`usu_email` LIKE '".$contexto."' OR U.`usu_username` LIKE '".$contexto."'";

			$getusuario = acb_getusuario( '' , 'WHERE '.$like.' ORDER BY U.`usu_dtalter` DESC LIMIT '.$_POST['usu_quantidade'] );

			if ( $getusuario[0]=="SUCESSO" ) {
				if ($getusuario[1]>0 ) {
					echo "SUCESSO||";

					$_usuarios=$getusuario[2];

					foreach ($_usuarios as $key => $usuario) {
						$text_status = $usuario->usu_status==1?'success':'dark';
						echo
						"<div class='col-sm-12'>
							<div class='card mb-3'>
								<div class='card-header'>
									<i class=\"fas fa-circle text-".$text_status."\"></i>
									<b class='text-uppercase'>".$usuario->usu_nome."</b>
									<a href='usuario?view=formusuario&usu_id=".$usuario->usu_id."' class='btn btn-primary btn-sm float-right' style='border-radius: 50px;'>
										<i class='fas fa-user-edit'></i> 
										<span class='d-none d-md-inline'>EDITAR</span>
									</a>
								</div>
								<div class='card-body'>
									<div class='row text-secondary mb-2'>
										<div class='col-6'>
											<b>EMAIL:</b> ".$usuario->usu_nome." | ".$usuario->usu_username."
										</div>
										<div class='col-6 float-right text-right'>
											<b>Nascido em:</b> &nbsp;".$usuario->usu_dtnasc."&nbsp;&nbsp;&nbsp;
										</div>
										<div class='clearfix'></div>
									</div>
									<div class='row text-secondary mb-3'>
										<div class='col-6 small'>
											<b>Cadastrado em:</b> ".$usuario->usu_dtcad."
										</div>
										<div class='col-6 float-right text-right small'>
											<b>Ultimo acesso em::</b> &nbsp;".$usuario->usu_ultimoacesso."&nbsp;&nbsp;&nbsp;
										</div>
										<div class='clearfix'></div>
									</div>							        
								</div>
							</div>
						</div>";
					}

				} else {
					echo "SUCESSO||";
				}
			} else {
				echo "ERROGRAVE||";
				echo $getusuario[1]." \n";
				echo $getusuario[2]." \n";
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