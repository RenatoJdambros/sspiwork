<?
if (!defined('ABSPATH')) exit;
?>


<div class="container-fluid">
  <span class="border-top-0"><div id=bordasRNC class="shadow bg-white"></span>
    <div class="shadow bg-white">
      <nav class="navbar navbar-light text-center " style="border-radius: 50px 8px 8px 0px; background-color: #FFD700;
                  background-image: linear-gradient(to bottom, transparent, rgba(100,50,20,.40));;">   
        <h3 style="margin-left: 20px; " class="text-center">RNC</h3>
          <span class="navbar-text">Relatório de Não-Conformidade</span>
      </nav>
    </div>
<!--Cabeça do formulário-->
<form method="post">
  <input type="hidden" name="inserirRNC" value="1" />
  <div class="container-fluid backgroundR"> 
  <div class="form-group col-md-6">
    <label for="nomeRNC" data-toggle="tooltip" title="Obrigatório">Nome da RNC:</label>
    <input type="text" class="form-control" id="nomeRNC" name="nome" value="<?= $rnc['nome'] ?>" placeholder="ex: Extintor fora de lugar no almoxarifado" required>
  </div>
<br>
<h5>ORIGEM
  <span style="margin: 0 5px;">|</span>
    <small class="font-weight-light">Informações do emitente da RNC</small>
</h5>
<hr>
<!--Corpo do formulário-->
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="selectUserOrigem" data-toggle="tooltip" title="Obrigatório">Usuário de Origem:</label>
      <select id="selectUserOrigem" name="id_origem" class="form-control custom-select" required>
        <option value="<?= $userOrigem['id'] ?>" selected><?= $userOrigem['setor'] . " - " . $userOrigem['nome']?></option>
      </select>
    </div>
    <!---->
    <div class="form-group col-md-2">
      <label for="numeroOP">Número O.P:</label>
        <input value="<?= $rnc['numero_op'] ?>" type="text" class="form-control" id="numero_op" placeholder="ex: 20182">
    </div>
    </div><!--fim da linha 1-->
    <!---->          
    <div class="form-group">
      <label for="descricao" data-toggle="tooltip" title="Obrigatório">Descrição:</label>
        <textarea class="form-control rounded-0" id="descricao" name="descricao" rows="4"  placeholder="Descreva a não-conformidade encontrada..." required><?= $rnc['descricao'] ?></textarea>
    </div> 
    <!-- necessários pois os asrquivos originais do header e footer estão dando conflito-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--botão Dados de Clientes-->
    <div id="accordion">
      <div class="card backgroundRBOX">
        <div class="card-header card">
          <a class="card-link row" data-toggle="collapse" href="#collapseOne">
            Dados de clientes
            <small id="" class="form-text text-muted">&nbsp;&nbsp;|&nbsp;&nbsp;Utilizados em não-conformidades geradas por clientes</small>
          </a>
        </div>
    <!--Corpo Dados de Clientes-->
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-9">
            <label >Nome:</label>
              <input type="text" class="form-control" id="" placeholder="Digite o nome do contato">
          </div>
    <div class="form-group col-md-3">
      <label >Telefone:</label>
        <input type="text" class="form-control" id="" placeholder="Telefone para contato">
    </div>
    <div class="form-group col-md-8">
      <label >Nome da obra:</label>
        <input type="text" class="form-control" id="" placeholder="Digite o nome do solicitante">
    </div>
    <div class="form-group col-md-4">
      <label >E-mail:</label>
        <input type="email" class="form-control" id="" placeholder="Digite o e-mail do contato">
          </div>    
        </div> 
      </div>
    </div>
  </div>
</div><!--fim corpo Dados de Clientes-->
<br>
  <h5>DESTINO <span style="margin: 0 5px;">|</span> <!--Início Destino-->
<small class="font-weight-light">Informações do destinatário da RNC</small>
  </h5>
<hr>
<!--Início form destino-->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="selectUserDestino" data-toggle="tooltip" title="Obrigatório">Usuário de Destino:</label>
        <select id="selectUserDestino" name="id_destino" class="form-control custom-select" required>
            <option value="<?= $userDestino['id'] ?>" selected><?= $userDestino['setor'] . " - " . $userDestino['nome']?></option>
        </select>
      </div>
    </div> 
  <hr>
  <div class="form-group">
    <label for="justificativa" data-toggle="tooltip" title="Obrigatório">Justificativa: <span style="color: red;">*</span></label>
      <textarea class="form-control rounded-0" id="justificativa" name="justificativa" rows="4"  placeholder="Descreva a justificativa..." required></textarea>
  </div>
  <div class="form-group">
    <label for="correcao" data-toggle="tooltip" title="Obrigatório">Correção realizada: <span style="color: red;">*</span></label>
      <textarea class="form-control rounded-0" id="correcao" name="correcao" rows="4"  placeholder="Descreva a correção..." required></textarea>
  </div>
  <br>
  </div> <!-- Fim form background-->
</div><!-- Fim div contorno-->
</form><!-- Fim formulário-->
<br>
<button type="button" class="btn btn-secondary" onclick="window.location='<?= HOME_URI ?>/rnc/'">Voltar</button>
<button type="submit" class="btn btn-warning">Atualizar RNC</button>
<hr>
</div><!-- Fim conteúdo página-->
