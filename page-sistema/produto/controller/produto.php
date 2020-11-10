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

	switch ($_POST['acao']) {

		case 'validarcampo':
			if ( $_POST['pro_id']=="" ) {
				$getLoja = sc_getLoja( array($_POST['campo'] => $_POST['valor'] ) );
			}else{
				$getLoja = sc_getLoja( array($_POST['campo'] => $_POST['valor']), ' AND L.`pro_id`!='.$_POST['pro_id'] );
			}

			if ( $getLoja[0]=="SUCESSO" && $getLoja[1]>0 ) {
				echo "INDISPONIVEL||Controle de duplicidade||".$getLoja[2][0]->pro_id;
			}else{
				echo "DISPONIVEL||Controle de duplicidade";
			}
		break;

		case 'deletarimagem':
			
			$getLoja = sc_getLoja( array('pro_id' => $_POST['pro_id'] ) );

			if ( $getLoja[0]!="SUCESSO" && $getLoja[1]!=1 ) {
				echo "ERROGRAVE||Loja não encontrada! Atualize e tente novamente!";
	            exit;
			}

			$_produto=$getLoja[2][0];

			foreach ($_produto as $coluna => $info) {
				if ( $coluna==$_POST['campo'] && !is_null($info) ) {
					if ( file_exists('../media/'.$info)) {
						if ( unlink('../media/'.$info) ) {
							$s_produto = "UPDATE `acb_produto` SET `".$_POST['campo']."`=NULL,  `pro_dtalter`=now(), `pro_usualter`=:usuario WHERE `pro_id`=:pro_id";
							try {
								$conexao->beginTransaction();
								$r_produto = $conexao->prepare($s_produto);
								$r_produto->bindParam(':pro_id', 				$_produto->pro_id );
								$r_produto->bindParam(':usuario', 				$usu_id );

								if ( $r_produto->execute() ) {
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

		case 'salvarproduto':

			if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarproduto!=1 ) {
				echo "ERROGRAVE||Usuário não possui permissão para gerenciar produto!";
				exit;
			}

			if ( $_POST['pro_cnpj']=="" ) {
				echo "ERROPOST||Erro nas informações enviadas, atualize e tente novamente!";
				exit;
			} else {
				$getLoja = sc_getLoja( array('pro_cnpj' => $_POST['pro_cnpj'] ) );

				if ( $getLoja[0]=="SUCESSO" && $getLoja[1]>0 ) {
					echo "EMPRESAENCONTRADA||Já existe produto cadastrada com este CNPJ, Atualize e tente novamente!";
					exit;
				}
			}

			if ( $_POST['pro_razaosocial']=="" ) {
				echo "ERROPOST||Erro nas informações enviadas, atualize e tente novamente!";
				exit;
			} else {
				$getLoja = sc_getLoja( array('pro_razaosocial' => $_POST['pro_razaosocial'] ) );

				if ( $getLoja[0]=="SUCESSO" && $getLoja[1]>0 ) {
					echo "EMPRESAENCONTRADA||Já existe produto cadastrada com esta Razão Social, Atualize e tente novamente!";
					exit;
				}
			}

			$_POST['pro_whatsapp']=$_POST['pro_whatsapp']=="on"?1:0;

			if ( $_POST['pro_id']=="" ) {
				$s_produto = "INSERT INTO `acb_produto`( `pro_status`, `pro_disponibilidade`, `pro_cnpj`, `pro_razaosocial`, `pro_nomefantasia`, `pro_im`, `pro_ie`, `pro_email`, `pro_telefone`, `pro_celular`, `pro_whatsapp`, `pro_idendereco`, `pro_descricao`, `pro_dtcad`, `pro_dtalter`, `pro_usualter` ) VALUES ( :pro_status, :pro_disponibilidade, :pro_cnpj, :pro_razaosocial, :pro_nomefantasia, :pro_im, :pro_ie, :pro_email, :pro_telefone, :pro_celular, :pro_whatsapp, :pro_idendereco, :pro_descricao, now(), now(), :usuario )";

				$s_endereco = "INSERT INTO `acb_endereco`( `end_cep`, `end_logradouro`, `end_numero`, `end_complemento`, `end_bairro`, `end_cidade`, `end_estado`, `end_pais`, `end_googlemaps`, `end_dtcad`, `end_dtalter`, `end_usualter` ) VALUES ( :end_cep, :end_logradouro, :end_numero, :end_complemento, :end_bairro, :end_cidade, :end_estado, :end_pais, :end_googlemaps, now(), now(), :usuario )";

			}else{
				$s_produto = "UPDATE `acb_produto` SET `pro_status`=:pro_status, `pro_disponibilidade`=:pro_disponibilidade, `pro_cnpj`=:pro_cnpj, `pro_razaosocial`=:pro_razaosocial, `pro_nomefantasia`=:pro_nomefantasia, `pro_im`=:pro_im, `pro_ie`=:pro_ie, `pro_telefone`=:pro_telefone, `pro_celular`=:pro_celular, `pro_whatsapp`=:pro_whatsapp, `pro_descricao`=:pro_descricao, `pro_email`=:pro_email, `pro_dtalter`=now(), `pro_usualter`=:usuario WHERE `pro_id`=:pro_id";

				$s_endereco = "UPDATE `acb_endereco` SET `end_cep`=:end_cep, `end_logradouro`=:end_logradouro, `end_numero`=:end_numero, `end_complemento`=:end_complemento, `end_bairro`=:end_bairro, `end_cidade`=:end_cidade, `end_estado`=:end_estado, `end_pais`=:end_pais, `end_googlemaps`=:end_googlemaps, `end_dtalter`=now() WHERE `end_id`=:end_id";
			}

			try {
				$conexao->beginTransaction();

				$r_endereco = $conexao->prepare($s_endereco);
				if ( $_POST['pro_id']!="" ) {
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
					
					$r_produto = $conexao->prepare($s_produto);

					if ( $_POST['pro_id']=="" ) {
						$_idendereco = $conexao->lastInsertId();
						$r_produto->bindParam(':pro_idendereco',	$_idendereco );
					}else{
						$r_produto->bindParam(':pro_id', 			$_POST['pro_id'] );
					}
					
					$r_produto->bindParam(':pro_status', 			$_POST['pro_status'] );
					$r_produto->bindParam(':pro_disponibilidade',	$_POST['pro_disponibilidade'] );
					$r_produto->bindParam(':pro_cnpj', 			$_POST['pro_cnpj'] );
					$r_produto->bindParam(':pro_razaosocial', 		$_POST['pro_razaosocial'] );
					$r_produto->bindParam(':pro_nomefantasia', 	$_POST['pro_nomefantasia'] );
					$r_produto->bindParam(':pro_im', 				$_POST['pro_im'] );
					$r_produto->bindParam(':pro_ie', 				$_POST['pro_ie'] );
					$r_produto->bindParam(':pro_email', 			$_POST['pro_email'] );
					$r_produto->bindParam(':pro_telefone', 		$_POST['pro_telefone'] );
					$r_produto->bindParam(':pro_celular', 			$_POST['pro_celular'] );
					$r_produto->bindParam(':pro_whatsapp', 		$_POST['pro_whatsapp'] );
					$r_produto->bindParam(':pro_descricao', 		$_POST['pro_descricao'] );
					$r_produto->bindParam(':usuario', 				$usu_id );

					if ( $r_produto->execute() ) {
						if ( $_POST['pro_id']=="" ) {
							$_idLoja = $conexao->lastInsertId();
							echo "SUCESSO||Loja cadastrada!||".$_idLoja;
						}else{
							echo "SUCESSO||Loja atualizada!||".$_POST['pro_id'];
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

		case 'pesquisarproduto':
			// buscar produtoS
			$contexto = '%'.$_POST['pro_pesquisar'].'%';

			$like = " L.`pro_id` LIKE '".$contexto."' OR  L.`pro_razaosocial` LIKE '".$contexto."' OR  L.`pro_nomefantasia` LIKE '".$contexto."' OR L.`pro_cnpj` LIKE '".$contexto."'";

			$getLoja = sc_getLoja( '' , 'WHERE '.$like.'  GROUP BY L.`pro_id` ORDER BY L.`pro_dtalter` DESC LIMIT '.$_POST['pro_quantidade'] );

			if ( $getLoja[0]=="SUCESSO" ) {
				if ($getLoja[1]>0 ) {
					echo "SUCESSO||";

					$_produtos=$getLoja[2];

					foreach ($_produtos as $key => $produto) {

						$text_status = $produto->pro_status==1?'success':'dark';

						$pro_disponibilidade = $produto->pro_disponibilidade==1?'Visivel no site':'Ocultado do site';

						echo "<div class='col-sm-12'>
								<div class='card mb-3'>
									<div class='card-header'>
										<i class=\"fas fa-circle text-".$text_status."\"></i>
										<b class='text-uppercase'>".$produto->pro_razaosocial."</b>
										<a href='produto?view=formproduto&pro_id=".$produto->pro_id."' class='btn btn-primary btn-sm float-right' style='border-radius: 50px;'>
											<i class='fas fa-user-edit'></i> 
											<span class='d-none d-md-inline'>EDITAR</span>
										</a>
									</div>
									<div class='card-body'>
										<div class='row text-secondary'>
											<div class='col-4'>
												<b>CNPJ:</b> ".$produto->pro_cnpj."
											</div>
											<div class='col-4'>
												<b>Razão Social:</b> ".$produto->pro_nomefantasia."
											</div>
											<div class='col-4 text-right'>
												".$pro_disponibilidade."
											</div>
										</div>
										<div class='row text-secondary'>
											<div class='col-4'>
												<b>Email:</b> ".$produto->pro_email."
											</div>
											<div class='col-4'>
												<b>Telefone:</b> ".$produto->pro_telefone."
											</div>
											<div class='col-4 text-right'>
												<b>Celular:</b> ".$produto->pro_celular."
											</div>
										</div>	
										<div class='row text-secondary'>
											<div class='col-12'>
												<b>Endereço:</b> ".$produto->end_logradouro.", Nº ".$produto->end_numero.". ".$produto->end_complemento.". ".$produto->end_bairro.", ".$produto->end_cidade."/".$produto->end_estado."
											</div>
										</div>	
									</div>
									<div class='card-footer'>
										<div class='row text-secondary small'>
											<div class='col-4'>
												<b>Cadastrado em:</b> ".date('d/m/Y h:m', strtotime($produto->pro_dtcad))."
											</div>
											<div class='col-8'>
												<b>Ultima alteração:</b> ".date('d/m/Y h:m', strtotime($produto->pro_dtalter)).", por ".$produto->usu_nome."
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
										Nenhuma produto encontrada
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
		
		default:
			echo "ERROGRAVE||Ação desconhecida";
	    	exit;
		break;
	} // fim so switch post acao

?>