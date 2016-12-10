<!-- carrusel de imagenes -->
<div class="container-full" id="base" data-ruta="<?=base_url()?>">
	<?php if(isset($exito)){ ?>
		<div id="alerta" class="row">
			<div class="col-md-12 text-center"  style="font-size:1.5em;font-weight:bold">
				<div class="alert alert-info" role="alert"><span style="color:" class="glyphicon glyphicon-ok"></span> <?=$exito?></div>
			</div>
		</div>
	<?php } ?>
	<div class="row">
		<div id="fb-root"></div>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=1499963823642785";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Your share button code -->

		<div class="col-md-12">
			<div id="mySlider" class="carousel slide" data-ride="carousel">
				<!--<ol class="carousel-indicators">
					<li data-target="#mySlider" data-slide-to="0" class="active prev"></li>
				    <li data-target="#mySlider" data-slide-to="1" class="prev"></li>
				    <li data-target="#mySlider" data-slide-to="2" class="prev"></li>
				</ol>-->
				<div class="carousel-inner" role="listbox">
					<div class="item ">
						<a href="http://iscocomputadoras.com/articulos/secciones/9">
						<img src="<?=base_url()?>banner/24-11-16.jpg" alt="" >
						<!--<div class="carousel-caption">
				        	<img src="img/1.jpg" alt="">
				     	</div>-->
				     	</a>
					</div>
					<div class="item active">
						<a href="http://iscocomputadoras.com/articulos/secciones/18">
						<img src="<?=base_url()?>banner/diamuerto.jpg" alt="" >
						<!--<div class="carousel-caption">
				        	<img src="img/1.jpg" alt="">
				     	</div>-->
				     	</a>

					</div>
				


				</div>
				 <!-- Controls -->
			    <a class="left carousel-control" href="#mySlider" role="button" data-slide="prev">
			    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    	<span class="sr-only">Anterior</span>
			    </a>
			    <a class="right carousel-control" href="#mySlider" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Siguiente</span>
			    </a>

			</div>
		</div>
	</div>
</div>
<!-- Carrusel de imagenes -->
<div class="container container-mov">
	<div class="row">
		<!--<div class="slider">

		</div>-->
		<!--div class="col-xs-12 col-md-12 padding-container ">
			<h2 style="color:#0066FF !important;">Los mejores precios, en ISCOCOMPUTADORAS </h1><hr>
			<div class="col-xs-12 div Ofertas " id="prods" data-ruta="<?=base_url()?>inicio/cargaAjax">
				<?php foreach($articles->result() as $ar) { ?>
					<div class="col-md-3 col-xs-6" >
						<div class="col-sm-12 divArticles ">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($ar->sku, 0,1)?>/<?=substr($ar->sku, 1,1)?>/<?=$ar->sku?>.jpg" alt="" data-sku="<?=$ar->sku?>" class="img-responsive thumb"/></a>
							</figure>
							<p class="descripcion">
								<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><?=strtolower($ar->descripcion)?></a>
							</p>
							<div class="descripcion-costo">

								<?php if($ar->descuento > 0){ ?>
									<p class="spnCosto">$ <?php $utilidad=$ar->utilidad; if($ar->utilidad==0)$utilidad=$ar->ut; echo number_format(ceil((($ar->precio+(($ar->precio*$utilidad)/100))-(($ar->precio*$ar->descuento)/100)*1.16)),2,".",",")?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?php $utilidad=$ar->utilidad; if($ar->utilidad==0)$utilidad=$ar->ut; echo number_format(ceil(($ar->precio+(($ar->precio*$utilidad)/100))*(1.16)),2,".",",")?></p>
								<?php } ?>
							</div>

						</div>
					</div>
				<?php } ?>
				<div id="spin"></div>
				</div>
			</div-->

		<div class="col-md-3 hidden-xs menu-lateral" style="margin-top:20px;margin-bottom:20px">
			<div class="list-group">
				<a href="#" class="list-group-item li-cabezera">SECCIONES</a>
				<?php foreach ($secciones->result() as $row)
				{?>

					<a href="<?=base_url()?>articulos/secciones/<?=$row->id_seccion?>" class="list-group-item"><?=$row->seccion?></a>
				<?php }?>
			</div>
		</div>
		<div class="col-md-9 col-xs-12" style="margin-top:20px;margin-bottom:20px">
			<h1>>> Popular <<</h1>
			<?php foreach($articles->result() as $ar) { ?>
			<div class="articulo col-md-6 col-xs-6">
				<div class="atributos">
					<p class="skuFabricante">SKU: <?=$ar->skuFabricante?></p>
					<p class="description ">
						<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><?=strtolower($ar->descripcion)?></a>
					</p>
					<div class="precio">
						<?php if($ar->descuento > 0){ ?>
							<p>$ <?php $utilidad=$ar->utilidad; if($ar->utilidad==0)$utilidad=$ar->ut; echo number_format(ceil((($ar->precio+(($ar->precio*$utilidad)/100))-(($ar->precio*$ar->descuento)/100)*1.16)),2,".",",")?></p>
							<?php } else { ?>
							<p>$ <?php $utilidad=$ar->utilidad; if($ar->utilidad==0)$utilidad=$ar->ut; echo number_format(ceil(($ar->precio+(($ar->precio*$utilidad)/100))*(1.16)),2,".",",")?></p>
						<?php } ?>
					</div>
				</div>
				<figure>
					<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><img class="img-responsive thumb" src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($ar->sku, 0,1)?>/<?=substr($ar->sku, 1,1)?>/<?=$ar->sku?>.jpg"></a>
				</figure>
			</div>
			<?php } ?>
		</div>
	</div>
