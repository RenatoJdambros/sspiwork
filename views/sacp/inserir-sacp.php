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

        <form method="post"> <!-- form -->
            <input type="hidden" name="inserirSACP" value="1" />

            <div class="panel-body backgroundS"> 
                <br>
                
                <div class="form-group row">
                    <div class="form-group col-xs-5">
                        <label for="setor_origem">
                            Setor Solicitante:
                        </label>
                        <select id="setor_origem" name="setor_origem" class="form-control custom-select">
                            <option hidden disabled selected value>Selecione o setor solicitante</option>
                            <?php foreach ($setores as $key => $setor) {
                                echo "<option value='" . $setor['id'] . "'>" . $setor['nome'] . "</option>";
                            } ?>
                        </select>
                    </div>

    <div class="form-group col-xs-5">
        <label for="setor_destino">Setor Destino:</label>
        <select id="setor_destino" name="setor_destino" class="form-control custom-select">
            <option hidden disabled selected value>Selecione o setor destino</option>
            <?php foreach ($setores as $key => $setor) {
                echo "<option value='" . $setor['id'] . "'>" . $setor['nome'] . "</option>";
            } ?>
        </select>
    </div>

    <!-- validacao futura -->
    <?php /* if (empty($_POST['setorSolicitante']) && empty($_POST['setorDestino'])) { 
        echo "<button type='submit' class='btn btn-primary'>OK</button>";
    } else { */ ?>
    
   <div class="form-group col-xs-2">
      <label for="numero_op">Número O.P:</label>
      <input type="text" class="form-control" id="numero_op" name="numero_op" placeholder="ex: 20182">
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
    <label for="descricao">Descrição:</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao"  placeholder="Descreva a não-conformidade encontrada..."></textarea>
  </div> 

<hr>
 
 <br>

  <div id="accordion">
<div class="card backgroundRBOX">
  <div class="card-header card">
    <a class="card-link row" data-toggle="collapse" href="#collapseOne">
      Dados de clientes
      <small id="" class="form-text text-muted">&nbsp;&nbsp;|&nbsp;&nbsp;Utilizados em não-conformidades geradas por clientes</small>
    </a>
  </div>
  <div id="collapseOne" class="collapse" data-parent="#accordion">
    <div class="card-body">



    
  
    

    <br>

<h5>ORIGEM
<span style="margin: 0 5px;">|</span>
<small class="font-weight-light">Informações do emitente da RNC</small></h5>
<hr>
<?php
$arrayTeste = array(
  array(
    "Cavar",
    'Com a pá',
    'Renato Jacques Dambros - TI',
    '25/12/2019',
    'Estoque',
    'Sim'
  ),
  array(
    "Nadar profundamente e estabelecer novos recordes",
    'Com os braços abertos, afim de evidenciar as possibilidades de desafios novos e futuro organizacional Com os braços abertos, afim de evidenciar as possibilidades de desafios novos e futuro organizacional',
    'Luiz Comiram Alfredo de alburquerque - Almoxarifado',
    '29/11/2019',
    'Almoxarifado',
    'Não'
  ),
  array(
    "Nadar profundamente e estabelecer novos recordes",
    'Com os braços abertos, afim de evidenciar as possibilidades de desafios novos e futuro organizacional Com os braços abertos, afim de evidenciar as possibilidades de desafios novos e futuro organizacional',
    'Luiz Comiram Alfredo de alburquerque - Almoxarifado',
    '29/11/2019',
    'Almoxarifado',
    'Não'
  )
)
?>
<div class="table-responsive">
<table id="1" class="table table-bordered">
  <thead>
    <tr class="text-secundary" id=bordasAcao style="background-color: #D9E3F0">
      <th id=bordasAcao width="200">O que fazer</th>
      <th id=bordasAcao scope="col" width="300">Como fazer</th>
      <th id=bordasAcao scope="col" width="200">Quem</th>
      <th id=bordasAcao scope="col" width="100">Quando</th>
      <th id=bordasAcao scope="col" width="100">Onde</th>
      <th id=bordasAcao scope="col" width="50">Status</th>
      <th id=bordasAcao scope="col" width="50">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($arrayTeste as $key => $value) { ?>
    <tr id=bordasAcao style="background-color: white;" >
      <td id=bordasAcao><?=$value[0]?></td>
      <td id=bordasAcao><?=$value[1]?></td>
      <td id=bordasAcao><?=$value[2]?></td>
      <td id=bordasAcao><?=$value[3]?></td>
      <td id=bordasAcao><?=$value[4]?></td>
      <td id=bordasAcao><?=$value[5]?></td>
    <td id=bordasAcao><div class="dropdown show">
  <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>

<br>

</div>
</div>
</div>


<br>
                    <button type="button" class="btn btn-secondary" onclick="window.location='<?= HOME_URI ?>/sacp/'">Voltar</button>
                    <button type="submit" class="btn btn-primary">Gerar SACP</button>
                    <hr>
</div>
</div>
</div>
</div>
<!-- /page content -->