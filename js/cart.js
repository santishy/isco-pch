$(function(){

	var btnCart = $('#btnCart') , inputQty = $('.txtCant') , btnUpdate = $('.btnUpdate'),
	btnDel = $('#btnDelCar') , btnClose = $('#btnClose') , btnRefresh = $('#tblCart');
	btnEnviarCotizacion=$("#btnEnviarCotizacion");
	btnCart.on('click',addCart);
	btnEnviarCotizacion.attr('disabled',true);
	$("#btnAceptarPublicidad").on("click",function(){
		if($(this).is(':checked'))
			btnEnviarCotizacion.attr('disabled',false);
		else
			btnEnviarCotizacion.attr('disabled',true);
	});
	//btnDel.on('click',deleteCar);

	/*btnClose.on('click',function(){
		$('#modalCart').modal('hide');
		window.location = $('#ruta').val();
	});*/
	btn_cotizar=$("#btn_cotizar");
	//inputQty.on('change',function(e){
	btn_cotizar.on('click',function()
	{
		$("#modalCart").modal("hide");
		$("#modalCotizacion").modal("show");

	});
	btnRefresh.on('change','tr td form .txtCant',function()
	{
		//e.preventDefault();
		elm = $(this);
		$(this).parent().parent().find('button.btnUpdate').removeAttr('disabled');
		//$(this).next().removeAttr('disabled');
	});
	$(".optAlmacen").on('click',function(){
		$("#txtExis").val($(this).parent().data('cant'));
		$("#txtAlmacen").val($(this).val());
		btnCart.attr('disabled',false);
	});
	//btnUpdate.on('click',function(){
	btnRefresh.on('click','tr .btnUpdate',function(){
		formC = $(this).prev();
		pr = $(this).parent().prev();
		sub = $(this).parent().next();
		updateCart();
	});
	btnEnviarCotizacion.on('click',enviarCotizacion);
	function addCart(e){
		e.preventDefault();
		formulario = $('#frmCart ');
		nameP = document.frmCart.txtNombre.value, sku = document.frmCart.txtSku.value, price = document.frmCart.txtPrecio.value,
		qty = document.frmCart.txtCantidad.value , id = document.frmCart.id_articulo.value ,
		exisP = document.frmCart.txtExis.value;
		//alert($('#tblCart tr:last-child').find('td.qty').text());
		$.ajax({

			url:formulario.attr('action'),
			type:'post',
			data:formulario.serialize(),
			dataTye:'json',
			beforeSend:function(){
				btnCart.attr('disabled',true);
				btnCart.text('Agregando..');
			},
			success:function(response){
				response = JSON.parse(response);
				getElements();
				if(response.ban == 1 || response.ban == '1'){
					$("#btnConfirmPass").data('cartid',response.shopping_cart_id);
					$('#pMsjVacio').text('');
					$('#btnConfirmPass').removeAttr('disabled');
					/* creating element for add to shopping cart */
					$('<tr />',{
						'class' : 'trNew'
					}).appendTo('#tblCart');
					$('<td />',{
						"class" : 'cartImage'
					}).appendTo('#tblCart tr.trNew');

					$('<figure />').appendTo('#tblCart tr.trNew td.cartImage');
					$('<img />',{
						'src' : 'http://www.pchmayoreo.com/media/catalog/product/'+sku.substr(0,1)+'/'+sku.substr(1,1)+'/'+sku+'.jpg'

					}).appendTo('#tblCart tr.trNew td.cartImage figure');

					$('#cantCart').css({
						'font-size':'16px',
						'background-color':'#E65C00'
					});
					$('<td />',{
						'text' : id,
						'class' : 'code'
					}).appendTo('#tblCart tr.trNew');
					$('<td />',{
						'text' : nameP
					}).appendTo('#tblCart tr.trNew');
					$('<td />',{
						'text' : price
					}).appendTo('#tblCart tr.trNew');
					$('<td />',{
						//'text' : qty,
						'class': 'qty'
					}).appendTo('#tblCart tr.trNew');
					//////
					$('<form />',{
						'action': $('#ruta').val()+'cart/update',
						'method':'post',
						'id':'frmScart',
						'name':'frmScart'
					}).appendTo('#tblCart tr.trNew td.qty');
					$('<input />',{
						'type':'hidden',
						'name':'id',
						'value':id
					}).appendTo('#tblCart tr.trNew td.qty form');
					$('<input />',{
						'type':'hidden',
						'name':'exis',
						'value':exisP
					}).appendTo('#tblCart tr.trNew td.qty form');
					$('<input />',{
						'type':'number',
						'name':'cant',
						'class':'txtCant form-control',
						'min': 0,
						'max':exisP,
						'value':qty
					}).appendTo('#tblCart tr.trNew td.qty form');
					$('<button />',{
						'class':'btnUpdate btn btn-success btn-xs',
						//'text':'modificar'
						'html': '<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>'

					}).appendTo('#tblCart tr.trNew td.qty');
					///
					$('<td />',{
						'text' : qty * price,
						'class':'tdSub'
					}).appendTo('#tblCart tr.trNew');

					/* ****** */
					$('#cantCart').text(response.valor);
				}
				else if(response.ban == 2 || response.ban == '2'){

					$('#tblCart tr').each(function(){
						if(response.codigo === $(this).find('td.code').text())
						{
							cant = parseInt(qty) + parseInt(response.qty);
							$(this).find('td.qty input').val(cant);
							tot = cant * price;
							$(this).children('td').last().text(tot);
						}
					});

				}
				else
					alert('no puedes agregar más productos de los que hay disponibles');
				$('#tdTotalCant').text(getElements());
				$('#modalCart').modal('show');


			},
			complete:function(){
			  	btnCart.removeAttr('disabled');
			  	btnCart.text('Agregar al carrito');
			},
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado)
	        },
	       timeout:15000

		});

	}


	function getElements(){
		temp = 0;
		$('#tblCart .tdSub').each(function(){
			temp += parseInt($(this).text());
		});
		return temp;
	}


	function updateCart(){

		$.ajax({

			url:formC.attr('action'),
			type:'post',
			data:formC.serialize(),
			dataTye:'json',
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			success:function(response){
				response = JSON.parse(response);

				if(response.ban == 0 || response.ban == '0'){
					if(response.valor > 0){
						formC.parent().parent().remove();
					}
					else{
						//$('#container-cart').html('<p class="">Carrito vacio</p>');
						formC.parent().parent().remove();
						$('#pMsjVacio').text('Carrito vacio');
						$('#btnConfirmPass').attr('disabled',true);
					}
				}
				else{
					elm.val(response.cantidad);
					sub.text(response.cantidad * parseInt(pr.text()));
				}

				$('#tdTotalCant').text(getElements());

				$('#cantCart').text(response.valor);

			},
			complete:function(){
				$('.loader').css('display','none');
			},
			error:function(xhr,error,estado){
				alert(xhr+" "+error+" "+estado);
			},
			timeout:15000

		});

	}
// de aqui empiezan mi codigo
$("#btnConfirmPass").on('click',function()
	{
		window.location.href=$(this).data('ruta')+$(this).data('cartid');
		//window.location.href=$(this).data('ruta')+$(this).data('cartid');
	});
});
function enviarCotizacion()
{
	var ruta=$("#btnEnviarCotizacion").data('ruta');
	if($("#nombreCotizacion").val().replace(/^\s+/,'').replace(/\s+$/,'')!=""  && $("#correoCotizacion").val().replace(/^\s+/,'').replace(/\s+$/,'')!="" )
	{
		$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:$("#frmCotizacion").serialize(),
		type:'post',
		dataTye:'json',
		success:function(resp)
		{
			$("#modalCotizacion").modal('hide');
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{
			if($("#id_paquete").length)
				$("#id_paquete").val("");
		}
		})
	}
	else
	{
		alert('Complete los campos');
	}
}
