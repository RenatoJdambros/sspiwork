<?php
    if (!defined('ABSPATH')) exit;
?>



<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<!--MODAL de carregamento on.click.submit-->
<div class="modal fade" id="modal-mensagem">
    <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-body">
                 <div class=container4>
                 <p style="font-size: 18px;" class="P.blocktext">Gerando RNC</p>
                 <div class="spinner">&nbsp;</div>
                 </div>
             </div>
         </div>
     </div>
 </div>


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
        <form enctype="multipart/form-data" method="post"> <!-- form -->
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
                <hr>

                <!--botão Dados de Clientes-->
                <div id="accordion">
                <button style="background-color: #FAF6DC;" class="btn btn-basic" data-toggle="collapse" href="#collapseOne">
                                Dados de clientes
                                <small id="" class="form-text text-muted">
                                <span style="margin: 0 5px;"> | </span>Utilizados em não-conformidades geradas por clientes
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

	<hr>

<!--botão FOTOS-->
<div id="accordion">
    <button style="background-color: #FAF6DC;" class="btn btn-basic" data-toggle="collapse" href="#fotos">
            Documentos
            <small id="" class="form-text text-muted">
            <span style="margin: 0 5px;"> | </span> Fotos, vídeos, documentos PDF ou do pacote Office
            </small>
        </button>
        <!--Corpo Dados fotos-->
    <div id="fotos" class="collapse" data-parent="#accordion">
        <div class="container-fuid form-group row" style="background-color: #FAF6DC;">
            <div class="form-group col-xs-12">
                <br>
                <div class="file-loading">
                <input id="file-4" type="file" class="file" multiple data-theme="fas" name="arquivos[]">
            </div>
            </div>
        </div>
    </div> <!-- end collapseOne -->
</div> <!-- end accordion -->

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
                                        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-mensagem">
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

$("#file-4").fileinput({
        theme: 'fas',
        maxFileCount: 10,
        initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        allowedFileTypes: ["image", "video", "pdf",],
        purifyHtml: true,
        uploadExtraData: {
        img_key: "1000",
        img_keywords: "happy, places"
    }
}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);
}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);
});


(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-58087941-1', 'auto');
    ga('send', 'pageview');
    ga('send', 'event', 'labs', 'spinner-loader');
</script>
