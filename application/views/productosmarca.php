<div class="container divProductosMarca">
<div class="row">
		<div class="col-md-9 col-sm-12 col-xs-12">
			<?php foreach($nombremarca->result() as $marca) { 
				if($ban == 1){

			?>

				<h1 class="h1-seccion">PRODUCTOS MARCA <?=$marca->marca?></h1> 
			<?php } else { ?>
				<h1 class="h1-seccion"><?=$marca->seccion?></h1>
			<?php }}
				if($precio != '' && $preciof == '')
					echo '<p style="font-size:16px;"> Precios desde <strong>$'. $precio . '</strong></p>';
				else if($precio != '' && $preciof != '')
					echo '<p style="font-size:16px;"> Precios entre <strong>$'. $precio . ' y '.$preciof.' </strong></p>';

			?>	
		</div>
		<div class="col-md-3 col-sm-12 col-xs-12">
			<h4 style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">Ordenar por precio</h4> 
			<div class="row" style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">
				<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
					<div class="col-xs-12">
						<div class="form-group">
							<?php if($this->uri->segment(4)=='linea'){ ?>
								<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/linea/<?=$this->uri->segment(5)?>/2" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
									<span class="glyphicon glyphicon-menu-down"></span>
									<span class="glyphicon glyphicon-menu-up"></span>
								</a>
								<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/linea/<?=$this->uri->segment(5)?>/1" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
									<span class="glyphicon glyphicon-menu-up"></span>
									<span class="glyphicon glyphicon-menu-down"></span>
								</a>	
							<?php } else 
									
									if($this->uri->segment(2)=='marcaSeccion')
									{
										
									?>
									<a href="<?=base_url()?><?=$this->uri->segment(1)?>/deMayorMenor/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/2/<?=$this->uri->segment(6)?>/1" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
										<span class="glyphicon glyphicon-menu-down"></span>
										<span class="glyphicon glyphicon-menu-up"></span>
									</a>
									
									<a href="<?=base_url()?><?=$this->uri->segment(1)?>/deMayorMenor/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/1/<?=$this->uri->segment(6)?>/1" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
										<span class="glyphicon glyphicon-menu-up"></span>
										<span class="glyphicon glyphicon-menu-down"></span>
									</a>

								<?php } else { ?>
									<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/2" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
										<span class="glyphicon glyphicon-menu-down"></span>
										<span class="glyphicon glyphicon-menu-up"></span>
									</a>
									<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/1" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
										<span class="glyphicon glyphicon-menu-up"></span>
										<span class="glyphicon glyphicon-menu-down"></span>
									</a>
							<?php }?>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>
	
	
	<hr>
	<div class="row" style="display:none">
		<div class="col-sm-3 busqueda-rango" >
			<span id="prueba" class="glyphicon glyphicon-usd"></span>
			<div class="panel panel-default">
				<div class="panel-body">
					<h3>Búsqueda por precio</h3> <hr>
						<div class="row">
							<form action="<?=base_url()?>articulos/precio" method="post" id="frmRange">
								<div class="col-sm-12 col-xs-12">
									<div class="form-group">
										<div class="input-group">									 		
								      		<input type="number" min="0" name="txtRang" id="txtRang" class="form-control" placeholder="Desde" required />
											<input type="hidden" name="linea" value="<?=$linea?>">
								      		<span class="input-group-btn">
								        		<button class="btn btn-primary" id="btnSearchQty">Ir</button>
								      		</span>
								    	</div>										
									</div>								
								</div>
								<?php foreach($nombremarca->result() as $marca) { 
									if($ban == 1){
								?>

									<input type="hidden" name="txtId" value="<?=$marca->id_marca?>">
								<?php } else { ?>
									<input type="hidden" name="txtId" value="<?=$marca->id_seccion?>">
								<?php }}?>	
								<input type="hidden" name="txtBan" value="<?=$ban?>">
								
							</form>
						</div> 
						<hr style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">
						<h4 style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">Ordenar por precio</h4> 
						<div class="row" style="display:<?php if($this->uri->segment(2)=='rango' || $this->uri->segment(2)=='precio') echo 'none';?>">
							<form action="<?=base_url()?>busqueda/precio" method="post" id="frmRange">
								<div class="col-xs-12">
									<div class="form-group">
										<?php if($this->uri->segment(4)=='linea'){ ?>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/linea/<?=$this->uri->segment(5)?>/2" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
												<span class="glyphicon glyphicon-menu-down"></span>
												<span class="glyphicon glyphicon-menu-up"></span>
											</a>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/linea/<?=$this->uri->segment(5)?>/1" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
												<span class="glyphicon glyphicon-menu-up"></span>
												<span class="glyphicon glyphicon-menu-down"></span>
											</a>	
										<?php } else {?>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/2" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de menor a mayor">
												<span class="glyphicon glyphicon-menu-down"></span>
												<span class="glyphicon glyphicon-menu-up"></span>
											</a>
											<a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>/1" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="de mayor a menor">
												<span class="glyphicon glyphicon-menu-up"></span>
												<span class="glyphicon glyphicon-menu-down"></span>
											</a>
										<?php }?>
									</div>
								</div>
							</form>
						</div> 
						<hr>
						<div class="row">
							<div class="col-xs-12">
								<h4>Por rango de precios</h4>
							</div>
							<form action="<?=base_url()?>articulos/rango" method="post" id="frmRangeSearch">
								<div class="col-sm-12 col-xs-12">
									<div class="form-group">
										<div class="input-group">									 		
								      		<input type="number" min="0" name="txtRange1" id="txtRange1" placeholder="Desde" class="form-control" required style="width: 50%;"/>
								      		<input type="number" min="0" name="txtRange2" id="txtRange2" placeholder="Hasta" class="form-control" required style="width: 50%;"/>						
											<input type="hidden" name="txtban" value="<?=$ban?>">
											<input type="hidden" name="linea" value="<?=$linea?>">
								      		<span class="input-group-btn">
								        		<button class="btn btn-primary" id="btnSearchRange">Ir</button>
								      		</span>
								    	</div>	
										
									</div>
								</div>								
								<?php foreach($nombremarca->result() as $marca) { 
									if($ban == 1){
								?>
									<input type="hidden" name="txtIdArt" value="<?=$marca->id_marca?>">
								<?php } else { ?>
									<input type="hidden" name="txtIdArt" value="<?=$marca->id_seccion?>">
								<?php }}?>	
								<input type="hidden" name="txtBan" value="<?=$ban?>">
								<!--<div class="col-sm-2 col-xs-2">
									<div class="form-group" style="margin-top:25px;">
										<button class="btn btn-primary btn-sm" id="btnSearchRange">Ir</button>
									</div>
								</div>-->
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 categorias">
			<div class="col-md-11">		
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				  <div class="panel-heading">Categorias</div>
				  <!-- List group -->
				  <ul class="list-group">
				  	<?php foreach($categorias->result() as $row){?>
				    <li class="list-group-item"><a href="<?=base_url()?>articulos/<?php if($ban==2) echo 'secciones'; else echo 'marcas';?>/<?=$id?>/linea/<?=$row->id_linea?>"><?=$row->linea?></a><span class="badge"><?=$row->nume?></span></li>
				    <?php }?>
				  </ul>
				</div>
			</div>
			<?php if(isset($marcaSeccion)){ ?>
			<div class="col-md-11">		
				<div class="panel panel-primary">
				  <!-- Default panel contents -->
				  <div class="panel-heading">Marcas</div>
				  <!-- List group -->
				  <ul class="list-group">
				  	<?php foreach($marcaSeccion->result() as $row){?>
				    <li class="list-group-item"><a href="<?=base_url()?>busqueda/marcaSeccion/<?=$id?>/<?=$row->id_marca?>"><?=$row->marca?></a><span class="badge"><?=$row->nume?></span></li>
				    <?php }?>
				  </ul>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="col-md-8">
			<?php if($artmarca->num_rows() > 0){?>
				<?php foreach($artmarca->result() as $art) { ?>
				<article >
					<div class=" row articulomarca">
						<div class="col-xs-6 col-md-4 divImg">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg" class="img-responsive" alt="" data-sku="<?=$art->sku?>"  />
								</a>
							</figure>
						</div>
						<div class="col-xs-6 col-md-offset-1  col-md-7" style="height:100% !important">
							<a href="<?=base_url()?>productos/detallesproducto/<?=$art->id_articulo?>">
								<p class="pDesc descripcion"> <?=$art->descripcion?></p></a>
							<p class="marcap"><?=$art->marca?></p>
							<p class="sku">SKU: <strong><?=$art->sku?></strong></p>
							
							<p class="price"><strong style="<?php if($art->descuento>0) echo 'text-decoration:line-through';?>">$<?php echo $this->funciones->precio($art->utilidad,$art->ut,$art->precio,0);?> </strong></p>
							<?php if($art->descuento>0) {?>
								<p class="precioDescuento">$<?php echo $this->funciones->precio($art->utilidad,$art->ut,$art->precio,$art->descuento);?></p>
							<?php }?>
						</div>
						
					</div>
				</article>
				<?php } ?>
			<?php } else { ?> 	<div class="col-md-12">
								<div class="ups figure">
									<b></b><b></b>
									<i></i>
								</div>
								
								</div>
								<p class="text-center">No hay resultados para la búsqueda</p>
								 <?php } ?>
		</div>
	</div>
	<div class="text-center">

		<nav><?=$paginacion?></nav>
	</div>
</div>
<script src="<?=base_url()?>js/busqueda.js"></script>