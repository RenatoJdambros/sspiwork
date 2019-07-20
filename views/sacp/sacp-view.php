<?php
    if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/home/'">
                            Voltar
                            </button>
                                <?php if ($this->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) { ?>
                                    <a href="<?=HOME_URI?>/sacp/inserir">
                                        <button type="submit" class="btn btn-primary">Gerar SACP</button>
                                    </a>
                    <?php } ?>
                    </div>
                    <p align="right" style="max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                        <span style="margin-top: -18px; " class="badge">Painel de Visualização</span></p>
            <div class="panel-body">
            <br>

                    <table border="0" cellspacing="5" cellpadding="5">
                        <tbody>
                            <tr>
                                <td>
                                    Data Inicial:&nbsp;
                                </td>
                                <td>
                                    <input type="date" id="min" name="min"
                                    value="<//?= data('default', false, '- 2 week') ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Data Final:&nbsp;
                                </td>
                                <td>
                                    <input type="date" id="max" name="max"
                                    value="<//?= data() ?>" max="<//?= data() ?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <input id="filterDataGeracao" type="radio" name="filterDate" value="data_gerada" checked>
                    <label for="filterDataGeracao">Data Geração</label>

                    <input id="filterDataPrazo" type="radio" name="filterDate" value="data_prazo">
                    <label for="filterDataPrazo">Data Prazo</label>

                    <input id="filterDataFinalizacao" type="radio" name="filterDate" value="data_finalizada">
                    <label for="filterDataFinalizacao">Data Finalização</label>

                    <br>

                    <button id="confirmFilterDate" class="btn btn-primary">Filtrar</button>

                    <table id="sacp" class="table table-striped table-bordered bulk_action" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Status</th>
                                <th>Número O.P.</th>
                                <th>RNC</th>
                                <th>Data Geração</th>
                                <th>Data Prazo</th>
                                <th>Data Finalização</th>
                                <th class="no-export"></th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- /page content -->
<script type="text/javascript">
    window.onload = function() {

        var table = $('#sacp').DataTable({
            "lengthMenu": [[20, 30, 50], [20, 30, 50]],
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "page",
                "type": "POST",
                "data": {
                    "dataMin": $('#min').val(),
                    "dataMax": $('#max').val()
                }
            },
            "language": {
                "paginate": {
                    "first": "Primeira",
                    "previous": "Voltar",
                    "next": "Avançar"
                },
                "info": "Listando _START_ até _END_ de _TOTAL_ resultados",
                "infoFiltered": " - Filtrados de _MAX_ resultados",
                "infoEmpty": "Nenhum resultado encontrado.",
                "emptyTable": "Nenhum resultado encontrado.",
                "processing": "Carregando",
                "lengthMenu": "Mostrar _MENU_ itens por página",
                "search": "Buscar: "
            }
        });

        // Event listener to the two range filtering inputs to redraw on input
        $('#confirmFilterDate').click( function() {
            var radioSelected = '';

            if ($('#filterDataGeracao').is(':checked')) {
                radioSelected = $('#filterDataGeracao').val();
            } else if ($('#filterDataFinalizacao').is(':checked')) {
                radioSelected = $('#filterDataFinalizacao').val();
            } else if ($('#filterDataPrazo').is(':checked')) {
                radioSelected = $('#filterDataPrazo').val();
            }

            table.destroy();
            table = $('#sacp').DataTable({
                "lengthMenu": [[20, 30, 50], [20, 30, 50]],
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "ajax": {
                    "url": "page",
                    "type": "POST",
                    "data": {
                        "dataMin": $('#min').val(),
                        "dataMax": $('#max').val(),
                        "dataFilter": radioSelected
                    }
                },
                "language": {
                    "paginate": {
                        "first": "Primeira",
                        "previous": "Voltar",
                        "next": "Avançar"
                    },
                    "info": "Listando _START_ até _END_ de _TOTAL_ resultados",
                    "infoFiltered": " - Filtrados de _MAX_ resultados",
                    "infoEmpty": "Nenhum resultado encontrado.",
                    "emptyTable": "Nenhum resultado encontrado.",
                    "processing": "Carregando",
                    "lengthMenu": "Mostrar _MENU_ itens por página",
                    "search": "Buscar: "
                }
            });
        });
    }
</script>
