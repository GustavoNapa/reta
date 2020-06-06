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
        <div class="row">
            <div class="col-md-12">
                <label>Nome: </label>
                <label id="cpf_cli_<?php echo $listar_cli->ID; ?>"><?php echo $listar_cli->NAME; ?></label>
            </div>
            <div class="col-md-12">
                <label>Interesse: </label>
                <label><?php echo $listar_cli->INTERESSE; ?></label>
            </div>	
        </div>
    </div>
</div>
<div class="modal-footer">
</div>
<script>
    $('#celular').mask('(##) #####-####');

    $(document).ready(function(err) {
        $('#btn_showTelefone').click(function() {
            openFormTelefone();
        });
        $('#btn_hideTelefone').click(function() {
            hideFormTelefone();
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

    function openFormTelefone() {
        $('#btn_showTelefone').addClass("d-none");
        $('#btn_hideTelefone').removeClass("d-none");
        $('#input_tel').removeClass("d-none");
    }

    function hideFormTelefone() {
        $('#btn_showTelefone').removeClass("d-none");
        $('#btn_hideTelefone').addClass("d-none");
        $('#input_tel').addClass("d-none");
    }
</script>