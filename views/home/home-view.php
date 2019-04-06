<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Informações</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <br>
        Lorem ipsum tellus vel sapien inceptos fusce ligula lorem, dolor inceptos nec laoreet auctor tortor praesent sit fringilla, dui quam ipsum donec neque sociosqu aenean. sollicitudin pellentesque sapien tempus felis, risus rutrum nibh nisi, risus proin pellentesque. ante arcu venenatis pulvinar egestas felis tellus ut arcu primis quam magna, interdum vestibulum himenaeos nulla vivamus fermentum duis varius sit ultrices ut, tristique primis pulvinar facilisis curae nunc aliquet fames etiam massa. accumsan at auctor congue sed urna ac vestibulum nam erat quisque sodales varius augue, hendrerit aliquet orci sapien sociosqu convallis pulvinar nam semper habitant augue. <br>
        <br>
        Lacus nam non molestie orci magna nibh magna erat, ac habitant mattis proin aenean laoreet purus phasellus, in tortor ultricies potenti lacus at porttitor. mi a egestas vel non eget purus, sem eu tellus eleifend ornare porta proin, dui posuere suspendisse erat turpis. et sem mattis elementum neque adipiscing inceptos, dui placerat euismod pulvinar interdum massa, etiam amet diam etiam ultricies. posuere vivamus suspendisse nec primis libero proin ipsum interdum justo, enim curabitur mauris faucibus in aptent justo sollicitudin, adipiscing accumsan aliquam auctor posuere mattis rutrum vivamus. aenean donec dictum dui gravida adipiscing ut velit inceptos rhoncus, quisque posuere aliquam venenatis ad ultrices tempor nisi, tellus dictumst turpis adipiscing nec suscipit convallis dolor. <br>
        <br>
        Congue ultrices lacinia vestibulum massa ut interdum etiam vehicula suscipit, hac semper nam lectus leo maecenas quisque fermentum consequat, dolor lacinia rhoncus sem quisque class viverra neque. libero rutrum ipsum scelerisque nam commodo volutpat fringilla inceptos, sit eleifend nisl blandit etiam arcu duis viverra torquent, nec rhoncus integer per inceptos turpis volutpat. vestibulum ante vulputate magna scelerisque ipsum primis egestas iaculis volutpat mattis sagittis vel maecenas, lorem at ullamcorper quisque habitasse etiam ultricies at ultricies eget rutrum. fermentum elementum fermentum pellentesque risus hendrerit, dictum luctus taciti ullamcorper at, hac inceptos fermentum aenean. <br>
        <br>  
      </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
    
    
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">HOME</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href="#myModal">Info</a>
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
        <div class="shadow p-4 mb-4 bg-white rounded">
          <h4 class="text-center">SELECIONE O TIPO DE RELATÓRIO</h4> 
    <div class="row"> 
      <div class="col"> <!--col -->
          <div class="card" style="border:0px">
            <div class="card-body">
            <img style="max-width: 200px;  max-height:200px;  width: auto;  height: auto;" src="<?=HOME_URI?>/views/_images/relat1.png" alt="Chania" align="left"> 
            <div style="text-align: left" >
            <h5 class="text-warning"><b>RNC</b></h5> 
              <p class="card-text"><b><i>Relatório de <br> Não Conformidade</i></b></p>
              <p class="card-text">Responsável por um texto que serve de apoio para identificar espaçamento correto e tamanho de descriçao.</p>
              <br>
              <button type="button" class="btn btn-warning">GERAR </button>
              <button type="button" class="btn btn-warning">CONSULTAR</button>
            </div>
           </div>
          </div>
        </div> <!--endcol -->

        <div class="col"> <!--col2 -->
          <div class="card" style="border:0px">
            <div class="card-body">
            <img style="max-width: 200px;  max-height:200px;  width: auto;  height: auto;" src="<?=HOME_URI?>/views/_images/relat2.png" alt="Chania" align="left"> 
            <div style="text-align: left" >
            <h5 class="text-primary"><b>SACP</b></h5> 
              <p class="card-text"><b><i>Solicitação de Ação Corretiva ou Preventiva (e mudanças no SGI)</i></b></p>
              <p class="card-text">Responsável por um texto que serve de apoio para identificar espaçamento correto e tamanho de descriçao.</p>
              <br>
              <button type="button" class="btn btn-primary">GERAR </button>
              <button type="button" class="btn btn-primary">CONSULTAR</button>
             </div>
          </div>
        </div> <!--endcol2 -->
    </div> <!--endrow -->
  </div>
</div>