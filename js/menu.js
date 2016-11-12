/*var cbpHorizontalMenu = (function(){

		var $listItems = $('.nav > ul > li '),
			$menuItems = $listItems.children('a'),
			$body = $('body'),
			$container = $('.container');
			$slider = $('.slide');
			$lnkhome = $('#lnkHome');
			$lnkCart = $('#lnkCart');
			$lnkContact = $('#lnkContacto');
			current = -1;

		function init(){
			$menuItems.on('click',open);
			$listItems.on( 'click', function( event ) { event.stopPropagation(); } );
			$lnkhome.on('click',function(e){
				e.stopPropagation();
				window.location = $('#ruta').val();
			});
			$lnkContact.on('click',function(e){
				e.stopPropagation();
				window.location = $(this).data('contacto');
			});

			$lnkCart.on('click',function(e){
				e.stopPropagation();
				$('#modalCart').modal('show');
			});
		}	

		function open(event){
			if(current !== -1){
				$listItems.eq(current).removeClass('cbp-hropen');
			}
			var $item = $(event.currentTarget).parent('li'),
				idx = $item.index();

			if(current === idx)
			{
				$item.removeClass('cbp-hropen');
				$container.removeClass('contenedor-home');
				$slider.removeClass('contenedor-home');
				current = -1;
			}	
			else{
				$item.addClass('cbp-hropen');
				$container.addClass('contenedor-home');
				$slider.addClass('contenedor-home');
				current = idx;
				$body.off('click').on('click',close);
			}

			return false;

		}

		function close(){
			$listItems.eq(current).removeClass('cbp-hropen');
			$container.removeClass('contenedor-home');
			$slider.removeClass('contenedor-home');
			current = -1;
		}

		return { init:init };

	})();*/