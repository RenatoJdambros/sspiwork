<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<div class="container-fluid">
<div class="shadow bg-white rounded">
<div class="container-fluid">
    <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <button type="button" class="btn btn-secondary"
                        onclick="window.location='<?= HOME_URI ?>/home/'">Voltar</button>
                    <a href="<?= HOME_URI ?>/rnc/inserir">
                        <button type="button" class="btn btn-warning">GERAR RNC</button>
                    </a>
                    <hr>
                </div>
                <div class="x_content">
                    <br>
                    <table id="rnc" class="table table-striped table-bordered bulk_action server-side">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Status</th>
                                <th>Número O.P.</th>
                                <th>SACP</th>
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
