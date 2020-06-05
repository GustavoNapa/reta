<?php

$query = "SELECT * FROM CLIENTES";

$resultado = $conexao->prepare($query);
$resultado->execute(); 

$linha  = $resultado->fetchAll(PDO::FETCH_OBJ);
$contar = $resultado->rowCount();

?>

<div id="modal-infocontato" name="modal-infocontato" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<button id="btn_showNovoCarro" class="btn btn-success btn-block mb-4">Novo</button>
    <hr>
    <div>
        <form id="form_cadCarro" class="p-4">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp" placeholder="Nome do cliente">
            </div>
            <div class="form-group">
                <label>Interesse</label>
                
                <div class="form-check">
                <input class="form-check-input" type="radio" name="interesse" id="interesse1" value="Comprar" checked>
                <label class="form-check-label" for="interesse1">
                    Comprar
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="interesse" id="interesse2" value="Vender">
                <label class="form-check-label" for="interesse2">
                    Vender
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="interesse" id="exampleRadios3" value="Comprar e vender">
                <label class="form-check-label" for="exampleRadios3">
                    Comprar e vender
                </label>
                </div>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="tel" class="form-control" name="celular" id="celular" aria-describedby="emailHelp" placeholder="Celular do cliente">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            <button id="btn_hideNovoCarro" type="button" class="btn btn-warning btn-block">Voltar</button>
        </form>
    </div>
    <table id="table_clietes" class="table table-dark">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Interesse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($linha as $key => $cliente) { ?>
                <tr>
                <th scope="row"><?=$cliente->ID ?></th>
                    <td><?=$cliente->NAME ?></td>
                    <td><?=$cliente->INTERESSE ?></td>
                    <td class="text-center"><button idCliente="<?=$cliente->ID ?>" class="btn_infoCliente badge badge-info p-2"><i class="fas fa-info"></i></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    
<script>
    $('#form_cadCarro').hide();
    $('#celular').mask('(##) #####-####');

    $(document).ready(function(err) {
        $('#btn_showNovoCarro').click(function() {
            openFormClient();
            toastr["success"]("Preencha os dados corretamente!");
        });

        $('#btn_hideNovoCarro').click(function() {
            hideFormClient();
            toastr["warning"]("Os dados não foram salvos");
        });

        $('.btn_infoCliente').click(function(){
            $('#modal-infocontato').modal('show');

            var idClienteDetalhes = $(this).attr('idCliente');

            $.ajax({
                url:    'pages/home/modalVisualizarCliente.php',
                type:   'POST',
                data:       'idcliente='+idClienteDetalhes,
                beforeSend: '',
                error:      '',
                success: function(retornodetalhes){
                    $('#modal-infocontato').find('.modal-content').html(retornodetalhes);
                } // fim da function
            }); // fim do ajax
        });
        
        // Validar e salvar dados
        $('#form_cadCarro').submit(function(norefresh){

            // evitar refresh de formulario
            norefresh.preventDefault();  

            // coloque aqui as coisas de validação e ajax...                 
            var dados = $('#form_cadCarro').serialize();

            console.log('dados: '+dados);

            // dispara o ajax depois de 1segundo
            setTimeout(function(){
                // salvar dador pessoais
                $.ajax({
                    url:  'pages/home/save.php',
                    type:   'POST',
                    data:       'acao=salvar&'+dados,
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
        }); // fim do submit endereços
    });

    function openFormClient() {
        $('#btn_showNovoCarro').hide(300);
        $('#table_clietes').hide(300);
        
        $('#form_cadCarro').show(600);
    }

    function hideFormClient() {
        $('#form_cadCarro').hide(300);

        $('#btn_showNovoCarro').show(600);
        $('#table_clietes').show(600);
    }
</script>