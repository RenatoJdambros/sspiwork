<?php
    if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/home/'">
                            Voltar
                            </button>
                                <?php if ($this->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) { ?>
                                    <a href="<?=HOME_URI?>/sacp/inserir">
                                        <button type="submit" class="btn btn-primary">Gerar SACP</button>
                                    </a>
                    <?php } ?>
                    </div>
            <div class="panel-body">                   
            <br>
                    <table id="sacp" class="table table-striped table-bordered bulk_action server-side" style="width: 100%;">

                        <thead>
                        <tr>
                                <th>ID</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Status</th>
                                <th>Número O.P.</th>
                                <th>RNC</th>
                                <th>Data Geração</th>
                                <th>Data Finalização</th>
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
</div>
<hr>
<!-- /page content -->
<script>
    var controlador = 'sacp';
</script>