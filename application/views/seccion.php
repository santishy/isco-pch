<div class="container">
	<div class="row" style="padding-bottom:15px">
		<div class="col-md-6">
			<div class="filtros">
				<form>
					<div class="form-group">
						<label class="control-label col-md-4" style="color:#336699;text-align:right">Ordenar por</label>
						<div class="col-md-6">
							<select class="form-control" name="filtro" id="filtro">
								<option value="1">Menor a mayor</option>
								<option value="2">Mayor a menor</option>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-3">
		</div>
		<div class="col-md-3">
			<h3 class="categoria">Categorias</h3>
		</div>
	</div>
	<div class="row">
	<div class="fila-seccion col-md-9" data-seccion="<?php if(isset($seccion)) echo $seccion;?>"data-base="<?=base_url()?>"data-ruta="<?=base_url()?>articulos/cargaAjax" data-op="<?php if(isset($opcion)) echo $opcion;?>" data-id="<?php if(isset($id)) echo $id;?>" >
			<?php foreach($artmarca->result() as $art) { ?>
			<div class="container-prod">
				<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>" >
					<img data-sku="<?=$art->sku?>" src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" class="img-responsive" alt="" data-sku="<?=$art->sku?>"  />
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
	<div class="col-md-3 sidebar-prod">
		<ul class="list-group lista-categoria">
		  	<?php if(isset($marcaSeccion)){
		  		if(isset($categorias)) foreach($categorias->result() as $row){?>
		    <li class="list-group-item"><a class="category" data-linea="<?=$row->linea?>" href="<?=base_url()?>articulos/<?php if($ban==2) echo 'secciones'; else echo 'marcas';?>/<?=$id?>/linea/<?=$row->id_linea?>"><?=$row->linea?></a><span class="badge"><?=$row->nume?></span></li>
		    <?php }?>
		</ul>
		<?php if(count($marcaSeccion->result_array())>0)	{?>
			<h3 class="categoria">Marcas</h3>
		<ul class="list-group lista-categoria">
		  	<?php if(isset($marcaSeccion)) foreach($marcaSeccion->result() as $row){?>
		    <li class="list-group-item"><a class="marcaAjax" data-marca="<?=$row->id_marca?>" href="3"><?=$row->marca?></a><span class="badge"><?=$row->nume?></span></li>
		    <?php }?>
		</ul>
		<?php }}?>
	</div>
	</div>
</div>
<script src="<?=base_url()?>js/barra.js"></script>
