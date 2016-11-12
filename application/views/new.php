<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Nuevos Productos</h2>
		</div>
	<div class="fila-seccion col-md-12 fila-seccion-new" data-seccion="<?php if(isset($seccion)) echo $seccion;?>"data-base="<?=base_url()?>"data-ruta="<?=base_url()?>articulos/cargaAjax" data-op="<?php if(isset($opcion)) echo $opcion;?>" data-id="<?php if(isset($id)) echo $id;?>" >

			<?php foreach($artmarca->result() as $art) { ?>
			<div class="container-prod">
				<p class="nuevo">Nuevo</p>
				<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>" >
					<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" class="img-responsive" alt="" data-sku="<?=$art->sku?>"  />
				</a>
				<div class="data-prod">
					<p><a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>" class="nombre"><?=$art->descripcion?></a></p>
					<p class="sku">SKU: <?=$art->sku?></p>
					<p class="price"><strong style="<?php if($art->descuento>0) echo 'text-decoration:line-through';?>">$<?php echo $this->funciones->precio($art->utilidad,$art->ut,$art->precio,0);?> </strong></p>
					<?php if($art->descuento>0) {?>
						<p class="precioDescuento">$<?php echo $this->funciones->precio($art->utilidad,$art->ut,$art->precio,$art->descuento);?></p>
					<?php }?>
				</div>
			</div>
		<?PHP }?>
		<div id="spin"></div>
	</div>
	</div>
</div>