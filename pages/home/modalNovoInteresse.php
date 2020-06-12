<?php
    include_once "../../config/database.php";

    $id = $_POST['idcliente'];

    $query = "SELECT * FROM CLIENTES WHERE ID = :idCliente";

    $resultado = $conexao->prepare($query);
    
    $resultado->bindParam(':idCliente', $id);

    $resultado->execute(); 

    $linha  = $resultado->fetchAll(PDO::FETCH_OBJ);
    $contar = $resultado->rowCount();

    $listar_cli = $linha[0];

    $query_tel = "SELECT * FROM TELEFONES WHERE `ID_CLIENTE` = :idCliente";

    $resultado = $conexao->prepare($query_tel);
    
    $resultado->bindParam(':idCliente', $id);

    $resultado->execute(); 

    $linha_tel  = $resultado->fetchAll(PDO::FETCH_OBJ);
    $contar_tel = $resultado->rowCount();
?>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detalhes do cliente</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container-fluid modal-body">
	<div class="al-left col-md-12">
        <div class="col-md-12">
            <label>Nome: </label>
            <label id="cpf_cli_<?php echo $listar_cli->ID; ?>"><?php echo $listar_cli->NAME; ?></label>
        </div>
        <div class="col-md-12">
            <label>Interesse: </label>
            <label><?php echo $listar_cli->INTERESSE; ?></label>
        </div>
        <div class="col-md-12">
            </label><label for="btn_trade" class="control-label"></label>
            <button id="btn_trade" type="button" class="btn btn-block btn-success btn-sel-page">
                <span id="span_trade"><b><i class="fas fa-arrow-up"></i> </b>Vender</span>
                <input id="trade" name="trade" type="checkbox" checked class="invisible">
            </button>
        </div>
        <div class="col-md-12">
            </label><label for="btn_bem_pretendido" class="control-label"></label>
            <button id="btn_bem_pretendido" type="button" class="btn btn-block btn-info btn-sel-page">
                <span id="span_bem_pretendido"><b><i class="fas fa-car"></i> </b>Carro</span>
                <input id="bem_pretendido" name="bem_pretendido" type="checkbox" class="invisible">
            </button>
        </div>
        <HR />
        <div id="detalhes" class="col-md-12">
            <?php include_once "venderCarro.php"; ?>
        </div>    
        <div class="form-group">
            <button idCliente="<?= $id ?>" class="btn_infoCliente btn btn-warning btn-block p-2"><i class="fas fa-arrow-left"></i> Voltar</button>
        </div>
    </div>
    
