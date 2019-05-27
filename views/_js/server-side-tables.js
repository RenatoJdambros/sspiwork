if(typeof controlador != 'undefined'){
    $('#' + controlador + '.server-side').dataTable({
        "lengthMenu": [[20, 30, 50], [20, 30, 50]],
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "ajax": {
            "url": "page",
            "type": "POST"
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
    }).on('draw.dt', function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });

        // $('.stars-existing').starrr({
        //     rating: 4
        // });
    });
}