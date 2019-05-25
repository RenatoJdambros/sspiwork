
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
              <input type="hidden" name="editar_usuario" value="1" />
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome Completo</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="nome" value="<?=$this->usuario['nome']?>" required="required" placeholder="Nome Completo">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="email" value="<?=$this->usuario['email']?>" required="required" placeholder="E-mail">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefone</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control telefone" name="telefone" value="<?=$this->usuario['telefone']?>" required="required" placeholder="Telefone">
                </div>
              </div>
              <?php if ($this->userdata['tipo_usuario'] == '1') { ?>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Usuário</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="tipo_usuario" required="required">
                    <option hidden disabled selected value>Selecione uma opção</option>
                      <?php foreach ($this->tipos_usuarios as $key => $tipo_usuario) { ?>                          
                        <option value="<?= $tipo_usuario['id'] ?>" <?= $tipo_usuario['id']==$this->usuario['tipo_usuario']?'selected':'';?> ><?= $tipo_usuario['nome'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" required="required">
                      <option hidden disabled selected value>Selecione uma opção</option>
                      <option value="1" <?= $this->usuario['status']==1?'selected':''?> >Ativo</option>
                      <option value="2" <?= $this->usuario['status']==2?'selected':''?> >Bloqueado</option>
                    </select>
                  </div>
                </div>
              <?php } ?>
              
              <h2 class="page-header">Senha</h2>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Senha</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" class="form-control" name="senha" placeholder="Senha">
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12 dataTables_empty">
                  <div class="btn btn-info" onclick="gerarSenha();">Gerar senha</div>
                </div>
              </div>

  					  <div style="clear:both;"></div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="button" class="btn btn-primary" onclick="window.location='<?=HOME_URI?>/usuarios/'">Cancelar</button>
                  <button type="submit" class="btn btn-success">Alterar dados</button>
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