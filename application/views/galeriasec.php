<div class="col-md-9">
	<h3 class="titulo-galeria">Galeria</h3>
	<div class="imgs-galeria">
		<?php $i=0; foreach ($artsec->result() as $row)
		{?>
			<div class="pic normal" data-index="<?=$i?>" data-id="<?=$row->id_articulo?>"><a href="#"><img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($row->sku, 0,1)?>/<?=substr($row->sku, 1,1)?>/<?=$row->sku?>.jpg" data-sku="<?=$row->sku?>"></a></div>
		<?php  $i=$i+1; }?>
	</div>
</div>
</div></div>
<div class="modale" data-ruta="<?=base_url()?>articulos/getArticulo">
    <h3></h3>
    <div class="imagen-modal">
       	<div class="especificaciones"></div>
        <a id="atras" href="" data-src="" data-posicion="" data-direccion="0"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
        <a href=""><img src="" class="img-circle" id="imagen-modal"></a>
        <a id="adelante" href="" data-src="" data-posicion="" data-direccion="1"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
        <div class="ficha"></div>
    </div>
    <a class="cerrar" href="">Salir <span class="glyphicon glyphicon-remove-sign"></span></a>
</div>
