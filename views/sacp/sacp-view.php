<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->

<div class="row-fuid">
    <div class="shadow p-4 mb-4 bg-white rounded">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <button type="button" class="btn btn-secondary"
                    onclick="window.location='<?= HOME_URI ?>/home/'">Voltar</button>
                <a href="<?= HOME_URI ?>/sacp/inserir">
                    <button type="button" class="btn btn-primary">GERAR SACP</button>
                </a>
                <hr>
            </div>
            <div class="x_content">
                <br>
                <table id="sacp" class="table table-striped table-bordered bulk_action server-side">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Envolvidos</th>
                            <th>Status</th>
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


<!-- /page content -->