</div>
<div class="modal-footer">
</div>
<script>
    $('#celular').mask('(##) #####-####');

    $(document).ready(function(err) {

        $('#btn_bem_pretendido').click(function(){
            if(document.getElementById("bem_pretendido").checked == true){
                document.getElementById("bem_pretendido").checked = false;
                $('#btn_bem_pretendido').removeClass('btn-warning').addClass('btn-info');
                $('#span_bem_pretendido').html('<b><i class="fas fa-car"></i> </b>Automovel');
            }else{
                document.getElementById("bem_pretendido").checked = true;
                $('#btn_bem_pretendido').removeClass('btn-info').addClass('btn-warning');
                $('#span_bem_pretendido').html('<b><i class="fas fa-home"></i> </b>Imovel');              
            }
        });

        $('#btn_trade').click(function(){
            if(document.getElementById("trade").checked == true){
                document.getElementById("trade").checked = false;
                $('#btn_trade').removeClass('btn-success').addClass('btn-danger');
                $('#span_trade').html('<b><i class="fas fa-arrow-down"></i> </b>Comprar');
            }else{
                document.getElementById("trade").checked = true;
                $('#btn_trade').removeClass('btn-danger').addClass('btn-success');
                $('#span_trade').html('<b><i class="fas fa-arrow-up"></i> </b>Vender');              
            }
        });

        $('#btn_troca').click(function(){
            if(document.getElementById("troca").checked == true){
                document.getElementById("troca").checked = false;
                $('#btn_troca').removeClass('btn-success').addClass('btn-danger');
                $('#span_troca').html('NÃO');
            }else{
                document.getElementById("troca").checked = true;
                $('#btn_troca').removeClass('btn-danger').addClass('btn-success');
                $('#span_troca').html('SIM');              
            }
        });

        $('.btn-sel-page').click(function(){
            trade = document.getElementById("trade").checked;
            bem_pretendido = document.getElementById("bem_pretendido").checked;

            if(trade){
                if(bem_pretendido){
                    $.ajax({
                        url:    'pages/home/venderImovel.php',
                        success: function(retornodetalhes){
                            $("#detalhes").html(retornodetalhes);
                        } // fim da function
                    }); // fim do ajax
                }else{
                    $.ajax({
                        url:    'pages/home/venderCarro.php',
                        success: function(retornodetalhes){
                            $("#detalhes").html(retornodetalhes);
                        } // fim da function
                    }); // fim do ajax
                }
            }else{
                if(bem_pretendido){                    
                    $.ajax({
                        url:    'pages/home/comprarImovel.php',
                        success: function(retornodetalhes){
                            $("#detalhes").html(retornodetalhes);
                        } // fim da function
                    }); // fim do ajax
                }else{
                    $.ajax({
                        url:    'pages/home/comprarCarro.php',
                        success: function(retornodetalhes){
                            $("#detalhes").html(retornodetalhes);
                        } // fim da function
                    }); // fim do ajax
                }
            }
        });

        $('#salvar_interesse').click(function() {
            toastr["warning"]("Ainda não implementado"); 
        });

        $('.btn_infoCliente').click(function(){
            var idClienteDetalhes = $(this).attr('idCliente');

            $.ajax({
                url:    'pages/home/modalVisualizarCliente.php',
                type:   'POST',
                data:       'idcliente='+idClienteDetalhes,
                beforeSend: '',
                error:      '',
                success: function(retornodetalhes){
                    $('#modal-infocontato').find('.modal-content').html(retornodetalhes);

                    $('#modal-infocontato').modal('show');
                } // fim da function
            }); // fim do ajax
        });

        $('#save_celphone').click(function() {
            idCliente = <?= $_POST['idcliente']; ?>

            celular = $('#celular').val();

            // dispara o ajax depois de 1segundo
            setTimeout(function(){
                // salvar dador pessoais
                $.ajax({
                    url:  'pages/home/save.php',
                    type:   'POST',
                    data:       'acao=salvar_telefone&idCliente='+idCliente+'&celular='+celular,
                    beforeSend: '',
                    error:      '',
                    success: function(retornovalidarendereco){

                        switch(retornovalidarendereco) {

                            case "0":
                                toastr["success"]("Área de teste");  
                                console.log(retornovalidarendereco); 

                                return false;                         
                            break;

                            // TRATAR SUCESSO DE UPDATE
                            case "INSERTSUCESSO":
                                toastr["success"]("Salvo com sucesso!");
                                
                                setTimeout(function(){
                                    // reload
                                    location.reload();                                
                                }, 500);
                                return false;                                        
                            break;
                            
                            case "UPDATESUCESSO":
                                toastr["success"]("Dados atualizados com sucesso!");
                                console.log('update-endereco - Sucesso ao atualizar enderenço: '+retornovalidarendereco);

                                setTimeout(function(){
                                    // reload
                                    location.reload('cliente?acao=cadastrar');                                
                                }, 500);

                                return false;
                            break;

                            // TRATAR ERROS DE UPDATE
                            case "ERRONOUPDATE":
                                toastr["error"]("Ocorreu um erro grave, você será redirecionado!");
                                console.log('update-endereco - Erro no PDO Insert: '+retornovalidarendereco);
                                
                                setTimeout(function(){
                                    window.location.replace('cliente?acao=recuperacao');
                                }, 1000); 
                                return false;
                            break;

                            case "DUPLICIDADEENCONTRADA":
                                toastr["warning"]("Ouve um erro, endereço duplicado, não é permitido este tipo de duplicidade.");
                                console.log('Erro no Insert: '+retornoinserirdadospessoais);
                                
                                setTimeout(function(){
                                    window.location.replace('cliente');
                                }, 5000); 
                                return false;
                            break;

                            case "CAMPOSOBRIGATORIOSVAZIOS":                            
                                toastr["warning"]("Existem campos obrigatórios vazios! Verifique e tente novamente...");
                                console.log('update-endereco - Campos do formulários vazio: '+retornovalidarendereco);

                                return false;
                            break;

                            default:
                                console.log(retornovalidarendereco);
                                toastr["error"]("Algo de errado aconteceu.");
                                toastr["error"](retornovalidarendereco);

                                return false;
                            break;
                        } // Fim do Switch
                    } // fim da function
                }); // fim do ajax
            }, 1000); 
        })
    });
</script>