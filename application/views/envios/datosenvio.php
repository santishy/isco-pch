<div class="container">
	<div class="row" style="margin-top:10px;">
		<div class="col-sm-8">
			  <a href="#" id="facturar">Generar Factura <span class="glyphicon glyphicon-file"></span></a>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="col-md-8">
						<h3>Datos de Envio</h3>
					</div>
					<div class="col-md-4 text-right">
						<p id="datosEnvioAnterior" class="envio" data-ruta="<?=base_url()?>envios/obtenerUltimoEnvio">
							<span class="glyphicon glyphicon-send" ></span>
						</p>
					</div>
				</div>
				<div class="panel-body">
			 	
					<form class="form-horizontal" name="frm_envio" id="frm_envio" method="post" action="<?=base_url()?>envios/registroEnvio" >
						<div class="form-group">
							<label class="col-md-2 control-label">Nombre</label>
							<div class="col-md-10">
								<input type="text" id="nombre" name="nombre" class="form-control" value="<?=set_value('nombre')?>">
								<input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
								<input type="hidden" name="correo" id="correo" value="<?=$correo?>">
								<input type="hidden" name="id_cliente" id="id_cliente">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Paterno</label>
							<div class="col-md-4">
								<input type="text" name="apellido_paterno" id="ap_paterno" class="form-control" value="<?=set_value('apellido_paterno')?>">
							</div>	
							<label class="col-md-2 control-label">Materno</label>
							<div class="col-md-4">
								<input type="text" name="apellido_materno" id="ap_materno" class="form-control" value="<?=set_value('apellido_materno')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Calle</label>
							<div class="col-md-10">
								<input name="calle" id="calle" class="form-control" value="<?=set_value('calle')?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Int.</label>
							<div class="col-md-4">
								<input type="text" name="n_interior"  class="form-control" value="<?=set_value('n_interior')?>">
							</div>	
							<label class="col-md-2 control-label">Ext.</label>
							<div class="col-md-4">
								<input type="text" name="n_exterior" id="numero" class="form-control" value="<?=set_value('n_exterior')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Referencia</label>
							<div class="col-md-10">
								<input name="referencia" class="form-control" value="<?=set_value('referencia')?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Ciudad</label>
							<div class="col-md-4">
								<input type="text" name="ciudad" id="ciudad" class="form-control" value="<?=set_value('ciudad')?>">
							</div>	
							<label class="col-md-2 control-label">Estado</label>
							<div class="col-md-4">
								<input type="text" name="estado" id="estado" class="form-control" value="<?=set_value('estado')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Colonia</label>
							<div class="col-md-4">
								<input type="text" name="colonia" id="colonia"class="form-control" value="<?=set_value('colonia')?>">
							</div>	
							<label class="col-md-2 control-label">Telefono</label>
							<div class="col-md-4">
								<input type="text" name="telefono" class="form-control" value="<?=set_value('telefono')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">C.Postal</label>
							<div class="col-md-4">
								<input type="text" name="codigo_postal" id="cp" class="form-control" value="<?=set_value('codigo_postal')?>">
							</div>	
							<!--label class="col-md-3 control-label">Razon social</label>
							<div class="col-md-5">
								<input type="text" name="razon_social" class="form-control" value="<?=set_value('razon_social')?>">
							</div>	
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">RFC</label>
							<div class="col-md-5">
								<input type="text" name="rfc" class="form-control" value="<?=set_value('rfc')?>">
							</div-->	
							
							<div class="col-md-6 text-right">
								<button class="btn btn-primary btn-block">Guardar</button>
								<button type="button" id="btnLimpiar" class="btn btn-info">Limpiar</button>
							</div>	
						</div>
						<div class="form-group">
							<?=validation_errors()?>
						</div>
					</form>
				</div><!--panel-body-->
			</div><!--panel-default-->
		</div>
		<div class="col-md-4">
			<?php foreach($envios->result() as $row){?>
				<div class="panel panel-default">
				  	<div class="panel-body">
				  		<span class="last-envio" data-idenvio="<?=$row->id_cliente?>" data-ruta="<?=base_url()?>envios/obtenerUltimoEnvio">Escoger este envío</span>
				  		<hr class='hr-envio'>
				  	  	<div class="envios">
				  	  		<p><?php echo $row->nombre.' '.$row->apellido_paterno.' '.$row->apellido_materno?></p>
				  	  		<p><?=$row->calle?></p>
				  	  		<p><?=$row->ciudad?> (más)...</p>
				  	  	</div>
				 	</div>
				</div>
			<?php }?>
		</div>
	</div><!--row-->
