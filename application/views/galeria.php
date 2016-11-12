<?php $arr=$query->result_array();?>
		<div class="col-md-9">
			<h2 class="titulo-galeria">Galeria</h2>
			<div class="imgs-galeria">
				<?php $i=0; foreach ($query->result() as $row)
				{?>
					<div class="pic normal" data-index="<?=$i?>" data-id="<?=$row->id_articulo?>"><a href="#"><img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($row->sku, 0,1)?>/<?=substr($row->sku, 1,1)?>/<?=$row->sku?>.jpg" data-sku="<?=$row->sku?>"></a></div>
				<?php  $i=$i+1; }?>
			</div>
			<!--div class="container-gallery">
				<div class="fila">
					<div class="columna-1-3">
						<div class="small pic" data-index="0" data-id="<?=$arr[0]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[0]['sku'], 0,1)?>/<?=substr($arr[0]['sku'], 1,1)?>/<?=$arr[0]['sku']?>.jpg">
						</div>
						<div class="small pic" data-index="1" data-id="<?=$arr[1]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[1]['sku'], 0,1)?>/<?=substr($arr[1]['sku'], 1,1)?>/<?=$arr[1]['sku']?>.jpg">
						</div>
					</div>
					<div class="columna-2-3" >
						<div class="normal pic" data-index="2" data-id="<?=$arr[2]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[2]['sku'], 0,1)?>/<?=substr($arr[2]['sku'], 1,1)?>/<?=$arr[2]['sku']?>.jpg">
						</div>
					</div>
				</div>
				<div class="fila">
					<div class="columna-2-3">
						<div class="normal pic" data-index="3" data-id="<?=$arr[3]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[3]['sku'], 0,1)?>/<?=substr($arr[3]['sku'], 1,1)?>/<?=$arr[3]['sku']?>.jpg">
						</div>
						<div class="fila">
							<div class="columna-50">
								<div class="large pic" data-index="4" data-id="<?=$arr[4]['id_articulo']?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[4]['sku'], 0,1)?>/<?=substr($arr[4]['sku'], 1,1)?>/<?=$arr[4]['sku']?>.jpg">
								</div>

							</div>
							<div class="columna-50">
								<div class="small pic" data-index="5" data-id="<?=$arr[5]['id_articulo']?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[5]['sku'], 0,1)?>/<?=substr($arr[5]['sku'], 1,1)?>/<?=$arr[5]['sku']?>.jpg">
								</div>
								<div class="small pic" data-index="6" data-id="<?=$arr[6]['id_articulo']?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[6]['sku'], 0,1)?>/<?=substr($arr[6]['sku'], 1,1)?>/<?=$arr[6]['sku']?>.jpg">
								</div>

							</div>
						</div>
					</div>
					<div class="columna-1-3">
						<div class="small pic" data-index="7" data-id="<?=$arr[7]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[7]['sku'], 0,1)?>/<?=substr($arr[7]['sku'], 1,1)?>/<?=$arr[7]['sku']?>.jpg">
						</div>
						<div class="large pic" data-index="8" data-id="<?=$arr[8]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[8]['sku'], 0,1)?>/<?=substr($arr[8]['sku'], 1,1)?>/<?=$arr[8]['sku']?>.jpg">
						</div>
						<div class="small pic" data-index="9" data-id="<?=$arr[9]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[9]['sku'], 0,1)?>/<?=substr($arr[9]['sku'], 1,1)?>/<?=$arr[9]['sku']?>.jpg">
						</div>
					</div>
				</div>
				<div class="fila">
					<div class="col-1-3">
						<div class="large pic" data-index="10" data-id="<?=$arr[10]['id_articulo']?>">
							<img  src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[10]['sku'], 0,1)?>/<?=substr($arr[10]['sku'], 1,1)?>/<?=$arr[10]['sku']?>.jpg">
						</div>
						<div class="small pic" data-index="11" data-id="<?=$arr[11]['id_articulo']?>">
							<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[11]['sku'], 0,1)?>/<?=substr($arr[11]['sku'], 1,1)?>/<?=$arr[11]['sku']?>.jpg">
						</div>
					</div>
					<div class="col-2-3">
						<div class="fila">
							<div class="columna-50">
								<div class="small pic" data-index="12" data-id="<?=$arr[12]['id_articulo']?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[12]['sku'], 0,1)?>/<?=substr($arr[12]['sku'], 1,1)?>/<?=$arr[12]['sku']?>.jpg">
								</div>

							</div>
							<div class="columna-50">
								<div class="small pic" data-index="13" data-id="<?=$arr[13]['id_articulo']?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($arr[13]['sku'], 0,1)?>/<?=substr($arr[13]['sku'], 1,1)?>/<?=$arr[13]['sku']?>.jpg">
								</div>

							</div>
						</div>
						<div class="normal pic" data-index="14" data-id="<?=$arr[14]['id_articulo']?>">
							<img src="">
						</div>
					</div>
				</div>
			</div-->
		</div>
	</div>
</div>
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
