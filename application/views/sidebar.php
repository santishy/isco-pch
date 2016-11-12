<div class="row">
	<div class="container" style="background-color:white" >
		<div class="col-md-3">
			<h3 class="titulo-galeria">Categorias</h3>
			<ul class="lista-lateral">
				<?php foreach ($secciones->result() as $row) 
				{?>
					<li>
						<a href="<?=base_url()?>articulos/searchGaleria/<?=$row->id_seccion?>" ><?=$row->seccion?></a>
					</li>
				<?php }?>
			</ul>
		</div>