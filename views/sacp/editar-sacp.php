<?php
    if (!defined('ABSPATH')) {
        exit;
    }

    if ($this->userdata['tipo_usuario'] == 3) {
        if (!in_array($parametros[0], $sacpPresente))  {
            require_once ABSPATH . '/includes/403.php';
            return;
        }
    }

    $radioOptions = array('relatorio', 'indicador', 'auditoria', 'recebida', 'acao', 'riscos', 'oportunidade', 'necessidade');
    if (empty($dados['origem'])) {
        $dados['origem'] = '';
    }
    $request = $_SERVER['REQUEST_URI'];
    $request = explode("/", $request);
    $request = $request[3];
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<div class="modal fade" id="modal-mensagem">
    <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-body">
                 <div class=container4>
                 <p style="font-size: 18px;" class="P.blocktext">Atualizando SACP</p>
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
                    <button  type="button" class="btn btn-default"
                        <?php if ($request == 'editar') { ?>
                            onclick="window.location='<?= HOME_URI ?>/sacp/'"
                        <?php } else { ?>
                            onclick="window.location='<?= HOME_URI ?>/rnc/'"
                        <?php } ?>>
                        Voltar
                    </button>
                    <h3 style="text-align: center; margin-top: -30px; margin-left: 70px">Solicitação de Ação Corretiva ou Preventiva</h3>
                </div>
                <p align="right" style="position: relative; max-height: 2px; background: #337AB7; margin-right: 35px; margin-top: 0px;">
                        <span style="margin-top: -18px; background: #337AB7;" class="badge">Editar</span></p>


        <form enctype="multipart/form-data" method="post"> <!-- form -->
            <input type="hidden" name="editarSACP" value="1" />

            <div style="position: absolut; margin-top: -12px;" class="panel-body backgroundS">
                <br>

                <div class="form-group row">
                    <div class="form-group col-md-5">
                        <label for="setor_origem">
                            Setor Solicitante:
                        </label>
                        <select id="setor_origem" name="setor_origem" class="form-control custom-select" required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
                            <option hidden disabled selected value> </option>
                            <?php foreach ($setores as $key => $setor) { ?>
                                <option value="<?= $setor['id'] ?>"
                                <?php
                                    if (!empty($dados['setor_origem'])) {
                                        if($dados['setor_origem'] == $setor['id']) {
                                            echo 'selected';
                                        }
                                    }
                                ?>>
                                    <?= $setor['nome'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

    <div class="form-group col-md-5">
        <label for="setor_destino">Setor Destino:</label>
        <select id="setor_destino" name="setor_destino" class="form-control custom-select"
        required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
            <option hidden disabled selected value> </option>
            <?php foreach ($setores as $key => $setor) { ?>
                <option value="<?= $setor['id'] ?>"
                <?php
                    if (!empty($dados['setor_destino'])) {
                        if($dados['setor_destino'] == $setor['id']) {
                            echo 'selected';
                        }
                    }
                ?>>
                    <?= $setor['nome'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- validacao futura -->
    <?php /* if (empty($_POST['setorSolicitante']) && empty($_POST['setorDestino'])) {
        echo "<button type='submit' class='btn btn-primary'>OK</button>";
    } else { */ ?>

   <div class="form-group col-md-2">
      <label for="numero_op">Número O.P:</label>
      <input style="min-width: 20px; max-width: 178px;" value="<?= $dados['numero_op'] ? $dados['numero_op'] : '' ?>"
      type="number" class="form-control" id="numero_op" name="numero_op" <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
    </div>
    </div>

    <label for="participantes">Participantes:</label>
    <select class="js-example-basic-multiple form-group custom-select" id="participantes" name="participantes[]" style="width: 100%" multiple="multiple"
    required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <?php
            foreach ($participantes as $key => $participante) { ?>
                <option value="<?= $participante['id'] ?>"
                    <?php
                        if (!empty($dados['participantes'])) {
                            if (in_array($participante['id'], $dados['participantes'])) {
                                echo 'selected';
                            }
                        }
                    ?>>
                        <?= $participante['nome'] ?>
                    </option>
            <?php } ?>
    </select>

<br>
<br>
<h5><b>Origem:</b></h5>
<div class="container-fluid">
  <div class="form-group row">
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio1" value="relatorio"
      <?= $dados['origem'] == 'relatorio' ? 'checked' : '' ?>
      required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio1">Relatório de Ação Corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio2" value="indicador"
      <?= $dados['origem'] == 'indicador' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio2">Indicador</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio3" value="auditoria"
      <?= $dados['origem'] == 'auditoria' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio3">Auditoria (int./ext.)</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio4" value="recebida"
      <?= $dados['origem'] == 'recebida' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio4">Recebida de cliente</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio5" value="acao"
      <?= $dados['origem'] == 'acao' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio5">Ação corretiva</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio6" value="riscos"
      <?= $dados['origem'] == 'riscos' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio6">Riscos</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio7" value="oportunidade"
      <?= $dados['origem'] == 'oportunidade' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio7">Oportunidade</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input origemRadio" type="radio" name="origem" id="radio8" value="necessidade"
      <?= $dados['origem'] == 'necessidade' ? 'checked' : '' ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="radio8">Necessidade de mudança</label>
    </div>
    <div class="radio-inline">
      <input class="form-check-input outros" type="radio" name="origem" id="outros"
      <?php if (!in_array($dados['origem'], $radioOptions)) echo 'checked'; ?>
      <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      <label class="form-check-label" for="outros">Outros</label>
    </div>
    <div class="row">
      <div class="col-md-12">
        <input id="origemText" type="text" class="form-control form-control-sm origemText" name="origem" placeholder="Outros..."
        value="<?php if (!in_array($dados['origem'], $radioOptions)) {echo $dados['origem'] . "\"";} else { ?>" <?php echo 'disabled'; } ?>
        required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>
      </div>
    </div>
  </div>
</div>
    <br>


   <div class="form-group">
    <label for="descricao">Descrição da mudança:</label>
    <textarea class="form-control rounded-0" id="descricao" rows="4" name="descricao"
    required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
    ><?= $dados['descricao'] ?></textarea>
  </div>

  <div class="form-group">
    <label for="proposito">Propósito da mudança:</label>
    <textarea class="form-control rounded-0" id="proposito" rows="4" name="proposito"
    required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
    ><?= !empty($dados['proposito']) ? $dados['proposito'] : '' ?></textarea>
  </div>

  <div class="form-group">
    <label for="consequencia">Consequências da mudança:</label>
    <textarea class="form-control rounded-0" id="consequencia" rows="4" name="consequencia"
    required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
    ><?= !empty($dados['consequencia']) ? $dados['consequencia'] : '' ?></textarea>
    <span class="help-block">Obs: Verificar disponibilidade de recursos e responsabilidades. Atualizar matrizes de riscos do setor.</span>
  </div>

  <div class="form-group">
    <label for="brainstorming">Brainstorming / Alterações no SGI:</label>
    <textarea class="form-control rounded-0" id="brainstorming" rows="4" name="brainstorming"
    required <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
    ><?= !empty($dados['brainstorming']) ? $dados['brainstorming'] : '' ?></textarea>
  </div>

  <div class="form-group">
    <label for="data_prazo">Prazo Final:</label>
    <input type='date' class="form-control" id="data_prazo" name="data_prazo"
    value="<?= $dados['data_prazo'] = $ex = date('Y-m-d', strtotime($dados['data_prazo'])); ?>" min="<?php $data = new DateTime('now'); echo $data->format('Y-m-d'); ?>" max="2099-01-01"
    <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>>

</div>
<br>




        <!--Corpo Dados de Clientes-->

<!--botão FOTOS-->
<div id="accordion">
    <button style="background-color: #80BDFF;" class="btn btn-basic" data-toggle="collapse" href="#fotos">
            Documentos
            <small id="" class="form-text text-muted" style="color: #27408B;">
            <span style="margin: 0 5px;"> | </span> Fotos, vídeos, documentos PDF ou do pacote Office
            </small>
        </button>
        <!--Corpo Dados fotos-->
    <div id="fotos"  data-parent="#accordion"
    <?php if (!empty($dados['fotos'])) {
    echo "class='collapse show in'";
    } else {
     echo "class='collapse'";
    } ?>>
        <div class="container-fuid form-group row" style="background-color: #80BDFF;">
        <br>

        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#galeria">Galeria de Arquivos</a></li>
                <li <?php if ($this->userdata['tipo_usuario'] == 3) {echo "style='display:none'";} ?>><a data-toggle="tab" href="#add">Adicionar novos Arquivos</a></li>
            </ul>
        </div>

<div class="tab-content">
  <div id="galeria" class="tab-pane fade in active">
  <?php     $fotos = $dados['fotos'];
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
                <video height="100" onclick="changevid(this)" src="/sspiwork/views/_uploads/SACP/<?= $fotos[$key]['nome_codigo']?>">
            </div>
        </a>
        <div class="caption">
        <p style="margin-top: -16px;" align="center" >
            <a download href="/sspiwork/views/_uploads/SACP/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
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
            <img style="height: 100px;" onclick="changeimg(this)" src="/sspiwork/views/_uploads/SACP/<?= $fotos[$key]['nome_codigo']?>" alt = "<?= $fotos[$key]['nome_original'] ?>">
        </a>
        <div class="caption">
        <p style="margin-top: -16px;" align="center">
            <a download href="/sspiwork/views/_uploads/SACP/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
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
                    <a download href="/sspiwork/views/_uploads/SACP/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
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
                    <a download href="/sspiwork/views/_uploads/SACP/<?= $fotos[$key]["nome_codigo"] ?>" class="btn btn-default btn-sm" role="button">
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




  <div id="accordion" style=" ">
    <button style="background-color: #80BDFF;"  class="btn btn-basic" data-toggle="collapse" href="#collapseOne">
      Diagrama de causa e efeito
    <small id="" class="form-text">
        &nbsp;&nbsp;|&nbsp;&nbsp;6M
    </small>
              </button>




    <!--Corpo esp-peixe-->
    <div id="collapseOne" style="background-color: #80BDFF; margin-top: -2px;" class="backgroundS" data-parent="#accordion"
    <?php if (!empty($dados['espinhaPeixe'])) {
    echo "class='collapse show in'";
    } else {
     echo "class='collapse'";
    } ?>>
        <div align="center"  class="form-group row">
            <div class="form-group col-xs-12">
                <br>
    <!--Div esp-peixe-->
    <div style="width: 1151px; height: 438px;" class="row-fuid esp-peixe">
        <p style="font-size: 10px;">&nbsp;&nbsp;</p>

        <!--L1-->
        <div style="z-index:8; position:relative" class="row">
            <textarea class="form-control" name="medida[]" rows="1" placeholder=" 1 -"
            style="position:absolute; min-height: 33px; min-width:172px;  margin-left: 7.9%; margin-top: 2.4%; width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 3) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" rows="1" placeholder=" 1 -"
            style="position:absolute; min-height: 33px; min-width:167px; margin-left: 26%; margin-top: 2.4%;  width:167px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 2) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" rows="1" placeholder=" 1 -"
            style="position:absolute; min-height: 33px; min-width:165px; margin-left: 43.6%; margin-top: 2.4%;  width:165px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 1) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL1-->

        <!--L2-->
        <div style="z-index:7; position:relative" class="row">
            <textarea class="form-control" name="medida[]" rows="1" placeholder=" 2 -"
            style="position:absolute; min-height: 33px; min-width:169px; margin-left: 9.6%; margin-top: 5.7%; width:169px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 3) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" rows="1" placeholder=" 2 -"
            style="position:absolute; min-height: 33px; min-width:170px; margin-left: 27.2%; margin-top: 5.7%;  width:170px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 2) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" rows="1" placeholder=" 2 -"
            style="position:absolute; min-height: 33px; min-width:168px; margin-left: 44.6%; margin-top: 5.7%;  width:168px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 1) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL2-->

        <!--L3-->
        <div style="z-index:6; position:relative" class="row">
            <textarea class="form-control" name="medida[]" rows="1" placeholder=" 3 -"
            style="position:absolute; min-height: 33px; min-width:166px; margin-left: 11.3%; margin-top: 9%; width:166px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 3) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" rows="1" placeholder=" 3 -"
            style="position:absolute; min-height: 33px; min-width:166px; margin-left: 28.7%; margin-top: 9%;  width:166px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 2) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" rows="1" placeholder=" 3 -"
            style="position:absolute; min-height: 33px; min-width:166px; margin-left: 46%; margin-top: 9%;  width:166px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 1) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL3-->

        <!--L4-->
        <div style="z-index:5; position:relative" class="row">
            <textarea class="form-control" name="medida[]" rows="1" placeholder=" 4 -"
            style="position:absolute; min-height: 33px; min-width:164px; margin-left: 12.9%; margin-top: 12.4%; width:164px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 3) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="metodo[]" rows="1" placeholder=" 4 -"
            style="position:absolute; min-height: 33px; min-width:163px; margin-left: 30%; margin-top: 12.4%;  width:163px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 2) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="maodeobra[]" rows="1" placeholder=" 4 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 47.1%; margin-top: 12.4%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 1) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL4-->

        <!--L5-->
        <div style="z-index:4; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" rows="1" placeholder=" 1 -"
            style="position:absolute; min-height: 33px; min-width:164px; margin-left: 12.9%; margin-top: 17.4%; width:164px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 6) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" rows="1" placeholder=" 1 -"
            style="position:absolute; min-height: 33px; min-width:163px; margin-left: 30%; margin-top: 17.4%;  width:163px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 5) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" rows="1" placeholder=" 1 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 47.1%; margin-top: 17.4%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 4) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL5-->

        <!--L6-->
        <div style="z-index:3; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" rows="1" placeholder=" 2 -"
            style="position:absolute; min-height: 33px; min-width:172px;  margin-left: 11.3%; margin-top: 20.9%; width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 6) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" rows="1" placeholder=" 2 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 28.7%; margin-top: 20.9%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 5) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" rows="1" placeholder=" 2 -"
            style="position:absolute; min-height: 33px; min-width: 172px; margin-left: 46%; margin-top: 20.9%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 4) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL6-->

        <!--L7-->
        <div style="z-index:2; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" rows="1" placeholder=" 3 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 9.6%; margin-top: 24.2%; width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 6) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" rows="1" placeholder=" 3 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 27.2%; margin-top: 24.2%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 5) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" rows="1" placeholder=" 3 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 44.6%; margin-top: 24.2%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 4) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL7-->

        <!--L8-->
        <div style="z-index:1; position:relative" class="row">
            <textarea class="form-control" name="maquina[]" rows="1" placeholder=" 4 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 7.9%; margin-top: 27.7%; width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 6) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="materiais[]" rows="1" placeholder=" 4 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 26%; margin-top: 27.7%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 5) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>

            <textarea class="form-control" name="meioambiente[]" rows="1" placeholder=" 4 -"
            style="position:absolute; min-height: 33px; min-width:172px; margin-left: 43.6%; margin-top: 27.7%;  width:172px; height: 33px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
            if (!empty($dados['espinhaPeixe'])) {
                foreach ($dados["espinhaPeixe"] as $key => $dado) {
                    if ($dado['id_tipo_plano_acao'] == 4) {
                        echo $dado['descricao'];
                        unset($dados['espinhaPeixe'][$key]);
                        break;
                    }
                }
            } ?></textarea>
        </div>
        <!--endL8-->
        <!--Descrição-->
        <div style="z-index:1; position:relative" class="row">
            <textarea class="form-control" name="descricaoPeixe" rows="1" placeholder="Adicione uma descrição:"
            style="position:absolute; min-height: 32px; margin-left: 72.4%; margin-top: 2.5%; width:286px; height: 327px;"
            <?php if ($this->userdata['tipo_usuario'] == 3) {echo 'disabled';} ?>
            ><?php
                if (!empty($dados['espinhaPeixe'])) {
                    $dados['espinhaPeixe'] = array_values($dados['espinhaPeixe']);
                    echo $dados['espinhaPeixe'][0]['descricao'];
                }
            ?></textarea>
                </div>
                <!--endDescr-->
        </div>
                <!
            --endL8-->

            <!--end esp-peixe-->

      </div>
      </div>
      </div>

      </div>
      </div>


    <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
        <div class="panel-footer">
            <button id="go" type="submit" class="btn btn-primary"  data-toggle="modal" data-target="#modal-mensagem">
                <?php if ($request == 'editar') {
                    echo "Atualizar SACP";
                } else {
                    echo "Gerar SACP";
                } ?>
            </button>
            <?php if ($request == 'editar') { ?>
               &nbsp; OBS: Salvar alterações antes de inserir um novo planos de ação
            <?php } ?>
        </div>
    <?php } ?>

    </div>




</form> <!--Fim formulário principal -->
    <?php if ($request == 'editar') { ?>
    <br>
    <hr>
    <p>&nbsp;</p>

    <!-- planos de ação -->
    <div class="panel panel-default" id="   ">
        <div class="panel-heading">
            <h3 style="margin-top: 4px;" align="center">PLANOS DE AÇÃO</h3>
    </div>
    <div style="position: absolut; margin-top: -12px; background: rgb(108,117,125)"class="panel-body">
  <div class="panel-body">
  <div class="well" >
  <h3 >Mão de Obra
        <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
            <a href="<?= HOME_URI ?>/sacp/inserirPlano/<?= $parametros[0] ?>/1">
                <button style=" float: left; margin-top: -4px; margin-right: 10px;" type="button" class="btn btn-primary">
                    +
                </button>
            </a>
        <?php } ?>
    </h3>
    <table id="maodeobra" class="table table-striped table-bordered bulk_action" style="width: 100%;">

        <thead>
            <tr class="backgroundS">
                <th>O que Fazer</th>
                <th>Como Fazer</th>
                <th>Quem</th>
                <th>Quando</th>
                <th>Onde</th>
                <th style="width:1%;">Status</th>
                <th class="no-export" style="width:1%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dados['maodeobra'] as $key => $dado) { ?>
                <tr>
                    <th><?= $dado['o_que'] ?></th>
                    <th><?= $dado['como'] ?></th>
                    <th><?= $dado['nome'] ?></th>
                    <th><?= dataBR($dado['quando']) ?></th>
                    <th><?= $dado['nomeOnde'] ?></th>
                    <th><span class='label label-<?php if ($dado['status'] == 2) {echo 'warning';} else {echo 'success';} ?>'><?= $dado['nomeStatus'] ?></span></th>
                    <th>
                        <div class="btn-group">
                            <?php if (($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                    || $dado['quem'] == $this->userdata['id'])
                                        &&
                                    ($dado['status'] != 3 || $this->userdata['tipo_usuario'] != 3)) { ?>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php if ($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                                || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/editarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'finalizar', $this->userdata['user_permissions'])
                                            || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/finalizarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-check"></i> Finalizar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/excluirPlano/<?= $dado['id_sacp'] . "/" . $dado['id'] ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                                    <div style="display:none">
                                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                            <?php } else { ?>
                                <button data-toggle="dropdown" class="btn btn-default" type="button" disabled> Mais <span class="caret"></span> </button>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            <?php } ?>
        </tbody>

    </table>
    </div>

    <hr>

    <div class="well" >
    <h3>Método
        <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
            <a href="<?= HOME_URI ?>/sacp/inserirPlano/<?= $parametros[0] ?>/2">
                <button style=" float: left; margin-top: -4px; margin-right: 10px;" type="button" class="btn btn-primary">
                    +
                </button>
            </a>
        <?php } ?>
    </h3>
    <table id="metodo" class="table table-striped table-bordered bulk_action" style="width: 100%;">

        <thead>
            <tr class="backgroundS">
                <th>O que Fazer</th>
                <th>Como Fazer</th>
                <th>Quem</th>
                <th>Quando</th>
                <th>Onde</th>
                <th style="width:1%;">Status</th>
                <th class="no-export" style="width:1%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dados['metodo'] as $key => $dado) { ?>
                <tr>
                    <th><?= $dado['o_que'] ?></th>
                    <th><?= $dado['como'] ?></th>
                    <th><?= $dado['nome'] ?></th>
                    <th><?= dataBR($dado['quando']) ?></th>
                    <th><?= $dado['nomeOnde'] ?></th>
                    <th><span class='label label-<?php if ($dado['status'] == 2) {echo 'warning';} else {echo 'success';} ?>'><?= $dado['nomeStatus'] ?></span></th>
                    <th>
                        <div class="btn-group">
                            <?php if (($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                    || $dado['quem'] == $this->userdata['id'])
                                        &&
                                    ($dado['status'] != 3 || $this->userdata['tipo_usuario'] != 3)) { ?>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php if ($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                                || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/editarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'finalizar', $this->userdata['user_permissions'])
                                            || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/finalizarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-check"></i> Finalizar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/excluirPlano/<?= $dado['id_sacp'] . "/" . $dado['id'] ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                                    <div style="display:none">
                                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                            <?php } else { ?>
                                <button data-toggle="dropdown" class="btn btn-default" type="button" disabled> Mais <span class="caret"></span> </button>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
    <hr>
<div class="well" >
    <h3>Medida
        <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
            <a href="<?= HOME_URI ?>/sacp/inserirPlano/<?= $parametros[0] ?>/3">
                <button style=" float: left; margin-top: -4px; margin-right: 10px;" type="button" class="btn btn-primary">
                    +
                </button>
            </a>
        <?php } ?>
    </h3>
    <table id="medida" class="table table-striped table-bordered bulk_action" style="width: 100%;">

        <thead>
            <tr class="backgroundS">
                <th>O que Fazer</th>
                <th>Como Fazer</th>
                <th>Quem</th>
                <th>Quando</th>
                <th>Onde</th>
                <th style="width:1%;">Status</th>
                <th class="no-export" style="width:1%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dados['medida'] as $key => $dado) { ?>
                <tr>
                    <th><?= $dado['o_que'] ?></th>
                    <th><?= $dado['como'] ?></th>
                    <th><?= $dado['nome'] ?></th>
                    <th><?= dataBR($dado['quando']) ?></th>
                    <th><?= $dado['nomeOnde'] ?></th>
                    <th><span class='label label-<?php if ($dado['status'] == 2) {echo 'warning';} else {echo 'success';} ?>'><?= $dado['nomeStatus'] ?></span></th>
                    <th>
                        <div class="btn-group">
                            <?php if (($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                    || $dado['quem'] == $this->userdata['id'])
                                        &&
                                    ($dado['status'] != 3 || $this->userdata['tipo_usuario'] != 3)) { ?>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php if ($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                                || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/editarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'finalizar', $this->userdata['user_permissions'])
                                            || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/finalizarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-check"></i> Finalizar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/excluirPlano/<?= $dado['id_sacp'] . "/" . $dado['id'] ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                                    <div style="display:none">
                                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                            <?php } else { ?>
                                <button data-toggle="dropdown" class="btn btn-default" type="button" disabled> Mais <span class="caret"></span> </button>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
    <hr>
<div class="well" >
    <h3>Meio Ambiente
        <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
            <a href="<?= HOME_URI ?>/sacp/inserirPlano/<?= $parametros[0] ?>/4">
                <button style=" float: left; margin-top: -4px; margin-right: 10px;" type="button" class="btn btn-primary">
                    +
                </button>
            </a>
        <?php } ?>
    </h3>
    <table id="meioambiente" class="table table-striped table-bordered bulk_action" style="width: 100%;">

        <thead>
            <tr class="backgroundS">
                <th>O que Fazer</th>
                <th>Como Fazer</th>
                <th>Quem</th>
                <th>Quando</th>
                <th>Onde</th>
                <th style="width:1%;">Status</th>
                <th class="no-export" style="width:1%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dados['meioambiente'] as $key => $dado) { ?>
                <tr>
                    <th><?= $dado['o_que'] ?></th>
                    <th><?= $dado['como'] ?></th>
                    <th><?= $dado['nome'] ?></th>
                    <th><?= dataBR($dado['quando']) ?></th>
                    <th><?= $dado['nomeOnde'] ?></th>
                    <th><span class='label label-<?php if ($dado['status'] == 2) {echo 'warning';} else {echo 'success';} ?>'><?= $dado['nomeStatus'] ?></span></th>
                    <th>
                        <div class="btn-group">
                            <?php if (($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                    || $dado['quem'] == $this->userdata['id'])
                                        &&
                                    ($dado['status'] != 3 || $this->userdata['tipo_usuario'] != 3)) { ?>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php if ($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                                || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/editarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'finalizar', $this->userdata['user_permissions'])
                                            || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/finalizarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-check"></i> Finalizar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/excluirPlano/<?= $dado['id_sacp'] . "/" . $dado['id'] ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                                    <div style="display:none">
                                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                            <?php } else { ?>
                                <button data-toggle="dropdown" class="btn btn-default" type="button" disabled> Mais <span class="caret"></span> </button>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
    <hr>
<div class="well" >
    <h3>Materiais
        <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
            <a href="<?= HOME_URI ?>/sacp/inserirPlano/<?= $parametros[0] ?>/5">
                <button style=" float: left; margin-top: -4px; margin-right: 10px;" type="button" class="btn btn-primary">
                    +
                </button>
            </a>
        <?php } ?>
    </h3>
    <table id="materiais" class="table table-striped table-bordered bulk_action" style="width: 100%;">

        <thead>
            <tr class="backgroundS">
                <th>O que Fazer</th>
                <th>Como Fazer</th>
                <th>Quem</th>
                <th>Quando</th>
                <th>Onde</th>
                <th style="width:1%;">Status</th>
                <th class="no-export" style="width:1%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dados['materiais'] as $key => $dado) { ?>
                <tr>
                    <th><?= $dado['o_que'] ?></th>
                    <th><?= $dado['como'] ?></th>
                    <th><?= $dado['nome'] ?></th>
                    <th><?= dataBR($dado['quando']) ?></th>
                    <th><?= $dado['nomeOnde'] ?></th>
                    <th><span class='label label-<?php if ($dado['status'] == 2) {echo 'warning';} else {echo 'success';} ?>'><?= $dado['nomeStatus'] ?></span></th>
                    <th>
                        <div class="btn-group">
                            <?php if (($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                    || $dado['quem'] == $this->userdata['id'])
                                        &&
                                    ($dado['status'] != 3 || $this->userdata['tipo_usuario'] != 3)) { ?>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php if ($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                                || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/editarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'finalizar', $this->userdata['user_permissions'])
                                            || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/finalizarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-check"></i> Finalizar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/excluirPlano/<?= $dado['id_sacp'] . "/" . $dado['id'] ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                                    <div style="display:none">
                                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                            <?php } else { ?>
                                <button data-toggle="dropdown" class="btn btn-default" type="button" disabled> Mais <span class="caret"></span> </button>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
    <hr>
<div class="well" >
    <h3>Máquina
        <?php if ($this->userdata['tipo_usuario'] != 3) { ?>
            <a href="<?= HOME_URI ?>/sacp/inserirPlano/<?= $parametros[0] ?>/6">
                <button style=" float: left; margin-top: -4px; margin-right: 10px;" type="button" class="btn btn-primary">
                +
                </button>
            </a>
        <?php } ?>
    </h3>
    <table id="maquina" class="table table-striped table-bordered bulk_action" style="width: 100%;">

        <thead>
            <tr class="backgroundS">
                <th>O que Fazer</th>
                <th>Como Fazer</th>
                <th>Quem</th>
                <th>Quando</th>
                <th>Onde</th>
                <th style="width:1%;">Status</th>
                <th class="no-export" style="width:1%;"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dados['maquina'] as $key => $dado) { ?>
                <tr>
                    <th><?= $dado['o_que'] ?></th>
                    <th><?= $dado['como'] ?></th>
                    <th><?= $dado['nome'] ?></th>
                    <th><?= dataBR($dado['quando']) ?></th>
                    <th><?= $dado['nomeOnde'] ?></th>
                    <th><span class='label label-<?php if ($dado['status'] == 2) {echo 'warning';} else {echo 'success';} ?>'><?= $dado['nomeStatus'] ?></span></th>
                    <th>
                        <div class="btn-group">
                            <?php if (($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                    || $dado['quem'] == $this->userdata['id'])
                                        &&
                                    ($dado['status'] != 3 || $this->userdata['tipo_usuario'] != 3)) { ?>
                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <?php if ($this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
                                                || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/editarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-edit"></i> Editar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'finalizar', $this->userdata['user_permissions'])
                                            || $dado['quem'] == $this->userdata['id']) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/finalizarPlano/<?= $dado['id_sacp'] . "/" . $dado['id_tipo_plano'] . "/" . $dado['id'] . "/" . $dado['quem'] ?>"><i class="fa fa-check"></i> Finalizar</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                                <li>
                                                    <a href="<?= HOME_URI ?>/sacp/excluirPlano/<?= $dado['id_sacp'] . "/" . $dado['id'] ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                                    <div style="display:none">
                                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                            <?php } else { ?>
                                <button data-toggle="dropdown" class="btn btn-default" type="button" disabled> Mais <span class="caret"></span> </button>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            <?php } ?>
        </tbody>

    </table>

    </div>
</div>
    </div> <!--Fim panel Body-->

    <?php } ?>

    </div>
</div>
<hr>

</div>
</div>

<!-- /page content -->

    <script>

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
