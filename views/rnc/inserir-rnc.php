<?php
    if (!defined('ABSPATH')) exit;
?>

<div class="container-fluid">
    <div id=bordasRNC class="shadow bg-white">
        <div class="shadow bg-white">
            <nav class="navbar navbar-light text-center " style="border-radius: 50px 8px 8px 0px; background-color: #FFD700;
                        background-image: linear-gradient(to bottom, transparent, rgba(100,50,20,.40));;">   
                <h3 style="margin-left: 20px; " class="text-center">
                    RNC
                </h3>
                <span class="navbar-text">
                    Relatório de Não-Conformidade
                </span>
            </nav>
        </div>

        <form method="post"> <!-- form -->
            <input type="hidden" name="inserirRNC" value="1" />

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
                            <span style="color: red;">*</span>
                        </label>
                        <select id="selectUserOrigem" name="id_origem" class="form-control custom-select" required>
                            <option value="<?= $this->userdata['id'] ?>" selected><?= $setorAtual . " - " . $this->userdata['nome']?></option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numeroOP">
                            Número O.P:
                        </label>
                        <input type="number" class="form-control" id="numeroOP" name="numero_op" placeholder="ex: 20182">
                    </div>

                </div>
          
                <div class="form-group">
                    <label for="descricao" data-toggle="tooltip" title="Obrigatório">
                        Descrição: 
                        <span style="color: red;">*</span>
                    </label>
                    <textarea class="form-control rounded-0" id="descricao" name="descricao" rows="4"  placeholder="Descreva a não-conformidade encontrada..." required></textarea>
                </div> 

                <!-- necessários pois os asrquivos originais do header e footer estão dando conflito-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-md-8">
                                        <label for="cliente_nome">
                                            Nome:
                                        </label>
                                        <input type="text" class="form-control" name="cliente_nome" id="cliente_nome" placeholder="Digite o nome do contato">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_telefone">
                                            Telefone:
                                        </label>
                                        <input type="text" class="form-control" name="cliente_telefone" id="cliente_telefone" placeholder="Telefone para contato">
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="cliente_obra">
                                            Nome da obra:
                                        </label>
                                        <input type="text" class="form-control" name="cliente_obra" id="cliente_obra" placeholder="Digite o nome do solicitante">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cliente_email">
                                            E-mail:
                                        </label>
                                        <input type="email" class="form-control" name="cliente_email" id="cliente_email" placeholder="Digite o e-mail do contato">
                                    </div> 

                                </div> <!-- end form-row -->
                            </div> <!-- end card-body -->
                        </div> <!-- end collapseOne -->
                    </div> <!-- end card backgroundRBOX -->
                </div> <!-- end accordion -->
                <br>

                <h5> <!-- destino -->
                    DESTINO 
                    <span style="margin: 0 5px;"> | </span>
                    <small class="font-weight-light">
                        Informações do destinatário da RNC
                    </small>
                </h5>
            
                <hr>

                <div class="form-row"> <!-- form destino -->
                    <div class="form-group col-md-6">
                        <label for="selectUserDestino" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Destino: 
                            <span style="color: red;">*</span>
                        </label>
                        <select id="selectUserDestino" name="id_destino" class="form-control custom-select" required>
                            <option hidden disabled selected value>Selecione um usuário</option>
                            <?php foreach ($usuarios as $key => $usuario) {
                                echo "<option value='" . $usuario['id'] . "'>" . $usuario['nomeSetor'] . " - " . $usuario['nome'] . "</option>";
                            } ?>
                        </select>
                    </div>
                </div> <!-- end form destino -->

                <br>
            </div> <!-- Fim form background-->
    </div><!-- Fim div contorno-->
            <br>
            <button type="button" class="btn btn-secondary" onclick="window.location='<?= HOME_URI ?>/rnc/'">Voltar</button>
            <button type="submit" class="btn btn-warning">Gerar RNC</button>
        </form><!-- end form -->
</div><!-- Fim conteúdo página-->
