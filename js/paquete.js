var indicador=0;
$(document).on('ready',function(){
	btnPaquete=$('.btnPaquete');
	btnPaquete.on('click',function(){
		sku=$(this).parent().data('sku');
		idp=$(this).parent().data('id');
		precio=$(this).parent().data('precio');
		utilidad=$(this).parent().data('utilidad');
		console.log('utilidad:' + utilidad);
		addPaquete(idp,sku,precio,utilidad);
	});
	$("#cotizacion-paquete").on('click',function(e){
		e.preventDefault();
		$("#id_paquete").val($(this).data('id'));
		$("#modalCotizacion").modal('show')
	});
	defineSizes();
	$("#btnCrearPaquete").on('click',function()
	{
		if($("#nombre_paquete").val()=="" || $("#precio_paquete").val()=="")
			alert("Introducir los datos");
		else
			insertarPaquete();
	})

	$(".img-paquete").hover(function(){
			console.log('hola paquetes')
		$(".paquete-imgs").find('div').eq($(this).data('cont')).addClass('paquete-hover');
	},function(){
		$(".paquete-imgs").find('div').eq($(this).data('cont')).removeClass('paquete-hover');
	})
	$(".descripcion-paquete").hover(function(){
		$(".paquete-imgs").find('div').eq($(this).data('cont')).addClass('paquete-hover');
	},function(){
		$(".paquete-imgs").find('div').eq($(this).data('cont')).removeClass('paquete-hover');
	})
	$(".right-p").on('click',function(e){
		e.preventDefault();
		moveSlide('right');
	})
	$(".left-p").on('click',function(e){
		e.preventDefault();
		moveSlide('left');
	})
});

function addPaquete(idp,sku,precio,ut)
{
	var ruta=$("#Lista").data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:{id:idp,price:precio,name:sku,utilidad:ut,qty:1},
		type:'post',
		dataType:'json',
		success:function(resp)
		{

				var tabla=document.querySelector('#tb_paquete');
				tabla.innerHTML="";
				for(i=0; i<resp.length-1;i++)
				{
					var temp=resp[i];
					var ren=document.createElement('tr');
					var td=document.createElement('td');
					var img=document.createElement('img');
					img.classList.add('img-responsive');
					var rutaImg='http://www.pchmayoreo.com/media/catalog/product/'+temp.name.substr(0,1)+'/'+temp.name.substr(1,1)+'/'+temp.name+'.jpg';
					var bandera=ImageExist(rutaImg);
					if(!bandera)
						rutaImg='http://localhost/isco/img/broken.jpg';
					img.setAttribute('src',rutaImg);
					img.style.width='5em';
					td.appendChild(img);
					ren.appendChild(td);
					var td=document.createElement('td');
					td.innerHTML=temp.name;
					ren.appendChild(td);
					var td=document.createElement('td');
					var input=document.createElement('input');
					input.setAttribute('name','cant');
					input.setAttribute('type','number');
					input.classList.add('form-control');
					var div=document.createElement('div');
					div.classList.add('col-md-8');
					//div.classList.add('col-md-offset-2');
					input.setAttribute('value',temp.qty);
					div.appendChild(input);
					td.appendChild(div);
					var input=document.createElement('input');
					input.setAttribute('type','hidden');
					input.setAttribute('name','rowid');
					input.setAttribute('value',temp.rowid);
					td.appendChild(input);
					ren.appendChild(td);
					var td=document.createElement('td');
					td.classList.add('td-button');
					var boton=document.createElement('button');
					boton.classList.add('btn');
					//boton.classList.add('btn-xs');
					boton.classList.add('btn-primary');
					boton.classList.add('btn-block');
					boton.classList.add('btnUpdatePaquete');
					var span=document.createElement('span');
					span.classList.add('glyphicon');
					span.classList.add('glyphicon-repeat');
					boton.appendChild(span);
					td.appendChild(boton);
					ren.appendChild(td);
					tabla.appendChild(ren);
					$("#modalPaquete").modal('show');
				}
				$("#precio_paquete").val(resp[resp.length-1]);
				$(".td-button").on('click','.btnUpdatePaquete',
					function(){
					var cant=$(this).parent().parent().find('td').eq(2).find('div input').val();
					var rowid=$(this).parent().parent().find('td').eq(2).find('input[type="hidden"]').val();
					var row=$(this).parent().parent();
					updatePaquete(cant,rowid,row);
				}
				);
		},
		error:function(xhr,error,estado){
			//alert(xhr,error,estado);
		},
		complete:function()
		{

		}
	})


}
function updatePaquete(cant,prowid,ren)
{
	var ruta=$("#Lista").data('rutamodpaq');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:{qty:cant,rowid:prowid},
		type:'post',
		dataType:'json',
		success:function(resp)
		{
			if(resp.ban==1)
			{
				ren.remove();
			}
			else
			{
				ren.find('td').eq(2).find('div input').val(cant);
			}
		},
		complete:function(){

		},
		error:function(xhr,error,estado){
			alert(xhr+" "+error+" "+estado);
		}
	})
}
function insertarPaquete()
{
	var ruta=$("#frmPaquete").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:$("#frmPaquete").serialize(),
		type:'post',
		dataType:'json',
		success:function(resp)
		{
			if(resp.ban){
				ban=false;
				for(i=0;i<resp.length;i++)
				{
					if(!resp[i])
					{
						ban=true;
						break;
					}
				}
				if(ban)
					alert('no se insertaron todos los productos');
				else
					$("#modalPaquete").modal('hide');
			}
			else
				alert('Ese paquete ya existe');

		},
		complete:function(){

		},
		error:function(xhr,error,estado)
		{
			alert(xhr,error,estado);
		}
	})
}
function ImageExist(url)
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}
function moveSlide(direccion)
{
	console.log($(".form_container .slide-p").length)
	var limite=($(".form_container .slide-p").length/5);
	indicador=(direccion=='right') ? indicador+1 : indicador-1
	indicador=(indicador>=limite) ? 0 : indicador
	indicador=(indicador<0) ? limite-1 : indicador
	$('.form_container .slideContainer').animate({'margin-left':-($('.form_container').width()*indicador)+'px'})
}
function defineSizes()
{
	$('.form_container .slide-p').each(function(i,ele){
		$(ele).width($('.form_container').find('.slide-p').eq(0).width());
	})
}
