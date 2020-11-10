<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
	// validar post
	if ( !isset($_POST['usu_id']) && $_POST['usu_id']=="" ) {
		echo "<h1 class='text-danger'>Erro grave, é necessário que informe o id do usuário!</h1>";
		exit;
	}

	// functions - carregar usuario
    include '../../../page-sistema/usuario/function/usuario.php';

	$getUsuario = acb_getUsuario( array('usu_id' => $_POST['usu_id'] ) );
	if ( $getUsuario[0]!="SUCESSO" && $getUsuario[1]!=1 ) {
		echo "<h1 class='text-danger'>Não encontramos o usuário com id: ".$_POST['usu_id']."</h1>";
        exit;
	}

	$_usuario=$getUsuario[2][0];

	$getBasicoUsuario = acb_getBasicoUsuario();
	if ( $getBasicoUsuario[0]=="SUCESSO" ) {
		if ( $getBasicoUsuario[DB_PREFIX."_nivelacesso"]['total']<=0 ) {
			echo '<h1 class="text-danger">Cadastro básico de nivel de acesso não encontrado</h1>';
            exit;
		}

		if ( $getBasicoUsuario[DB_PREFIX."_sexo"]['total']<=0 ) {
			echo '<h1 class="text-danger">Cadastro básico de sexo não encontrado</h1>';
            exit;
		}

		if ( $getBasicoUsuario[DB_PREFIX."_estadocivil"]['total']<=0 ) {
			echo '<h1 class="text-danger">Cadastro básico de estado civil não encontrado</h1>';
            exit;
		}

		if ( $getBasicoUsuario[DB_PREFIX."_setor"]['total']<=0 ) {
			echo '<h1 class="text-danger">Cadastro básico de setor não encontrado</h1>';
            exit;
		}

		$_nivelacesso 		= $getBasicoUsuario[DB_PREFIX."_nivelacesso"]['resultado'];
		$_sexo 				= $getBasicoUsuario[DB_PREFIX."_sexo"]['resultado'];
		$_estadocivil 		= $getBasicoUsuario[DB_PREFIX."_estadocivil"]['resultado'];
		$_setor				= $getBasicoUsuario[DB_PREFIX."_setor"]['resultado'];
	}
?>

