<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->

<div class="container-fluid">
<div class="shadow bg-white rounded">
<div class="container-fluid">
    <br>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <?php if ($this->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) { ?>
                    <a href="<?=HOME_URI?>/sacp/inserir">
                        <button type="submit" class="btn btn-primary">Gerar SACP</button>
                    </a>
                <?php } ?>
            <hr>
            </div>
            <div class="x_content">
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