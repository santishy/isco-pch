<div class="container contenedor">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
			  <div class="panel-body">
			  		<p>Ingresar</p>
			  		<hr>
			    	<form  action="<?=base_url()?>envios/ingresarUsuario" method="post">
			    		<div class="form-group">
			    			<label>Correo</label>
			    			<input name="correo" type="email" class="form-control" value="">
			    		</div>
			    		<div class="form-group">
			    			<label>Password</label>
			    			<input name="pass"type="password" class="form-control" value="">
			    		</div>
			    		<div class="form-group">
			    			<button class="btn btn-primary">Enviar</button>
			    			<p class="help-block"><div class='alert alert-danger' style="display:<?php if(empty($mensaje2)) echo 'none';?>"><?=$mensaje2?></div><?=validation_errors()?></p>
			    		</div>
			    	</form>
			  </div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
			  <div class="panel-body">
			  		<p>Registrarse</p>
			  		<hr>
			    	<form action="<?=base_url()?>envios/registrarUsuario" method="post">
			    		<div class="form-group">
			    			<label>Correo</label>
			    			<input type="email" name="correo" class="form-control" value="">
			    		</div>
			    		<div class="form-group">
			    			<label>Password</label>
			    			<input type="password" name="pass" class="form-control" value="">
			    		</div>
			    		<div class="form-group">
			    			<label>Repetir</label>
			    			<input type="password" name="confirmacionPass" class="form-control" value="">
			    		</div>
			    		<div class="form-group">
			    			<button class="btn btn-primary">Enviar</button>
			    			<p class="help-block"><?=validation_errors()?><div class='alert alert-danger' style="display:<?php if(empty($mensaje)) echo 'none';?>"><?=$mensaje?></div></p>
			    		</div>
			    	</form>
			  </div>
			</div>
		</div><!--div-col-md-3-->
		<div class="col-xs-6">
			<p class="text-center ptitulo">Tal vez te pueda interesar</p>
			<div class="col-xs-12 div Ofertas">
				<?php foreach($query->result() as $ar) { ?>
					<div class="col-xs-6" >
						<div class="col-sm-12 divArticles">
							<figure>
								<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>">
									<img src="http://www.pchmayoreo.com/media/catalog/product/<?=substr($ar->sku, 0,1)?>/<?=substr($ar->sku, 1,1)?>/<?=$ar->sku?>.jpg" alt="" class="img-responsive" />
								</a>
							</figure>
							<p class="descripcion">
								<a href="<?=base_url()?>productos/detallesproducto/<?=$ar->id_articulo?>"><?=$ar->descripcion?></a>
							</p>
							<div class="descripcion-costo">
								<!--<p><del>$ <?=$ar->precio?></del> </p>-->
								<?php if($ar->descuento > 0){ ?>
									<p class="spnCosto">$ <?=$ar->precio-(($ar->precio*$ar->descuento)/100).' '.$ar->moneda?></p>
								<?php } else { ?>
									<p class="spnCosto">$ <?=$ar->precio.' '.$ar->moneda?></p>
								<?php } ?>	
							</div>
							<!--<div>
								<a href="#"><button class="btn btn-primary btn-sm pull-right  btnCart">Añadir <span class="glyphicon glyphicon-shopping-cart white" style="color:white;" aria-hidden="true"></span></button></a>
							</div>-->
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>
	</div><!--row-->
</div><!--container-->