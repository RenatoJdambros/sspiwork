    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">HOME</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Ajuda</a>
            </li>
          </ul>
        </div>  
      </nav> 

    <div class="cabecalho" >
      <div class="container">
        <img style="max-width: 200px; max-height:200px; width: auto; height: auto;" src="<?=HOME_URI?>/views/_images/logofull.png"/>
      </div>
    </div>

    <div class="container">
        <div class="shadow p-3 mb-2 bg-white rounded"><br>
          <h4 class="text-center">SELECIONE O TIPO DE RELATÓRIO</h4> 
    <div class="row">
      <div class="col">
          <div class="card" style="border:0px">
            <div class="card-body">
              <img style="max-width: 200px;  max-height:200px;  width: auto;  height: auto;" src="<?=HOME_URI?>/views/_images/relat1.png" alt="Chania" align="left"> 
              <h5 class="text-warning"><b>RNC</b></h5>
              <p class="card-text"><b><i>Relatório de <br> Não Conformidade</i></b></p>
              <p class="card-text">Responsável por um texto que serve de apoio para identificar espaçamento correto e tamanho de descriçao.</p>
              <a href="#" class="btn btn-warning">Gerar Relatório</a>
            </div>
          </div>
        </div> <!--endcol -->
      <div class="col">
        <div class="card" style="border:0px">
          <div class="card-body">
            <img style="max-width: 200px; max-height:200px; width: auto; height: auto;" src="<?=HOME_URI?>/views/_images/relat2.png" alt="Chania" align="left"> 
            <h5 class="text-primary"><b>SACP</b></h5>
            <p class="card-text"><b><i>Solicitação de Ação Corretiva, Preventiva (e mudanças no SGI)</i></b></p>
            <p class="card-text">Responsável por um texto que serve de apoio para identificar espaçamento correto e tamanho de descriçao.</p>
            <a href="#" class="btn btn-primary">Gerar Relatório</a>
          </div>
        </div>
      </div> <!--endcol -->
    </div> <!--endrow -->
  </div>
</div>