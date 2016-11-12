<div class="row">
	<div class="col-md-12">
		<h1 class="titulo-paquete">Aprovecha nuestros Combos</h1>
		<div class="form_container">
			<div class="slideContainer">
				<?php foreach ($paquetes->result() as $row) {?>
					<div class="slide-p">
						<i class="fa fa-cart-plus" aria-hidden="true"></i>
						<a href="<?=base_url()?>productos/getPaquetes/<?=$row->id_paquete?>">
							<?=$row->nombre_paquete?>
						</a>
					</div>
				<?php }?>
			</div>
			<button class="left-p"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
			<button class="right-p"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</div>
	</div>
	<div class="col-md-12 caja-paquetes" style="height:100% !important;padding:30px;margin-top:50px">
		<div  class="paquete-imgs" style="width:30%;">
			<?php $i=0; foreach ($query->result() as $row) {?>
				<img data-cont="<?=$i?>" class="img-responsive img-paquete" src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($row->sku, 0,1)?>/<?=substr($row->sku, 1,1)?>/<?=$row->sku?>.jpg">
			<?php $i++;}?>
		</div>
		<div  class="paquete-imgs" style="align-items:stretch;width:45%">
			<?php $i=0;foreach ($query->result() as $row) {?>
				<div class="descripcion-paquete" data-cont="<?=$i?>">
					<p><?=$row->descripcion?></p>
					<p>Nom. de productos:<label> <?=$row->qty?></label></p>
					<a href="<?=base_url()?>productos/detallesproducto/<?=$row->id_articulo?>" class="btn btn-primary">Comprar/separado</a>
				</div>
			<?php $i++;}?>
		</div>
		<div class="detail-paquete">
			<p><?=' '.$nombre_paquete?></p>
			<p><?php echo ' $'.number_format($precio_descuento,2,'.',",");?></p>
			<p><?php echo ' $'.number_format($precio_paquete,2,'.',",");?></p>
			<!--a href="#" class="btn btn-info btn-block">Comprar Paquete</a-->
			<a style="left:10px;color:#cc5200" href="#" data-id="<?=$id_paquete?>" id="cotizacion-paquete"class="btn btn-default btn-block"><span class="glyphicon glyphicon-print"></span> Solicitar la compra</a>

		</div>
	</div>
</div>
<script src="<?=base_url()?>js/paquete.js"></script>