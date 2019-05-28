<?php
    if (!defined('ABSPATH')) exit;
?>

<div class="container-fluid">
    <div class="shadow bg-white rounded">
        <div class="container-fluid">
            <h4 class="text-left">
                <sub>Escolha uma opção:</sub>
            </h4>
            <hr>
            <div class="row"> <!-- row -->

                <div class="col"> <!-- col 1 -->
                    <div class="card" style="border:0px" >
                        <div class="card-body">
                            <div id="img">
                                <img src="<?= HOME_URI ?>/views/_images/relat1.png">
                                <p style="margin: 1em 0 0 16px;">                       
                                    <a href="<?= HOME_URI ?>/rnc/">
                                        <button type="button" class="btn btn-warning">
                                            SELECIONAR
                                        </button>
                                    </a>
                                </p>
                            </div>
                            <div style="text-align: left">
                                <h5 class="text-warning">
                                    <b>RNC</b>
                                </h5>
                                <p class="card-text">
                                    <b>
                                        <i>
                                            Relatório de <br>Não Conformidade
                                        </i>
                                    </b>
                                </p>
                                <p class="card-text">
                                    Responsável por um texto que serve de apoio para identificar
                                    espaçamento correto e tamanho de descriçao.
                                </p>                               
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col 1 -->

                <div class="col"> <!-- col 2 -->
                    <div class="card" style="border:0px" >
                        <div class="card-body">
                            <div id="img">
                                <img src="<?= HOME_URI ?>/views/_images/relat2.png">
                                <p style="margin: 1em 0 0 16px;">
                                    <a href="<?= HOME_URI ?>/sacp/">
                                        <button type="button" class="btn btn-primary">
                                            SELECIONAR
                                        </button>
                                    </a>
                                </p>
                            </div>
                            <div style="text-align: left;">
                                <h5 class="text-primary">
                                    <b>SACP</b>
                                </h5>
                                <p class="card-text">
                                    <b>
                                        <i>
                                            Solicitação de Ação Corretiva ou <br>Preventiva 
                                            (e mudanças no SGI)
                                        </i>
                                    </b>
                                </p>
                                <p class="card-text">
                                    Responsável por um texto que serve de apoio para identificar 
                                    espaçamento correto e tamanho de descriçao.
                                </p>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col 2 -->
            </div> <!-- end row -->
        </div>
    </div>
</div>