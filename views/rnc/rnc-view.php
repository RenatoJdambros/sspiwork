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
                        <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/home/'">
                            Voltar
                            </button>
                            <?php if ($this->check_permissions('rnc', 'inserir', $this->userdata['user_permissions'])) { ?>
                                <a href="<?=HOME_URI?>/rnc/inserir">
                                    <button type="submit" class="btn btn-warning">Gerar RNC</button>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <p align="right" style="max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                        <span style="margin-top: -18px; " class="badge">Painel de Visualização</span></p>
                        
            <div class="panel-body">                   
            <br>
            
                    <table id="rnc" class="table table-striped table-bordered bulk_action server-side" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Status</th>
                                <th>Número O.P.</th>
                                <th>SACP</th>
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
   

<!-- /page content -->
<script>
    var controlador = 'rnc';
</script>
<hr>