<section id="imprimirusuario" class="mt-3 mr-2 ml-2 mb-3">
	<div class="row">
		<div class="col-2 pl-3">
			<img class="img-fluid" src="global/media/logo_acb.png" align="center">
		</div>
		<div class="col-8">
			<h3 class="text-center mb-1">Açai com Bobagens</h3>
			<h6 class="text-center text-secondary">Ficha de funcionário</h6>
		</div>
		<div class="col-2 pr-3 text-right text-secondary">
			<?=date('d/m/Y')?><br>
			<?=date('H:i')?>
		</div>
	</div>
	<hr class="mt-3 mb-3" style="border: 1px solid #ccc; border-radius: 5px;">

	<h5 class="text-secondary">Dados pessoais</h5>
	
	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-8 text-left">
			<b>Nome:</b> <?=$_usuario->usu_nome?>
		</div>
		<div class="col-4 text-left">
			<b>CPF:</b> <?=$_usuario->usu_cpf?>
		</div>
	</div>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-3 text-left">
			<b>Sexo:</b> 
				<?php foreach ($_sexo as $key => $sexo): ?>
					<?=$_usuario->usu_idsexo==$sexo->sex_id?ucfirst(strtolower($sexo->sex_nome)):''?>
				<?php endforeach ?>
		</div>
		<div class="col-3 text-left">
			<b>Estado Civil:</b>
				<?php foreach ($_estadocivil as $key => $estadocivil): ?>
					<?=$_usuario->usu_idestadocivil==$estadocivil->ecv_id?ucfirst(strtolower($estadocivil->ecv_nome)):''?>
				<?php endforeach ?>
		</div>
		<div class="col-6 text-left">
			<b>Nascido em:</b> <?=date('d/m/Y', strtotime($_usuario->usu_dtnasc))?>, 27 anos
		</div>
	</div>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-6 text-left">
			<b>Email:</b> <?=$_usuario->usu_email?>
		</div>
		<div class="col-6 text-left">
			<b>Email ACB:</b> <?=$_usuario->usu_emailacb?>
		</div>
	</div>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-6 text-left">
			<b>Telefone:</b> <?=$_usuario->usu_telefone?>
		</div>
		<div class="col-6 text-left">
			<b><?=$_usuario->usu_whatsapp==1?"WhatsApp":"Celular"?>:</b> <?=$_usuario->usu_celular?>
		</div>
	</div>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-6 text-left">
			<b>Cargo:</b> <?=$_usuario->usu_cargo?>
		</div>
		<div class="col-6 text-left">
			<b>Corporativo:</b> <?=$_usuario->usu_corporativo?>
		</div>
	</div>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-6 text-left">
			<b>Setor:</b> 
				<?php foreach ($_setor as $key => $setor): ?>
					<?=$_usuario->usu_idsetor==$setor->set_id?ucfirst(strtolower($setor->set_nome)):''?>
				<?php endforeach ?>
		</div>
		<div class="col-6 text-left">
			<b>Remuneração:</b> R$ <?=number_format($_usuario->usu_remuneracao, 2, ',', '.')?>
		</div>
	</div>

	<h5 class="mt-3 text-secondary">Endereço</h5>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-4 text-left">
			<b>CEP:</b> <?=$_usuario->end_cep?>
		</div>
		<div class="col-8 text-left">
			<b>Logradouro:</b> <?=$_usuario->end_logradouro?>
			Nº <?=$_usuario->end_numero?>
		</div>
	</div>

	<div class="row m-0 pt-2 pb-2 border">
		<div class="col-4 text-left">
			<b>Bairro:</b> <?=$_usuario->end_bairro?>
		</div>
		<div class="col-4 text-left">
			<b>Cidade:</b> <?=$_usuario->end_cidade?>
		</div>
		<div class="col-4 text-left">
			<b>UF:</b> <?=$_usuario->end_estado?>/<?=$_usuario->end_pais?>
		</div>
	</div>

	<div class="dadosdeacesso_print">
		<h5 class="mt-3 text-secondary">Dados de acesso</h5>

		<div class="row m-0 pt-2 pb-2 border">
			<div class="col-6 text-left">
				<b>Usuário:</b> <?=$_usuario->usu_username?>
			</div>
			<div class="col-6 text-left">
				<b>Nível de acesso:</b> 
					<?php foreach ($_nivelacesso as $key => $nivelacesso): ?>
						<?=$_usuario->usu_idnivelacesso==$nivelacesso->nva_id?ucfirst(strtolower($nivelacesso->nva_nome)):''?>
					<?php endforeach ?>
			</div>
		</div>

		<div class="row m-0 pt-2 pb-2 border">
			<div class="col-4 text-left">
				<b>Cadastrado em:</b> 
					<br><?=date('d/m/Y H:i', strtotime($_usuario->usu_dtcad))?>
			</div>
			<div class="col-4 text-left">
				<b>Alterado em:</b> 
					<br><?=date('d/m/Y H:i', strtotime($_usuario->usu_dtalter))?>
			</div>
			<div class="col-4 text-left">
				<b>Ultimo acesso:</b> 
					<br><?=date('d/m/Y H:i', strtotime($_usuario->usu_ultimoacesso))?>
			</div>
		</div>
	</div>

	<div class="observacao">
		<h5 class="mt-3 text-secondary">Observação</h5>

		<div class="row m-0 pt-2 pb-2 border">
			<div class="col-12 text-left">
				<p id="text_observacao" align="justify">
					<i>Clique em <b>adicionar</b> para adicionar aqui seu texto personalizado!</i>
				</p>
				<textarea id="textarea_obs" class="form-control form-control-sm textarea_obs" rows="3" placeholder="Digite aqui sua observação para impressão, depois clique em atualizar"></textarea>
			</div>
			<div class="col-12 text-left">
				<button id="btn_adicionarobs" class="btn btn-sm btn-default text-danger">Adicionar</button>
				<button id="btn_atualizarobs" class="btn btn-sm btn-default text-primary textarea_obs">Atualizar</button>
			</div>
		</div>
	</div>

	<div class="assinatura mt-5">
		<div class="row m-0 pt-2 pb-2">
			<div class="col-6 text-center">
				<hr class="mt-3 mb-0" style="border: 1px solid #ccc; border-radius: 5px; width: 80%">
				<span class="small"><i>Açai com Bobagens</i></span>
			</div>
			<div class="col-6 text-center">
				<hr class="mt-3 mb-0" style="border: 1px solid #ccc; border-radius: 5px; width: 80%">
				<span class="small"><i>Funcionário</i></span>
			</div>
		</div>
	</div>
	
	<div class="row mt-5 pt-2 pb-2">
		<div class="col-12 text-center small text-secondary">
			Contagem, <?=date('d F Y')?> <?=date('H:i')?>
		</div>
	</div>	
