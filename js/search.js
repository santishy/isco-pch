$(document).on('ready',function()
{
	$("#txtSearch").on('keypress',function(){
		$(".container-search").css({display:'block'})
		$(".container-search").animate({height:"70%",width:"86%",opacity:1},'slow');
	})
/*	$('img').error(function(){
		$(this).unbind("error").attr('src',"http://iscocomputadoras.com/uploads/"+$(this).data('sku')".jpg").error(function(){
		$(this).unbind("error").attr('src',"http://iscocomputadoras.com/pchimg/"+$(this).data('sku').toLowerCase()+".jpg").error(function(){
			console.log("ahora esta en search")
			$(this).unbind("error").attr('src',ruta+"img/broken.jpg");
		});
	});
});*/
	var container=null;
	$("#txtSearch").on('keyup',search);
	$(document).click(function(e){
		evento=e.target;
		evento=$(evento).attr('class');
		if(typeof(evento.indexOf())!='undefined')
		{
			cad=evento.indexOf('container-search');
			console.log(e.target.id+" "+cad)
			if(cad==-1 && e.target.id!='txtSearch' )
				$(".container-search").animate({height:'0px',width:'0px',opacity:'0'});
		}

	})
	$(".cerrar").on('click',function(e){
		e.preventDefault();
		$(".modale").removeClass('modale-visible')
	});
	$(".pic").on("click",function(){
		getArticulo($(this).data("id"));
		var src=$(this).find('img').attr('src');
		container=$(this);
		$(".modale img").attr('src',src);
		var modale=document.querySelector('.modale');
		modale.classList.add('modale-visible')

	})
	$("#atras,#adelante").on('click',function(e){
		e.preventDefault();

		var ind=container.data('index');
		direccion=$(this).data('direccion');
		if(direccion==1 || direccion=="1")
			ind=ind+1;
		else
			ind=ind-1;
		var temp=$(".pic").eq(ind);
		console.log('size:'+$(".pic").size()+" ind:"+ind)
		if(ind > -1 && ind<$(" .pic").size())
		{
			var src=$(".pic").eq(ind).find('img').attr('src');
			container=temp;
			getArticulo($(".pic").eq(ind).data('id'));
			$(".modale #imagen-modal").attr('src',src);
			console.log('camino');
		}
		else
			console.log('no camino')

		});
});
function search()
{
	var ruta=$(".container-search").data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		type:"post",
		data:{palabra:$("#txtSearch").val()},
		dataType:'json',
		success:function(data)
		{
			var mensaje=document.createElement('div');
			mensaje.classList.add('alert','alert-info','mns');
			if(data.length)
				mensaje.innerHTML="<center>Si no esta lo que busca aqui, presione enter en el campo de busqueda o el boton</center>";
			else
				mensaje.innerHTML="No hay resultados."
			containerSearch=document.querySelector('.container-search');
			containerSearch.innerHTML="";
			containerSearch.appendChild(mensaje)
			for(var i=0;data.length;i++)
			{
				var contenedor = document.createElement('div');
				var costo=document.createElement('div');
				costo.classList.add('cabezera-costo');
				var pcosto=document.createElement('p');

				if(typeof(data[i].utilidad) != 'undefined' )
					if(data[i].utilidad>0)
						utilidad=data[i].utilidad;

					else
						utilidad=data[i].ut;
				else
					utilidad=data[i].utilidad;
				console.log('esto es la utilidad'+utilidad);
				console.log('precio neto:'+data[i].precio)
				if(data[i].descuento>0)
				{
					//var precio= ((data[i].precio+((data[i].precio*utilidad)/100))*1.16)-((data[i].precio*data[i].descuento)/100);
					var precio=((parseFloat(data[i].precio)+((parseFloat(data[i].precio)*parseFloat(utilidad))/100))*1.16);
					console.log(precio);
				}
				else
					var precio=((parseFloat(data[i].precio)+((parseFloat(data[i].precio)*parseFloat(utilidad))/100))*1.16);
				console.log('sin redondear'+precio)
				precio=Math.round(precio);
				console.log('redondeado:'+precio)
				precio=precio-((precio*parseFloat(data[i].descuento))/100);
				precio=precio.toString();

				//console.log("PROVEEDOR:"+data[i].proveedor);
				precio="$"+precio+".00";
				pcosto.innerHTML=precio;
				costo.appendChild(pcosto);
				contenedor.classList.add('col-md-2','col-xs-6','mod-md');
				var contenido = document.createElement('div');
				contenido.classList.add('art-search');
				var figura=document.createElement("figure");//->contendino
				var link=document.createElement("a");//->figure

				link.setAttribute('href',"http://iscocomputadoras.com/productos/detallesproducto/"+data[i].id_articulo); //poner id
				var img=document.createElement('img');// ->link
				if(data[i].proveedor=="pchmayoreo")
					img.setAttribute('src',"http://www.pchmayoreo.com/media/catalog/product/"+data[i].sku.substr(0,1)+"/"+data[i].sku.substr(1,1)+"/"+data[i].sku+".jpg" );
				else
				{
					img.setAttribute('src',"http://iscocomputadoras.com/uploads/"+data[i].sku+".jpg" );
					//alert("http://localhost/uploads/"+data[i].sku);
				}
				img.dataset.sku=data[i].sku;
				img.classList.add("img-responsive","thumb");
				var descripcion=document.createElement('div');
				descripcion.classList.add('descripcion-search');
				var link_desc=document.createElement('a');
				link_desc.setAttribute('href',"http://iscocomputadoras.com/productos/detallesproducto/"+data[i].id_articulo);
				link_desc.innerHTML=data[i].descripcion.toLowerCase();
				link.appendChild(img);
				figura.appendChild(link);
				descripcion.appendChild(link_desc);
				contenido.appendChild(costo);
				contenido.appendChild(figura);
				contenido.appendChild(descripcion);
				contenedor.appendChild(contenido);
				containerSearch.appendChild(contenedor);
				$(".art-search").animate({opacity:1},1000);
				$('img').error(function(){
					$(this).unbind("error").attr('src',"http://iscocomputadoras.com/uploads/"+$(this).data('sku')+".jpg").error(function(){
					$(this).unbind("error").attr('src',"http://iscocomputadoras.com/pchimg/"+$(this).data('sku').toLowerCase()+".jpg").error(function(){
						console.log("sku:"+$(this).data('sku'))
						$(this).unbind("error").attr('src',"http://iscocomputadoras.com/img/broken.jpg");
					});
				});
			});

			}
		},
		error:function(xhr,estado,error)
		{

		},
		complete:function()
		{

		}
	})
}
function getArticulo(id)
{
	var ruta=$(".modale").data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		type:'post',
		data:{id_articulo:id},
		dataType:'json',
		success:function(resp)
		{
			console.log(resp[0].ut+"utilidad: "+resp[0].utilidad)
			if(resp.length>0)
			{
				var contenedor = document.querySelector('.especificaciones');
				contenedor.innerHTML="";
				var parrafo=document.createElement('p');
				parrafo.innerHTML="<b>SKU</b>: "+resp[0].sku;
				contenedor.appendChild(parrafo);
				var parrafo=document.createElement('p');
				parrafo.innerHTML=resp[0].descripcion;
				contenedor.appendChild(parrafo);
				var parrafo=document.createElement('p');
				parrafo.innerHTML=resp[0].linea;
				contenedor.appendChild(parrafo);
				var parrafo=document.createElement('p');
				console.log('precio: '+resp[0].precio)
				var precio=((parseFloat(resp[0].precio)*parseFloat(resp[0].ut))/100)+parseFloat(resp[0].precio);

				precio=parseFloat(precio)*1.16;
				precio=precio-((precio*parseFloat(resp[0].descuento))/100);
				precio=Math.round(precio);
				parrafo.innerHTML="$"+precio;
				contenedor.classList.add('columna')
				contenedor.appendChild(parrafo);
				var h3=document.createElement('h3');
				var ficha=document.querySelector('.ficha');
				ficha.innerHTML="";
				h3.innerHTML="Descarga la ficha tecnica";
				ficha.appendChild(h3);
				var link=document.createElement('a');
				link.setAttribute('id',"pdf");
				link.setAttribute('target','_blank')
				link.style.display="block";
				link.setAttribute('href',"http://iscocomputadoras.com/imagenes/"+resp[0].sku+".pdf");
				var pdf=document.createElement('img');
				pdf.classList.remove('Responsive')
				pdf.classList.remove('image')
				pdf.setAttribute('src','http://iscocomputadoras.com/img/pdf.jpg');
				pdf.classList.add('Responsive')
				pdf.classList.add('image');
				//link.style.textAlign="center";
				pdf.style.width="30%";
				pdf.style.marginLeft="35%";
				link.appendChild(pdf);
				ficha.appendChild(link);
				comprar=document.createElement('a');
				comprar.innerHTML="";
				comprar.setAttribute('href','http://iscocomputadoras.com/productos/detallesproducto/'+resp[0].id_articulo);
				comprar.classList.add('link-producto');
				comprar.innerHTML="<span class='glyphicon glyphicon-shopping-cart'></span> Comprar";
				modale=document.querySelector('.modale');
				modale.appendChild(comprar)
			}
		},
		error:function(xhr,estado,error)
		{

		},
		complete:function(){

		}
	})
}
function fileExists(url) {
    if(url){
        var req = new XMLHttpRequest();
        req.open('GET', url, false);
        req.send();
        return req.status==200;
    } else {
        return false;
    }
}
function ImageExist(url)
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}
function existImage(url)
{
//var sURL = "existeimagen.asp?url="+ url;
var oXMLHTTP = new ActiveXObject("Microsoft.XMLHTTP");
oXMLHTTP.open("POST",url,false);
oXMLHTTP.send('');

var resultado = oXMLHTTP.responseText;

if (resultado == 'True')
alert("Existe la image...")
else
alert("No existe la image...")
}
