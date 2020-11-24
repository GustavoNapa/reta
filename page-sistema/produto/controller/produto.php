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
							$s_produto = "UPDATE `rtv_produto` SET `".$_POST['campo']."`=NULL,  `pro_dtalter`=now(), `pro_usualter`=:usuario WHERE `pro_id`=:pro_id";
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

			$_POST['pro_whatsapp']=$_POST['pro_whatsapp']=="on"?1:0;
			$_POST['proprietario']=$_POST['proprietario']=="on"?1:0;
			$_POST['troca']=$_POST['troca']=="on"?1:0;
			$_POST['mancha']=$_POST['mancha']=="on"?1:0;
			$_POST['seguro']=$_POST['seguro']=="on"?1:0;
			$_POST['recuperado']=$_POST['recuperado']=="on"?1:0;

			if ( $_POST['pro_id']=="" ) {
				$s_produto = "INSERT INTO `rtv_produto`( `pro_status`, `pro_disponibilidade`, `pro_modelo`, `pro_marca`, `pro_versao`, `pro_cor`, `pro_km`, `pro_celular`, `pro_whatsapp`, `pro_placa`, `pro_ano`, `pro_acessorios`, `pro_troca`, `pro_proprietario`, `pro_mancha`, `pro_seguro`, `pro_recuperado`, `pro_descricao`, `pro_dtcad`, `pro_dtalter`, `pro_usualter` ) VALUES ( :pro_status, :pro_disponibilidade, :pro_modelo, :pro_marca, :pro_versao, :pro_cor, :pro_km, :pro_celular, :pro_whatsapp, :pro_placa, :pro_ano, :pro_acessorios, :pro_troca, :pro_proprietario, :pro_mancha, :pro_seguro, :pro_recuperado, :pro_descricao, now(), now(), :usuario )";

			}else{
				$s_produto = "UPDATE `rtv_produto` SET `pro_status`=:pro_status, `pro_disponibilidade`=:pro_disponibilidade, `pro_modelo`=:pro_modelo, `pro_marca`=:pro_marca, `pro_versao`=:pro_versao, `pro_cor`=:pro_cor, `pro_km`=:pro_km, `pro_whatsapp`=:pro_whatsapp, `pro_celular`=:pro_celular, `pro_ano`=:pro_ano, `pro_descricao`=:pro_descricao, `pro_placa`=:pro_placa, `pro_acessorios`=:pro_acessorios, `pro_troca`=:pro_troca, `pro_proprietario`=:pro_proprietario, `pro_mancha`=:pro_mancha, `pro_seguro`=:pro_seguro, `pro_recuperado`=:pro_recuperado, `pro_dtalter`=now(), `pro_usualter`=:usuario WHERE `pro_id`=:pro_id";
			}



			try {					
				$conexao->beginTransaction();

				$r_produto = $conexao->prepare($s_produto);

				if ( $_POST['pro_id']=="" ) {
				}else{
					$r_produto->bindParam(':pro_id', 			$_POST['pro_id'] );
				}
				
				$r_produto->bindParam(':pro_status', 			$_POST['pro_status'] );
				$r_produto->bindParam(':pro_disponibilidade',	$_POST['pro_disponibilidade'] );
				$r_produto->bindParam(':pro_modelo', 			$_POST['pro_modelo'] );
				$r_produto->bindParam(':pro_marca', 		$_POST['pro_marca'] );
				$r_produto->bindParam(':pro_versao', 	$_POST['pro_versao'] );
				$r_produto->bindParam(':pro_cor', 				$_POST['pro_cor'] );
				$r_produto->bindParam(':pro_km', 				$_POST['pro_km'] );
				$r_produto->bindParam(':pro_celular', 			$_POST['pro_celular'] );
				$r_produto->bindParam(':pro_whatsapp', 		$_POST['pro_whatsapp'] );
				$r_produto->bindParam(':pro_placa', 			$_POST['pro_placa'] );
				$r_produto->bindParam(':pro_ano', 		$_POST['pro_ano'] );
				$r_produto->bindParam(':pro_acessorios', 		$_POST['pro_acessorios'] );
				$r_produto->bindParam(':pro_troca', 		$_POST['troca'] );
				$r_produto->bindParam(':pro_proprietario', 		$_POST['proprietario'] );
				$r_produto->bindParam(':pro_mancha', 		$_POST['mancha'] );
				$r_produto->bindParam(':pro_seguro', 		$_POST['seguro'] );
				$r_produto->bindParam(':pro_recuperado', 		$_POST['recuperado'] );
				$r_produto->bindParam(':pro_descricao', 		$_POST['pro_descricao'] );
				$r_produto->bindParam(':usuario', 				$usu_id );

				if ($r_produto->execute()) {
					if ( $_POST['pro_id']=="" ) {
						$_idLoja = $conexao->lastInsertId();
						echo "SUCESSO||Loja cadastrada!||".$_idLoja;
					}else{
						echo "SUCESSO||Loja atualizada!||".$_POST['pro_id'];
					}
				}else{
				}

				$conexao->commit();

			}catch (PDOException $e) {
				$conexao->rollBack();
				echo "ERROGRAVE||".$e;
				exit;
			}
		break;

		case 'pesquisarproduto':
			// buscar produtoS
			$contexto = '%'.$_POST['pro_pesquisar'].'%';

			$like = " L.`pro_id` LIKE '".$contexto."' OR  L.`pro_marca` LIKE '".$contexto."' OR  L.`pro_versao` LIKE '".$contexto."' OR L.`pro_modelo` LIKE '".$contexto."'";

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
										<b class='text-uppercase'>".$produto->pro_marca."</b>
										<a href='produto?view=formproduto&pro_id=".$produto->pro_id."' class='btn btn-primary btn-sm float-right' style='border-radius: 50px;'>
											<i class='fas fa-user-edit'></i> 
											<span class='d-none d-md-inline'>EDITAR</span>
										</a>
									</div>
									<div class='card-body'>
										<div class='row text-secondary'>
											<div class='col-4'>
												<b>CNPJ:</b> ".$produto->pro_modelo."
											</div>
											<div class='col-4'>
												<b>Razão Social:</b> ".$produto->pro_versao."
											</div>
											<div class='col-4 text-right'>
												".$pro_disponibilidade."
											</div>
										</div>
										<div class='row text-secondary'>
											<div class='col-4'>
												<b>Email:</b> ".$produto->pro_celular."
											</div>
											<div class='col-4'>
												<b>Telefone:</b> ".$produto->pro_whatsapp."
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