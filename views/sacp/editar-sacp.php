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
            <input type="hidden" name="editarSACP" value="1" />

            <div class="panel-body backgroundS"> 
                <br>
                
                <div class="form-group row">
                    <div class="form-group col-md-5">
                        <label for="setor_origem">
                            Setor Solicitante:
                        </label>
                        <select id="setor_origem" name="setor_origem" class="form-control custom-select" required>
                            <option hidden disabled selected value> </option>
                            <?php foreach ($setores as $key => $setor) { ?>
                              <option value="<?= $setor['id'] ?>" <?= $dados['setor_origem'] == $setor['id'] ? 'selected' : '' ?>><?= $setor['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

    <div class="form-group col-md-5">
        <label for="setor_destino">Setor Destino:</label>
        <select id="setor_destino" name="setor_destino" class="form-control custom-select" required>
            <option hidden disabled selected value> </option>
            <?php foreach ($setores as $key => $setor) { ?>
              <option value="<?= $setor['id'] ?>" <?= $dados['setor_destino'] == $setor['id'] ? 'selected' : '' ?>><?= $setor['nome'] ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- validacao futura -->
    <?php /* if (empty($_POST['setorSolicitante']) && empty($_POST['setorDestino'])) { 
        echo "<button type='submit' class='btn btn-primary'>OK</button>";
    } else { */ ?>
    
   <div class="form-group col-md-2">
      <label for="numero_op">Número O.P:</label>
      <input value="<?= $dados['numero_op'] ? $dados['numero_op'] : '' ?>" style="min-width: 20px; max-width: 158px;" type="text" class="form-control" id="numero_op" name="numero_op" >
    </div>
    </div>
    
    <label for="participantes">Participantes:</label>
    <select class="js-example-basic-multiple form-group custom-select" id="participantes" name="participantes[]" style="width: 100%" multiple="multiple" required>
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
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio1" value="relatorio" required>
      <label class="form-check-label" for="radio1">Relatório de Ação Corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio2" value="indicador">
      <label class="form-check-label" for="radio2">Indicador</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio3" value="auditoria">
      <label class="form-check-label" for="radio3">Auditoria (int./ext.)</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio4" value="recebida">
      <label class="form-check-label" for="radio4">Recebida de cliente</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio5" value="acao">
      <label class="form-check-label" for="radio5">Ação corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio6" value="riscos">
      <label class="form-check-label" for="radio6">Riscos</label>
    </div>  
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio7" value="oportunidade">
      <label class="form-check-label" for="radio7">Oportunidade</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio8" value="necessidade">
      <label class="form-check-label" for="radio8">Necessidade de mudança</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input outros" type="radio" name="origem" id="outros">
      <label class="form-check-label" for="outros">Outros</label>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input id="origemText" type="text" class="form-control form-control-sm origemText" name="origem" placeholder="Outros..." disabled required>
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
    <textarea class="form-control rounded-0" id="proposito" rows="4" name="proposito" required></textarea>
  </div> 

  <div class="form-group">
    <label for="consequencia">Consequências da mudança:</label>
    <textarea class="form-control rounded-0" id="consequencia" rows="4" name="consequencia" required></textarea>
    <span class="help-block">Obs: Verificar disponibilidade de recursos e responsabilidades. Atualizar matrizes de riscos do setor.</span>
  </div>  

  <div class="form-group">
    <label for="brainstorming">Brainstorming / Alterações no SGI</label>
    <textarea class="form-control rounded-0" id="brainstorming" rows="4" name="brainstorming" required></textarea>
  </div> 
  </div>
  <div class="panel-footer">
    <button type="submit" class="btn btn-primary">
      Gerar SACP
    </button>
  </div>

</form> <!--Fim formulário principal -->


  </div> <!--Fim panel Body-->
        


</div>
<hr>
</div>

<!-- /page content -->