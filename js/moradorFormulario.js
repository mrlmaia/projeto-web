$(document).ready(function(){
	$('#cpf').mask('###.###.###-#0');
	$('#celular').mask('(##)#####-###0');		
});

$("#formulario").validate(
	{
		rules:{
			nome:{
				required:true			   
			},
			cpf:{
				required:true,
				remote: {
					url: "moradorVerificarCPF.php",
					type: "post",
					data: {
						idMorador: function() {
							return $( "#idMorador" ).val();
					  	}
					}
				}			   
			},
			email:{
				required:true,
				email:true,
				remote: {
					url: "moradorVerificarEmail.php",
					type: "post",
					data: {
						idMorador: function() {
							return $( "#idMorador" ).val();
					  	}
					}
				}			   
			},
			dataNascimento:{
				required:true			   
			},
			celular:{
				required:true			   
			},
			foto:{
				required:true			   
			}				
		}, 
		messages:{
			nome:{
				required:"Por favor, preencha este campo."
			},
			cpf:{
				required:"Por favor, preencha este campo.",
				remote: "Este CPF já está sendo usado"
			},
			email:{
				required:"Por favor, preencha este campo.",
				email:"Por favor, insira um email válido.",
				remote: "Este email já está sendo usado."
			},
			dataNascimento:{
				required:"Por favor, preencha este campo."
			},
			celular:{
				required:"Por favor, preencha este campo."
			},
			foto:{
				required:"Por favor, preencha este campo."
			}							   
		}
	}
);