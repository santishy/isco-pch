<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary sombras">
				<div class="panel-heading"><h3>Descuentos</h3></div>
				<div class="panel-body">
			    	<form method='post' action='<?=base_url()?>configuracion/descuento'>
			    		<div class="form-group">
				    		<label>Secciones</label>
				    		<input name='seccion' id='seccion'class='form-control' type='text' placeholder='Introduce la seccion' data-ruta="<?=base_url()?>configuracion/likeSeccion">
				    		<input type="hidden" name="cont" value="<?=$cont?>">
			    		</div>
			    		<div class="input-group">
							<input type="text" class="form-control" placeholder="Ejemplo: 5" aria-label="Amount (to the nearest dollar)" name='descseccion'>
							<span class="input-group-addon">%</span>
						</div>
						<hr>
			    		<div class="form-group">
			    			<label>Marcas</label>
			    			<input name='marca' id='marca'class='form-control' type='text' placeholder='Introduce la marca' data-ruta="<?=base_url()?>configuracion/likeMarca">
			    		</div>
			    		<div class="input-group">
							<input type="text" class="form-control" placeholder="Ejemplo: 5" aria-label="Amount (to the nearest dollar)" name='descmarca'>
							<span class="input-group-addon">%</span>
						</div>
						<hr>
			    		<div class="form-group">
			    			<label>Sku</label>
			    			<input name='sku' id='sku' class='form-control' type='text' placeholder='Introduce el sku' data-ruta="<?=base_url()?>configuracion/likeSku">
			    		</div>
			    		<div class="input-group">
							<input type="text" class="form-control" placeholder="Ejemplo: 5" aria-label="Amount (to the nearest dollar)" name='descsku'>
							<span class="input-group-addon">%</span>
						</div>
						<hr>
			    		<div class="form-group">
			    			<button class='btn btn-primary'>Descuento</button>
			    		</div>
			    	</form>
				</div><!--panel-body-->
			</div><!--panel-defualt-->
		</div><!--col-md-4-->
		<div class="col-md-8">
			<?=$bandera?>
			<div class="panel panel-primary sombras">
				<div class="panel-heading"><h3>Utilidades</h3></div>
				<div class="panel-body">
					<div class="row">
						<form method="post" action="<?=base_url()?>configuracion/utilidadSeccion">
							<div class="col-md-4">
								<div class="form-group">
									<label>Secciones</label>
									<input name="seccion" id="seccionUtilidad" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Desde</label>
									<input name="desde" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Hasta</label>
									<input name="hasta" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Utilidad</label>
									<input name="utilidad" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<button class="btn btn-primary">Aplicar</button>
							</div>
							<div class="col-md-12">
								<div class="radio">
								  <label>
								    <input type="radio" name="prioridad" id="optionsRadios1" value="1" >
								    Aplicar prioridad de utilidad (esto modificara cual quier otra utilidad aplicada)
								  </label>
								</div>
							</div>
						</form>
					</div><!--row-->
					<hr>
					<div class="row">
						<form method="post"action="<?=base_url()?>configuracion/utilidadMarca">
							<div class="col-md-4">
								<div class="form-group">
									<label>Marcas</label>
									<input name="marca" id="marcaUtilidad" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Desde</label>
									<input name="desde" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Hasta</label>
									<input name="hasta" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Utilidad</label>
									<input name="utilidad" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<button class="btn btn-primary">Aplicar</button>
							</div>
							<div class="col-md-12">
								<div class="radio">
								  <label>
								    <input type="radio" name="prioridad" id="optionsRadios1" value="1">
								    Aplicar prioridad de utilidad (esto modificara cual quier otra utilidad aplicada)
								  </label>
								</div>
							</div>
						</form>
					</div><!--row-->
					<hr>
					<div class="row">
						<form method="post" action="<?=base_url()?>configuracion/utilidadSku">
							<div class="col-md-4">
								<div class="form-group">
									<label>Sku</label>
									<input name="sku" id="skuUtilidad" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Utilidad</label>
									<input name="utilidad" id="" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<button class="btn btn-primary">Aplicar</button>
							</div>
						</form>
					</div><!--row-->
				</div><!--panel-body-->
			</div><!--panel-defualt-->
		</div><!--col-md-4-->
	</div>
	<div class="row">
		<?php $this->load->view('admin/lista'); ?>
	</div><!--div-->
</div>
<script>
	$(document).on('ready',function()
	{
		console.log("hola")
		var rutaLikeSeccion=$("#seccion").data('ruta');
		var rutaLikeMarca=$("#marca").data('ruta');
		var rutaLikeSku=$("#sku").data('ruta');
		$('img').error(function(){
		$(this).unbind("error").attr('src',"http://iscocomputadoras.com/uploads/"+$(this).data('sku')+".jpg").error(function(){
		$(this).unbind("error").attr('src',"http://localhost/isco/img/broken.jpg");
			});
			});
		$("#seccion").autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url:rutaLikeSeccion ,
		      			dataType: "json",
		      			type:'post',
						data: {
						   seccion: request.term,
						},
						 success: function( data ) {
							 response( data);
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
		$("#marca").autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url:rutaLikeMarca ,
		      			dataType: "json",
		      			type:'post',
						data: {
						   marca: request.term,
						},
						 success: function( data ) {
							 response( data);
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
		$("#sku").autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url:rutaLikeSku ,
		      			dataType: "json",
		      			type:'post',
						data: {
						   sku: request.term,
						},
						 success: function( data ) {
							 response( data);
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
		//-------------------------
		$("#seccionUtilidad").autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url:rutaLikeSeccion ,
		      			dataType: "json",
		      			type:'post',
						data: {
						   seccion: request.term,
						},
						 success: function( data ) {
							 response( data);
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
		$("#marcaUtilidad").autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url:rutaLikeMarca ,
		      			dataType: "json",
		      			type:'post',
						data: {
						   marca: request.term,
						},
						 success: function( data ) {
							 response( data);
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
		$("#skuUtilidad").autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url:rutaLikeSku ,
		      			dataType: "json",
		      			type:'post',
						data: {
						   sku: request.term,
						},
						 success: function( data ) {
							 response( data);
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
	});
</script>