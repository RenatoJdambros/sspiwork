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
                    <h2>Configurações<small>Edite um código</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="post">
					  <input type="hidden" name="insere_configuracoes" value="1" />
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="nome" required="required" value="<?=$this->config['nome']?>" placeholder="Nome do cliente">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea type="text" class="form-control ckeditor" name="value" style="min-height:120px;" required="required"  placeholder="Código"><?=$this->config['value']?></textarea>
                        </div>
                      </div>
                    
                      </div>



                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary" onclick="window.location='<?=HOME_URI?>/configuracoes/'">Voltar</button>
                          <button type="submit" class="btn btn-success">Atualizar Código</button>
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
        
 