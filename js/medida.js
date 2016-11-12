var ancho=$(window).width();
$(document).on('ready',function(){
	$(".menu-new ul li ul").css({'width':$(document).width()+"px"});
	$('.noclick').on('click',function(e){
		e.preventDefault();
		console.log('santiago martin ochoa estrada')
	})
	$(".submenu").on('click',function(e){
	
		if(ancho<800)
			$(this).children('ul').slideToggle();
	})

})
$(window).resize(function(){
	ancho=$(window).width();
	if(ancho>800)
	{

	}
})