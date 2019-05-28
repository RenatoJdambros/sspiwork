<?php 
    if (!defined('ABSPATH')) exit; 
?>

<!-- page content -->
<h3><?=$this->title?></h3>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <?php if ($this->check_permissions('usuarios', 'inserir', $this->userdata['user_permissions'])) { ?>
                        <a href="<?=HOME_URI?>/usuarios/inserir">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar Usuário
                            </button>
                        </a>
                    <?php } ?>
                </h2>
            </div>
            <div class="x_content">
                <table id="usuarios" class="table table-striped table-bordered bulk_action server-side" style="width: 100%;">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Setor</th>
                            <th>Email</th>
                            <th>Tipo de Usuário</th>
                            <th class="no-export"></th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
  var controlador = "usuarios";
</script>
