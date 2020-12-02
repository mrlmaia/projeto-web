$(document).ready(function(){
    $('#valor').mask('#.##0,00', {reverse: true});
    $('#valorRateio').mask('#.##0,00', {reverse: true});

});

$("#formulario").validate(
	{
		rules:{
			idMoradorResponsavel:{
				required:true		   
            },
            idTipo:{
				required:true		   
            },
            valor:{
                required:true
            },
            dataVencimento:{
				required:true		   
            },
            descricao:{
				required:true  
            },
            estado:{
				required:true		   
            }
		}, 
		messages:{
			idMoradorResponsavel:{
                required:"Por favor, preencha este campo."
            },
            idTipo:{
                required:"Por favor, preencha este campo."
            },
            valor:{
                required:"Por favor, preencha este campo."
            },
            dataVencimento:{
                required:"Por favor, preencha este campo."
            },
            descricao:{
                required: "Por favor, preencha este campo."
            },
            estado: {
                required: "Por favor, preencha este campo."
            }
		}
	}
);

$("#formularioRateioConta").validate(
	{
		rules:{
			idMorador:{
				required:true		   
            },
            valorRateio:{
				required:true		   
            },
            situacao:{
                required:true
            }
		}, 
		messages:{
			idMorador:{
                required:"Por favor, preencha este campo."
            },
            valorRateio:{
                required:"Por favor, preencha este campo."
            },
            situacao:{
                required:"Por favor, preencha este campo."
            }
		}
    }
);