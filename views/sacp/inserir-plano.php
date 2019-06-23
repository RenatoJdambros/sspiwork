<?php
    if (!defined('ABSPATH')) exit;
    switch($parametros[1]) {
        case 1:
            $plano = 'Mão de Obra';
            break;
        case 2:
            $plano = 'Método';
            break;
        case 3:
            $plano = 'Medida';
            break;
        case 4:
            $plano = 'Meio Ambiente';
            break;
        case 5:
            $plano = 'Materiais';
            break;
        case 6:
            $plano = 'Máquina';
            break;
        default:
            break;
    }
?>
<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/sacp/editar/<?= $parametros[0] ?>'">
                        Voltar
                        </button>
                    <h4 style="text-align: center;  margin-top: -30px; " >
                        <b><?= $this->title ?></b></h4>
                </div>
                <p align="right" style="position: relative; max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                    <span style="margin-top: -18px;" class="badge"><?= $plano ?></span></p>


             <div class="panel-body">                   
        <br>
        <div class="container-fluid">
                <form class="form-horizontal form-label-left" method="post">
                    <input type="hidden" name="inserirPlano" value="1" />

                    <div class="form-group">
                        <label class="control-label col-md-2 " for="o_que" 
                        data-toggle="tooltip" title="Obrigatório">
                            O Que Fazer
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="o_que" class="form-control" name="o_que" 
                            placeholder="O Que Fazer" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 " for="como" 
                        data-toggle="tooltip" title="Obrigatório">
                            Como Fazer
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="como" class="form-control" name="como" 
                            placeholder="Como Fazer" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 " for="quem" 
                        data-toggle="tooltip" title="Obrigatório">
                            Quem
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <select name="quem" id="quem" class="form-control custom-select" required>
                                <option hidden disabled selected value>Selecione uma opção</option>
                                <?php foreach($participantes as $key => $participante) { ?>
                                    <option value='<?= $participante['id'] ?>'><?= $participante['nomeSetor'] . " - " . $participante['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-2 " for="quando" 
                        data-toggle="tooltip" title="Obrigatório">
                            Quando
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <input type="date" id="quando" class="form-control" name="quando"  
                            required max="2099-01-01">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 " for="onde" 
                        data-toggle="tooltip" title="Obrigatório">
                            Onde
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-md-6">
                            <select name="onde" id="onde" class="form-control custom-select" required readonly>
                                <option value='<?= $setor['id'] ?>'><?= $setor['nome'] ?></option>
                            </select>
                        </div>
                    </div>

                
                </div>
            </div>

                

                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">
                        Inserir
                    </button>
                </div>
                            
                        
                </form>
            </div>
        </div>
        <hr>
    </div>
    
</div>
<!-- /page content -->