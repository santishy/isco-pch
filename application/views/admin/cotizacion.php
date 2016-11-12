	<div class="col-md-12">
		<form action="<?=base_url()?>configuracion/busquedaLista" method="post"class="navbar-form navbar-right" role="search">
	        <div class="form-group">
	          <input type="text" name="cadena" class="form-control" placeholder="" required>
	        </div>
	        <button type="submit" class="btn btn-default">Buscar</button>
	     </form>
		<table class="table table-bordered tabla">
			<thead>
				<th>Sku</th>
				<th>Marca</th>
				<th>Seccion</th>
				<th>Precio</th>
				<th>Utilidad</th>
				<th>Descuento</th>
				<th>PrecioCliente</th>
				<th>Opciones</th>
			</thead>
			<tbody>
				<form action="<?=base_url()?>configuracion/listaUtilidad" method="post">
				<?php  $i=0; foreach($query->result() as $row){ ?>
				<tr>
					<td><?=$row->sku?></td>
					<td><?=$row->marca?></td>
					<td><?=$row->seccion?></td>
					<td><?=$row->precio?></td>
					<td><?php if(isset($row->utilidad) and $row->utilidad>0) echo $row->utilidad; else if ($row->ut!=0)echo $row->ut; else echo '0';?></td>
					<td><?=$row->descuento?></td>
					<td><?php $utilidad=$row->utilidad; if($row->utilidad==0)$utilidad=$row->ut; echo number_format(ceil(($row->precio+(($row->precio*$utilidad)/100))*(1.16)),2,".",","); ?></td>
					<td></td>
				</tr>
				<?php } ?>
				<tr><input type="hidden" name="ind" value="<?=$i?>"><td style="text-align:center" class="titulo" colspan="5"><?=$paginacion?></td><td></td><td></td><td></td></tr>
				</form>
			</tbody>
		</table>
	</div>
