<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    include_once '../../../global/controller/conexao/conexao_pdo.php';
    include_once '../../../global/controller/config.php';

	switch ( $_POST['acao'] ) {

		case 'validarlogin':
			if (!isset($_POST['usu_login']) || !isset($_POST['usu_senha'])) {
				echo "ERRONOPOST";
				exit;
			} 

			// print_r($_POST);

    		$s_usuario = "SELECT * FROM ".DB_PREFIX."_usuario where `usu_email`=:usu_login or `usu_username`=:usu_login";
			try{ 
		        $r_usuario = $conexao->prepare($s_usuario);
		        $r_usuario->bindParam(':usu_login', $_POST['usu_login'] );
		        $r_usuario->execute();
		        $c_usuario	= $r_usuario->rowCount();
		        // Valida username ou email
		        if ($c_usuario != 1) {
		        	echo "ACESSONEGADO||Usuário não encontrado";
		        	exit;
		        }
		        // Valida senha
		        $_usuario 	= $r_usuario->fetchAll(PDO::FETCH_OBJ)[0];
				if ( $_POST['usu_senha'] != $_usuario->usu_senha) {
					echo "SENHAINVALIDA||Senha incorreta";
					exit;
				}
				// Valida status do usuário
				if ( $_usuario->usu_status!= 1) {
					echo "USUARIOINATIVO||Usuário inativo sem permissão de acesso";
					exit;
				}

				// Verificar nivel de acesso
				$s_nivelacesso = "SELECT * FROM ".DB_PREFIX."_nivelacesso 
								INNER JOIN ".DB_PREFIX."_usuario ON `usu_idnivelacesso` = `nva_id`
								WHERE `nva_id`=:nva_id
								AND `usu_id`=:usu_id";

				$r_nivelacesso = $conexao->prepare($s_nivelacesso);
		        $r_nivelacesso->bindParam(':nva_id', $_usuario->usu_idnivelacesso );
		        $r_nivelacesso->bindParam(':usu_id', $_usuario->usu_id );
		        $r_nivelacesso->execute();
		        $c_nivelacesso	= $r_nivelacesso->rowCount();
		        if ($c_nivelacesso != 1) {
		        	echo "SEMPERMISSAO||Usuário está sem permissão de acesso";
		        	exit;
		        }
		        $_nivelacesso 	= $r_nivelacesso->fetchAll(PDO::FETCH_OBJ)[0];
		        // Validar status do nivel de acesso
		        if ( $_nivelacesso->nva_status!= 1) {
					echo "NIVELDEACESSOINATIVO||O usuário pertence à um grupo sem permissão de acesso";
					exit;
				}

				// print_r($_usuario);

		        // Update de acesso
		        $u_acesso = "UPDATE ".DB_PREFIX."_usuario
		        			SET `usu_codigo`=NULL, `usu_ultimoacesso`=now() 
		        			WHERE `usu_id`=:usu_id";
	        	$r_acesso = $conexao->prepare($u_acesso);
   	 			$r_acesso->bindValue(':usu_id', $_usuario->usu_id);
   	 			$r_acesso->execute();
						        
		        // Criar sessões de LOGIN
				$_SESSION[SS_PREFIX.'_LOGIN']			= true;
				$_SESSION[SS_PREFIX.'_USUARIO'] 		= $_usuario;
				$_SESSION[SS_PREFIX.'_NIVELACESSO'] 	= $_nivelacesso;
				$_SESSION[SS_PREFIX.'_MENU'] 			= 1; // 1 aberto  // 0 fechado
				$_SESSION[SS_PREFIX.'_DTLOGIN'] 		= date("Y-m-d H:i:s");

				echo "SUCESSO||Acesso permitido, aguarde...";
				exit; // FIM
		    }catch(PDOException $e){
		        echo 'ERROPDO||'.$e;
		        exit;
		    } // se nao der certo faça isso
		break;

		case 'alternarmenu':
			if ( $_SESSION[SS_PREFIX.'_MENU'] == 1) {
				$_SESSION[SS_PREFIX.'_MENU'] = 0;
			}else{
				$_SESSION[SS_PREFIX.'_MENU'] = 1;
			}
			echo $_SESSION[SS_PREFIX.'_MENU'];
		break;
		
		default:
			echo "ERROGRAVE||Ação desconhecida";
	    	exit;
		break;
	} // fim so switch post acao

?>