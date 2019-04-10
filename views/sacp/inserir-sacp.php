<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>SACP<small> Gerar uma nova SACP</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" method="post">
                    <input type="hidden" name="insere_beacon" value="1" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="nome" required="required"
                                placeholder="Nome SACP">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Options</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="opcoes" required="required">
                                <option hidden>Selecione uma opção</option>
                                <?php foreach ($opcoes as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div style="clear:both;"></div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location='<?= HOME_URI ?>/sacp/'">Voltar</button>
                            <button type="submit" class="btn btn-primary">Gerar SACP</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->