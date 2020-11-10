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
	include_once '../../../page-sistema/cliente/function/cliente.php';
	include_once 'page-sistema/cliente/function/cliente.php';

	switch ($_POST['acao']) {

		case 'validarcpfcnpj':
			// print_r($_POST);
			// [acao] => validarcpfcnpj
			// [cpfcnpj] => 110.245.656-02
			$select_cli = "	SELECT * FROM ".DB_PREFIX."_cliente C 
							WHERE C.`cli_cpfcnpj`=:cli_cpfcnpj";
			try{ 
				$r_cliente = $conexao->prepare($select_cli);
				$r_cliente->bindParam(':cli_cpfcnpj',	$_POST['cpfcnpj']);
				$r_cliente->execute();
				$contar_cli = $r_cliente->rowCount();
				if ($contar_cli>0) {
					echo "CLIENTEENCONTRADO||".$r_cliente->fetchAll(PDO::FETCH_OBJ)[0]->cli_id;
				}else{
					echo "NOVOCLIENTE";
				}
			}catch(PDOException $e){
				echo "ERROGRAVE||".$e;
			} // se nao der certo faça isso
		break;

		case 'salvarcliente':

			if ( $_POST['cli_cpfcnpj']=="" ) {
				echo "ERROPOST||Erro ao salvar cliente, atualize e tente novamente!";
				exit;
			} else {
				$getCliente = fd_getCliente( array('cli_cpfcnpj' => $_POST['cli_cpfcnpj'] ) );

				if ( $getCliente[0]=="SUCESSO" && $getCliente[1]>0 ) {
					echo "CLIENTEENCONTRADO||Atualize e tente novamente!";
					exit;
				}
			}

			// STATUS
			if ( $_POST['cli_status']=="on" ) {
				$_POST['cli_status'] 			= 1;
				$_POST['cli_idmotivobloqueio'] 	= NULL;
				$_POST['cli_dtbloqueio'] 		= NULL;
			}else{
				$_POST['cli_status'] 			= 0;
				$_POST['cli_idmotivobloqueio']	= $_POST['cli_idmotivobloqueio']==""?NULL:$_POST['cli_idmotivobloqueio'];
				$_POST['cli_dtbloqueio']		= $_POST['cli_dtbloqueio']==""?NULL:$_POST['cli_dtbloqueio'];
			}

			// TIPO
			if ( strlen($_POST['cli_cpfcnpj'])>14 ) {
				$_POST['cli_tipo'] 	= "J";
			}else{
				$_POST['cli_tipo'] 	= "F";
			}

			// vazio == insert
			if ( $_POST['cli_id']=="" ) {
				$s_cliente = "INSERT INTO `fd_cliente`(`cli_status`, `cli_tipo`, `cli_cpfcnpj`, `cli_nome`, `cli_idsexo`, `cli_idestadocivil`, `cli_dtnasc`, `cli_idmotivobloqueio`, `cli_dtbloqueio`, `cli_nomecartao`, `cli_email`, `cli_telefone`, `cli_celular`, `cli_contato`, `cli_idendereco`, `cli_observacao`, `cli_dtcad`, `cli_dtalter`, `cli_usualter`) VALUES ( :cli_status, :cli_tipo, :cli_cpfcnpj, :cli_nome, :cli_idsexo, :cli_idestadocivil, :cli_dtnasc, :cli_idmotivobloqueio, :cli_dtbloqueio, :cli_nomecartao, :cli_email, :cli_telefone, :cli_celular, :cli_contato, :cli_idendereco, :cli_observacao, now(), now(), :usuario )";

				$s_endereco = "INSERT INTO `fd_endereco`(`end_cep`, `end_logradouro`, `end_numero`, `end_complemento`, `end_bairro`, `end_cidade`, `end_estado`, `end_pais`, `end_dtalter`) VALUES ( :end_cep, :end_logradouro, :end_numero, :end_complemento, :end_bairro, :end_cidade, :end_estado, :end_pais, now() )";

			}else{
				$s_cliente = "UPDATE `fd_cliente` SET `cli_status`=:cli_status, `cli_nome`=:cli_nome, `cli_idsexo`=:cli_idsexo, `cli_idestadocivil`=:cli_idestadocivil, `cli_dtnasc`=:cli_dtnasc, `cli_idmotivobloqueio`=:cli_idmotivobloqueio, `cli_dtbloqueio`=:cli_dtbloqueio, `cli_nomecartao`=:cli_nomecartao, `cli_email`=:cli_email, `cli_telefone`=:cli_telefone, `cli_celular`=:cli_celular, `cli_contato`=:cli_contato, `cli_observacao`=:cli_observacao, `cli_dtalter`=now(), `cli_usualter`=:usuario WHERE `cli_id`=:cli_id";

				$s_endereco = "UPDATE `fd_endereco` SET `end_cep`=:end_cep, `end_logradouro`=:end_logradouro, `end_numero`=:end_numero, `end_complemento`=:end_complemento, `end_bairro`=:end_bairro, `end_cidade`=:end_cidade, `end_estado`=:end_estado, `end_pais`=:end_pais, `end_dtalter`=now() WHERE `end_id`=:cli_idendereco";
			}

			try {
				$conexao->beginTransaction();

				$r_endereco = $conexao->prepare($s_endereco);
				if ( $_POST['cli_id']!="" && $_POST['cli_idendereco']!="" ) {
					$r_endereco->bindParam(':cli_idendereco', 	$_POST['cli_idendereco'] );
				}
				$r_endereco->bindParam(':end_cep', 				$_POST['end_cep'] );
				$r_endereco->bindParam(':end_logradouro', 		$_POST['end_logradouro'] );
				$r_endereco->bindParam(':end_numero', 			$_POST['end_numero'] );
				$r_endereco->bindParam(':end_complemento', 		$_POST['end_complemento'] );
				$r_endereco->bindParam(':end_bairro', 			$_POST['end_bairro'] );
				$r_endereco->bindParam(':end_cidade', 			$_POST['end_cidade'] );
				$r_endereco->bindParam(':end_estado', 			$_POST['end_estado'] );
				$r_endereco->bindParam(':end_pais', 				$_POST['end_pais'] );

				if ( $r_endereco->execute() ) {

					$_idendereco = $conexao->lastInsertId();

					$r_cliente = $conexao->prepare($s_cliente);
					if ( $_POST['cli_id']=="" ) {
						$r_cliente->bindParam(':cli_cpfcnpj', 		$_POST['cli_cpfcnpj'] );
						$r_cliente->bindParam(':cli_tipo', 			$_POST['cli_tipo'] );
						$r_cliente->bindParam(':cli_idendereco', 	$_idendereco );
					}else{
						$r_cliente->bindParam(':cli_id', 			$_POST['cli_id'] );
					}
					$r_cliente->bindParam(':cli_status', 			$_POST['cli_status'] );
					$r_cliente->bindParam(':cli_nome', 				$_POST['cli_nome'] );
					$r_cliente->bindParam(':cli_idsexo', 			$_POST['cli_idsexo'] );
					$r_cliente->bindParam(':cli_idestadocivil', 	$_POST['cli_idestadocivil'] );
					$r_cliente->bindParam(':cli_dtnasc', 			$_POST['cli_dtnasc'] );
					$r_cliente->bindParam(':cli_idmotivobloqueio', 	$_POST['cli_idmotivobloqueio'] );
					$r_cliente->bindParam(':cli_dtbloqueio', 		$_POST['cli_dtbloqueio'] );
					$r_cliente->bindParam(':cli_nomecartao', 		$_POST['cli_nomecartao'] );
					$r_cliente->bindParam(':cli_email', 			$_POST['cli_email'] );
					$r_cliente->bindParam(':cli_telefone', 			$_POST['cli_telefone'] );
					$r_cliente->bindParam(':cli_celular', 			$_POST['cli_celular'] );
					$r_cliente->bindParam(':cli_contato', 			$_POST['cli_contato'] );
					$r_cliente->bindParam(':cli_observacao', 		$_POST['cli_observacao'] );
					$r_cliente->bindParam(':usuario', 				$_SESSION[SS_PREFIX.'_USUARIO']->usu_id );

					if ( $r_cliente->execute() ) {

						$_idcliente = $conexao->lastInsertId();
						
						if ( $_POST['cli_id']=="" ) {
							echo "SUCESSO||Novo cliente cadastrado||".$_idcliente;
						} else {
							echo "SUCESSO||Cliente atualizado!";
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

		case 'pesquisarcliente':
			// buscar clienteS
			$contexto = '%'.$_POST['cli_pesquisar'].'%';

			$like = " C.`cli_id` LIKE '".$contexto."' OR  C.`cli_nome` LIKE '".$contexto."' OR C.`cli_cpfcnpj` LIKE '".$contexto."'";

			$getCliente = fd_getCliente( '' , 'WHERE '.$like.' AND C.`cli_iddependente` is null ORDER BY C.`cli_dtalter` DESC LIMIT '.$_POST['cli_quantidade'] );

			if ( $getCliente[0]=="SUCESSO" ) {
				if ($getCliente[1]>0 ) {
					echo "SUCESSO||";

					$_clientes=$getCliente[2];

					foreach ($_clientes as $key => $cliente) {

						$cpfcnpj = strlen($cliente->cli_cpfcnpj)<15?"CPF":"CNPJ";

						echo
						"<div class='col-sm-12'>
							<div class='card mb-3'>
								<div class='card-header'>
									<b class='text-uppercase'>".$cliente->cli_nome."</b>
									<a href='cliente?view=formcliente&cli_id=".$cliente->cli_id."' class='btn btn-primary btn-sm float-right' style='border-radius: 50px;'>
										<i class='fas fa-user-edit'></i> 
										<span class='d-none d-md-inline'>EDITAR</span>
									</a>
								</div>
								<div class='card-body'>
									<div class='row text-secondary'>
										<div class='col-6'>
											<b>".$cpfcnpj.":</b> ".$cliente->cli_cpfcnpj."
										</div>
										<div class='col-6 float-right text-right'>
											<b>Nº CONTRATO:</b> &nbsp;".$cliente->cli_id."&nbsp;&nbsp;&nbsp;
										</div>
										<div class='clearfix'></div>
									</div>

									<div class='row text-secondary'>
										<div class='col-6'>
											<b>Contato:</b> ".$cliente->cli_telefone."
										</div>
										<div class='col-6 float-right text-right'>
											<b>EMAIL:</b> ".$cliente->cli_email."
										</div>
										<div class='clearfix'></div>
									</div>
									<div class='row' >
										<div class='col-12 text-secondary'>
											<p align='justify'>
												<b class='text-left'>Observação:</b>&nbsp;&nbsp;".$cliente->cli_observacao."
											</p>
										</div>
										<div class='clearfix'></div>
									</div>

									<div class='row mt-3 float-right' hidden>
										<div class='col-12'>
											<button class='btn btn-secondary btn-sm'>
												<i class='far fa-eye'></i>&nbsp;&nbsp;
												Mais detalhes
											</button>
											<!-- <a href='#' class='card-link text-danger'>Mais detalhes</a> -->
											<!-- <a href='#' class='card-link text-danger'>Book a Trip</a> -->
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
				echo $getCliente[1]." \n";
				echo $getCliente[2]." \n";
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