<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<div class="container-fluid">
    <div class="shadow bg-white rounded">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                        <?php if ($this->check_permissions('rnc', 'inserir', $this->userdata['user_permissions'])) { ?>
                            <a href="<?=HOME_URI?>/rnc/inserir">
                                <button type="submit" class="btn btn-warning">Gerar RNC</button>
                            </a>
                        <?php } ?>
                            <hr>
                        </div>
                        <div class="x_content">
                            <table id="rnc" class="table table-striped table-bordered bulk_action server-side" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
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
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script>
    var controlador = 'rnc';
</script>
