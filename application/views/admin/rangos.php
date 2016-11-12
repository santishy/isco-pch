<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary sombras">
				  <!-- Default panel contents -->
				<div class="panel-heading"><h3>EDITAR RANGOS</h3></div>
				 	<div class="panel-body">
				 	   <p><?=$paginacion?><?=validation_errors()?></p>
				 	   <p>
				 	   		<div class="col-md-3 col-md-offset-9">
					 	   		<form action="<?=base_url()?>configuracion/editarRangos" method="post">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon" style="background-color:#47A3DA;color:white">
												<span class="icon-search2" aria-hidden="true"></span>
											</div>
											<input type="text" name="categoria" class="form-control" placeholder="Marca/Seccion" required />
										</div>
									</div>
								</form>
							</div>
				 	   </p>
					</div>
				  <!-- Table -->
			    <table class="table table-striped tablaR">
			   		<thead>
			   			<th>Desde</th>
			   			<th>Hasta</th>
			   			<th>Utilidad</th>
			   			<th>Marca/Sec.</th>
			   			<th>Opciones</th>
			   		</thead>
			   		<tbody>
			   			<?php foreach($query->result() as $row){?>
			   			<tr>
			   				<form method="post" action="<?=base_url()?>configuracion/modificarRango" style="display:inline-block">
			   				<td>
								<input type="text" class="form-control" name="desde" value="<?=$row->desde?>">
								<input type="hidden" name="id_utilidad" value="<?=$row->id_utilidad?>">
							</td>
			   				<td>
			   					<input type="text" class="form-control" value="<?=$row->hasta?>" name="hasta">
			   				</td>
			   				<td>
			   					<input type="text" class="form-control" name="ut" value="<?php echo $row->ut;?>">
			   				</td>
			   				<td>
			   					<input type="text" class="form-control" name="categoria" value="<?=$row->categoria?>">
			   				</td>
			   				<td>
			   					<button class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
			   					</form>	
			   					<form action="<?=base_url()?>configuracion/eliminarRango" method="post" style="display:inline-block">
			   						<input type="hidden" name="id_utilidad" value="<?=$row->id_utilidad?>">
			   						<button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
			   					</form>
			   				</td>

			   			</tr>
			   			<?php }?>
			   		</tbody>
			    </table>
			    <center><?=$paginacion?></center>
			</div>
		</div>	
	</div>
</div>