<?php
    include_once "../../config/database.php";

    $id = $_POST['idcliente'];

    //Seleciona informações do cliente
    $query = "SELECT * FROM CLIENTES WHERE ID = :idCliente";

    $resultado = $conexao->prepare($query);
    
    $resultado->bindParam(':idCliente', $id);

    $resultado->execute(); 

    $linha  = $resultado->fetchAll(PDO::FETCH_OBJ);
    $contar = $resultado->rowCount();

    $listar_cli = $linha[0];

    //Seleciona informações de telefones do cliente
    $query_tel = "SELECT * FROM TELEFONES WHERE `ID_CLIENTE` = :idCliente";

    $resultado = $conexao->prepare($query_tel);
    
    $resultado->bindParam(':idCliente', $id);

    $resultado->execute(); 

    $linha_tel  = $resultado->fetchAll(PDO::FETCH_OBJ);
    $contar_tel = $resultado->rowCount();

    //Seleciona informações de interesse daquele cliente
    // $query_int = "SELECT * FROM INTERESSES WHERE `ID_CLIENTE` = :idCliente";

    // $resultado = $conexao->prepare($query_int);
    
    // $resultado->bindParam(':idCliente', $id);

    // $resultado->execute(); 

    // $linha_int  = $resultado->fetchAll(PDO::FETCH_OBJ);
    // $contar_int = $resultado->rowCount();
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
        
        <div class="row">
            <div class="col-md-12">
                <table id="table_clietes" class="table table-dark">
                    <thead>
                        <tr>
                        <th colspan="4" style="text-align: center;">Telefones
                            <button id="btn_showTelefone" class="badge badge-success p-2 float-right"><i class="fas fa-plus"></i></button>
                            <button id="btn_hideTelefone" class="badge badge-warning p-2 float-right d-none"><i class="fas fa-minus"></i></button>
                            <div id="input_tel" class="row col-md-12 d-none">
                                <input type="tel" class="form-control col-md-10" name="celular" id="celular" placeholder="Celular do cliente">
                                <button id="save_celphone" class="badge badge-success col-md-2 p-2"><i class="fas fa-plus"></i></button>
                            </div>
                        </th>
                        </tr>
                        <?php if($contar_tel){ ?>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Numero</th>
                        <th scope="col">É WPP?</th>
                        </tr>
                        <?php } ?>
                    </thead>
                    <?php if($contar_tel){ ?>
                    <tbody>
                        <?php foreach ($linha_tel as $key => $cliente) { ?>
                            <tr>
                            <th scope="row"><?=$cliente->ID ?></th>
                                <td><?=$cliente->NUMBER ?></td>
                                <td>Não sei</td>
                                <td class="text-center"><button class="badge badge-info p-2 btn-block"><i class="fas fa-edit"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <?php } ?>
                </table>
            </div>	
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="table_clietes" class="table table-dark">
                    <thead>
                        <tr>
                        <th colspan="3" style="text-align: center;">Interesses
                            <button id="btn_novoInteresse" idCliente="<?= $id ?>" class="badge badge-success p-2 float-right"><i class="fas fa-plus"></i></button>
                        </th>
                        </tr>
                        <?php if($contar_tel){ ?>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Detalhes</th>
                        </tr>
                        <?php } ?>
                    </thead>
                    <?php if($contar_tel){ ?>
                    <tbody>
                        <?php foreach ($linha_tel as $key => $cliente) { ?>
                            <tr>
                            <th scope="row"><?=$cliente->ID ?></th>
                                <td>Automóvel</td>
                                <td class="text-center"><button class="badge badge-info p-2 btn-block"><i class="fas fa-info"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <?php } ?>
                </table>
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

        $('#btn_novoInteresse').click(function(){
            var idClienteDetalhes = $(this).attr('idCliente');

            $.ajax({
                url:    'pages/home/modalNovoInteresse.php',
                type:   'POST',
                data:       'idcliente='+idClienteDetalhes,
                beforeSend: '',
                error:      '',
                success: function(retornodetalhes){
                    $('#modal-infocontato').find('.modal-content').html(retornodetalhes);
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
