<?php
    if (!defined('ABSPATH')) exit;
?>

<!-- page content -->
<hr>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <button type="button" class="btn btn-default" onclick="window.location='<?= HOME_URI ?>/home/'">
                            Voltar
                            </button>
                            <?php if ($this->check_permissions('rnc', 'inserir', $this->userdata['user_permissions'])) { ?>
                                <a href="<?=HOME_URI?>/rnc/inserir">
                                    <button type="submit" class="btn btn-warning">Gerar RNC</button>
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

                    <input id="filterDataFinalizacao" type="radio" name="filterDate" value="data_finalizada">
                    <label for="filterDataFinalizacao">Data Finalização</label>

                    <br>

                    <button id="confirmFilterDate" class="btn btn-warning">Filtrar</button>

                    <table id="rnc" class="table table-striped table-bordered bulk_action" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Status</th>
                                <th>Número O.P.</th>
                                <th>SACP</th>
                                <th>Data Geração</th>
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


<script type="text/javascript">
    window.onload = function() {

        var table = $('#rnc').DataTable({
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
            }

            table.destroy();
            table = $('#rnc').DataTable({
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
<hr>
