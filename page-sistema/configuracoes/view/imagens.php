<?php
ob_start(); //abrir sessao
session_start();//iniciar sessao
error_reporting(0); //não exibir erros!*
	
?>

<div class="card shadow mb-3">
	<div class="card-header">
		<div class="row">
			<div class="col-12 h5">
				<i class="fas fa-camera-retro"></i> Imagens do sistema e site

				<span class="float-right">
					<a href="configuracoes" type="button" class="btn btn-secondary mr-2 btn-sm" style="border-radius: 50px;">
						<i class="fas fa-undo-alt"></i>
						<span class="d-none d-md-inline">VOLTAR</span>
					</a>
				</span>
			</div>
		</div>
	</div>
	<div class="card-body">

		<div class="row">
			<div class="col-12">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">Descrição</th>
							<th scope="col" class="text-right">Visualizar</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Logo Açai com Bobagens</td>
							<td class="text-right">
								<button class="btn btn-primary btn-sm">
									<i class="far fa-eye"></i>&nbsp;&nbsp;
									Visualizar
								</button>
							</td>
						</tr>

						<tr>
							<td>Logo Cream Purple</td>
							<td class="text-right">
								<button class="btn btn-primary btn-sm">
									<i class="far fa-eye"></i>&nbsp;&nbsp;
									Visualizar
								</button>
							</td>
						</tr>

					</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		<?php if ( isset($_GET['view']) && $_GET['view']=="modal" && $_GET['tabela']!="" ): ?>
			// $(".<?=$_GET['tabela']?>").click();
		<?php endif ?>

	});

	// Modal
	// function abrirCadastroBasico(titulo, tabela, prefixo, modal="basico") {
 //        $.ajax({
 //            url:    'page-sistema/cadastrobasico/view/modal_'+modal+'.php',
 //            type:   'POST',
 //            data:   'titulo='+titulo+'&tabela='+tabela+'&prefixo='+prefixo+'&modal='+modal,
 //            success: function(retornoloadfile){
 //                abrirModalGlobal('<i class="fas fa-tools"></i> '+titulo, retornoloadfile, '&nbsp;');
 //                $("#modal_global_body").addClass('pt-0');
 //            } // fim da function
 //        }); // fim do ajax  
 //    }
</script>