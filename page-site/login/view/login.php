<?php
    // Permitir somente usuário deslogado
    if ( $_SESSION[SS_PREFIX.'_LOGIN']==true ) {

        $dataHoje       = date("Y-m-d H:i:s");
        $dataCreated    = $_SESSION[SS_PREFIX.'_DTLOGIN'];

        // Calcula a diferença em segundos entre as datas
        // $diferencaDia = floor ( ( strtotime($dataHoje) - strtotime($dataCreated) ) / ( 60*60*24 ) );
        $diferencaHora = floor( ( strtotime($dataHoje) - strtotime($dataCreated) ) / 3600 );

        if ( $diferencaHora>1 ) {
            session_destroy();
            unset($_SESSION);
            header('Location: login');
            exit;
        }else{
            header('Location: admin');
            exit;
        }
    }
?>

<style type="text/css">
    body {
        background: 
            linear-gradient(
              rgba(0, 0, 0, 0.7), 
              rgba(0, 0, 0, 0.7)
            ),
            url(page-site/inicio/media/loja_acb2.jpg) fixed center center;
        background-size: cover;
        padding: 60px 0;
    }
    .transparent{
        background: rgba(255, 255, 255, 0.5);
    }
</style>

<div id="login" class="container">
    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-4"></div>
        <div class="col-sm-8 col-md-8 col-lg-4">
            <form id="form_login" class="needs-validation mt-5" novalidate>

                <div class="card shadow transparent">
                    <div class="card-body">

                        <center>
                            <img class="avatar rounded-circle" src="global/media/logo_acb.png" style="max-height: 100px">
                        </center>

                        <div class="clearfix mb-3"></div>

                        <div class="mb-3">
                            <label for="usu_login" class="small text-dark"><b>Usuário</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                </div>
                                <input id="usu_login" name="usu_login" type="text" class="form-control" placeholder="Usuário" required="">
                                <div class="invalid-feedback" style="width: 100%;">
                                    Informe nome de usuário ou email
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="usu_senha" class="small text-dark"><b>Senha</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend" onclick="$('#usu_senha').attr('type', 'password');$('#ver_senha').fadeIn();">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input id="usu_senha" name="usu_senha" type="password" class="form-control" placeholder="Senha" required="">
                                <div id="ver_senha" class="input-group-prepend" onclick="$('#usu_senha').attr('type', 'text');$(this).hide();">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                </div>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Informe sua senha de acesso
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 float-right">
                            <button class="btn btn-sm btn-acb">Entrar</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-4"></div>
    </div>
</div>

<script type="text/javascript">
    // logout info
    <?php if ( $_GET['logout']=="true" ): ?>
        swal({
          title: "Até breve",
          text: "Você foi desconectado do sistema",
          icon: "success",
          // buttons: true,
        });
    <?php endif ?>

    // mensagem erro
    <?php if ( $_GET['mensagem']!="" ): ?>
        swal({
          title: "Atenção",
          text: "<?=$_GET['mensagem']?>",
          icon: "warning",
          // buttons: true,
        });
        console.log('<?=$_GET['log']?>');
    <?php endif ?>

    // LOGIN
    $("#form_login").submit(function(event) {
        event.preventDefault();
        if (this.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            toastr["warning"]("Confira os campos obrigatórios!");
            this.classList.add('was-validated');
            return false;
        }
        this.classList.add('was-validated');
        var form = $('#form_login').serialize();
        $('#login').find("input,button").attr("disabled", true);
        $.ajax({
            url:    'page-site/login/controller/login.php',
            type:   'POST',
            data:   'acao=validarlogin&'+form,
            success: function(retorno){
                var arrRetorno = retorno.split('||');
                // console.log(retorno);
                // return false;
                if (arrRetorno[0]=="SUCESSO") {
                    // toastr["success"](arrRetorno[1]);
                    swal({
                      title: "Bem vindo",
                      text: arrRetorno[1],
                      icon: "success",
                      buttons: false,
                    });
                    setTimeout(function(){
                        location.replace('admin');
                    }, 1500);
                } else {
                    // toastr["error"](arrRetorno[1]);
                    swal({
                      title: "Atenção",
                      text: arrRetorno[1],
                      icon: "warning",
                      // buttons: true,
                    });
                    console.log(retorno);
                    setTimeout(function(){
                        $('#login').find("input,button").attr("disabled", false);
                    }, 2000);
                }
            } // fim da function
        }); // fim do ajax
    });
</script>