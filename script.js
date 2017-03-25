$(document).ready(function() {
	$('#buscarbotao').on('click', function(){
		$.ajax({
	        url: 'encontrar.php',
	        type: 'post',
	        data: {buscar: $('#buscar').val()},
	        dataType: 'json',
	        success: function(json) {
	        	$('.campoerror').remove();
	        	if(json['error']){
	        		$('#buscar').parent().append("<p class='campoerror' style='color:red; ' >"+json['error']+"</p>");
	        	}else{
	        		var html = '';
        			for (var i = 0; i < json['dominios'].length; i++) {
        				html += '<tr>';
        				html += '   <td>'+json['dominios'][i]['dominio']+'</td>';
        				if(json['dominios'][i]['escolhido'] == 1){
        					html += '   <td><a href="#" id="mudanome'+json['dominios'][i]['codigo']+'" style="color:red;" onClick="naoqueroesse('+json['dominios'][i]['codigo']+');">Não Quero!</a></td>';
        				}else{
        					html += '   <td><a href="#" id="mudanome'+json['dominios'][i]['codigo']+'" onClick="queroesse('+json['dominios'][i]['codigo']+');">Quero esse!</a></td>';
        				}
        				html += '</tr>';
        			}
	        		$('#mostradomino').html(html);
	        	}
	        },
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
	    });
	    return false;
	});
});
function queroesse(codigopar){
	$.ajax({
        url: 'escolher.php',
        type: 'post',
        data: {codigo: codigopar},
        dataType: 'json',
        success: function(json) {
        	if(json['sucesso']){
        		$('#mudanome'+codigopar).closest('td').html('').html('<a href="#" id="mudanome'+codigopar+'" onClick="naoqueroesse('+codigopar+');" style="color:red;" title="">Não Quero!</a>');
        		var html = '';
        		if(json['dominios']){
	        		for (var i = 0; i < json['dominios'].length; i++) {
		        		html += '<tr>';
		        		html += '<td>'+json['dominios'][i]['dominio']+'</td>';
		        		html += '<td>'+json['dominios'][i]['data']+'</td>';
                        html += '<td><a href="#" onClick="naoqueroesse('+json['dominios'][i]['codigo']+');" style="color:red;" title="">Não Quero!</a></td>';
		        		html += '<td><a href="https://registro.br/cgi-bin/nicbr/documento?fqdn='+json['dominios'][i]['dominio']+'" target="_blank" style="color:#5cc773;" title="">Registrar</a></td>';
		        		html += '</tr>';
	        		}
	        		$('#escolhidos').html('');
        			$('#escolhidos').html(html);
        		}else{
        			$('#escolhidos').html('');
        		}
        	}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    return false;
}

function naoqueroesse(codigopar){
	$.ajax({
        url: 'retirar.php',
        type: 'post',
        data: {codigo: codigopar},
        dataType: 'json',
        success: function(json) {
        	if(json['sucesso']){
        		$('#mudanome'+codigopar).closest('td').html('').html('<a href="#" id="mudanome'+codigopar+'" onClick="queroesse('+codigopar+');">Quero esse!</a>');
        		var html = '';
        		if(json['dominios'].length > 0){
	        		for (var i = 0; i < json['dominios'].length; i++) {
		        		html += '<tr>';
		        		html += '<td>'+json['dominios'][i]['dominio']+'</td>';
		        		html += '<td>'+json['dominios'][i]['data']+'</td>';
		        		html += '<td><a href="#" onClick="naoqueroesse('+json['dominios'][i]['codigo']+');" style="color:red;" title="">Não Quero!</a></td>';
                        html += '<td><a href="https://registro.br/cgi-bin/nicbr/documento?fqdn='+json['dominios'][i]['dominio']+'" target="_blank" style="color:#5cc773;" title="">Registrar</a></td>';
		        		html += '</tr>';
	        		}
	        		$('#escolhidos').html('');
        			$('#escolhidos').html(html);
        		}else{
					$('#escolhidos').html('');
        		}
        	}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    return false;
}