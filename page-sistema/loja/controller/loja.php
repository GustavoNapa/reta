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

	switch ($_POST['acao']) {

		case 'validarcampo':
			if ( $_POST['loj_id']=="" ) {
				$getLoja = sc_getLoja( array($_POST['campo'] => $_POST['valor'] ) );
			}else{
				$getLoja = sc_getLoja( array($_POST['campo'] => $_POST['valor']), ' AND L.`loj_id`!='.$_POST['loj_id'] );
			}

			if ( $getLoja[0]=="SUCESSO" && $getLoja[1]>0 ) {
				echo "INDISPONIVEL||Controle de duplicidade||".$getLoja[2][0]->loj_id;
			}else{
				echo "DISPONIVEL||Controle de duplicidade";
			}
		break;

		case 'deletarimagem':
			
			$getLoja = sc_getLoja( array('loj_id' => $_POST['loj_id'] ) );

			if ( $getLoja[0]!="SUCESSO" && $getLoja[1]!=1 ) {
				echo "ERROGRAVE||Loja não encontrada! Atualize e tente novamente!";
	            exit;
			}

			$_loja=$getLoja[2][0];

			foreach ($_loja as $coluna => $info) {
				if ( $coluna==$_POST['campo'] && !is_null($info) ) {
					if ( file_exists('../media/'.$info)) {
						if ( unlink('../media/'.$info) ) {
							$s_loja = "UPDATE `acb_loja` SET `".$_POST['campo']."`=NULL,  `loj_dtalter`=now(), `loj_usualter`=:usuario WHERE `loj_id`=:loj_id";
							try {
								$conexao->beginTransaction();
								$r_loja = $conexao->prepare($s_loja);
								$r_loja->bindParam(':loj_id', 				$_loja->loj_id );
								$r_loja->bindParam(':usuario', 				$usu_id );

								if ( $r_loja->execute() ) {
									$conexao->commit();
									// TUDO OK
									echo "SUCESSO||Imagem atualizada!";
									break;
									exit;
								}
							} catch (PDOException $e) {
								echo "ERROGRAVE||Erro ao salvar a imagem no banco de dados!||".$e;
								$conexao->rollBack();
							}
						}
					}
				}
			}
		break;

		case 'salvarloja':

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar loja!";
				exit;
			}

			if ( $_POST['loj_cnpj']=="" ) {
				echo "ERROPOST||Erro nas informações enviadas, atualize e tente novamente!";
				exit;
			} else {
				$getLoja = sc_getLoja( array('loj_cnpj' => $_POST['loj_cnpj'] ) );

				if ( $getLoja[0]=="SUCESSO" && $getLoja[1]>0 ) {
					echo "EMPRESAENCONTRADA||Já existe loja cadastrada com este CNPJ, Atualize e tente novamente!";
					exit;
				}
			}

			if ( $_POST['loj_razaosocial']=="" ) {
				echo "ERROPOST||Erro nas informações enviadas, atualize e tente novamente!";
				exit;
			} else {
				$getLoja = sc_getLoja( array('loj_razaosocial' => $_POST['loj_razaosocial'] ) );

				if ( $getLoja[0]=="SUCESSO" && $getLoja[1]>0 ) {
					echo "EMPRESAENCONTRADA||Já existe loja cadastrada com esta Razão Social, Atualize e tente novamente!";
					exit;
				}
			}

			$_POST['loj_whatsapp']=$_POST['loj_whatsapp']=="on"?1:0;

			if ( $_POST['loj_id']=="" ) {
				$s_loja = "INSERT INTO `acb_loja`( `loj_status`, `loj_disponibilidade`, `loj_cnpj`, `loj_razaosocial`, `loj_nomefantasia`, `loj_im`, `loj_ie`, `loj_email`, `loj_telefone`, `loj_celular`, `loj_whatsapp`, `loj_idendereco`, `loj_descricao`, `loj_dtcad`, `loj_dtalter`, `loj_usualter` ) VALUES ( :loj_status, :loj_disponibilidade, :loj_cnpj, :loj_razaosocial, :loj_nomefantasia, :loj_im, :loj_ie, :loj_email, :loj_telefone, :loj_celular, :loj_whatsapp, :loj_idendereco, :loj_descricao, now(), now(), :usuario )";

				$s_endereco = "INSERT INTO `acb_endereco`( `end_cep`, `end_logradouro`, `end_numero`, `end_complemento`, `end_bairro`, `end_cidade`, `end_estado`, `end_pais`, `end_googlemaps`, `end_dtcad`, `end_dtalter`, `end_usualter` ) VALUES ( :end_cep, :end_logradouro, :end_numero, :end_complemento, :end_bairro, :end_cidade, :end_estado, :end_pais, :end_googlemaps, now(), now(), :usuario )";

			}else{
				$s_loja = "UPDATE `acb_loja` SET `loj_status`=:loj_status, `loj_disponibilidade`=:loj_disponibilidade, `loj_cnpj`=:loj_cnpj, `loj_razaosocial`=:loj_razaosocial, `loj_nomefantasia`=:loj_nomefantasia, `loj_im`=:loj_im, `loj_ie`=:loj_ie, `loj_telefone`=:loj_telefone, `loj_celular`=:loj_celular, `loj_whatsapp`=:loj_whatsapp, `loj_descricao`=:loj_descricao, `loj_email`=:loj_email, `loj_dtalter`=now(), `loj_usualter`=:usuario WHERE `loj_id`=:loj_id";

				$s_endereco = "UPDATE `acb_endereco` SET `end_cep`=:end_cep, `end_logradouro`=:end_logradouro, `end_numero`=:end_numero, `end_complemento`=:end_complemento, `end_bairro`=:end_bairro, `end_cidade`=:end_cidade, `end_estado`=:end_estado, `end_pais`=:end_pais, `end_googlemaps`=:end_googlemaps, `end_dtalter`=now() WHERE `end_id`=:end_id";
			}

			try {
				$conexao->beginTransaction();

				$r_endereco = $conexao->prepare($s_endereco);
				if ( $_POST['loj_id']!="" ) {
					$r_endereco->bindParam(':end_id', 			$_POST['end_id'] );
				}
				$r_endereco->bindParam(':end_cep', 				$_POST['end_cep'] );
				$r_endereco->bindParam(':end_logradouro', 		$_POST['end_logradouro'] );
				$r_endereco->bindParam(':end_numero', 			$_POST['end_numero'] );
				$r_endereco->bindParam(':end_complemento', 		$_POST['end_complemento'] );
				$r_endereco->bindParam(':end_bairro', 			$_POST['end_bairro'] );
				$r_endereco->bindParam(':end_cidade', 			$_POST['end_cidade'] );
				$r_endereco->bindParam(':end_estado', 			$_POST['end_estado'] );
				$r_endereco->bindParam(':end_pais', 			$_POST['end_pais'] );
				$r_endereco->bindParam(':end_googlemaps', 		$_POST['end_googlemaps'] );
				$r_endereco->bindParam(':usuario', 				$usu_id );

				if ( $r_endereco->execute() ) {
					
					$r_loja = $conexao->prepare($s_loja);

					if ( $_POST['loj_id']=="" ) {
						$_idendereco = $conexao->lastInsertId();
						$r_loja->bindParam(':loj_idendereco',	$_idendereco );
					}else{
						$r_loja->bindParam(':loj_id', 			$_POST['loj_id'] );
					}
					
					$r_loja->bindParam(':loj_status', 			$_POST['loj_status'] );
					$r_loja->bindParam(':loj_disponibilidade',	$_POST['loj_disponibilidade'] );
					$r_loja->bindParam(':loj_cnpj', 			$_POST['loj_cnpj'] );
					$r_loja->bindParam(':loj_razaosocial', 		$_POST['loj_razaosocial'] );
					$r_loja->bindParam(':loj_nomefantasia', 	$_POST['loj_nomefantasia'] );
					$r_loja->bindParam(':loj_im', 				$_POST['loj_im'] );
					$r_loja->bindParam(':loj_ie', 				$_POST['loj_ie'] );
					$r_loja->bindParam(':loj_email', 			$_POST['loj_email'] );
					$r_loja->bindParam(':loj_telefone', 		$_POST['loj_telefone'] );
					$r_loja->bindParam(':loj_celular', 			$_POST['loj_celular'] );
					$r_loja->bindParam(':loj_whatsapp', 		$_POST['loj_whatsapp'] );
					$r_loja->bindParam(':loj_descricao', 		$_POST['loj_descricao'] );
					$r_loja->bindParam(':usuario', 				$usu_id );

					if ( $r_loja->execute() ) {
						if ( $_POST['loj_id']=="" ) {
							$_idLoja = $conexao->lastInsertId();
							echo "SUCESSO||Loja cadastrada!||".$_idLoja;
						}else{
							echo "SUCESSO||Loja atualizada!||".$_POST['loj_id'];
						}
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'pesquisarloja':
			// buscar lojaS
			$contexto = '%'.$_POST['loj_pesquisar'].'%';

			$like = " L.`loj_id` LIKE '".$contexto."' OR  L.`loj_razaosocial` LIKE '".$contexto."' OR  L.`loj_nomefantasia` LIKE '".$contexto."' OR L.`loj_cnpj` LIKE '".$contexto."'";

			$getLoja = sc_getLoja( '' , 'WHERE '.$like.'  GROUP BY L.`loj_id` ORDER BY L.`loj_dtalter` DESC LIMIT '.$_POST['loj_quantidade'] );

			if ( $getLoja[0]=="SUCESSO" ) {
				if ($getLoja[1]>0 ) {
					echo "SUCESSO||";

					$_lojas=$getLoja[2];

					foreach ($_lojas as $key => $loja) {

						$text_status = $loja->loj_status==1?'success':'dark';

						$loj_disponibilidade = $loja->loj_disponibilidade==1?'Visivel no site':'Ocultado do site';

						echo "<div class='col-sm-12'>
								<div class='card mb-3'>
									<div class='card-header'>
										<i class=\"fas fa-circle text-".$text_status."\"></i>
										<b class='text-uppercase'>".$loja->loj_razaosocial."</b>
										<a href='loja?view=formloja&loj_id=".$loja->loj_id."' class='btn btn-primary btn-sm float-right' style='border-radius: 50px;'>
											<i class='fas fa-user-edit'></i> 
											<span class='d-none d-md-inline'>EDITAR</span>
										</a>
									</div>
									<div class='card-body'>
										<div class='row text-secondary'>
											<div class='col-4'>
												<b>CNPJ:</b> ".$loja->loj_cnpj."
											</div>
											<div class='col-4'>
												<b>Razão Social:</b> ".$loja->loj_nomefantasia."
											</div>
											<div class='col-4 text-right'>
												".$loj_disponibilidade."
											</div>
										</div>
										<div class='row text-secondary'>
											<div class='col-4'>
												<b>Email:</b> ".$loja->loj_email."
											</div>
											<div class='col-4'>
												<b>Telefone:</b> ".$loja->loj_telefone."
											</div>
											<div class='col-4 text-right'>
												<b>Celular:</b> ".$loja->loj_celular."
											</div>
										</div>	
										<div class='row text-secondary'>
											<div class='col-12'>
												<b>Endereço:</b> ".$loja->end_logradouro.", Nº ".$loja->end_numero.". ".$loja->end_complemento.". ".$loja->end_bairro.", ".$loja->end_cidade."/".$loja->end_estado."
											</div>
										</div>	
									</div>
									<div class='card-footer'>
										<div class='row text-secondary small'>
											<div class='col-4'>
												<b>Cadastrado em:</b> ".date('d/m/Y h:m', strtotime($loja->loj_dtcad))."
											</div>
											<div class='col-8'>
												<b>Ultima alteração:</b> ".date('d/m/Y h:m', strtotime($loja->loj_dtalter)).", por ".$loja->usu_nome."
											</div>
										</div>
									</div>
								</div>
							</div>";
					}

				} else {
					echo "SUCESSO||";

					echo
					"<div class='col-sm-12'>
						<div class='card mb-3'>
							<div class='card-header'>
								ERRO 404 - LOJA NOT FOUND
							</div>
							<div class='card-body'>
								<div class='row text-secondary'>
									<div class='col-6'>
										Nenhuma loja encontrada
									</div>
									<div class='clearfix'></div>
								</div>						        
							</div>
						</div>
					</div>";
				}
			} else {
				echo "ERROGRAVE||";
				echo $getLoja[1]." \n";
				echo $getLoja[2]." \n";
			}
			// echo "LOG: \n";
			// echo $contexto." \n";
		break;

		case 'salvarestado':

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar loja!";
				exit;
			}

			$campoId 	= $_POST['prefixo']."_id";
			$campoUF 	= $_POST['prefixo']."_uf";
			$campoNome 	= $_POST['prefixo']."_nome";

			if ( $_POST['id']=="0" ) {
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['nome'] ) );

				if ( $valida_nome[0]=="SUCESSO" && $valida_nome[1]>0 ) {
					echo "DUPLICIDADE||Controle de duplicidade: Já existe estado com este nome no sistema!";
					exit;
				}

				$valida_uf = getCadastroBasicoLoja( $_POST['tabela'], array( $campoUF => $_POST['uf'] ) );

				if ( $valida_uf[0]=="SUCESSO" && $valida_uf[1]>0 ) {
					echo "DUPLICIDADE||Controle de duplicidade: Já existe estado com esta UF no sistema!";
					exit;
				}
			}else{
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['nome']), ' AND '.$campoId.'!='.$_POST['id'] );

				if ( $valida_nome[0]=="SUCESSO" && $valida_nome[1]>0 ) {
					echo "DUPLICIDADE||Controle de duplicidade: Já existe estado com este nome no sistema!";
					exit;
				}

				$valida_uf = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['uf']), ' AND '.$campoId.'!='.$_POST['id'] );

				if ( $valida_uf[0]=="SUCESSO" && $valida_uf[1]>0 ) {
					echo "DUPLICIDADE||Controle de duplicidade: Já existe estado com esta UF no sistema!";
					exit;
				}
			}

			if ( $_POST['id']=="0" ) {
				$s_cadastro = "INSERT INTO `".DB_PREFIX."_".$_POST['tabela']."` ( `".$_POST['prefixo']."_status`, `".$_POST['prefixo']."_uf`, `".$_POST['prefixo']."_nome`, `".$_POST['prefixo']."_dtcad`,  `".$_POST['prefixo']."_dtalter`, `".$_POST['prefixo']."_usualter`) VALUES ( :_status, :_uf, :_nome, now(), now(), :usuario )";
			} else {
				$s_cadastro = "UPDATE `".DB_PREFIX."_".$_POST['tabela']."` SET `".$_POST['prefixo']."_status`=:_status, `".$_POST['prefixo']."_uf`=:_uf, `".$_POST['prefixo']."_nome`=:_nome, `".$_POST['prefixo']."_dtalter`=now(), `".$_POST['prefixo']."_usualter`=:usuario WHERE `".$_POST['prefixo']."_id`=:_id";
			}

			try {
				$conexao->beginTransaction();

				$r_cadastro = $conexao->prepare($s_cadastro);
				
				if ( $_POST['id']!="0" ) {
					$r_cadastro->bindParam(':_id',	$_POST['id'] );
				}

				// tem em todos!
				$r_cadastro->bindParam(':_status', 	$_POST['status'] );
				$r_cadastro->bindParam(':_uf', 		$_POST['uf'] );
				$r_cadastro->bindParam(':_nome', 	strtoupper($_POST['nome']) );
				$r_cadastro->bindParam(':usuario', 	$usu_id );

				if ( $r_cadastro->execute() ) {

					$_idCadastro = $conexao->lastInsertId();
					
					if ( $_POST['id']=="0" ) {
						echo "SUCESSO||Novo estado cadastrado||".$_idCadastro;
					} else {
						echo "SUCESSO||Estado atualizado!";
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'salvarcidade':

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar loja!";
				exit;
			}

			$campoId 		= $_POST['prefixo']."_id";
			$campoIdEstado 	= $_POST['prefixo']."_idestado";
			$campoNome 		= $_POST['prefixo']."_nome";

			if ( $_POST['id']=="0" ) {
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['nome'], $campoIdEstado => $_POST['idestado']) );
			}else{
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['nome'], $campoIdEstado => $_POST['idestado']), ' AND '.$campoId.'!='.$_POST['id'] );
			}

			if ( $valida_nome[0]=="SUCESSO" && $valida_nome[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Já existe esta cidade cadastrada para este estado no sistema!";
				exit;
			}

			if ( $_POST['id']=="0" ) {
				$s_cadastro = "INSERT INTO `".DB_PREFIX."_".$_POST['tabela']."` ( `".$_POST['prefixo']."_status`, `".$_POST['prefixo']."_idestado`, `".$_POST['prefixo']."_nome`, `".$_POST['prefixo']."_dtcad`,  `".$_POST['prefixo']."_dtalter`, `".$_POST['prefixo']."_usualter`) VALUES ( :_status, :_idestado, :_nome, now(), now(), :usuario )";
			} else {
				$s_cadastro = "UPDATE `".DB_PREFIX."_".$_POST['tabela']."` SET `".$_POST['prefixo']."_status`=:_status, `".$_POST['prefixo']."_idestado`=:_idestado, `".$_POST['prefixo']."_nome`=:_nome, `".$_POST['prefixo']."_dtalter`=now(), `".$_POST['prefixo']."_usualter`=:usuario WHERE `".$_POST['prefixo']."_id`=:_id";
			}

			try {
				$conexao->beginTransaction();

				$r_cadastro = $conexao->prepare($s_cadastro);
				
				if ( $_POST['id']!="0" ) {
					$r_cadastro->bindParam(':_id',	$_POST['id'] );
				}

				// tem em todos!
				$r_cadastro->bindParam(':_status', 	$_POST['status'] );
				$r_cadastro->bindParam(':_idestado',$_POST['idestado'] );
				$r_cadastro->bindParam(':_nome', 	strtoupper($_POST['nome']) );
				$r_cadastro->bindParam(':usuario', 	$usu_id );

				if ( $r_cadastro->execute() ) {
					if ( $_POST['id']=="0" ) {
						$_idCadastro = $conexao->lastInsertId();
						echo "SUCESSO||Nova cidade cadastrada!||".$_idCadastro;
					} else {
						echo "SUCESSO||Cidade atualizada!||".$_POST['id'];
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'salvarbairro':

			// print_r($_POST);exit;
			// [acao] => salvarbairro
			// [bai_id] => 2
			// [bai_idcidade] => 1
			// [bai_nome] => VALE DO JATOBÁ
			// [bai_status] => 1

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar loja!";
				exit;
			}

			if ( $_POST['bai_id']=="" ) {
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( 'bai_nome' => $_POST['bai_nome'], 'bai_idcidade' => $_POST['bai_idcidade']) );
			}else{
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( 'bai_nome' => $_POST['bai_nome'], 'bai_idcidade' => $_POST['bai_idcidade']), ' AND '.'bai_id'.'!='.$_POST['bai_id'] );
			}

			if ( $valida_nome[0]=="SUCESSO" && $valida_nome[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Já existe este bairro cadastrado para esta cidade no sistema!";
				exit;
			}

			if ( $_POST['bai_id']=="" ) {
				$s_cadastro = "INSERT INTO `".DB_PREFIX."_bairro` ( `bai_status`, `bai_idcidade`, `bai_nome`, `bai_dtcad`,  `bai_dtalter`, `bai_usualter`) VALUES ( :bai_status, :bai_idcidade, :bai_nome, now(), now(), :usuario )";
			} else {
				$s_cadastro = "UPDATE `".DB_PREFIX."_bairro` SET `bai_status`=:bai_status, `bai_idcidade`=:bai_idcidade, `bai_nome`=:bai_nome, `bai_dtalter`=now(), `bai_usualter`=:usuario WHERE `bai_id`=:bai_id";
			}

			try {
				$conexao->beginTransaction();

				$r_cadastro = $conexao->prepare($s_cadastro);
				
				if ( $_POST['bai_id']!="" ) {
					$r_cadastro->bindParam(':bai_id',	$_POST['bai_id'] );
				}

				// tem em todos!
				$r_cadastro->bindParam(':bai_status', 	$_POST['bai_status'] );
				$r_cadastro->bindParam(':bai_idcidade',	$_POST['bai_idcidade'] );
				$r_cadastro->bindParam(':bai_nome', 	strtoupper($_POST['bai_nome']) );
				$r_cadastro->bindParam(':usuario', 		$usu_id );

				if ( $r_cadastro->execute() ) {
					if ( $_POST['bai_id']=="" ) {
						$_idCadastro = $conexao->lastInsertId();
						echo "SUCESSO||Novo bairro cadastrado!||".$_idCadastro;
					} else {
						echo "SUCESSO||Bairro atualizado!||".$_POST['bai_id'];
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'salvarregiao':

			// print_r($_POST);exit;
			// [acao] => salvarregiao
			// [reg_idloja] => 1
			// [reg_id] => 
			// [reg_idbairro] => 1
			// [reg_valordelivery] => 1,99
			// [reg_status] => 1

			// Campos obrigatórios
			if ( $_POST['reg_idloja']=="" || $_POST['reg_idbairro']=="" || $_POST['reg_valordelivery']=="" || $_POST['reg_status']=="" ) {
				echo "ERROPOST||Erro ao enviar informações, atualize e tente novamente!";
				exit;
			}

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarloja!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar loja!";
				exit;
			}

			if ( $_POST['reg_id']=="" ) {
				$valida_regiao = getCadastroBasicoLoja( 
					'regiao', 
					array( 
						'reg_idloja' 		=> $_POST['reg_idloja'], 
						'reg_idbairro' 	=> $_POST['reg_idbairro']
					) 
				);
			}else{
				$valida_regiao = getCadastroBasicoLoja( 
					'regiao', 
					array( 
						'reg_idloja' 		=> $_POST['reg_idloja'], 
						'reg_idbairro' 	=> $_POST['reg_idbairro']
					), 
					' AND '.'reg_id'.'!='.$_POST['reg_id'] );
			}

			if ( $valida_regiao[0]=="SUCESSO" && $valida_regiao[1]>0 ) {
				echo "DUPLICIDADE||Controle de duplicidade: Já existe esta região cadastrada para esta loja no sistema!";
				exit;
			}

			if ( $_POST['reg_id']=="" ) {
				$s_cadastro = "INSERT INTO `".DB_PREFIX."_regiao` ( `reg_idloja`, `reg_idbairro`, `reg_status`, `reg_valordelivery`, `reg_dtcad`, `reg_dtalter`, `reg_usualter`) VALUES ( :reg_idloja, :reg_idbairro, :reg_status, :reg_valordelivery, now(), now(), :usuario )";
			} else {
				$s_cadastro = "UPDATE `".DB_PREFIX."_regiao` SET `reg_idloja`=:reg_idloja, `reg_idbairro`=:reg_idbairro, `reg_status`=:reg_status, `reg_valordelivery`=:reg_valordelivery, `reg_dtalter`=now(), `reg_usualter`=:usuario WHERE `reg_id`=:reg_id";
			}

			// converter em money/float
				$_POST['reg_valordelivery'] = str_replace(".", "", $_POST['reg_valordelivery'] );
				$_POST['reg_valordelivery'] = str_replace(",", ".", $_POST['reg_valordelivery'] );
				$_POST['reg_valordelivery'] = floatval($_POST['reg_valordelivery']);

			try {
				$conexao->beginTransaction();

				$r_cadastro = $conexao->prepare($s_cadastro);
				
				if ( $_POST['reg_id']!="" ) {
					$r_cadastro->bindParam(':reg_id',	$_POST['reg_id'] );
				}

				// tem em todos!
				$r_cadastro->bindParam(':reg_idloja', 		$_POST['reg_idloja'] );
				$r_cadastro->bindParam(':reg_idbairro',		$_POST['reg_idbairro'] );
				$r_cadastro->bindParam(':reg_status',		$_POST['reg_status'] );
				$r_cadastro->bindParam(':reg_valordelivery',$_POST['reg_valordelivery'] );
				$r_cadastro->bindParam(':usuario', 			$usu_id );

				if ( $r_cadastro->execute() ) {
					if ( $_POST['reg_id']=="" ) {
						$_idCadastro = $conexao->lastInsertId();
						echo "SUCESSO||Nova região cadastrada!||".$_idCadastro;
					} else {
						echo "SUCESSO||Região atualizada!||".$_POST['reg_id'];
					}
				}

				$conexao->commit();

			} catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
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

			if ( $_POST['id']=="0" ) {
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['nome'] ) );
			}else{
				$valida_nome = getCadastroBasicoLoja( $_POST['tabela'], array( $campoNome => $_POST['nome']), ' AND '.$campoId.'!='.$_POST['id'] );
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
				$r_cadastro->bindParam(':usuario', 	$usu_id );

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