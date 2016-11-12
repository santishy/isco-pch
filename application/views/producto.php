<div class="container ">
	<div class="row">
		<div class="col-md-12 ">
			<?php foreach($articulo->result() as $art)
			{ ?>
			<div class="col-md-12 col-xs-12">
				<div class="col-md-5 col-xs-12">
					<figure>
						<?php if($proveedor=="pchmayoreo") {?>
								<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg"
						 alt="imagen de producto"data-sku="<?=$art->sku?>" class="img-responsive" style=" margin: 0 auto;"/>
							<?php } else {?>

							 <img src="http://localhost/administrador/<?=$art->sku?>.jpg" alt="" data-sku="<?=$art->sku?>" alt="imagen de producto" class="img-responsive" style=" margin: 0 auto;"/><?php }?>

					</figure>
					<div id="lightgallery" style="overflow: overlay;border: 1px solid #ddd; border-radius: 4px;">

							<?php $cad=$art->sku;
							$temp=$cad;
							for($i=0;$i<3;$i++)
							{
								//echo 'https://s3.amazonaws.com/imgisco/'.$cad.'.jpg';

								if(file_exists('imagenes/'.$cad.'.jpg') ){?>

										<a href="http://imagenes.iscocomputadoras.com/<?=$cad?>.jpg" class="thumbnail col-md-3 col-sm-3 col-xs-3" style=" min-height: 72px; height: auto; max-height: 175px;" rel="http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg">
											<img class="img-responsive" src="http://imagenes.iscocomputadoras.com/<?=$cad?>.jpg">
										</a>
										<!--a href="https://s3.amazonaws.com/imgisco/<?=$cad?>.jpg" class="thumbnail col-md-3 col-sm-3 col-xs-3" style=" min-height: 72px; height: auto; max-height: 175px;">
											<img class="img-responsive" src="https://s3.amazonaws.com/imgisco/<?=$cad?>.jpg">
										</a-->

									<?php
									}
										$cad=addslashes($cad."\x20");
										//$cad.="+";
									?>
								<?php
							}
								?>
					</div>

				</div>

				<div class="col-md-7 col-xs-12 div-compra well">
					<div class="col-md-12">
						<p class="compra-tit"><?=$art->linea?></p>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<table id="t-sucursal" class="table table-striped ">
								<thead style="color:#01579B;font-weight:bold;">
									<th>Almacen</th>
									<th>Stock</th>
									<th>Opcion</th>
								</thead>
								<tbody>
									<?php for($i=0;$i<count($vec_almacen);$i++){?>
									<tr>
										<td>
											<label><?=$this->funciones->getAlmacen($vec_almacen[$i]['almacen']);?></label>
										</td>
										<td>
											<span class="badge"><?=$vec_almacen[$i]['existencia']?></span>
											<!--input type="text" value="<?=$vec_almacen[$i]['existencia']?>" name="existencias"  class="form-control" style="width:25%;" disabled-->
										</td>
										<td>
											<div class="radio" >
											  <label data-cant="<?=$vec_almacen[$i]['existencia']?>">
											    <input type="radio" name="almacen" class="optAlmacen" value="<?=$vec_almacen[$i]['almacen']?>" <?php if($vec_almacen[$i]['existencia']==0) echo 'disabled';?>>

											  </label>
											</div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-6  container-cant-first text-center">
						<p class="elige col-md-11 text-center" ><span class="glyphicon glyphicon-arrow-left"></span> Elige un almacen para tu compra</p>
						<p class="precioProd">$<?=$this->funciones->precio(0,$utilidad,$precio,$descuento)?></p>
						<p class="iva">El precio incluye IVA</p>

						<div class="col-md-12 div-cant">
							<form action="<?=base_url()?>cart/addCart" name="frmCart" method="post" id="frmCart">
								<div class="form-group">
									<div class="input-group">
										<input type="number" class="form-control" name="txtCantidad" value="1" min="1" max="<?=$existencia?>" id="txtCantidad" />
										<input type="hidden" name="id_articulo" value="<?=$art->id_articulo?>" />
										<input type="hidden" name="txtNombre" value="<?=$art->descripcion?>" />
										<input type="hidden" name="txtAlmacen" id="txtAlmacen" />
										<input type="hidden" name="txtSku" value="<?=$sku?>" />
										<input type="hidden" name="txtPrecio" value="<?=$costo?>" />
										<input type="hidden" name="moneda" value="<?=$moneda?>">
										<input type="hidden" name="txtExis" id="txtExis"value="" />
										<input type="hidden" name="proveedor"  value="<?=$proveedor?>"
										<span class="input-group-btn" >
											<button id="btnCart" class="btn btn-sm btn-primary" disabled><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" ></span>Agregar al carrito</button>
										</span>
									</div>
								</div>
							</form>
						</div>
						<p style="padding-bottom:15px"class="costo-envio">Costo de envio $99 pesos Enviamos a toda la República</p>
					</div>
					<div class="col-md-12">
						<h3>Descripción breve</h3>
						<div class="descripcion">
							<p><?=$art->descripcion?></p>
						</div>
						<div class="col-md-12">
							<p class="text-left" style="margin-top:15px">
								<div class="col-md-2 col-md-offset-10">
									<div class="fb-share-button" data-href="http://iscocomputadoras.com/productos/detallesproducto/<?=$art->id_articulo?>" data-layout="button" ></div>
									<!--a target="_blank" rel="image_src" href="http://www.facebook.com/sharer.php?s=100&p[title]=hola&p[summary]=RESUMEN&p[url]=iscocomputadoras.com&p[images][0]=http://www.pchmayoreo.com/media/catalog/product/<?=substr($art->sku, 0,1)?>/<?=substr($art->sku, 1,1)?>/<?=$art->sku?>.jpg">Facebook</a-->
								</div>
							</p>
						</div>
						<div class="col-md-7 col-xs-8">
							<p class="comment">Si desea ver mas a detalle vea la ficha tecnica (No todos los prods. contienen)</p>
						</div>
						<?php if(file_exists('imagenes/'.$temp.'.pdf') ){?>
						<div class="col-md-5 col-xs-4">
							<a style="color:#b30000;font-size:1.2em;font-weight:bold;display:inline-block;"href="http://imagenes.iscocomputadoras.com/<?=$art->sku?>.pdf" target="_blank">FICHA TECNICA <img src="<?=base_url()?>img/pdf.jpg" class="Responsive image" style="width:30px;vertical-align:top;"></a>
						</p>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
			<?php                                                      } ?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 div relacionados">
			<div class="container">
		  <div class="span8">
		    <h1>Te puede interesar</h1>
		    <div class="">
		    <div id="myCarousel" class="carousel slide">
		    <!-- Carousel items -->
		    <div class="carousel-inner">
		     	<div class="item active">
		        	<div class="row-fluid">
		          <?php for($i=0;$i<count($query);$i++)
		          { ?>
		          	<?php if ($i<4)
		          	{?>
		          	<div class="col-md-3 col-xs-6 col-sm-6 p-relacionado" >
						<div class="col-xs-12 col-sm-12 col-md-12 divArticles">
		          		<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>" >
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($query[$i]['sku'], 0,1)?>/<?=substr($query[$i]['sku'], 1,1)?>/<?=$query[$i]['sku']?>.jpg" alt="" data-sku="<?=$query[$i]['sku']?>" class="img-responsive thumb"/>
		          		</a>
		          		<p class="descripcion">
							<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>"><?=$query[$i]['descripcion']?></a>
						</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($query[$i]['descuento'] > 0)
								{ ?>
									<p class="spnCosto">$ <?=$this->funciones->precio($query[$i]['utilidad'],$query[$i]['ut'],$query[$i]['precio'],$query[$i]['descuento'])?></p>
								<?php
							}
							else
								 { ?>

									<p class="spnCosto">$ <?php $utilidad=$query[$i]['utilidad']; if($query[$i]['utilidad']==0)$utilidad=$query[$i]['ut']; echo number_format(ceil(($query[$i]['precio']+(($query[$i]['precio']*$utilidad)/100))*1.16),2,".",",")?></p>
								<?php } ?>
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
		          		</div>
		          	</div>
		        <?php
		         }
		        ?>
		        <?php
		          }
		        ?>
		         </div><!--/row-fluid-->
		    	</div><!--/item-->
		    	<div class="item ">
		        	<div class="row-fluid">
		          <?php
		          	for($i=0;$i<count($query);$i++)
		          		{ ?>
		          		<?php
		          			if ($i>3 && $i<8)
		          				{?>
		          	<div class="col-md-3 col-xs-6 col-sm-6 p-relacionado" >
						<div class="col-xs-12 col-sm-12 col-md-12 divArticles">
		          		<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>" >
		          			<?php if($proveedor=="pchmayoreo") {?>
								<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($query[$i]['sku'], 0,1)?>/<?=substr($query[$i]['sku'], 1,1)?>/<?=$query[$i]['sku']?>.jpg" alt="" data-sku="<?=$query[$i]['sku']?>" class="img-responsive thumb"/>
							<?php } else {?>

							 <img src="http://localhost/administrador/<?=$query[$i]['sku']?>.jpg" alt="" data-sku="<?=$query[$i]['sku']?>" class="img-responsive thumb"/><?php }?>
		          		</a>
		          		<p class="descripcion">
							<a href="<?=base_url()?>productos/detallesproducto/<?=$query[$i]['id_articulo']?>"><?=$query[$i]['descripcion']?></a>
						</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($query[$i]['descuento'] > 0)
								{ ?>
									<p class="spnCosto">$ <?=$this->funciones->precio($query[$i]['utilidad'],$query[$i]['ut'],$query[$i]['precio'],$query[$i]['descuento'])?></p>
								<?php } else
								 { ?>

									<p class="spnCosto">$ <?php $utilidad=$query[$i]['utilidad']; if($query[$i]['utilidad']==0)$utilidad=$query[$i]['ut']; echo number_format(ceil(($query[$i]['precio']+(($query[$i]['precio']*$utilidad)/100))*1.16),2,".",",")?></p>
								<?php } ?>
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
		          		</div>
		          	</div>
		        	<?php } ?>
		          	<?php } ?>
		         </div><!--/row-fluid-->
		    	</div><!--/item-->
		    </div><!--/carousel-inner-->
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
		    </div><!--/myCarousel-->
		    </div><!--/well-->
		  </div>
		</div>
	</div>
	</div>
	<hr>
	<div class="row container-especificaciones" id="especificaciones">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="table-responsive">
				<table class="table table-hover">
					<caption>
						ESPECIFICACIONES DEL PRODUCTO
					</caption>
					<thead>
						<tr>
							<th colspan="2" class="success">
								CARACTERÍSTICAS
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="success">
								Linea
							</td>
							<td>
								<?=$linea?>
							</td>
						</tr>
						<tr>
							<td class="success">
								Sección
							</td>
							<td>
								<?=$seccion?>
							</td>
						</tr>
						<tr>
							<td class="success">
								Marca
							</td>
							<td>
								<?=$marca?>
							</td>
						</tr>
						<tr>
							<td class="success">
								Serie
							</td>
							<td>
								<?=$serie?>
							</td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th colspan="2" class="info">
								MEDIDAS
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="info">Alto</td>
							<td><?=$alto?> cm</td>
						</tr>
						<tr>
							<td class="info">Ancho</td>
							<td><?=$ancho?> cm</td>
						</tr>
						<tr>
							<td class="info">Largo</td>
							<td><?=$largo?> cm</td>
						</tr>
						<tr>
							<td class="info">Peso</td>
							<td><?=$peso?> kg</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
