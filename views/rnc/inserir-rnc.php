<?php
    if (!defined('ABSPATH')) exit;
?>

<hr>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button style="margin-rigt: 30px;" type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/rnc/'">
                    Voltar
                    </button>
                    <h4 style="text-align: center; margin-top: -27px;  text-color: #F6B05A; "> <b>Relatório de Não-Conformidade</b></h4>
                </div>
                <p align="right" style="background: #337AB7; margin-bottom: -18px; margin-right: 35px;">
                <span style="margin-top: -18px; background-color: #337AB7;" class="badge">Gerar</span></p>
    <div class="panel-body backgroundR">
        <form method="post"> <!-- form -->
            <input type="hidden" name="inserirRNC" value="1" />
                <h4> <!-- origem -->
                    ORIGEM
                    <span style="margin: 0 5px;"> | </span>
                    <small class="font-weight-light">
                        Informações do emitente da RNC
                    </small>
                </h4>
                <hr>
                <div class="form-group row"> <!-- form origem -->
                    <div class="form-group col-xs-8">
                        <label for="selectUserOrigem" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Origem: 
                            <span style="color: red;">*</span>
                        </label>
                        <select id="selectUserOrigem" name="id_origem" class="form-control" required>
                            <option value="<?= $this->userdata['id'] ?>" selected>
                                <?= $this->userdata['nome']?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-xs-4">
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
                    <textarea class="form-control rounded-0" id="descricao" name="descricao" rows="4" 
                    placeholder="Descreva a não-conformidade encontrada..." required></textarea>
                </div>
               
                <!--botão Dados de Clientes-->
                <div id="accordion">
                <button style="background-color: #FAF6DC;" class="btn btn-basic" data-toggle="collapse" href="#collapseOne">
                                Dados de clientes
                                <small id="" class="form-text text-muted">
                                    &nbsp;&nbsp;|&nbsp;&nbsp;Utilizados em não-conformidades geradas por clientes
                                </small>
                            </button>
                            <!--Corpo Dados de Clientes-->
                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="container-fuid form-group row" style="background-color: #FAF6DC;">
                                <div class="form-group col-xs-8">
                                    <br>
                                        <label for="cliente_nome">
                                            Nome:
                                        </label>
                                        <input type="text" class="form-control" name="cliente_nome" id="cliente_nome" 
                                        placeholder="Digite o nome do contato">
                                    </div>
                                    <br>   
                                <div class="form-group col-xs-4">
                                        <label for="cliente_telefone">
                                            Telefone:
                                        </label>
                                        <input type="text" class="form-control" name="cliente_telefone" id="cliente_telefone" 
                                        placeholder="Telefone para contato">
                                    </div>
                                <div class="form-group col-xs-8">
                                        <label for="cliente_obra">
                                            Nome da obra:
                                        </label>
                                        <input type="text" class="form-control" name="cliente_obra" id="cliente_obra" 
                                        placeholder="Digite o nome do solicitante">
                                </div>
                                    <div class="form-group col-xs-4">
                                        <label for="cliente_email">
                                            E-mail:
                                        </label>
                                        <input type="email" class="form-control" name="cliente_email" id="cliente_email" 
                                        placeholder="Digite o e-mail do contato">
                                    </div>
                                </div> <!-- end form-row -->
                            </div> <!-- end collapseOne -->
                        </div> <!-- end accordion -->
                    <button type="button" id="mulitplefileuploader">Importar arquivo(s)</button>
                <br>

                <div class="form-group row"> <!-- form destino -->
                    <div class="form-group col-md-12">
                        <br>
                        <h4> <!-- destino -->
                        DESTINO 
                            <span style="margin: 0 5px;"> | </span>
                            <small class="font-weight-light">
                                Informações do destinatário da RNC
                            </small>
                    </h4>
                <hr>
                <label for="selectUserDestino" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Destino: 
                            <span style="color: red;">*</span>
                        </label>
                        <select id="selectUserDestino" name="id_destino" class="form-control custom-select" required>
                            <option hidden disabled selected value>Selecione um usuário</option>
                            <?php foreach ($usuarios as $key => $usuario) {
                                echo "<option value='" . $usuario['id'] . "'>" . $usuario['nome'] . "</option>";
                            } ?>
                        </select>
                        <br>
                                                        </div>
                                                    </div> 
                                                </div> <!-- end div panel body -->
                                            <div class="panel-footer">
                                        <button type="submit" class="btn btn-primary">
                                        Gerar RNC
                                    </button>
                                </div>
                            </div> <!-- Fim div Painel-->
                        </div> <!-- Fim div container fluid-->
                        <hr>
                    </div> <!-- Fim div col-->
                </div><!-- Fim div row -->               
            </form><!-- end form -->
            <!-- Fim conteúdo página-->
            

<script type="text/javascript">
$(document).ready(function()
     {
    
     var settings = {
        url: "<?= HOME_URI ?>/rnc/ajax",
        method: "POST",
        allowedTypes:"pdf",
        fileName: "file",
        multiple: true,
        
        onSuccess:function(files,data,xhr)
        {
           //faz alguma coisa

        },
     
         afterUploadAll:function()
         {
            $(".upload-bar").css("animation-play-state","paused");
            
         },
        onError: function(files,status,errMsg)
        {       
          
            alert(errMsg);
        }

        
     }
     $("#mulitplefileuploader").uploadFile(settings);
        
     });
</script>
