<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*

    // Permitir somente usuário logado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']!=true ) {
        header('Location: login');
        exit;
    }

    if ( $_SESSION[SS_PREFIX.'_USUARIO']->nva_gerenciarbasico!=1 ) {
        fgb_erro( 'Usuário sem permissão de gerenciar cadastro básico', 'Usuário sem permissão de gerenciar cadastro básico', 'cadastrobasico.php', 'NOTFOUND' );
        exit;
    }

	include 'page-sistema/cadastrobasico/function/cadastrobasico.php';

	$cadastrosBasicos = array(
		array(
			'titulo' => 'CATEGORIA', 
			'tabela' => 'categoria',
			'prefixo' => 'ctg',
			'modal' => 'basico'
		),
		array(
			'titulo' => 'ESTADO CIVIL', 
			'tabela' => 'estadocivil',
			'prefixo' => 'ecv',
			'modal' => 'basico'
		), 
		array(
			'titulo' => 'SETOR', 
			'tabela' => 'setor',
			'prefixo' => 'set',
			'modal' => 'basico'
		), 
		array(
			'titulo' => 'SEXO', 
			'tabela' => 'sexo',
			'prefixo' => 'sex',
			'modal' => 'basico'
		),
	);
	
?>

<div class="row pl-3 pr-3 pt-0">
	<div class="col-sm-12">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-12">
						<h3>
							<b>Cadastro básico</b>
						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<table class="table table-striped">
							<thead>
								<tr class="row">
									<th class="col">
										<div class="row">
											<div class="col-sm-8 col-md-6 text-left">Cadastro de</div>
											<div class="d-none d-md-table-cell col-4 text-center">Total de registros</div>
											<div class="col-sm-4 col-md-2 text-right">#</div>
										</div>
									</th>
								</tr>
							</thead>
							<tbody>

								<?php foreach ($cadastrosBasicos as $key => $value): ?>
									<tr class="row">
										<td class="col">
											<div class="row">
												<div class="col-sm-8 col-md-6 text-left"><?=$value['titulo']?></div>
												<div class="d-none d-md-table-cell col-4 text-center"><?=getTotalCadastroBasico($value['tabela'])?></div>
												<div class="col-sm-4 col-md-2 text-right">
													<button onclick="abrirCadastroBasico('<?=$value['titulo']?>', '<?=$value['tabela']?>', '<?=$value['prefixo']?>')" class="btn btn-primary btn-sm <?=$value['tabela']?>">
														<i class="icofont-folder-open"></i>&nbsp;&nbsp;
														Abrir
													</button>
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		<?php if ( isset($_GET['view']) && $_GET['view']=="modal" && $_GET['tabela']!="" ): ?>
			$(".<?=$_GET['tabela']?>").click();
		<?php endif ?>

	});

	// Modal
	function abrirCadastroBasico(titulo, tabela, prefixo, modal="basico") {
        $.ajax({
            url:    'page-sistema/cadastrobasico/view/modal_'+modal+'.php',
            type:   'POST',
            data:   'titulo='+titulo+'&tabela='+tabela+'&prefixo='+prefixo+'&modal='+modal,
            success: function(retornoloadfile){
                abrirModalGlobal('<i class="fas fa-tools"></i> '+titulo, retornoloadfile, '&nbsp;');
                $("#modal_global_body").addClass('pt-0');
            } // fim da function
        }); // fim do ajax  
    }
</script>