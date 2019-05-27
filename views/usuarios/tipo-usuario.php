
<?
if (! defined('ABSPATH')) exit; 
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?=$this->title?></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Dados do Usuário <small>Insira os principais dados</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" method="post">
              <input type="hidden" name="insere_tipo_usuario" value="1" />
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="nome" required="required" placeholder="Nome">
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Home</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[home][]">
                    <option value="visualizar" selected>Visualizar</option>
                    <option value="relatorios">Relatórios</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagens</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[imagens][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="editar">Editar</option>
                    <option value="visualizar-status">Visualizar Status</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagens Aprovação</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[imagens-aprovacao][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="codigo-interno">Código Interno</option>
                  </select>
                </div>
              </div> -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mercados</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[mercados][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                    <option value="publicidade">Publicidade</option>
                    <option value="relatorio">Relatorio</option>
                    <option value="adicionar-mercado">Adicionar Mercado</option>
                    <option value="conferencia-produtos">Conferência Produtos</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Encartes</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[encartes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                    <option value="relatorio">Relatório</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Categorias Encartes</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[categorias-encartes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Produtos Encartes</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[produtos-encartes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Beacons</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[beacons][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                    <option value="relatorio">Relatório</option>
                    <option value="importar-ofertas">Importar Ofertas</option>
                    <option value="importar-produtos">Importar Produtos</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lista de Preços</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[lista-precos][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ofertas</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[ofertas][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                    <option value="relatorio">Relatório</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Ofertas Especiais</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[ofertas-especiais][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                    <option value="relatorio">Relatório</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Clubes</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[clubes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                    <option value="relatorio">Relatório</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Produtos Clubes</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[produtos-clubes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="fotos">Fotos</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Clientes</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[clientes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                    <option value="relatorio">Relatório</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Compras</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[compras][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sistema SMS</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[sms][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Notificações</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[notificacoes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Níveis</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[niveis][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pontuações</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[pontuacoes][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="remover">Remover</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuários</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="multiple_select form-control" multiple="multiple" name="permissoes[usuarios][]">
                    <option value="visualizar">Visualizar</option>
                    <option value="inserir">Inserir</option>
                    <option value="editar">Editar</option>
                    <option value="excluir">Excluir</option>
                  </select>
                </div>
              </div>
              
  					  <div style="clear:both;"></div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="button" class="btn btn-primary" onclick="window.location='<?=HOME_URI?>/usuarios/'">Cancelar</button>
                  <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->