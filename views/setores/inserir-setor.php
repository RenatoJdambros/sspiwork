<?php
    if (!defined('ABSPATH')) exit; 
?>
<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/setores/'">
                        Voltar
                        </button>
                    <h4 style="text-align: center;  margin-top: -30px; " >
                        <b><?=$this->title?></b></h4>
                </div>
                <p align="right" style="position: relative; max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                    <span style="margin-top: -18px;" class="badge">Painel de Controle</span></p>


             <div class="panel-body">                   
        <br>
        <div class="container-fluid">
                <form class="form-horizontal form-label-left" method="post">
                    <input type="hidden" name="inserirSetor" value="1" />

                    <div class="form-group">
                        <label class="control-label col-md-2 " for="nome" 
                        data-toggle="tooltip" title="Obrigatório">
                            Nome do Setor
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="nome" class="form-control" name="nome" 
                            placeholder="Nome do Setor" required>
                        </div>
                    </div>

                    <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        Cadastrar
                    </button>
                </div>
                            
                        
                </form>
            </div>
        </div>
        <hr>
    </div>
    
</div>
<!-- /page content -->