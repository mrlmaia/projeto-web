/*
Contador de tempo regressivo (cronômetro) em Javascript/JQuery
http://www.rafaelzottesso.com.br/2013/05/contador-de-tempo-regressivo-cronometro-em-javascriptjquery/
*/

// Tempo em segundos
var tempo = 60;

function atualizarTempo(){
	// Se o tempo não for zerado

	if((tempo - 1) >= 0){
		// Pega a parte inteira dos minutos
		var min = parseInt(tempo / 60);

		// Calcula os segundos restantes
		var seg = tempo % 60;

		// Formata o número menor que dez, ex: 08, 07, ...
		if(min < 10){
			min = "0" + min;
			min = min.substr(0, 2);
		}

		if(seg <= 9){
			seg = "0" + seg;
		}

		// Cria a variável para formatar no estilo hora/cronômetro
		tempoFormatado = '00:' + min + ':' + seg;

		//JQuery pra setar o valor
		$("#relogioSessao").text(tempoFormatado);	

		// Define que a função será executada novamente em 1000ms = 1 segundo
		setTimeout('atualizarTempo()', 1000);

		// diminui o tempo
		tempo--;

	// Quando o contador chegar a zero faz esta ação
	} else {
		alert('Sua sessão expirou.')
		location.href='loginEncerrar.php'
	}

}

// Chama a função ao carregar a tela
atualizarTempo();


/*
var min = 20;	
var	seg = 1;		
	function relogio(){			
		if((min > 0) || (seg > 0)){				
			if(seg == 0){					
				seg = 59;					
				min = min - 1	
			}				
			else{					
				seg = seg - 1;				
			}				
			if(min.toString().length == 1){					
				min = "0" + min;				
			}				
			if(seg.toString().length == 1){					
				seg = "0" + seg;				
			}				
			$("#relogioSessao").text(min + ":" + seg);			
			setTimeout('relogio()', 1000);			
		}			
		else{				
			$("#relogioSessao").text('00:00');			
		}		
	}

	relogio();	
*/