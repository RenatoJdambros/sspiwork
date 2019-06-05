<?php
  if (!defined('ABSPATH')) exit;
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
                <p style="background: #3173B9; margin-bottom: -18px;">&nbsp;</p>

        <form method="post"> <!-- form -->
            <input type="hidden" name="inserirSACP" value="1" />

            <div class="panel-body backgroundS"> 
                <br>
                
                <div class="form-group row">
                    <div class="form-group col-md-5">
                        <label for="setor_origem">
                            Setor Solicitante:
                        </label>
                        <select id="setor_origem" name="setor_origem" class="form-control custom-select">
                            <option hidden disabled selected value> </option>
                            <?php foreach ($setores as $key => $setor) {
                                echo "<option value='" . $setor['id'] . "'>" . $setor['nome'] . "</option>";
                            } ?>
                        </select>
                    </div>

    <div class="form-group col-md-5">
        <label for="setor_destino">Setor Destino:</label>
        <select id="setor_destino" name="setor_destino" class="form-control custom-select">
            <option hidden disabled selected value> </option>
            <?php foreach ($setores as $key => $setor) {
                echo "<option value='" . $setor['id'] . "'>" . $setor['nome'] . "</option>";
            } ?>
        </select>
    </div>

    <!-- validacao futura -->
    <?php /* if (empty($_POST['setorSolicitante']) && empty($_POST['setorDestino'])) { 
        echo "<button type='submit' class='btn btn-primary'>OK</button>";
    } else { */ ?>
    
   <div class="form-group col-md-2">
      <label for="numero_op">Número O.P:</label>
      <input style="min-width: 20px; max-width: 158px;" type="text" class="form-control" id="numero_op" name="numero_op" >
    </div>
    </div>
    
    <label for="participantes">Participantes:</label>
    <select class="js-example-basic-multiple form-group custom-select" id="participantes" name="participantes[]" style="width: 100%" multiple="multiple" >
      <?php foreach ($participantes as $key => $participante) { ?>
        <option value="<?= $participante['id'] ?>"><?= $participante['nomeSetor'] . " - " . $participante['nome'] ?></option>
      <?php } ?>
    </select>

<br>
<br>
<h5><b>Origem:</b></h5>
<div class="container-fluid">
  <div class="form-group row">
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio1" value="opcao1">
      <label class="form-check-label" for="radio1">Relatório de Ação Corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio2" value="opcao2">
      <label class="form-check-label" for="radio2">Indicador</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio3" value="opcao3">
      <label class="form-check-label" for="radio3">Auditoria (int./ext.)</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio4" value="opcao4">
      <label class="form-check-label" for="radio4">Recebida de cliente</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio5" value="opcao5">
      <label class="form-check-label" for="radio5">Ação corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio6" value="opcao6">
      <label class="form-check-label" for="radio6">Riscos</label>
    </div>  
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio7" value="opcao7">
      <label class="form-check-label" for="radio7">Oportunidade</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input" type="radio" name="origem" id="radio8" value="opcao8">
      <label class="form-check-label" for="radio8">Necessidade de mudança</label>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="text" class="form-control form-control-sm" name="origem" placeholder="Outros..." onchange="removerCheckbox(this.value)">
      </div>
    </div>
  </div>
</div>
    <br>

          
   <div class="form-group">
    <label for="descricao">Descrição da mudança:</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao" ></textarea>
  </div>

  <div class="form-group">
    <label for="descricao">Propósito da mudança:</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao" ></textarea>
  </div> 

  <div class="form-group">
    <label for="descricao">Consequências da mudança:</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao" ></textarea>
    <span class="help-block">Obs: Verificar disponibilidade de recursos e responsabilidades. Atualizar matrizes de riscos do setor.</span>
  </div>  

  <div class="form-group">
    <label for="descricao">Brainstorming / Alterações no SGI</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao" ></textarea>
  </div> 

</form> <!--Fim formulário principal -->


  </div> <!--Fim panel Body-->
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">
            Gerar SACP
            </button>
        </div>

</div>
</div>
<hr>
</div>

<!-- /page content -->