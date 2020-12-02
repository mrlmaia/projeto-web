$(document).ready(function(){
    $('#valor').mask('#.##0,00', {reverse: true});
});

$("#formulario").validate(
	{
		rules:{
			idRateio:{
				required:true	   
            },
            valor:{
                required:true
            },
            situacao:{
				required:true		   
            },
            idMorador:{
				required:true  
            },
            idConta:{
				required:true	   
            }
		}, 
		messages:{
			idRateio:{
                required:"Por favor, preencha este campo."
            },
            valor:{
                required:"Por favor, preencha este campo."
            },
            situacao:{
                required:"Por favor, preencha este campo."
            },
            idMorador:{
                required: "Por favor, preencha este campo."
            },
            idConta: {
                required: "Por favor, preencha este campo."
            }
		}
	}
);