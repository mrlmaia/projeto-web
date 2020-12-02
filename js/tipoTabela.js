$(document).ready( function () {

	$("#tabela").dataTable({
		"bJQueryUI": true,
		"oLanguage": {
			"sProcessing":   "Processando...",
			"sLengthMenu":   "_MENU_ registros por página",
			"sZeroRecords":  "Não foram encontrados resultados",
			"sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
			"sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
			"sInfoFiltered": "",
			"sInfoPostFix":  "",
			"sSearch":       "Pesquisar:",
			"sUrl":          "",
			"oPaginate": {
				"sFirst":    "Primeiro",
				"sPrevious": "Anterior",
				"sNext":     "Próximo",
				"sLast":     "Último"
			}
		}
	})     
	
	/*
	$('#tabela').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
	} );
	*/
	

} );