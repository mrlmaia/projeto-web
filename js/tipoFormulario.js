$("#formulario").validate(
	{
		rules:{
			nome:{
				required:true,
				remote: {
					url: "tipoVerificarNome.php",
					type: "post",
					data: {
						idTipo: function() {
							return $( "#idTipo" ).val();
					  	}
					}
				}			   
			}
		
		}, 
		messages:{
			nome:{
                required:"Por favor, preencha este campo.",
                remote: "Um tipo com este nome já foi cadastrado."
			}	   
		}
	}
);