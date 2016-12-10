$(function(){
	var ruta = $('#ruta').val();
	var rutaExterna=$("#rutaExterna").val();
	$('img').error(function(){
		$(this).unbind("error").attr('src',ruta+"pchimg/"+$(this).data('sku').toUpperCase()+".jpg").error(function(){
		$(this).unbind("error").attr('src',ruta+"pchimg/"+$(this).data('sku').toLowerCase()+'.jpg').error(function(){
		$(this).unbind("error").attr('src',ruta+"pchimg/"+$(this).data('sku').toUpperCase()+'.png').error(function(){
		$(this).unbind("error").attr('src',ruta+"pchimg/"+$(this).data('sku').toLowerCase()+'.png').error(function(){
			$(this).unbind("error").attr('src',rutaExterna+"uploads/"+$(this).data('sku')+".jpg").error(function(){
			$(this).unbind("error").attr('src',"http://iscocomputadoras.com/img/broken.jpg");
		});
	});
});
});
});});

	/*$('img').error(function(){
		$(this).unbind("error").attr('src',ruta+"img/broken.jpg");
	});
*/
	$('#btnSearchRange').click(function(e){
		e.preventDefault();
		if(isNaN(parseFloat($('#txtRange2').val())) || isNaN(parseFloat($('#txtRange1').val())))
			alert('Debes introducir números');
		else
			if(parseFloat($('#txtRange2').val()) <= parseFloat($('#txtRange1').val()))
			{
				alert('El valor de "Hasta" no puede ser menor a "Desde"');
				$('#txtRange2').val(parseFloat($('#txtRange1').val())+100);
			}
			else
				$('#frmRangeSearch').submit();

	});

	$('#btnSearchQty').click(function(e){
		e.preventDefault();
		if(isNaN(parseFloat($('#txtRang').val())))
			alert('Debes introducir un número');
		else
			$('#frmRange').submit();
	});

	$('.btn-menu').click(function(){
		/*if($('.cbp-hrmenu').css('display')=="none" || $('.cbp-hrmenu').css('display')=="NONE" )
			$('.cbp-hrmenu').css('display','block');
		else
			$('.cbp-hrmenu').css('display','none');*/

			$('.cbp-hrmenu').animate({height:'toggle'});
	})
	$('#lnkRango').click(function(e){
		e.preventDefault();
		clearFields(1);
		$('#divRange').slideUp();
		$('#divFrom').slideDown();

	});
	$('#lnkComeBack').click(function(e){
		e.preventDefault();
		clearFields(2);
		$('#divRange').slideDown();
		$('#divFrom').slideUp();
	});

	function clearFields(ban){
		if(ban == 1){
			$('#txtRange1').val('');
			$('#txtRange2').val('');
		}else
			$('#txtRang').val('');

	}
	var t=setTimeout(function(){
		$('#alerta').css('display','none');
		clearTimeout(t);
	},10000);
	var dispositivo = navigator.userAgent.toLowerCase();
	/*if( dispositivo.search(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/) > -1 )
	{
		$("#prueba").on('click',function(){
			if($('.busqueda-rango').css('left')=='0px')
				$('.busqueda-rango').animate({'left':'-80%'},'slow');
			else
				$('.busqueda-rango').animate({'left':'0px'},'slow');
		});
		texto=$(".description").text();
		txt=texto.slice(0,40);
		$(".description").text(txt+"...");

	}*/
});
