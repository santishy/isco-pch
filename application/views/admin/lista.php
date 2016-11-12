	<div class="col-md-12">
			<div class="panel panel-primary sombras">
				<div class="panel-body">
					<div class="col-md-4">
						<p class="titulo">Lista para utilidades</p>
					</div>
					<div class="col-md-4 text-center">
						<?=$paginacion?>
					</div>
					<div class="col-md-4">
						<form action="<?=base_url()?>configuracion/busquedaLista" method="post"class="navbar-form navbar-right" role="search">
					        <div class="form-group">
					          <input type="text" name="cadena" class="form-control" placeholder="" required>
					        </div>
					        <button type="submit" class="btn btn-default">Buscar</button>
					     </form>
					</div>
				</div>
			<table id="Lista" class="table table-striped tablaR" data-rutamodpaq="<?=base_url()?>configuracion/updatePaquete"data-ruta="<?=base_url()?>configuracion/addPaquete">
				<thead>
					<th>IMG</th>
					<th>Sku</th>
					<th>Marca</th>
					<th>Seccion</th>
					<th>Precio</th>
					<th>Utilidad</th>
					<th>Descuento</th>
					<th>PrecioCliente</th>
					<th>Utilidad</th>
					<th>Paquete</th>

				</thead>
				<tbody>
					<form action="<?=base_url()?>configuracion/listaUtilidad" method="post">
					<?php  $i=0; foreach($query->result() as $row){ ?>
					<tr>
						<td style="width:7em"><img class="img-responsive thumb" src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($row->sku, 0,1)?>/<?=substr($row->sku, 1,1)?>/<?=$row->sku?>.jpg"></td>
						<td><?=$row->sku?></td>
						<td><?=$row->marca?></td>
						<td><?=$row->seccion?></td>
						<td><?=$row->precio?></td>
						<td><?php if(isset($row->utilidad) and $row->utilidad>0) echo $row->utilidad; else if ($row->ut!=0)echo $row->ut; else echo '0';?></td>
						<td><?=$row->descuento?></td>
						<td><?php $utilidad=$row->utilidad; if($row->utilidad==0)$utilidad=$row->ut; echo number_format(ceil(($row->precio+(($row->precio*$utilidad)/100))*(1.16)),2,".",","); ?></td>
						<td><input type="checkbox" value="1" name="item<?=$i?>"><input type="hidden" name="id_articulo<?=$i?>" value="<?=$row->id_articulo?>"></td>
						<td data-precio="<?=$row->precio?>" data-id="<?=$row->id_articulo?>" data-sku="<?=$row->sku?>" data-utilidad="<?=$row->ut?>" style="text-align:center;"><button type="button" class="btn btn-default btn-xs btnPaquete" style="color:#004d4d;border:2px solid #003333;"><span class="glyphicon glyphicon-gift"></span></button></td>
					</tr>
					<?php $i++; } ?>
					<tr><input type="hidden" name="ind" value="<?=$i?>"><td style="text-align:center" class="titulo" colspan="5"><?=$paginacion?></td><td>Utilidad</td><td><input class="form-control" type="text" name="utilidad"></td><td><button class="btn btn-primary">Aplicar</button></td></tr>
					</form>
				</tbody>
			</table>
		</div>
	</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalPaquete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Paquete</h4>
      </div>
      <div class="modal-body" style="display:flex;flex-direction:column" >
      	<table class="table table-striped">
      		<thead>
      			<th>IMGEN</th>
      			<TH>SKU</TH>
      			<TH>CANTIDAD</TH>
      			<TH>ACTUALIZAR</TH>
      		</thead>
      		<tbody id="tb_paquete">
      		</tbody>
      	</table>
      	<form id="frmPaquete" action="<?=base_url()?>configuracion/insertarPaquete" >
      		<div class="form-group col-md-6">
      			<label>Nombre</label>
      			<input name="nombre_paquete" id="nombre_paquete" class="form-control">
      		</div>
      		<div  class="form-group col-md-6">
      			<label>Precio</label>
      			<input name="precio_paquete" id="precio_paquete"class="form-control">
      		</div>
      		<div class="form-group col-md-6">
      			<label>Utilidad</label>
      			<input name="pte_utilidad" id="pte_utilidad" class="form-control">
      		</div>
      		<div  class="form-group col-md-6">
      			<label>Descuento</label>
      			<input name="pte_descuento" id="pte_descuento"class="form-control">
      		</div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnCrearPaquete" class="btn btn-primary">Crear Paquete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?=base_url()?>js/paquete.js"></script>
