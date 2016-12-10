var pag=0;
var ord=1;
var plinea=null;
var marca=null;
var temp=0;
$(document).on('ready',function(){
 opts = {
  lines: 10 // The number of lines to draw
, length: 10 // The length of each line
, width: 4 // The line thickness
, radius: 10 // The radius of the inner circle
, scale: 1 // Scales overall size of the spinner
, corners: 1 // Corner roundness (0..1)
, color: '#000' // #rgb or #rrggbb or array of colors
, opacity: 0.90 // Opacity of the lines
, rotate: 0 // The rotation offset
, direction: -1 // 1: clockwise, -1: counterclockwise
, speed: 1 // Rounds per second
, trail: 60 // Afterglow percentage
, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
, zIndex: 2e9 // The z-index (defaults to 2000000000)
, className: 'spinner' // The CSS class to assign to the spinner
, top: '50%' // Top position relative to parent
, left: '50%' // Left position relative to parent
, shadow: false // Whether to render a shadow
, hwaccel: true // Whether to use hardware acceleration
, position: 'fixed' // Element positioning
}
 target = document.getElementById('spin');
$(".category").on('click',function(e){
	e.preventDefault();
	marca=null;
	contador(true)
	var pid=$(".fila-seccion").data('id');
	var pop=$(".fila-seccion").data('op');
	plinea=$(this).data('linea');
	var jdata={op:pop,id:pid,pagina:pag,orden:ord,linea:plinea};
	cargaAjax(true,jdata);
});
$(".marcaAjax").on('click',function(e){
	e.preventDefault();
	contador(true)
	var pid=$(".fila-seccion").data('id');
	var pop=$(".fila-seccion").data('op');
	//plinea=$(this).data('linea');
	marca=$(this).data('marca');
	var jdata={op:pop,id_marca:marca,id:pid,pagina:pag,orden:ord};
	cargaAjax(true,jdata);
});
$("#filtro").on('change',function(){
	contador(true)
	ord=$("#filtro").val();
	var pid=$(".fila-seccion").data('id');
	var pop=$(".fila-seccion").data('op');
	if(marca!=null)
		var jdata={op:pop,id_marca:marca,id:pid,pagina:pag,orden:ord};
	else
		if(plinea!=null)
			var jdata={op:pop,id:pid,pagina:pag,orden:ord,linea:plinea};
		else
			var jdata={op:pop,id:pid,pagina:pag,orden:ord};
	cargaAjax(true,jdata);

});
	$(window).scroll(function(){
		//console.log("window:"+$(window).scrollTop()+" document:"+$(document).scrollTop())
		if($(document).scrollTop()+$(window).height()>=$(document).height()-200)
		{
			contador(false);
			if(typeof(spinner) != "undefined")
				spinner.stop();
			//console.log('hola')
			ord=$("#filtro").val();
			var pid=$(".fila-seccion").data('id');
			var pop=$(".fila-seccion").data('op');
			pedro={'hola':'bla bal bal '};

			localStorage.seccion=$(".fila-seccion").data('seccion');
			if(marca!=null)
			{
				var jdata={op:pop,id_marca:marca,id:pid,pagina:pag,orden:ord};

			}
			else
			{

				if(plinea!=null)
					var jdata={op:pop,id:pid,pagina:pag,orden:ord,linea:plinea};
				else
					var jdata={op:pop,id:pid,pagina:pag,orden:ord};
			}
			if(pop==1 || pop=="1")
				localStorage.op='marcas';
			else
				localStorage.op='secciones';
			localStorage.id=pid;
			cargaAjax(false,jdata);

			/*console.log('pagina:'+localStorage.pag)
			console.log('op;'+localStorage.op)
			console.log('marca:'+marca)  AKI SE VE ALGO, LO MARKE*/
		}
	});
});
function contador(nuevo)
{

	if(nuevo)
		pag=0;
	else
		pag+=21;

}
function cargaAjax(nuevo,jdata)
{


	$.ajax({
		url:$('.fila-seccion').data('ruta'),
		beforeSend:function(){
				spinner = new Spinner(opts).spin(target);
				$("body").css('overflow','hidden');
			},
			type:'post',
			data:jdata,
			dataType:'json',
		success:function(data)
		{
			//carga elementos
			if(data.length==0)
				pag-=21;
			localStorage.pag=pag;
			crearElementos(data,nuevo);
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+" "+error+" "+estado);
		},
		complete:function(xhr){
			spinner.stop();
			$(".ocultar").css('display','inline-block');
			$(".ocultar").animate({opacity:1},800);
			$("body").css('overflow','auto');
		}
	});
}
function crearElementos(data,nuevo)
{
	if(nuevo)
		document.querySelector(".fila-seccion").innerHTML="";
	for(i=0;i<data.length;i++)
	{
		div=document.createElement("div");
		div.classList.add('container-prod');
		var link=document.createElement("a");//->figure
		link.setAttribute('href',$(".fila-seccion").data('base')+"productos/detallesproducto/"+data[i].id_articulo); //poner id
		var img=document.createElement('img');// ->link
		img.setAttribute('src',"http://www.pchmayoreo.com/media/catalog/product/"+data[i].sku.substr(0,1)+"/"+data[i].sku.substr(1,1)+"/"+data[i].sku+".jpg" );
		img.dataset.sku=data[i].sku;
		img.classList.add("img-responsive");
		link.appendChild(img);
		div.appendChild(link);
		var dataProd=document.createElement('div');
		dataProd.classList.add('data-prod');
		var pname=document.createElement('p');
		var sku=document.createElement('p');
		sku.classList.add('sku');
		sku.innerHTML=data[i].sku;
		var link_desc=document.createElement('a');
		link_desc.innerHTML=data[i].descripcion.toUpperCase();
		link_desc.classList.add('nombre');
		link_desc.setAttribute("href",$(".fila-seccion").data('base')+"productos/detallesproducto/"+data[i].id_articulo); //poner id
		pname.appendChild(link_desc);
		dataProd.appendChild(sku);
		var price=document.createElement('p');
		var strong=document.createElement('strong');
		if(data[i].ut>0)
			utilidad=data[i].ut;
		else
			utilidad=data[i].utilidad;
		precio=parseFloat(data[i].precio)*1.16;
		precio=precio + ((precio*parseFloat(utilidad))/100);
		//precio=((parseFloat(data[i].precio)+((parseFloat(data[i].precio)*parseFloat(utilidad))/100))*1.16);

		if(precio>0)
			precio=Math.round(precio);
		precio=precio.toString();
		precio="$"+precio+".00";
		strong.innerHTML=precio;
		price.classList.add('price');
		price.appendChild(strong);
		dataProd.appendChild(pname);
		dataProd.appendChild(price);
		//var utilidad=0;
		if(data[i].descuento>0)
		{
			strong.style.textDecoration="line-through";
			var precioDescuento=document.createElement('p');
			precioDescuento.classList.add('precioDescuento');
			precio=((data[i].precio)*1.16);
			precio=precio+((precio*utilidad)/100);

			descuento=(precio*data[i].descuento)/100;
			precio=precio-descuento;
			if(precio>0)
				precio=Math.round(precio);
			precio=precio.toString();
			precio="$"+precio+".00";
			precioDescuento.innerHTML=precio;
			dataProd.appendChild(precioDescuento);
		}
		div.appendChild(dataProd);
		document.querySelector('.fila-seccion').appendChild(div);
	}
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
}