</section>

<script type="text/javascript">
	$(document).ready(function(){ 
		var dadosdeacesso_print = 'hide';
		var observacao 			= 'hide';
		var assinatura 			= 'hide';

		$('#btn_verdadosacesso').click(function() {
			if ( dadosdeacesso_print == 'hide' ) {
				$('.dadosdeacesso_print').hide();
				dadosdeacesso_print = 'show';
			} else {
				$('.dadosdeacesso_print').fadeIn(500);
				dadosdeacesso_print = 'hide';
			}
		});

		$('#btn_verobservacao').click(function() {
			if ( observacao == 'hide' ) {
				$('.observacao').hide();
				observacao = 'show';
			} else {
				$('.observacao').fadeIn(500);
				observacao = 'hide';
			}
		});

		$('#btn_verassinatura').click(function() {
			if ( assinatura == 'hide' ) {
				$('.assinatura').hide();
				assinatura = 'show';
			} else {
				$('.assinatura').fadeIn(500);
				assinatura = 'hide';
			}
		});

		$('#btn_adicionarobs').click(function() {
			$(this).hide();
			// $('#text_observacao').hide();
			$('.textarea_obs').fadeIn(500);
		});

		//btn_atualizarobs
		$('.textarea_obs').hide();
		$('#btn_atualizarobs').click(function() {
			$('#text_observacao').html( $('#textarea_obs').val() );
			if ( $('#textarea_obs').val()=="" || $('#textarea_obs').val().lenght<5 ) {
				$('#textarea_obs').val('');
				$('#textarea_obs').hide();
				$('#text_observacao').html('<span class="text-danger">Nada foi alterado aqui!</span><br><i>Clique em <b>adicionar</b> para adicionar aqui seu texto personalizado!</i>');
				$('#btn_adicionarobs').text('Adicionar');
			} else {
				$('#textarea_obs').hide();
				$('#btn_adicionarobs').text('Atualizar');
			}
			$(this).hide();
			$('#btn_adicionarobs').fadeIn(500);
		});

		$('#textarea_obs').bind("blur, keyup, keydown, mouseover", function() {
            $('#text_observacao').html( $('#textarea_obs').val() );
            setTimeout(function(){
				$('#textarea_obs').mouseover();
	        }, 350);
        });
	});

	function acb_imprimir(){
		$('#btn_adicionarobs').hide();

		if ( $('#textarea_obs').val()=="" || $('#textarea_obs').val().lenght<5 ) {
			$('.observacao').hide();
			observacao = 'show';
		}

        var divToPrint=document.getElementById('imprimirusuario');
        var newWin=window.open('','Print-Window');
        newWin.document.open();

        newWin.document.write('<html>');
            newWin.document.write('<head>');
                newWin.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">');
            newWin.document.write('</head>');
            newWin.document.write('<body onload="window.print()">');
                newWin.document.write('<div class="container-fluid pt-5 pb-5">');
                    newWin.document.write(divToPrint.innerHTML);
                newWin.document.write('</div>');
            newWin.document.write('</body>');
        newWin.document.write('</html>');

        newWin.document.close();

        setTimeout(function(){
            newWin.close();
        },10);

        $('#btn_adicionarobs').fadeIn(500);
    }
</script>