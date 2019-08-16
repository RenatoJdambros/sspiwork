<?php
if (!defined('ABSPATH')) {
    exit;
}

if ($this->userdata['tipo_usuario'] == 3) {
    if ($this->userdata['id'] != $userOrigem['id']
     && $this->userdata['id'] != $userDestino['id']) {
        require_once ABSPATH . '/includes/403.php';
        return;
    }
}
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<!--MODAL de carregamento on.click.submit-->
<div class="modal fade" id="modal-mensagem">
    <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-body">
                 <div class=container4>
                 <p style="font-size: 18px;" class="P.blocktext">Atualizando RNC</p>
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
                        <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/rnc/'">
                        Voltar
                        </button>
                        <h3 style="text-align: center; margin-top: -30px; "> Solicitação de Ação Corretiva ou Preventiva (mudança no SGI)</h3>
                    </div>

                <p align="right" style="background: #F6B05A; margin-bottom: -18px; margin-right: 35px;">
                <span style="margin-top: -18px; background-color: #F6B05A;" class="badge">Editar</span></p>

    <div class="panel-body backgroundR">
    <form enctype="multipart/form-data" method="post"> <!-- form -->
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
                                <?= $userOrigem['nome']?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-xs-2">
                        <label for="numeroOP">
                            Número O.P:
                        </label>
                        <input value="<?= $rnc['numero_op'] ?>" type="number" name="numero_op" class="form-control"
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
                <button style="background-color: #FAF6DC;" class="btn btn-basic" data-toggle="collapse" href="#collapseOne">
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
                            <div class="form-group row" style="background-color: #FAF6DC;">
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


        <!--Corpo Dados de Clientes-->

<!--botão FOTOS-->
<div id="accordion">
    <button style="background-color: #FAF6DC;" class="btn btn-basic" data-toggle="collapse" href="#fotos">
            Documentos
            <small id="" class="form-text text-muted" style="color: #27408B;">
            <span style="margin: 0 5px;"> | </span> Fotos, vídeos, documentos PDF ou do pacote Office
            </small>
        </button>
        <!--Corpo Dados fotos-->
    <div id="fotos"  data-parent="#accordion"
    <?php if (!empty($fotos)) {
    echo "class='collapse show in'";
    } else {
     echo "class='collapse'";
    } ?>>
        <div class="container-fuid form-group row" style="background-color: #FAF6DC;">
        <br>

        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#galeria">Galeria de Arquivos</a></li>
                <li><a data-toggle="tab" href="#add">Adicionar novos Arquivos</a></li>
            </ul>
        </div>

