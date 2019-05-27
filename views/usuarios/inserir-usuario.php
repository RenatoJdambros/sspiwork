
<? if (! defined('ABSPATH')) exit; ?>

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
          </div>
          <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left" method="post">
              <input type="hidden" name="inserirUsuario" value="1" />
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome Completo</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="nome" placeholder="Nome Completo" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Setor</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select name="setor" id="setor" class="form-control custom-select" required>
                  <option hidden disabled selected value>Selecione um setor</option>
                    <?php foreach ($setores as $key => $setor) {
                      echo "<option value='" . $setor['id'] . "'>" . $setor['nome'] . "</option>";
                    } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="email" class="form-control" name="email" placeholder="usuario@edelbra.com.br" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" class="form-control" name="usuario"  placeholder="usuario.edelbra" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Senha</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <input type="text" class="form-control" name="senha"  placeholder="Senha" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Usuário</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" name="tipo_usuario" required>
                  <option hidden disabled selected value>Selecione uma opção</option>
                    <?php foreach ($tiposUsuario as $key => $tipo_usuario) { ?>                          
                      <option value="<?= $tipo_usuario['id'] ?>"><?= $tipo_usuario['nome'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

  					  <div style="clear:both;"></div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="button" class="btn btn-primary" onclick="window.location='<?=HOME_URI?>/usuarios/'">Cancelar</button>
                  <button type="submit" class="btn btn-success">Cadastrar Usuário</button>
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