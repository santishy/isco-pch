$(document).on('ready',function(){
btnRemision=$('.btnRemision');
pago=null;
$('#modalGeneral').modal({
  keyboard: false,
  show:false
});
$('#modalFactura').modal({
  keyboard: false,
  show:false
});
$(".verFactura").on('click',function(){
	pago=$(this).parent().data('pago');
	getFactura()

	$("#modalFactura").modal('show');
});
btnRemision.on('click',verRemisiones);
});
//--funcion para ver remisiones con el id del pago
function verRemisiones()
{
	if($('#tabla').length)
		$('#tabla').remove();
	$('#modalGeneral').modal('show');
	var idpago=$(this).parent().data('pago');
	var ruta=$("#rutaRemision").data('verremision');
	console.log(idpago);
	$.ajax({
		url:ruta,
		beforeSend:function()
		{

		},
		type:'post',
		data:{id_pago:idpago},
		dataType:'json',
		success:function(resp)
		{
			if(!jQuery.isEmptyObject(resp))
			{

				$('<table />',{
					'class':'table table-bordered tablaR',
					'id':'tabla'
				}).appendTo('#cuerpoMG')
				$('<thead />').appendTo('#tabla');
				$('<tr/>').appendTo('#tabla').find('thead');
				$('<th />',{'text':'Remision'}).appendTo('#tabla thead ');
				$('<th />',{'text':'Status'}).appendTo('#tabla thead ');
				$('<th />',{'text':'Almacen'}).appendTo('#tabla thead ');
				$('<th />',{'text':'Moneda'}).appendTo('#tabla thead ');
				//$('<tbody />').appendTo('#tabla');
				for(i=0;i<resp.length;i++)
				{
					console.log(resp.length)
					//$('<tr />').appendTo('#tabla').find('tbody');

					$('#tabla tbody ').append('<tr><td>'+resp[i].remision+'</td><td>'+resp[i].estado_remision+'</td><td>'+resp[i].almacen+'</td><td>'+resp[i].moneda+'</td></tr>')
				//	$('#tabla tbody').append()
				//	$('#tabla tbody').append()
					//$('#tabla tbody').append('<tr></tr>');
					/*$('<td />',{'text':resp[i].remision}).appendTo('#tabla tr').find('tbody').find('tr');
					$('<td />',{'text':resp[i].estado_remision}).appendTo('#tabla').find('tbody').find('tr');
					$('<td />',{'text':resp[i].almacen}).appendTo('#tabla').find('tbody').find('tr');*/
				}
			}
			else
			{
				alert('No tiene remisiones');
			}
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
		});
}
function getFactura()
{
	$("#modalFactura").find('p').text("");
	var ruta=$("#modalGeneral").data('rutaf');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:{id_pago:pago},
		type:'post',
		dataType:'json',
		success:function(resp)
		{
			jQuery.each(resp[0],function(ind,valor){
				console.log(ind+" "+valor)
				$("#"+ind).text(valor);
			})
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
	});
}