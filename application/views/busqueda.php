<div class="container divProductosMarca">
	<div class="row">
		<div class="col-xs-9">
			<h3><?=$articulos->num_rows().' '?> resultados para: <?=$cadena?></h3>
			<?php 
				if($precio != '' && $preciof == '')
					echo '<p style="font-size:16px;"> Precio desde <strong>$'. $precio . '</strong></p>';
				else if($precio != '' && $preciof != '')
					echo '<p style="font-size:16px;"> Precios entre <strong>$'. $precio . ' y '.$preciof.' </strong></p>';
			?>
		</div>
		<div class="col-xs-3">
			<div>

				<h4 style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">Ordenar por precio</h4> 
				<?php if($this->uri->segment(2)=="palabraBusqueda"){?>
					<a href="<?=base_url()?>busqueda/deMayorMenor/<?=$cadena?>/<?=$id_marca?>/2/<?=$this->uri->segment(5)?>/2" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
					<span class="glyphicon glyphicon-menu-down"></span>
					<span class="glyphicon glyphicon-menu-up"></span>
					</a>
					<a href="<?=base_url()?>busqueda/deMayorMenor/<?=$cadena?>/<?=$id_marca?>/1/<?=$this->uri->segment(5)?>/2" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
					<span class="glyphicon glyphicon-menu-up"></span>
					<span class="glyphicon glyphicon-menu-down"></span>
					</a>
					<?php } else {?>
					<a href="<?=base_url()?>busqueda/mayorMenor/2/<?=$cadena?>" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
						<span class="glyphicon glyphicon-menu-down"></span>
						<span class="glyphicon glyphicon-menu-up"></span>
					</a>
					<a href="<?=base_url()?>busqueda/mayorMenor/1/<?=$cadena?>" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
						<span class="glyphicon glyphicon-menu-up"></span>
						<span class="glyphicon glyphicon-menu-down"></span>
					</a>
					<?php } ?>
						</div>
					</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<?php if(isset($listaMarca)){ ?>
			<div class="col-md-12">		
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				  <div class="panel-heading">Marcas</div>
				  <!-- List group -->
				  <ul class="list-group">
				  	<?php foreach($listaMarca->result() as $row){?>
				    <li class="list-group-item"><a href="<?=base_url()?>busqueda/palabraBusqueda/<?=$cadena?>/<?=$row->id_marca?>"><?=$row->marca?></a><span class="badge"><?=$row->nume?></span></li>
				    <?php }?>
				  </ul>
				</div>
			</div>
			<?php } ?>
			

			
			<div class="row">
				<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
					<div class="col-xs-12">
						
					</div>
				</form>
			</div> 
			
		</div>
		<div class="col-sm-9">
			<?php if($articulos->num_rows() > 0){?>
			<?php foreach($articulos->result() as $art) { ?>
			<article >
				<div class=" row articulomarca">
					<div class="col-xs-6 col-md-4 divImg">
						<figure>
							<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
								<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>									/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" class="img-responsive" alt="" data-sku="<?=$art->sku?>"  />
							</a>
						</figure>
					</div>
					<div class="col-xs-6 col-md-offset-1  col-md-6">
						<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
							<p class="pDesc descripcion"> <?=$art->descripcion?></p></a>
						<p class="marcap"><?=$art->marca?></p>
						<p class="sku">SKU: <strong><?=$art->sku?></strong></p>
						<p class="price"><strong>$<?php echo $this->funciones->precio($art->utilidad,$art->ut,$art->precio,$art->descuento); ?> </strong></p>
						
					</div>
				</div>
			</article>			
			<?php } ?>
			<?php } else { ?> 	
			<div class="col-md-12">
				<div class="ups figure">
									<b></b><b></b>
									<i></i>
								</div>
								
								</div>
								<p class="text-center">No hay resultados para la búsqueda</p>
								 <?php } ?>
								 <center><?php if(isset($paginacion)) echo $paginacion;?></center>
		</div>
	</div>
</div>