$(document).on('ready',function()
{
	var dispositivo = navigator.userAgent.toLowerCase();
	/*$('img').error(function(){
		$(this).unbind("error").attr('src',"http://iscocomputadoras.com/uploads/"+$(this).data('sku')+".jpg").error(function(){
		$(this).unbind("error").attr('src',"http://iscocomputadoras.com/pchimg/"+$(this).data('sku').toLowerCase()+".jpg").error(function(){
			console.log("sku:"+$(this).data('sku'))
			$(this).unbind("error").attr('src',"http://iscocomputadoras.com/img/broken.jpg");
		});
	});
});*/
	if( dispositivo.search(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/) > -1 )
	{
		$("#prueba").on('click',function(){
			if($('.busqueda-rango').css('left')=='0px')
				$('.busqueda-rango').animate({'left':'-80%'},'slow');
			else
				$('.busqueda-rango').animate({'left':'0px'},'slow');
		});
	}
	else
	{
		$("#prueba ").on('click',function(){
			if($('.busqueda-rango').css('left')=='0px')
				$('.busqueda-rango').animate({'left':'-25%'},'slow');
			else
				$('.busqueda-rango').animate({'left':'0px'},'slow');
		});
	}
	$(window).resize(function(){
 		if($(document).width()<800)
 			$("#prueba").on('click',function(){
				if($('.busqueda-rango').css('left')=='0px')
					$('.busqueda-rango').animate({'left':'-80%'},'slow');
				else
					$('.busqueda-rango').animate({'left':'0px'},'slow');
			});
 		else
 		{

 			$('.busqueda-rango').css('left','-25%')
 			$("#prueba").on('click',function(){
			if($('.busqueda-rango').css('left')=='0px')
				$('.busqueda-rango').animate({'left':'-25%'},'slow');
			else
				$('.busqueda-rango').animate({'left':'0px'},'slow');
		});

 		}

	});

});