<div class="tab-content">
  <div id="galeria" class="tab-pane fade in active">
  <?php
            $imagem = array("gif", "jpeg", "pjpeg", "png", "tiff", "bmp", "jpg");
            $pdf = array("pdf");
            $video = array("mp4", "ogg", "webm", "x-sgi-movie", "x-ms-asf", "x-msvideo", "quicktime", "mpeg");
            $texto = array("doc", "vnd.openxmlformats-officedocument.spreadsheetml.sheet", "vnd.openxmlformats-officedocument.wordprocessingml.document", "xml", "rtf", "plain", "postscript",  "postscript", "excel", "msword", "xlsx", "xls");
    ?>
            <?php foreach ($fotos as $key => $nome_original) { ?>
            <?php   $str = $fotos[$key]['nome_codigo'];
                    $info = pathinfo($str);
                    $ext = $info['extension'];
            ?>

        <!-- VIDEO -->
        <?php if (in_array($ext, $video) ) { ?>
        <div class="col-md-3">
        <br>
        <a  style="margin-top: 10px;  margin-bottom: 20px;" href="#vid" class="thumbnail" align="center" data-toggle="tooltip" title="<?= $fotos[$key]['nome_original']?>">
            <div align="center">
                <video height="100" onclick="changevid(this)" src="/sspiwork/views/_uploads/RNC/<?= $fotos[$key]['nome_codigo']?>">
            </div>
        </a>
        <div class="caption">
        <p style="margin-top: -16px;" align="center" >
            <a download href="/sspiwork/views/_uploads/RNC/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
            Download
            </a>
        </p>
        </div>
        </div>
        <?php } ?>

        <!-- FOTOS -->
        <?php if (in_array($ext, $imagem) ) { ?>
        <div class="col-md-3">
        <br>
        <a style="margin-top: 10px;  margin-bottom: 20px;" href="#img" class="thumbnail" data-toggle="tooltip" title="<?= $fotos[$key]['nome_original']?>">
            <img style="height: 100px;" onclick="changeimg(this)" src="/sspiwork/views/_uploads/RNC/<?= $fotos[$key]['nome_codigo']?>" alt = "<?= $fotos[$key]['nome_original'] ?>">
        </a>
        <div class="caption">
        <p style="margin-top: -16px;" align="center">
            <a download href="/sspiwork/views/_uploads/RNC/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
            Download
            </a>
        </p>
        </div>
        </div>
        <?php } ?>

        <!-- PDF -->
        <?php if ( in_array($ext, $pdf)  ) { ?>
        <div class="col-md-3">
            <br>
                <a  style="margin-top: 10px;  margin-bottom: 20px;"  href="#text" class="thumbnail" data-toggle="tooltip" title="<?= $fotos[$key]['nome_original']?>">
                    <img style="height: 100px;" onclick="changeIt(this)" src="<?= HOME_URI ?>/views/_images/ipdf.png" alt = "<?= $fotos[$key]['nome_original'] ?>">
                </a>
            <div class = "caption">
                <p style="margin-top: -16px;" align="center">
                    <a download href="/sspiwork/views/_uploads/RNC/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
                    Download
                    </a>
                </p>
            </div>
        </div>
        <?php } ?>

        <!-- OFFICE -->
        <?php if (in_array($ext, $texto) ) { ?>
        <div class="col-md-3" >
            <br>
            <a style="margin-top: 10px;  margin-bottom: 20px;" href="#text" class="thumbnail" data-toggle="tooltip" title="<?= $fotos[$key]['nome_original']?>">
                <img style="height: 100px;" onclick="changeIt(this)" src="<?= HOME_URI ?>/views/_images/doc.png" alt = "<?= $fotos[$key]['nome_original'] ?>">
            </a>
            <div class = "caption">
                <p style="margin-top: -16px;" align="center">
                    <a download href="/sspiwork/views/_uploads/RNC/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
                    Download
                    </a>
                </p>
            </div>
        </div>
        <?php } ?>


    <?php } ?>

    <figure id="vid" class="lbox flip">
    <div class="vid">
    <video id="video" height="450" controls="controls" autoplay="autoplay">
        <source src="" type="video/mp4">
    </video>
    </div>
    <a href="#_"></a>
    </figure>

    <figure id="img" class="lbox bounce">
    <img id="valor" src=""/>
    <a href="#_"></a>
    </figure>

    <figure id="text" class="lbox flip">
    <div class="text">
        <p>Este formato de arquivo não possui visualização!</p>
    </div>
    <a href="#_"></a>
    </figure>
  </div>


  <div id="add" class="tab-pane fade">
  <div class="form-group col-xs-12">
        <br>
        <div class="file-loading">
        <input id="file-4" type="file" class="file" multiple data-theme="fas" name="arquivos[]">
    </div>
    </div>
  </div>
</div>

                <br>


        </div>
    </div> <!-- end collapseOne -->

</div> <!-- end accordion -->
<br>
                        <div class="form-group row">
                    <div class="form-group col-xs-6">
                        <label for="selectUserDestino" data-toggle="tooltip" title="Obrigatório">
                            Usuário de Destino:
                        </label>
                        <select id="selectUserDestino" name="id_destino" class="form-control custom-select" required
                            <?php if($this->userdata['id'] != $userOrigem['id']) echo "disabled" ?>>
                            <?php foreach ($usuarios as $key => $usuario) { ?>
                                    <option value='<?= $usuario['id'] ?>'
                                    <?php if ($usuario['id'] == $userDestino['id']) {echo "selected";} ?>>
                                        <?= $userDestino['nome'] ?>
                                    </option>
                                <?php } ?>

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
                                            <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-mensagem">
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


<script type="text/javascript">



function changeimg(img)
{
    var name = img.src;
    document.getElementById("valor").setAttribute("src", name);
}

function changevid(vid){
    var name = vid.src;
    document.getElementById("video").setAttribute("src", name);
}

$("#file-4").fileinput({
        theme: 'fas',
        maxFileCount: 10,
        initialPreviewAsData: true , // identify if you are sending preview data only and not the raw markup
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        allowedFileTypes: ["image", "video", "pdf",],
        purifyHtml: true ,
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
<hr>
