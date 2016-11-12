<div class="container">
	<div class="row">
		
  			<div class="panel panel-primary sombras">
			  <!-- Default panel contents -->
			  	<div class="panel-heading"><h3>Envios</h3></div>
			  	<div class="panel-body">
			    	<div class="col-md-4">
	 				<h3>Ver por estado</h3>
	 				<hr>
		 			<ul class="nav nav-pills nav-stacked">
		  				<li role="presentation">
		  					<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>configuracion/verEstado/pendiente">Pendiente</a>
		  				</li>
		  				<li role="presentation">
							<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>configuracion/verEstado/entregado">Entregado</a>
		  				</li>
		  				<li role="presentation">
							<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>configuracion/verEstado/cancelado">Cancelado</a>			
		  				</li>
					</ul>
					<?=validation_errors()?>
				</div>
				<div class="col-md-4">
					<h3>Busqueda</h3>
					<hr>
					<form action="<?=base_url()?>configuracion/buscar" method="post">
						<div class="input-group">
						  <span class="input-group-addon " id="basic-addon1 "><span class="glyphicon glyphicon-search"></span></span>
						  <input type="text" name="clave"class="form-control" placeholder="Buscar por nombre" aria-describedby="basic-addon1" required>
						</div>
					</form>
				</div>	
				<div class="col-md-4">
	 				<h3>Corte por fechas</h3>
	 				<hr>
	 				<form action="<?=base_url()?>configuracion/postFechas" method="post">
	 					<div class="form-group">
	 						<label>De:</label>
	 						<input type="date"name="inicio" id="inicio" class="form-control" value="" required>
	 					</div>
	 					<div class="form-group">	
	 						<label>Hasta:</label>
	 						<input type="date" name="fin" id="fin"class="form-control" value="" required>
	 					</div>
	 					<div class="form-group">
	 						<button class="btn btn-default">Realizar</button>
	 					</div>
	 				</form>
				</div>
			 	 </div>
			  	<!-- Table -->
			  	<table class="table table bordered tablaR">
			   		<THEAD>
			   			<TH>NOMBRE</TH>
			   			<TH>ESTADO</TH>
			   			
			   			<TH>TELEFONO</TH>
			   			<th>PAGO</th>
			   			<TH>OPCIONES</TH>
			   		</THEAD>
			   		<TBODY>
			   			<?PHP foreach($query->result() as $row){ ?>
			   				<tr>
			   					<td>
			   						<p><?=$row->nombre?></p>
			   						<p><?=$row->apellido_paterno?></p>
			   						
			   					</td>
			   					<td>
			   						<p><?=$row->estado?></p>
			   						<p><?=$row->ciudad?></p>
			   					</td>
			   					
			   					<td>
			   						<p><?=$row->telefono?></p>
			   					</td>
			   					<td>
			   						<p><?=$row->total?></p>
			   						<p><?=$row->fecha_pago?></p>
			   						<p><?=$row->tipo_pago?></p>
			   					</td>
			   					<td data-pago="<?=$row->id_pago?>" data-envio="<?=$row->id_cliente?>">
			   						<button type="button" class="btn btn-info btn-xs btnRemision">Rem.</button>
			   						<button type="button" class="btn btn-info btn-xs verFactura">Fac.</button>
			   						<a style="text-decoration:none" class="btn btn-info btn-xs" href="<?=base_url()?>envios/crearPDF/<?=$row->id_pago?>/<?=$row->id_cliente?>" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
			   						<hr>
			   						<div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    Cambiar E.
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									    <li><a href="<?=base_url()?>configuracion/cambiarEstado/pendiente/<?=$row->id_cliente?>/<?=$row->id_pago?>">Pendiente</a></li>
									    <li><a href="<?=base_url()?>configuracion/cambiarEstado/entregado/<?=$row->id_cliente?>/<?=$row->id_pago?>">Entregado</a></li>
									    <li><a href="<?=base_url()?>configuracion/cambiarEstado/cancelado/<?=$row->id_cliente?>/<?=$row->id_pago?>">Cancelado</a></li>
									  </ul>
									</div>
			   					</td>
			   				</tr>
			   			<?php } ?>
			   		</TBODY>
			  	</table>
			</div>
		</div><!--panel-->
	</div>
</div><!--container-->