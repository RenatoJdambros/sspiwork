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
                        <button type="button" class="btn btn-default" onclick="window.location='<?=HOME_URI?>/home/'">
                        Voltar
                        </button>
                        <?php if ($this->check_permissions('usuarios', 'inserir', $this->userdata['user_permissions'])) { ?>
                        <a href="<?=HOME_URI?>/usuarios/inserir">
                            <button type="submit" class="btn btn-primary">
                                Cadastrar Usuário
                            </button>
                        </a>
                    <?php } ?>
                        <h4 style="text-align: center; color: black; margin-top: -30px;">
                        <b><?=$this->title?></b></h4>
                    </div>
                    <p align="right" style="position: relative; max-height: 2px; background: gray; margin-right: 35px; margin-top: 0px;">
                            <span style="margin-top: -18px;" class="badge">Painel de Controle</span></p>

                <div class="panel-body">
                <br>
                <table id="usuarios" class="table table-striped table-bordered bulk_action server-side" style="width: 100%;">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Setor</th>
                            <th>Email</th>
                            <th>Tipo de Usuário</th>
                            <th>Status</th>
                            <th class="no-export"></th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
            </div>
         </div>
    </div>
    <hr>
</div>


<script type="text/javascript">
    window.onload = function() {

        var table = $('#usuarios').DataTable({
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
