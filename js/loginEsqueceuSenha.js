$(document).ready(function(){
    $('#cpf').mask('000.000.-0#');
  });


$("#formulario").validate({
       rules:{
           email:{
               required:true,
               email:true
           }, 
           cpf:{
               required:true
           }	   
       }, 
       messages:{
            email:{
               required:"Por favor, preencha este campo.",
               email:"Por favor, insira um email válido."
           },
           cpf:{
               required:"Por favor, preencha este campo."
           }	   
       }
});

