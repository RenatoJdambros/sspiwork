<?
if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<div class="row-fuid">
    <div class="shadow p-4 mb-4 bg-white rounded">
        <div class="x_panel">
            <div class="x_title">
                <h2>SACP<small> Gerar uma nova SACP</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left" method="post">
                    <input type="hidden" name="insere_beacon" value="1" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="nome" required="required" placeholder="Nome SACP">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Options</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" name="opcoes" required="required">
                                <option hidden>Selecione uma opção</option>
                                <?php foreach ($opcoes as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!--Div esp-peixe-->
                    <div style="width: 1250px;  height: 450px;" class="row-fuid esp-peixe">
                        <label for="Ajuste Altura"></label>

                        <!--L1-->
                        <div style="z-index:8; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 10%; margin-top: 2.6%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 28.3%; margin-top: 2.6%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 45.6%; margin-top: 2.6%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 1 -"></textarea>
                        </div>
                        <!--endL1-->

                        <!--L2-->
                        <div style="z-index:7; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 11.9%; margin-top: 6%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 29.75%; margin-top: 6%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 46.7%; margin-top: 6%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 2 -"></textarea>
                        </div>
                        <!--endL2-->

                        <!--L3-->
                        <div style="z-index:6; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 13.6%; margin-top: 9.3%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 31%; margin-top: 9.3%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 48%; margin-top: 9.3%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 3 -"></textarea>
                        </div>
                        <!--endL3-->

                        <!--L4-->
                        <div style="z-index:5; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 15.4%; margin-top: 12.5%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 32.3%; margin-top: 12.5%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 49.3%; margin-top: 12.5%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 4 -"></textarea>
                        </div>
                        <!--endL4-->

                        <!--L5-->
                        <div style="z-index:4; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 15.4%; margin-top: 17.3%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 32.3%; margin-top: 17.3%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 1 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 49.3%; margin-top: 17.3%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 1 -"></textarea>
                        </div>
                        <!--endL5-->

                        <!--L6-->
                        <div style="z-index:3; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 13.6%; margin-top: 20.6%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 31%; margin-top: 20.6%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 2 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 48%; margin-top: 20.6%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 2 -"></textarea>
                        </div>
                        <!--endL6-->

                        <!--L7-->
                        <div style="z-index:2; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 11.9%; margin-top: 23.8%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 29.75%; margin-top: 23.8%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 3 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 46.7%; margin-top: 23.8%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 3 -"></textarea>
                        </div>
                        <!--endL7-->

                        <!--L2-->
                        <div style="z-index:1; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 10%; margin-top: 27%; width:160px; height: 32px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 28.3%; margin-top: 27%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 4 -"></textarea>

                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 45.6%; margin-top: 27%;  width:160px; height: 32px;" id="#" rows="1" placeholder=" 4 -"></textarea>
                        </div>
                        <!--endL2-->

                        <!--Descrição-->
                        <div style="z-index:1; position:relative" class="row">
                            <textarea class="form-control" style="position:absolute; min-height: 32px; margin-left: 72.4%; margin-top: 2.8%; width:320px; height: 342px;" id="#" rows="1" placeholder="Adicione uma descrição:"></textarea>
                        </div>
                        <!--endDescr-->




                    </div>
            </div>
            <!--endL8-->

            <!--end esp-peixe-->












            <br><!-- fim conteúdo -->
            <br>
            <div style="clear:both;"></div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <button type="button" class="btn btn-secondary" onclick="window.location='<?= HOME_URI ?>/sacp/'">Voltar</button>
                    <button type="submit" class="btn btn-primary">Gerar SACP</button>
                </div>
            </div>
            </form>
            <hr>
        </div>
    </div>
</div>
</div>


<!-- /page content -->