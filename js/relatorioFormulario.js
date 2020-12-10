$('#formulario').validate({
  rules: {
    idTipo: {
      required: true,
    },
    inicio: {
      required: true,
    },
    termino: {
      required: true,
    }
  },
  messages: {
    idTipo: {
      required: 'Campo obrigatório',
    },
    inicio: {
      required: 'Campo obrigatório',
    },
    termino: {
      required: 'Campo obrigatório',
    }
  }
})
