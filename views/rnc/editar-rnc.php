<?php
    if (!defined('ABSPATH')) exit;
?>

<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/rnc/'">
                        Voltar
                        </button>
                        <h3 style="text-align: center; margin-top: -30px; "> Solicitação de Ação Corretiva ou Preventiva (mudança no SGI)</h3>
                    </div>

                <p align="right" style="background: #F6B05A; margin-bottom: -18px; margin-right: 35px;">
                <span style="margin-top: -18px; background-color: #F6B05A;" class="badge">Editar</span></p>
    
    <div class="panel-body backgroundR">
        <form method="post"> <!-- form -->
            <input type="hidden" name="editarRNC" value="1" />
            <input type="hidden" name="status" value="2" />
                <h4> <!-- origem -->
                    ORIGEM
                    <span style="margin: 0 5px;"> | </span>
                    <small class="font-weight-light">
                        Informações do emitente da RNC
                    </small>
                </h4>
                <hr>
                <div class="form-group row"> <!-- form origem -->
                    <div class="form-group col-xs-4">
                        <label for="selectUserOrigem" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Origem: 
                            <span style="color: red;">*</span>
                        </label>
                        <select id="selectUserOrigem" name="id_origem" class="form-control custom-select" required
                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                            <option value="<?= $userOrigem['id'] ?>" selected>
                                <?= $setorOrigem . " - " . $userOrigem['nome']?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-xs-2">
                        <label for="numeroOP">
                            Número O.P:
                        </label>
                        <input value="<?= $rnc['numero_op'] ?>" type="text" class="form-control" 
                        id="numero_op" placeholder="ex: 20182"
                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>                    </div>
                    </div>
                <div class="form-group">
                    <label for="descricao" data-toggle="tooltip" title="Obrigatório">
                        Descrição: 
                        <span style="color: red;">*</span>
                    </label>
                    <textarea class="form-control rounded-0" id="descricao" name="descricao" rows="4"  
                    placeholder="Descreva a não-conformidade encontrada..." required 
                    <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>><?= $rnc['descricao'] ?></textarea>
                </div>
                <br>
                <!--botão Dados de Clientes-->
                <div id="accordion">
                <button class="btn btn-basic" data-toggle="collapse" href="#collapseOne">
                                Dados de clientes
                                <small id="" class="form-text text-muted">
                                    &nbsp;&nbsp;|&nbsp;&nbsp;Utilizados em não-conformidades geradas por clientes
                                </small>
                            </button>
                            <!--Corpo Dados de Clientes-->
                        <div id="collapseOne" data-parent="#accordion"
                        <?php if (!empty($rnc['cliente_nome']) || !empty($rnc['cliente_telefone'])
                               || !empty($rnc['cliente_obra']) || !empty($rnc['cliente_email'])) {
                            echo "class='collapse show in'";
                        } else {
                            echo "class='collapse'";
                        } ?>>
                            <div class="form-group row">
                                <div class="form-group col-xs-8">
                                    <br>
                                        <label for="cliente_nome">
                                            Nome:
                                        </label>
                                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome"
                                        placeholder="Digite o nome do contato" value="<?= $rnc['cliente_nome'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>
                                    <br>   
                                <div class="form-group col-xs-4">
                                        <label for="cliente_telefone">
                                            Telefone:
                                        </label>
                                        <input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone"
                                        placeholder="Telefone para contato" value="<?= $rnc['cliente_telefone'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>
                                <div class="form-group col-xs-8">
                                        <label for="cliente_obra">
                                            Nome da obra:
                                        </label>
                                        <input type="text" class="form-control" id="cliente_obra" name="cliente_obra"
                                        placeholder="Digite o nome do solicitante" value="<?= $rnc['cliente_obra'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                </div>
                                    <div class="form-group col-xs-4">
                                        <label for="cliente_email">
                                            E-mail:
                                        </label>
                                        <input type="email" class="form-control" id="cliente_email" name="cliente_email"
                                        placeholder="Digite o e-mail do contato" value="<?= $rnc['cliente_email'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>
                                </div> <!-- end form-row -->
                            </div> <!-- end collapseOne -->
                        </div> <!-- end accordion -->
                        <hr>

                        <div class="form-group row">
                    <div class="form-group col-xs-6">
                        <label for="selectUserDestino" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Destino:
                        </label>
                        <select id="selectUserDestino" name="id_destino" class="form-control custom-select" required
                            <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                            <?php foreach ($usuarios as $key => $usuario) {
                                if ($usuario['id'] == $userDestino['id']) {
                                    echo "<option value='" . $usuario['id'] . "' selected>" . $usuario['nomeSetor'] 
                                    . " - " . $usuario['nome'] . "</option>";
                                } else {
                                    echo "<option value='" . $usuario['id'] . "'>" . $usuario['nomeSetor'] 
                                    . " - " . $usuario['nome'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                        <div class="form-group">
                    <label for="justificativa" data-toggle="tooltip" title="Obrigatório">
                        Justificativa:
                        <span style="color: red;">*</span>
                    </label>
                    <textarea class="form-control rounded-0" id="justificativa" name="justificativa"
                    rows="4"  placeholder="Descreva a justificativa..." required 
                    <?php if($this->userdata['id'] == $userOrigem['id']) echo "disabled" ?>><?= $rnc['justificativa'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="correcao" data-toggle="tooltip" title="Obrigatório">
                        Correção realizada:
                        <span style="color: red;">*</span>
                    </label>
                    <textarea class="form-control rounded-0" id="correcao" name="correcao" 
                    rows="4" placeholder="Descreva a correção..." required 
                    <?php if($this->userdata['id'] == $userOrigem['id']) echo "disabled" ?>><?= $rnc['correcao'] ?></textarea>
                </div>
                
                 
     
                                                </div> <!-- end div panel body -->
                                            <div class="panel-footer">
                                            <button type="submit" class="btn btn-warning">
                                            Atualizar RNC
                                            </button>
                                </div>
                            </div> <!-- Fim div Painel-->
                        </div> <!-- Fim div container fluid-->
                        <hr>
                    </div> <!-- Fim div col-->
                </div><!-- Fim div row -->               
            </form><!-- end form -->
<!-- Fim conteúdo página-->





                  

                        
            
                
               
            
            
            
            




    
          

        

        


