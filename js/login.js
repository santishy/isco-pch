$(document).on('ready',function()
{
	$("#modalLogin").modal
	({
	  keyboard: false,
	  show:false
	});
	$('#login').on('click',function(){
		$("#usuario").val("");
		$("#password").val("");
		$("#modalLogin").modal('show');
	});
	$("#btnLoginCliente").on('click',login);
});
function login()
{
	var ruta=$("#frmLoginCliente").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){
			$("#btnLoginCliente").attr('disabled',true);
		},
		type:'post',
		data:$("#frmLoginCliente").serialize(),
		dataType:'text',
		success:function(resp)
		{
			if(resp==1 || resp=="1")
			{
				$("#login").text($("#usuario").val());
				$("#modalLogin").modal('hide');
				$(".cerrarSesion").css('display','inline-block');
			}
			else
				alert('Verifique usuario y contraseña');
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{
			$("#btnLoginCliente").attr('disabled',false);
		}
	});
}