<?php
    if (!defined('ABSPATH')) {
        exit;
    }
?>
<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/sacp/'">
                        Voltar
                        </button>
                    <h4 style="text-align: center;  margin-top: -30px; " >
                        <b><?=$this->title?></b></h4>
                </div>
                <p align="right" style="position: relative; max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                    <span style="margin-top: -18px;" class="badge">Avaliação</span></p>


             <div class="panel-body">
        <br>
        <div class="container-fluid">
                <form class="form-horizontal form-label-left" method="post">
                    <input type="hidden" name="inserirAvaliacao" value="1" />

                    <div class="form-group">
                        <label class="control-label col-md-2 " for="avaliacao"
                        data-toggle="tooltip" title="Obrigatório">
                            Avaliação
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <textarea name="avaliacao" id="avaliacao" cols="200" rows="10"><?php
                                if (!empty($avaliacao)) {
                                    echo $avaliacao;
                                }
                            ?></textarea>
                        </div>
                    </div>

                    <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        Salvar
                    </button>
                </div>
                </form>
            </div>
        </div>
        <hr>
    </div>

</div>
<!-- /page content -->
