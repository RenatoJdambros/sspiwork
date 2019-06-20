<?php
    if (!defined('ABSPATH')) exit;
    $radioOptions = array('relatorio', 'indicador', 'auditoria', 'recebida', 'acao', 'riscos', 'oportunidade', 'necessidade');
    if (empty($dados['origem'])) {
        $dados['origem'] = '';
    }
?>

<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button  type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/sacp/'">
                    Voltar
                    </button>
                    <h3 style="text-align: center; margin-top: -30px; margin-left: 70px">Solicitação de Ação Corretiva ou Preventiva</h3>
                </div>
                <p align="right" style="position: relative; max-height: 2px; background: #337AB7; margin-right: 35px; margin-top: 0px;">
                        <span style="margin-top: -18px; background: #337AB7;" class="badge">Editar</span></p>


        <form method="post"> <!-- form -->
            <input type="hidden" name="editarSACP" value="1" />
            <input type="hidden" name="status" value="2" />

            <div style="position: absolut; margin-top: -12px;" class="panel-body backgroundS"> 
                <br>
                
                <div class="form-group row">
                    <div class="form-group col-md-5">
                        <label for="setor_origem">
                            Setor Solicitante:
                        </label>
                        <select id="setor_origem" name="setor_origem" class="form-control custom-select" required>
                            <option hidden disabled selected value> </option>
                            <?php foreach ($setores as $key => $setor) { ?>
                                <option value="<?= $setor['id'] ?>" 
                                <?php 
                                    if (!empty($dados['setor_origem'])) { 
                                        if($dados['setor_origem'] == $setor['id']) { 
                                            echo 'selected'; 
                                        }
                                    } 
                                ?>>
                                    <?= $setor['nome'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

    <div class="form-group col-md-5">
        <label for="setor_destino">Setor Destino:</label>
        <select id="setor_destino" name="setor_destino" class="form-control custom-select" required>
            <option hidden disabled selected value> </option>
            <?php foreach ($setores as $key => $setor) { ?>
                <option value="<?= $setor['id'] ?>" 
                <?php 
                    if (!empty($dados['setor_destino'])) { 
                        if($dados['setor_destino'] == $setor['id']) { 
                            echo 'selected'; 
                        }
                    } 
                ?>>
                    <?= $setor['nome'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- validacao futura -->
    <?php /* if (empty($_POST['setorSolicitante']) && empty($_POST['setorDestino'])) { 
        echo "<button type='submit' class='btn btn-primary'>OK</button>";
    } else { */ ?>
    
   <div class="form-group col-md-2">
      <label for="numero_op">Número O.P:</label>
      <input style="min-width: 20px; max-width: 178px;" value="<?= $dados['numero_op'] ? $dados['numero_op'] : '' ?>" style="min-width: 20px; max-width: 158px;" type="number" class="form-control" id="numero_op" name="numero_op" >
    </div>
    </div>
    
    <label for="participantes">Participantes:</label>
    <select class="js-example-basic-multiple form-group custom-select" id="participantes" name="participantes[]" style="width: 100%" multiple="multiple" required>
      <?php 
            foreach ($participantes as $key => $participante) { ?>
                <option value="<?= $participante['id'] ?>" 
                    <?php
                        if (!empty($dados['participantes'])) {
                            if (in_array($participante['id'], $dados['participantes'])) {
                                echo 'selected'; 
                            } 
                        }
                    ?>>
                        <?= $participante['nomeSetor'] . " - " . $participante['nome'] ?>
                    </option>
            <?php } ?>
    </select>

<br>
<br>
<h5><b>Origem:</b></h5>
<div class="container-fluid">
  <div class="form-group row">
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio1" value="relatorio" <?= $dados['origem'] == 'relatorio' ? 'checked' : '' ?> required>
      <label class="form-check-label" for="radio1">Relatório de Ação Corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio2" value="indicador" <?= $dados['origem'] == 'indicador' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio2">Indicador</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio3" value="auditoria" <?= $dados['origem'] == 'auditoria' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio3">Auditoria (int./ext.)</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio4" value="recebida" <?= $dados['origem'] == 'recebida' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio4">Recebida de cliente</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio5" value="acao" <?= $dados['origem'] == 'acao' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio5">Ação corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio6" value="riscos" <?= $dados['origem'] == 'riscos' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio6">Riscos</label>
    </div>  
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio7" value="oportunidade" <?= $dados['origem'] == 'oportunidade' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio7">Oportunidade</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio8" value="necessidade" <?= $dados['origem'] == 'necessidade' ? 'checked' : '' ?>>
      <label class="form-check-label" for="radio8">Necessidade de mudança</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input outros" type="radio" name="origem" id="outros"
      <?php if (!in_array($dados['origem'], $radioOptions)) echo 'checked'; ?>>
      <label class="form-check-label" for="outros">Outros</label>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input id="origemText" type="text" class="form-control form-control-sm origemText" name="origem" placeholder="Outros..." 
        value="<?php if (!in_array($dados['origem'], $radioOptions)) {echo $dados['origem'];} else {echo 'disabled';} ?>" required>
      </div>
    </div>
  </div>
</div>
    <br>

          
   <div class="form-group">
    <label for="descricao">Descrição da mudança:</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao" required><?= $dados['descricao'] ?></textarea>
  </div>

  <div class="form-group">
    <label for="proposito">Propósito da mudança:</label>
    <textarea class="form-control rounded-0" id="proposito" rows="4" name="proposito" required><?= !empty($dados['proposito']) ? $dados['proposito'] : '' ?></textarea>
  </div> 

  <div class="form-group">
    <label for="consequencia">Consequências da mudança:</label>
    <textarea class="form-control rounded-0" id="consequencia" rows="4" name="consequencia" required><?= !empty($dados['consequencia']) ? $dados['consequencia'] : '' ?></textarea>
    <span class="help-block">Obs: Verificar disponibilidade de recursos e responsabilidades. Atualizar matrizes de riscos do setor.</span>
  </div>  

  <div class="form-group">
    <label for="brainstorming">Brainstorming / Alterações no SGI</label>
    <textarea class="form-control rounded-0" id="brainstorming" rows="4" name="brainstorming" required><?= !empty($dados['brainstorming']) ? $dados['brainstorming'] : '' ?></textarea>
  </div> 
  </div>

  <div id="accordion" style=" ">
    <button style="background-color: #80BDFF;"  class="btn btn-basic" data-toggle="collapse" href="#collapseOne">
      Gerar diagrama de causa e efeito
    <small id="" class="form-text">
        &nbsp;&nbsp;|&nbsp;&nbsp;6M
    </small>
              </button>
              <p align="right" style="position: relative; max-height: 2px; 
                background:#80BDFF; margin-left: 0px; margin-bottom: -4px;">&nbsp;</p>
                           


    <!--Corpo esp-peixe-->
    <div id="collapseOne" style="background-color: #80BDFF;" class="collapse backgroundS" data-parent="#accordion">
        <div align="center"  class="form-group row">
            <div class="form-group col-xs-12">
                <br>
    <!--Div esp-peixe-->
    <div style="width: 1151px; height: 438px;" class="row-fuid esp-peixe">
        <p style="font-size: 10px;">&nbsp;&nbsp;</p> 

        <!--L1-->
        <div style="z-index:8; position:relative" class="row">
            <textarea class="form-control" name="medida[]" style="position:absolute; min-height: 33px; min-width:172px;  margin-left: 7.9%; margin-top: 2.4%; width:172px; height: 33px;" rows="1" placeholder=" 1 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 3) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" style="position:absolute; min-height: 33px; min-width:167px; margin-left: 26%; margin-top: 2.4%;  width:167px; height: 33px;" rows="1" placeholder=" 1 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 2) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" style="position:absolute; min-height: 33px; min-width:165px; margin-left: 43.6%; margin-top: 2.4%;  width:165px; height: 33px;" rows="1" placeholder=" 1 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 1) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL1-->

        <!--L2-->
        <div style="z-index:7; position:relative" class="row">
            <textarea class="form-control" name="medida[]" style="position:absolute; min-height: 33px; min-width:169px; margin-left: 9.6%; margin-top: 5.7%; width:169px; height: 33px;" rows="1" placeholder=" 2 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 3) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" style="position:absolute; min-height: 33px; min-width:170px; margin-left: 27.2%; margin-top: 5.7%;  width:170px; height: 33px;" rows="1" placeholder=" 2 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 2) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" style="position:absolute; min-height: 33px; min-width:168px; margin-left: 44.6%; margin-top: 5.7%;  width:168px; height: 33px;" rows="1" placeholder=" 2 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 1) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL2-->

        <!--L3-->
        <div style="z-index:6; position:relative" class="row">
            <textarea class="form-control" name="medida[]" style="position:absolute; min-height: 33px; min-width:166px; margin-left: 11.3%; margin-top: 9%; width:166px; height: 33px;" rows="1" placeholder=" 3 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 3) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" style="position:absolute; min-height: 33px; min-hwidth:166px; margin-left: 28.7%; margin-top: 9%;  width:166px; height: 33px;" rows="1" placeholder=" 3 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 2) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" style="position:absolute; min-height: 33px; min-width:166px; margin-left: 46%; margin-top: 9%;  width:166px; height: 33px;" rows="1" placeholder=" 3 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 1) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL3-->

        <!--L4-->
        <div style="z-index:5; position:relative" class="row">
            <textarea class="form-control" name="medida[]" style="position:absolute; min-height: 33px; min-width:164px; margin-left: 12.9%; margin-top: 12.4%; width:164px; height: 33px;" rows="1" placeholder=" 4 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 3) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" style="position:absolute; min-height: 33px; min-width:163px; margin-left: 30%; margin-top: 12.4%;  width:163px; height: 33px;" rows="1" placeholder=" 4 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 2) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" style="position:absolute; min-height: 33px; min-width:172px; margin-left: 47.1%; margin-top: 12.4%;  width:172px; height: 33px;" rows="1" placeholder=" 4 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 1) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL4-->

        <!--L5-->
        <div style="z-index:4; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" style="position:absolute; min-height: 33px; min-width:164px; margin-left: 12.9%; margin-top: 17.4%; width:164px; height: 33px;" rows="1" placeholder=" 1 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 6) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" style="position:absolute; min-height: 33px; min-width:163px; margin-left: 30%; margin-top: 17.4%;  width:163px; height: 33px;" rows="1" placeholder=" 1 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 5) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" style="position:absolute; min-height: 33px; min-width:172px; margin-left: 47.1%; margin-top: 17.4%;  width:172px; height: 33px;" rows="1" placeholder=" 1 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 4) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL5-->

        <!--L6-->
        <div style="z-index:3; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" style="position:absolute; min-height: 33px; minwidth:172px;  margin-left: 11.3%; margin-top: 20.9%; width:172px; height: 33px;" rows="1" placeholder=" 2 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 6) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" style="position:absolute; min-height: 33px; min-width:172px; margin-left: 28.7%; margin-top: 20.9%;  width:172px; height: 33px;" rows="1" placeholder=" 2 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 5) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" style="position:absolute; min-height: 33px; miwidth:172px; margin-left: 46%; margin-top: 20.9%;  width:172px; height: 33px;" rows="1" placeholder=" 2 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 4) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL6-->

        <!--L7-->
        <div style="z-index:2; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" style="position:absolute; min-height: 33px; miwidth:172px; margin-left: 9.6%; margin-top: 24.2%; width:172px; height: 33px;" rows="1" placeholder=" 3 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 6) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" style="position:absolute; min-height: 33px; min-width:172px; margin-left: 27.2%; margin-top: 24.2%;  width:172px; height: 33px;" rows="1" placeholder=" 3 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 5) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" style="position:absolute; min-height: 33px; min-width:172px; margin-left: 44.6%; margin-top: 24.2%;  width:172px; height: 33px;" rows="1" placeholder=" 3 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 4) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL7-->

        <!--L8-->
        <div style="z-index:1; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" style="position:absolute; min-height: 33px; miwidth:172px; margin-left: 7.9%; margin-top: 27.7%; width:172px; height: 33px;" rows="1" placeholder=" 4 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 6) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" style="position:absolute; min-height: 33px; miwidth:172px; margin-left: 26%; margin-top: 27.7%;  width:172px; height: 33px;" rows="1" placeholder=" 4 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 5) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" style="position:absolute; min-height: 33px; min-width:172px; margin-left: 43.6%; margin-top: 27.7%;  width:172px; height: 33px;" rows="1" placeholder=" 4 -"
            ><?php 
            foreach($dados["espinhaPeixe"] as $key => $dado) {
                if ($dado['id_tipo_plano_acao'] == 4) {
                echo $dado['descricao'];
                unset($dados['espinhaPeixe'][$key]);
                break;
                }
            } ?></textarea>
        </div>
        <!--endL8-->

        <!--Descrição-->
        <div style="z-index:1; position:relative" class="row">
            <textarea class="form-control" name="descricaoPeixe" style="position:absolute; min-height: 32px; margin-left: 72.4%; margin-top: 2.5%; width:286px; height: 327px;" rows="1" placeholder="Adicione uma descrição:"
            ><?php 
                $dados['espinhaPeixe'] = array_values($dados['espinhaPeixe']); 
                echo $dados['espinhaPeixe'][0]['descricao']; 
            ?></textarea>
        </div>
        <!--endDescr-->
    </div>
            <!--endL8-->

            <!--end esp-peixe-->

      </div>
      </div>
    </div>
    </div>

    <?php if(isset($dados['brainstorming'])) { ?>

        ratomanocu

    <?php } ?>
  <div class="panel-footer">
    <button type="submit" class="btn btn-primary">
      Atualizar SACP
    </button>
  </div>

</form> <!--Fim formulário principal -->


  </div> <!--Fim panel Body-->
        


</div>
<hr>
</div>

<!-- /page content -->