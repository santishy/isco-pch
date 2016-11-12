<footer >
<div class="container-full">
	<div class="footer row">
		<div class="col-md-12">
			<div class="col-md-8 col-xs-12 f-pagos">
				<h3>Formas de pago</h3>
				<ul class="list-inline row">
					<li class="col-md-2 col-sm-2 col-xs-4">						
						<a href="https://www.paypal.com/es/webapps/mpp/paypal-popup" title="Cómo funciona PayPal" onclick="javascript:window.open('https://www.paypal.com/es/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
							<img src="https://www.paypalobjects.com/webstatic/mktg/logo-center/logotipo_paypal_pagos_seguros.png" alt="Seguro con PayPal" class="img-responsive" />
						</a>
					</li>
					<li class="col-md-2 col-sm-2 col-xs-4">
						<img src="<?=base_url()?>img/visa-mastercard.png" title="Aceptamos Tarjetas de Credito" alt="visa mastercard" class="img-responsive" />
					</li>
					<li class="col-md-2 col-sm-2 col-xs-4">
						<img src="<?=base_url()?>img/logo-bancomer.png" title="Depositos y Transferencias en Bancommer" alt="Depositos y Transferencias en Bancommer" class="img-responsive" />
					</li>
					<li class="col-md-2 col-sm-2 col-xs-4">
						<img src="<?=base_url()?>img/Scotiabank.png" title="Depositos y  Transferencias Scotiabank" alt="Depositos y  Transferencias Scotiabank" class="img-responsive" />
					</li>
				</li>
			</div>
			<div class="col-md-4 col-xs-12 envios text-right">
				<h3>Formas de Envío</h3>
				<div class="row ">
					<div class="col-md-6 col-sm-9 col-xs-4">
						
					</div>
					<div class="col-md-6 col-sm-3 col-xs-6">
						<img src="<?=base_url()?>img/estafeta2.png" title="Envios Seguros" alt="estafeta" class="img-responsive" />
					</div>
				</div>
			</div>
				
			
			
		</div>	
	</div>
</div>

<div class="row footer-bottom">
	<div class="col-md-3 col-xs-12">
		<p class="text-center">
			Powered by Isco Computadoras
		</p>
	</div>
	<div class="col-md-7 col-xs-12">
		<ul class="list-inline menu-footer">
			<li><a href="#">Quienes Somos</a></li>
			<li><a href="#">Siguenos</a></li>
			<li><a href="#">Políticas y Aviso de Privacidad</a></li>
			<li><a href="#">Como Comprar</a></li>
			<li><a href="#">¿Porque Comprar en Isco?</a></li>
		</ul>
	</div>
	<div class="col-md-2 col-xs-12">
		<p class="text-center">
			© Isco Computadoras 2015
		</p>
	</div>
</div>
</footer>
<script>
	$(document).on('ready',function(){
		modalInfo=$("#modalInfo");
		$("#btnInfo").on('click',function(){
			modalInfo.modal('show');
		});
		$("#btnEnviarCorreo").on('click',function()
		{
			var ruta=$("#formInfo").attr('action');
			$.ajax
			({
				url:ruta,
				beforeSend:function(){

				},
				dataType:"text",
				type:'post',
				data:$("#formInfo").serialize(),
				success:function(resp){
					console.log(resp);
				},
				error:function(xhr,error,estado){
					alert(xhr+" "+error+" "+estado)
				},
				complete:function(){

				}
			});
		});
	});
</script>
<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	$(document).on('ready',function(){
		$(".list-search ul li").remove();
		$(".list-search span").on('click',function(){
			$(".list-search").css({display:'none'});
		});
		$("#list-search").on('click',function(){
			$(".list-search").css({display:'flex'});
		})
		if(localStorage.pag!= null)
		{
			if(localStorage.getItem("data") == null)
			{
				data=[];
			}
			else{
				data=JSON.parse(localStorage.data);
			}
			cadena={ "url":"http://localhost/isco/articulos/"+localStorage.op+"/"+localStorage.id+"/"+localStorage.pag,"seccion":localStorage.seccion};
			ban=false;
			
				for(ind=0;ind<data.length;ind++)
				{
					console.log(data[ind].seccion+"="+cadena.seccion)
					if(data[ind].seccion==cadena.seccion)
					{
						ban=true;
						data[ind]=cadena;
					}
				}
			if((data.length) > 9)
			{
				if(!ban)
					{
						for(i=0;i<data.length-1;i++)
						{
							data[i]=data[i+1];
						}
						data.pop();
					}
			}
			else 
				console.log('aki no entro;+'+data.length)
			if(!ban)
			{
				data.push(cadena);
			}
			localStorage.data=JSON.stringify(data);
		}
		else
			console.log('no entro');
		crearLista();
		/*
		{
			if(typeof(localStorage.getItem("data")) == "undefined")
			{
				data=[];
				console.log('indefinida')
			}
			else 
			{
				console.log('definida')
				console.log(localStorage.data)
				data=JSON.parse(localStorage.data);
			
			}
			var cadena="http://localhost/isco/articulos/"+localStorage.op+"/"+localStorage.id+"/"+localStorage.pag;
			data.push(cadena);
			//console.log(data[0])
			localStorage.data=JSON.stringify(data);
			
		}
		else 
			console.log('no entro ');*/
		
	});
	function crearLista()
	{
		if(localStorage.getItem("data")!= null){
			data=JSON.parse(localStorage.data);
			containerBacks=document.querySelector(".list-search ul");
			for(i=0;i<data.length;i++)
			{
				console.log(i+":"+data[i].url+" "+data[i].seccion);
				var li=document.createElement('li');
				var link=document.createElement('a');
				link.setAttribute('href',data[i].url);
				link.innerHTML=data[i].seccion;
				li.appendChild(link);
				containerBacks.appendChild(li);
			}
		}
	}
</script>


