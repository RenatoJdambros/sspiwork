<?php
    if (!defined('ABSPATH')) exit; 
?>

<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                <button type="button" class="btn btn-default" onclick="window.location='<?=HOME_URI?>/usuarios/'">
                        Voltar
                        </button>
                    <h4 style="text-align: center;  margin-top: -30px; " >
                        <b><?=$this->title?></b></h4>
                </div>
                <p align="right" style="position: relative; max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                    <span style="margin-top: -18px;" class="badge">Painel de Controle</span></p>


        <div class="panel-body">                   
        <br>
        <div class="container-fluid">
            <form class="form-horizontal form-label-left" method="post">
                <input type="hidden" name="editarUsuario" value="1" />

                <div class="form-group">
                    <label class="control-label col-md-2 " for="nome" 
                    data-toggle="tooltip" title="Obrigatório">
                        Nome Completo
                        <span style="color: red;">*</span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario['nome'] ?>" 
                        placeholder="Nome Completo" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 " for="setor" 
                    data-toggle="tooltip" title="Obrigatório">
                        Setor
                        <span style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 ">
                        <select name="setor" id="setor" class="form-control custom-select" required>
                            <option hidden disabled selected value>Selecione um setor</option>
                            <?php foreach ($setores as $key => $setor) {
                                if ($usuario['setor'] == $setor['id']) {
                                    echo "<option value='" . $setor['id'] . "' selected>" . $setor['nome'] . "</option>";
                                } else {
                                    echo "<option value='" . $setor['id'] . "'>" . $setor['nome'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 " for="email" 
                    data-toggle="tooltip" title="Obrigatório">
                        E-mail
                        <span style="color: red;">*</span>
                    </label>
                    <div class=" col-md-6">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" 
                        placeholder="usuario@edelbra.com.br" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 " for="usuario" 
                    data-toggle="tooltip" title="Obrigatório">
                        Usuário
                        <span style="color: red;">*</span>
                    </label>
                    <div class=" col-md-6">
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $usuario['usuario'] ?>" 
                        placeholder="usuario.edelbra" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="senha" 
                    data-toggle="tooltip" title="Obrigatório">
                        Senha
                    </label>
                    <div class=" col-md-6">
                        <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="tipo_usuario" 
                    data-toggle="tooltip" title="Obrigatório">
                        Tipo de Usuário
                        <span style="color: red;">*</span>
                    </label>
                    <div class=" col-md-6">
                        <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                            <option hidden disabled selected value>Selecione uma opção</option>
                            <?php foreach ($tiposUsuario as $key => $tipo_usuario) {
                                if ($usuario['tipo_usuario'] == $tipo_usuario['id']) {
                                    echo "<option value='" . $tipo_usuario['id'] . "' selected>"
                                    . $tipo_usuario['nome'] . "</option>";
                                } else {
                                    echo "<option value='" . $tipo_usuario['id'] . "'>"
                                    . $tipo_usuario['nome'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2" for="status" 
                    data-toggle="tooltip" title="Obrigatório">
                        Status
                        <span style="color: red;">*</span>
                    </label>
                    <div class=" col-md-6">
                        <select class="form-control" id="status" name="status" required>
                            <option value="ativo" <?php if ($usuario['status'] == 'ativo') {echo 'selected';} ?>>Ativo</option>
                            <option value="inativo" <?php if ($usuario['status'] == 'inativo') {echo 'selected';} ?>>Inativo</option>
                        </select>
                    </div>
                </div>
                </div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-primary" onclick="window.location='<?=HOME_URI?>/usuarios/'">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        Alterar dados
                    </button>
                </div>
                    
                
            </form>
        </div>
        </div>
        <hr>
    </div>
</div>
<!-- /page content -->