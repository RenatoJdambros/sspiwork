<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<div class="row-fuid">
    <div class="shadow p-4 mb-4 bg-white rounded">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>SACP<small> Gerar uma nova SACP</small></h2>
                    <hr>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="post">
                        <input type="hidden" name="insere_beacon" value="1" />
                        <div class="form-group">
                            <label>Nome</label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" name="nome" required="required"
                                    placeholder="Nome SACP">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Options</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="opcoes" required="required">
                                    <option hidden>Selecione uma opção</option>
                                    <?php foreach ($opcoes as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="card" style="width: 74rem;">
                            <img class=" img-fluid " style=" max-width: 100%; height: auto; "
                                src=" <?= HOME_URI ?>/views/_images/esp-peixe.png" alt="Chania">
                        </div><br>
                        <hr>

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
</div>
</div>

<!-- /page content -->