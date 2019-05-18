<?
if (!defined('ABSPATH')) exit;
?>


<div class="container-fluid">
<span class="border-top-0"><div id=bordasSACP class="shadow bg-white"></span>
  <div class="shadow bg-white" >
  <nav class="navbar navbar-light rounded-top" style="background-color: rgb(0,110,255);
background-image: linear-gradient(to bottom, transparent, rgba(100,50,20,.40));">  
      <h3 class="text-center text-white">SACP</h3>
      <span style="color-text:" class="navbar-text text-white">
    Solicitação de Ação Corretiva ou Preventiva (Mudanças no SGI)
  </span>
    </nav>
    </div>

<form>
<div class="container-fluid backgroundS"> 

<br>


<h5>ORIGEM
<span style="margin: 0 5px;">|</span>
<small class="font-weight-light">Informações do emitente da RNC</small></h5>
<hr>

<div class="form-row">
<div class="form-group col-md-4">
    <label for="">Setor:</label>
      <select id="" class="form-control custom-select">
        <option selected>Setor do solicitante</option>
        <option>Almoxarifado</option>
        <option>Atendimento</option>
        <option>Administrativo</option>
        <option>Controladoria</option>
        <option>Financeiro</option>
        <option>Logística</option>
        <option>Produção</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
      </select>
    </div>

    <div class="form-group col-md-6">
    <label for="">Nome:</label>
      <select id="" class="form-control custom-select">
        <option selected>Nome do solicitante</option>
      </select>
    </div>
    
   <div class="form-group col-md-2">
      <label for="">Número O.P:</label>
      <input type="text" class="form-control" id="" placeholder="ex: 20182">
    </div>
    </div>
          
   <div class="form-group">
    <label for="inputAddress">Descrição:</label>
    <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="4"  placeholder="Descreva a não-conformidade encontrada..."></textarea>
  </div> 
  

<!-- necessários pois os asrquivos originais do header e footer estão dando conflito-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    
  

    <br>



  <div id="accordion">
<div class="card  backgroundRBOX">
  <div class="card-header card">
    <a class="card-link row" data-toggle="collapse" href="#collapseOne">
      Dados de clientes
      <small id="" class="form-text text-muted">&nbsp;&nbsp;|&nbsp;&nbsp;Utilizados em não-conformidades geradas por clientes</small>
    </a>
  </div>
  <div id="collapseOne" class="collapse" data-parent="#accordion">
    <div class="card-body">
  <!--Div esp-peixe-->
  <div style="width: 1151px;  height: 438px;" class="row-fuid esp-peixe">
                        <label for="Ajuste Altura"></label>

                        <!--L1-->
                        <div style="z-index:8; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 7.9%; margin-top: 2.4%; width:172px; height: 33px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 26%; margin-top: 2.4%;  width:167px; height: 33px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 43.6%; margin-top: 2.4%;  width:165px; height: 33px;" id="#" rows="1" placeholder=" 1 -"></textarea>
                        </div>
                        <!--endL1-->

                        <!--L2-->
                        <div style="z-index:7; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 9.6%; margin-top: 5.7%; width:169px; height: 33px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 27.2%; margin-top: 5.7%;  width:170px; height: 33px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 44.6%; margin-top: 5.7%;  width:168px; height: 33px;" id="#" rows="1" placeholder=" 2 -"></textarea>
                        </div>
                        <!--endL2-->

                        <!--L3-->
                        <div style="z-index:6; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 11.3%; margin-top: 9%; width:166px; height: 33px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 28.7%; margin-top: 9%;  width:166px; height: 33px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 46%; margin-top: 9%;  width:166px; height: 33px;" id="#" rows="1" placeholder=" 3 -"></textarea>
                        </div>
                        <!--endL3-->

                        <!--L4-->
                        <div style="z-index:5; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 12.9%; margin-top: 12.4%; width:164px; height: 33px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 30%; margin-top: 12.4%;  width:163px; height: 33px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 47.1%; margin-top: 12.4%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 4 -"></textarea>
                        </div>
                        <!--endL4-->

                        <!--L5-->
                        <div style="z-index:4; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 12.9%; margin-top: 17.4%; width:164px; height: 33px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 30%; margin-top: 17.4%;  width:163px; height: 33px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 47.1%; margin-top: 17.4%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 1 -"></textarea>
                        </div>
                        <!--endL5-->

                        <!--L6-->
                        <div style="z-index:3; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 11.3%; margin-top: 20.9%; width:172px; height: 33px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 28.7%; margin-top: 20.9%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 46%; margin-top: 20.9%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 2 -"></textarea>
                        </div>
                        <!--endL6-->

                        <!--L7-->
                        <div style="z-index:2; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 9.6%; margin-top: 24.2%; width:172px; height: 33px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                           <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 27.2%; margin-top: 24.2%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                           <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 44.6%; margin-top: 24.2%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 3 -"></textarea>
                        </div>
                        <!--endL7-->

                        <!--L8-->
                        <div style="z-index:1; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 7.9%; margin-top: 27.7%; width:172px; height: 33px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 26%; margin-top: 27.7%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 33px; margin-left: 43.6%; margin-top: 27.7%;  width:172px; height: 33px;" id="#" rows="1" placeholder=" 4 -"></textarea>
                        </div>
                        <!--endL8-->

                        <!--Descrição-->
                        <div style="z-index:1; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 72.4%; margin-top: 2.5%; width:286px; height: 327px;" id="#" rows="1" placeholder="Adicione uma descrição:"></textarea>
                        </div>
                        <!--endDescr-->




                    
            
            </div>
            <!--endL8-->

            <!--end esp-peixe-->


      </div>
      </div>
    </div>


    
  
    

    <br>

    <h5>DESTINO
<span style="margin: 0 5px;">|</span>
<small class="font-weight-light">Informações do destinatário da RNC</small></h5>
<hr>
<form>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="">Setor:</label>
      <select id="" class="form-control custom-select">
        <option selected>Setor do destinatário</option>
        <option>Almoxarifado</option>
        <option>Atendimento</option>
        <option>Administrativo</option>
        <option>Controladoria</option>
        <option>Financeiro</option>
        <option>Logística</option>
        <option>Produção</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
        <option>...</option>
      </select>
    </div>

    <div class="form-group col-md-6">
    <label for="">Nome:</label>
      <select id="" class="form-control custom-select">
        <option selected>Nome do destinatário</option>
      </select>
    </div>
  </div>
    </form>

  <hr>

  <div class="form-group">
    <label for="inputAddress">Justificativa:</label>
    <textarea class="form-control rounded-0" id="" rows="4"  placeholder="Descreva a justificativa..."></textarea>
  </div>
  <div class="form-group">
    <label for="inputAddress">Correção realizada:</label>
    <textarea class="form-control rounded-0" id="" rows="4"  placeholder="Descreva a correção..."></textarea>
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