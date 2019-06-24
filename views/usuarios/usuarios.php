<?php 
    if (!defined('ABSPATH')) exit; 
?>

<!-- page content -->

<hr>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <button type="button" class="btn btn-default" onclick="window.location='<?=HOME_URI?>/home/'">
                        Voltar
                        </button>
                        <?php if ($this->check_permissions('usuarios', 'inserir', $this->userdata['user_permissions'])) { ?>
                        <a href="<?=HOME_URI?>/usuarios/inserir">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar Usuário
                            </button>
                        </a>
                    <?php } ?>
                        <h4 style="text-align: center; color: black; margin-top: -30px;">
                        <b><?=$this->title?></b></h4>
                    </div>
                    <p align="right" style="position: relative; max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                            <span style="margin-top: -18px;" class="badge">Painel de Controle</span></p>

                <div class="panel-body">                   
                <br>
                <table id="usuarios" class="table table-striped table-bordered bulk_action server-side" style="width: 100%;">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Setor</th>
                            <th>Email</th>
                            <th>Tipo de Usuário</th>
                            <th>Status</th>
                            <th class="no-export"></th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
         </div>
    </div>
    <hr>
</div>


<script>
  var controlador = "usuarios";
</script>