</div><!--container-->
<div class="modal fade" id="modalFactura">
  <div id="rutaRemision" class="modal-dialog" data-verremision="<?=base_url()?>configuracion/verRemisiones">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #D6EBFF">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="cuerpoMG">
      	<div class="well">
	      	 <p class="form-control-static" style="font-weight:bold;">Facturar a:</p>
	      	<div class="radio">
	            <label style="margin-right:20px;font-size:1em;">
	        	    <input type="radio" name="opcion" id="opcion1" value="99">
	            	Persona Moral
	            </label>
	            <label style="margin-right:20px;font-size:1em;">
	                <input type="radio" name="opcion" id="opcion2" value="0">
	                Persona Fisica
	            </label>
	        </div>
    	</div>
         <form class="form-horizontal" name="frmFactura" id="frmFactura" method="post" action="<?=base_url()?>factura/addFactura" >
			<div class="form-group">
				<label class="col-md-2 control-label">Nombre</label>
				<div class="col-md-4">
					<input type="text" name="nombre" class="form-control" disabled>
				</div>	
				<label class="col-md-2 control-label">Razon Social</label>
				<div class="col-md-4">
					<input type="text" name="razon_social" class="form-control" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Paterno</label>
				<div class="col-md-4">
					<input type="text" name="ap_paterno" class="form-control" disabled>
				</div>	
				<label class="col-md-2 control-label">Materno</label>
				<div class="col-md-4">
					<input type="text" name="ap_materno" class="form-control" disabled>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Calle</label>
				<div class="col-md-10">
					<input name="calle" class="form-control" value="<?=set_value('calle')?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Número</label>
				<div class="col-md-4">
					<input type="text" name="numero" class="form-control" value="<?=set_value('apellido_paterno')?>">
				</div>	
				<label class="col-md-2 control-label">Colonia</label>
				<div class="col-md-4">
					<input type="text" name="colonia" class="form-control" value="<?=set_value('apellido_materno')?>">
				</div>	
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Ciudad</label>
				<div class="col-md-4">
					<input type="text" name="ciudad" class="form-control" value="<?=set_value('apellido_paterno')?>">
				</div>	
				<label class="col-md-2 control-label">Estado</label>
				<div class="col-md-4">
					<input type="text" name="estado" class="form-control" value="<?=set_value('apellido_materno')?>">
				</div>	
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">C.P.</label>
				<div class="col-md-4">
					<input type="text" name="cp" class="form-control" value="<?=set_value('apellido_paterno')?>">
				</div>	
				<label class="col-md-2 control-label">RFC</label>
				<div class="col-md-4">
					<input type="text" name="rfc" class="form-control" value="<?=set_value('apellido_paterno')?>">
				</div>	
			</div>
		</form>
      </div>
      <div class="modal-footer" style="background-color:  #D6EBFF">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnFactura" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.mo-->
<script>
	$(document).on('ready',function()
	{
		var datos=$(".last-envio");
		modalFactura=$("#modalFactura");
		modalFactura.modal({
		  keyboard: false,
		  show:false
		});
		$("#opcion1").on('click',opciones);
		$("#opcion2").on('click',opciones);
		$("#facturar").on('click',function(){
			modalFactura.modal('show');
		});
		$("#btnFactura").on('click',addFactura);
		$('#btnLimpiar').on('click',limpiar);
		datos.on('click',function(){
			var idenvio=$(this).data('idenvio');
			var ruta=$(".last-envio").data('ruta');
			$.ajax({
				url:ruta,
				beforeSend:function()	
				{
					//$('#frm_envio').find('input').attr('disabled','disabled');
				},
				dataType:'json',
				type:'post',
				data:{id_cliente:idenvio},
				success:function(resp)
				{
					if(!jQuery.isEmptyObject(resp))
					{
					//	$('#frm_envio').find('input').attr('disabled','enabled');
						jQuery.each(resp[0],function(i,valor)
						{
							$("#frm_envio input[name="+i+"]").val(valor);
							//$("#frm_envio input[name="+i+"]").attr('disabled','disabled');
						});
						$('#btnLimpiar').show();
					}
					
				},
				error:function(xhr,error,estado)
				{
					alert(xhr+" "+error+" "+estado);
				},
				complete:function()
				{
						
				}
			});//fin ajax
		});//fin envento
});
function limpiar()
{
	var id_usuario=$('#id_usuario').val();
	var correo=$('#correo').val();
	$("#frm_envio").find(':text').each(function(){
		$($(this)).val('');
	});
	$("#id_cliente").val('');
}
function opciones()
{
	if($("#opcion1").is(':checked'))
	{
		document.frmFactura.razon_social.disabled=false;
		document.frmFactura.nombre.disabled=true;
		document.frmFactura.ap_materno.disabled=true;
		document.frmFactura.ap_paterno.disabled=true;
	}
	else
		if($("#opcion2").is(':checked'))
		{
			document.frmFactura.nombre.disabled=false;
			document.frmFactura.ap_materno.disabled=false;
			document.frmFactura.ap_paterno.disabled=false;
			document.frmFactura.razon_social.disabled=true;
		}
}
function addFactura()
{
	var ruta=$("#frmFactura").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:$("#frmFactura").serialize(),
		dataType:'json',
		type:'post',
		success:function(resp)
		{
			if(resp.ban)
			{
				if(resp.id_factura)
				{
					jQuery.each($("#frmFactura").find(':input'),function (ind,valor){
						ele  = $(this);
						if($("#"+ele.attr('name')).length)
							$("#"+ele.attr('name')).val(ele.val())
					});
					$("#frmFactura").find(":input").val("");
					modalFactura.modal("hide");
				}
			}
			else
				alert('Completa los datos');
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function(){

		}
	})
}
</script>
