<?php if (! defined('ABSPATH')) exit; ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?=$this->title?></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" id="users-div-view">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
                    
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              Configurações cadastradas no sistema
            </p>
            <table id="datatable" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Valor</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->lista as $config): ?>
                  <tr>
                    <td><?=$config['id']?></td>
                    <td><?=$config['nome']?></td>
                    <td><?= substr(strip_tags($config['value']), 0, 30); ?></td>
                    <td>
                      <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                        <?php if ($this->check_permissions('configuracoes', 'editar', $this->userdata['user_permissions'])) { ?>
                          <li><a href="<?=HOME_URI?>/configuracoes/editar/<?=$config['id']?>"><i class="fa fa-edit"></i>
                            Editar
                          </a></li>
                        <?php } ?>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
        
 