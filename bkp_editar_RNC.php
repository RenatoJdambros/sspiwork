<?php
    if (!defined('ABSPATH')) exit;
?>

<div class="container-fluid">
    <div id=bordasRNC class="shadow bg-white">
        <div class="shadow bg-white">
            <nav class="navbar navbar-light text-center " style="border-radius: 50px 8px 8px 0px; 
            background-color: #FFD700; background-image: linear-gradient(to bottom, transparent, rgba(100,50,20,.40));;"> 
                <h3 style="margin-left: 20px; " class="text-center">
                    RNC
                </h3>
                <span class="navbar-text">
                    Relatório de Não-Conformidade
                </span>
            </nav>
        </div>

        <form method="post"> <!-- form -->
            <input type="hidden" name="editarRNC" value="1" />
            <input type="hidden" name="status" value="2" />

            <div class="container-fluid backgroundR"> 
                <br>

                <h5> <!-- origem -->
                    ORIGEM
                    <span style="margin: 0 5px;"> | </span>
                    <small class="font-weight-light">
                        Informações do emitente da RNC
                    </small>
                </h5>

                <hr>

                <div class="form-row"> <!-- form origem -->

                    <div class="form-group col-md-4">
                        <label for="selectUserOrigem" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Origem:
                        </label>
                        <select id="selectUserOrigem" name="id_origem" class="form-control custom-select" required
                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                            <option value="<?= $userOrigem['id'] ?>" selected>
                                <?= $setorOrigem . " - " . $userOrigem['nome']?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numeroOP">
                            Número O.P:
                        </label>
                        <input value="<?= $rnc['numero_op'] ?>" type="text" class="form-control" 
                        id="numero_op" placeholder="ex: 20182"
                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                    </div>

                </div> 

                <div class="form-group">
                    <label for="descricao" data-toggle="tooltip" title="Obrigatório">
                        Descrição:
                    </label>
                    <textarea class="form-control rounded-0" id="descricao" name="descricao" rows="4"  
                    placeholder="Descreva a não-conformidade encontrada..." required 
                    <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>><?= $rnc['descricao'] ?></textarea>
                </div>

                <!--botão Dados de Clientes-->
                <div id="accordion">
                    <div class="card backgroundRBOX">
                        <div class="card-header card">
                            <a class="card-link row" data-toggle="collapse" href="#collapseOne">
                                Dados de clientes
                                <small id="" class="form-text text-muted">
                                    &nbsp;&nbsp;|&nbsp;&nbsp;Utilizados em não-conformidades geradas por clientes
                                </small>
                            </a>
                        </div>
                        <!--Corpo Dados de Clientes-->
                        <!-- php if checa se algum dos campos referente a cliente está preenchido, caso sim, já
                        carrega a página com a área expandida -->
                        <div id="collapseOne" data-parent="#accordion"
                        <?php if (!empty($rnc['cliente_nome']) || !empty($rnc['cliente_telefone'])
                               || !empty($rnc['cliente_obra']) || !empty($rnc['cliente_email'])) {
                            echo "class='collapse show in'";
                        } else {
                            echo "class='collapse'";
                        } ?>>
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-md-8">
                                        <label for="cliente_nome">
                                            Nome:
                                        </label>
                                        <input type="text" class="form-control" id="cliente_nome" name="cliente_nome"
                                        placeholder="Digite o nome do contato" value="<?= $rnc['cliente_nome'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_telefone">
                                            Telefone:
                                        </label>
                                        <input type="text" class="form-control" id="cliente_telefone" name="cliente_telefone"
                                        placeholder="Telefone para contato" value="<?= $rnc['cliente_telefone'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="cliente_obra">
                                            Nome da obra:
                                        </label>
                                        <input type="text" class="form-control" id="cliente_obra" name="cliente_obra"
                                        placeholder="Digite o nome do solicitante" value="<?= $rnc['cliente_obra'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_email">
                                            E-mail:
                                        </label>
                                        <input type="email" class="form-control" id="cliente_email" name="cliente_email"
                                        placeholder="Digite o e-mail do contato" value="<?= $rnc['cliente_email'] ?>"
                                        <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                                    </div>

                                </div> <!-- end form-row -->
                            </div> <!-- end card-body -->
                        </div> <!-- end collapseOne -->
                    </div> <!-- end card backgroundRBOX -->
                </div> <!-- end accordion -->
                <br>

                <h5> <!-- destino -->
                    DESTINO 
                    <span style="margin: 0 5px;">|</span>
                    <small class="font-weight-light">
                        Informações do destinatário da RNC
                    </small>
                </h5>

                <hr>

                <div class="form-row">
                    <div class="form-group col-md-6">
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

                <hr>

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

                <br>
            </div> <!-- Fim form background-->
    </div><!-- Fim div contorno-->
            <br>

            <button type="button" class="btn btn-secondary" onclick="window.location='<?= HOME_URI ?>/rnc/'">
                Voltar
            </button>

            <button type="submit" class="btn btn-warning">
                Atualizar RNC
            </button>
            
            <hr>
        </form><!-- end form -->
</div><!-- Fim conteúdo página-->
