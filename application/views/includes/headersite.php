<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
	
	<title><?=$title?></title>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="<?=base_url()?>css/normalize.css" />-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css" />-->	
	<link rel="stylesheet" href="<?=base_url()?>css/menu.css" />
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=base_url()?>css/style.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/style-sm.css" />
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Slab:600' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Glegoo:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/galeria/lightgallery.css" /> 
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>bower_components/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="<?=base_url()?>css/font-awesome/font-awesome.min.css">
	<meta property="og:url"           content="http://iscocomputadoras.com" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Your Website Title" />
	<meta property="og:description"   content="Your description" />
	<meta property="og:image"         content="" />
	
	<script src="http://heartcode-canvasloader.googlecode.com/files/heartcode-canvasloader-min-0.9.1.js"></script>
	<script src="http://fgnass.github.io/spin.js/spin.min.js"></script>
	<!-- Facebook Conversion Code for Pagos -Isco Computadoras -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6035702015202', {'value':'0.00','currency':'MXN'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6035702015202&amp;cd[value]=0.00&amp;cd[currency]=MXN&amp;noscript=1" /></noscript>
	<script type="text/javascript">
		function Error_Cargar() {
			window.event.srcElement.style.display = "None";
		}
	</script>
	
</head>
<body>
<div id="fb-root"></div>
<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '463785683829735',
	      xfbml      : true,
	      version    : 'v2.7'
	    });
	   /* FB.ui({
	  method: 'share_open_graph',
	  action_type: 'og.likes',
	  action_properties: JSON.stringify({
	    object:'https://developers.facebook.com/docs/',
	  })
	}, function(response){
	  // Debug response (optional)
	  console.log(response+"esta es la respuesta");
	});*/
	  };

	  (function(d, s, id){

	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/es_LA/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
</script>
	<header class="header">
		<div class="row">
			
			<div class="col-md-4 col-xs-10 col-md-offset-2 text-right" style="line-height:50px;">
				<span class="glyphicon glyphicon-earphone earphone"></span>
					<!--a href="tel:+523535327373" class="earphone">
						<span >SHY</span>
					</a-->
					<a href="tel:+018000014726" class="earphone" style="font-weight:bold">
						<span >Matriz Guadalajara 01 800 001 isco</span>
					</a>

			</div>
			<div class="col-md-1 col-xs-2" style="margin-top:12px;">
				<ul class="list-inline row">									
					<li class="col-md-5 col-xs-5">
						<a href="https://www.facebook.com/OficialIscoComputadoras?fref=ts" target="_blank">
							<img src="<?=base_url()?>img/face2.png" title="nuestra página en facebook" alt="facebook" class="img-responsive" style="margin: 0 auto;"/>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-3 col-xs-12" style="margin-top:5px;">
				<form action="<?=base_url()?>busqueda" method="post">
					<div class="form-group">
					    <div class="input-group">
					      <input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="Búsqueda en Isco" title="Escribe lo que buscas" required />
					      <span class="input-group-btn">
					      	<button class="btn btn-primary adSearch" id="btnSearch">
					      		<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					      	</button>
					      </span>
					    </div>
				   </div>
				</form>
			</div>
			<div class="col-md-2"  style="margin-top:5px;">
				<!--a href="<?=htmlspecialchars($loginUrl)?>" class="btn btn-block btn-social btn-facebook">
				  <span class="fa fa-facebook"></span>
				  Registrate
				</a-->
				<!--a id="login"  href="#" style="line-height:50px;" data-toggle="modal" data-target=".bs-example-modal-sm">
					<span >
						<?php if($this->session->userdata('id_usuario')>0) echo $this->session->userdata('correo'); else echo 'Mi Cuenta'; ?>
					</span>
				</a>
				<a class="btn btn-link cerrarSesion" style="display:<?php if(!$this->session->userdata('correo')) echo 'none;';?>" href="<?=base_url()?>envios/cerrarSesion" data-toggle="tooltip" data-placement="right" title="Cerrar Sesion"><span class="glyphicon glyphicon-log-out"></span></a-->

				<div class="list-search">
					<span class="glyphicon glyphicon-remove"></span>
					<ul>
					</ul
				</div>
			</div>
			
			</div>
		</div>
		<div class="row ">
		<div class="col-md-12 cabezera">
			<figure class="col-xs-5 col-sm-4 col-md-3">
				<a href="<?=base_url()?>"><img src="<?=base_url()?>img/logotipo.png" alt="Isco Computadoras" class="img-responsive"/></a>
			</figure>	
			<input type="checkbox" id="menu">
			<label for="menu" class="glyphicon glyphicon-menu-hamburger"></label>
			<nav class="menu-new">
			<ul>
				<li>
					<a href="<?=base_url()?>">Inicio</a>
				</li>
				<li class="submenu">
					<a href="#" class="noclick">Productos <span class="glyphicon glyphicon-menu-down"></span></a>
					<ul id="menu-prod">
						<?php foreach ($secciones->result() as $row) 
						{?>
							<li>
								<a href="<?=base_url()?>articulos/secciones/<?=$row->id_seccion?>"> <?=$row->seccion?></a>
							</li>
						<?php }?>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" class="noclick">Marcas <span class="glyphicon glyphicon-menu-down"></span></a>
					<ul id="menu-marcas">
						<?php foreach ($marcas->result() as $row) {?>
							<li>
								<a href="<?=base_url()?>articulos/marcas/<?=$row->id_marca?>"><?=$row->marca?></a>
							</li>
						<?php }?>
					</ul>
				</li>
				<li >
					<a href="<?=base_url()?>articulos/galeria" STYLE="COLOR:#ff4d94">GALERIA</a>
				</li>
					    <!--li style="background-color:#DC143C;">
							<a href="<?=base_url()?>articulos/nuevosProductos" id="lnkContacto" data-contacto="<?=base_url()?>articulos/nuevosProductos" style="color:white">LO NUEVO</a>
						</li-->
				<li>
					<a href="#" id="lnkCart" class="lnkCart">
								<span class="glyphicon glyphicon-shopping-cart icon" aria-hidden="true"></span>
								<span class="badge cantCart" id="cantCart">
									<?php if($this->session->userdata('carrito')){?>
										<?=$this->session->userdata('carrito')?>
									<?php } else { echo 0; }?>
								</span>
							</a>
				</li>
			</ul>
		</nav>
		</div>
		</div>
	</header>
	<div class="row">
			<div class="col-md-12 container-publicidad">
				<div class="col-md-8" border solid>
					<p style="width:100%;margin:0px" class="text-center texto-cabezera">¡Felices fiestas decembrinas! Te desea ISCO COMPUTADORAS.</p>
				</div>
				<div class="col-md-3">
					<button id="btnInfo"style="height:100%;color:#004d99;" class="btn-default btn btn-block" ><span class="glyphicon glyphicon-envelope"></span> Contáctenos</button>
				</div>
			</div>
			<div class="col-md-12 container-inferior">
				<a href="<?=base_url()?>productos/getPaquetes">Combos ISCO</a>
				<p>Mís búsquedas</p>
				<button id="list-search" class="btn btn-default btn-default" data-toggle="tooltip" data-placement="bottom" title="Lista"><span class="glyphicon glyphicon-list"></span></button>
			</div>
		</div>
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/agregarPrecio">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
			  <div class="modal-header" >
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <p class="titulo-login">Mi Cuenta</p>
			  </div>
			  <div class="modal-body">
			    <form name="frmLoginCliente" id="frmLoginCliente" action="<?=base_url()?>envios/loginCliente">
		          <div class="form-group">
		            <label style="">Correo</label>
		            <input type="email" name="usuario" id="usuario"class="form-control" placeholder="usuario@dominio.com">
		          </div>
		          <div class="form-group">
		            <label style="">Contraseña</label>
		            <input type="password" name="password" id="password" class="form-control">
		          </div>
		        </form>
			  </div>
			  <div class="modal-footer text-center">
			    <button type="button" id="btnLoginCliente" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Ingresar</button>
			  </div>
			</div>
		</div>
	</div>	
	<div id="modalInfo" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color:#4d4d4d" >
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" style="color:white">Escribenos</h4>
	      </div>
	      <div class="modal-body ">
	        <p style="font-size:.9em;text-align:justify;font-weight:bold">Si tienes alguna duda o necesitas alguna cotización especifica, escribenos a la brevedad te responderemos. También puedes marcar al 
	        	01800 001 ISCO (Horarios lunes a viernes, 10:00 a 14:00 y 16:00 a 19:00)</p>
	      </div>
	      <div class="row mns-info" style="margin-left:0px;margin-right:0px">
	      	<div style="margin-top:30px;padding-right:15px;padding-left:15px;" class="col-md-12">
	      	<form id="formInfo" action="<?=base_url()?>envios/mensajeCliente">
	      		<div class="form-group">
	      				<label>Correo</label>
		      			<input name="correo" class="form-control" type="email" placeholder="Escribe tu correo aquí." >
		      		</div>
		      		<div class="form-group">
		      			<label>Mensaje</label>
		      			<textarea rows="4"placeholder="Escribe tu mensaje."name="mensaje" class="form-control"></textarea>
		      		</div>
		      	</form>
		     </div>
	      </div>
	      	
	      <div class="modal-footer" >
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" id="btnEnviarCorreo">Enviar</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<div class="container-search well" data-ruta="<?=base_url()?>busqueda/busquedaAjax">
</div>

