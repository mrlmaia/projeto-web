$("#formulario").validate(
	{
		rules:{
			email:{
                required:true,
                email:true	   
            },
            senha:{
				required:true	   
            }
		}, 
		messages:{
			email:{
                required:"Por favor, preencha este campo.",
                email: "Por favor, insira um email válido."
            },
            senha: {
                required: "Por favor, preencha este campo."
            }
		}
	}
);