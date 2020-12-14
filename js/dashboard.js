$(document).ready(() => {
  exibirGastosPorTipo()
  exibirGastosPorMorador()
})

const colors = ["#0000FF", "#FF0000", "#008000", "#FFFF00", "#FFC0CB", "#FFA500", "#800000", "#8B008B"]
const colors2 = ["#4B0082", "#00FA9A", "#A0522D", "#F0E68C"]

function exibirGastosPorTipo() {
  const inicio = $("#inicio").val()
  const fim = $("#fim").val()

  $.ajax({
    url: 'graficoGastosPorTipo.php',
    type: 'get',
    data: {
      inicio,
      fim
    },
    success: response => {
      const responseData = JSON.parse(response)
      console.log(responseData)
      const type = "bar"
      const data = {
        labels: responseData.tipos,
        datasets: [
          {
            data: responseData.gastos,
            fillColor: false,
            backgroundColor: colors

          }
        ]
      }

      const options = {
        responsive: true,
        title: {
          display: true,
          text: 'Gastos por tipo'
        },
        legend: {
          display: false,

        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }

      }
      const ctx = document.getElementById("gastos-por-tipo").getContext('2d')
      new Chart(ctx, { type, data, options })
    },
  })
}

function exibirGastosPorMorador() {
  const inicio = $("#inicio").val()
  const fim = $("#fim").val()
  $.ajax({
    url: 'graficoGastosPorMorador.php',
    type: 'get',
    data: {
      inicio,
      fim
    },
    success: response => {
      const responseData = JSON.parse(response)
      console.log(responseData)
      const type = "bar"
      const data = {
        labels: responseData.moradores,
        datasets: [
          {
            data: responseData.gastos,
            fillColor: false,
            backgroundColor: colors2

          }
        ]
      }

      const options = {
        responsive: true,
        title: {
          display: true,
          text: 'Gastos por morador'
        },
        legend: {
          display: false,

        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }

      }
      const ctx = document.getElementById("gastos-por-morador").getContext('2d')
      new Chart(ctx, { type, data, options })
    },
    error: error => {
      console.log({ error })
    }
  })

}
