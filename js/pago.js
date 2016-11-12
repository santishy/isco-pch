$(document).on('ready',function(){

	$(function () {
        $('[data-toggle="tooltip"]').tooltip();
        
          });
        $("#modalCondiciones").modal({
            show:false,
            keyboard:false
        })
        $('#condiciones').on('click',function(){
            opcionesDeEnvio();
        }) 
        $("#link-condiciones").on('click',function(){
            $("#modalCondiciones").modal('show')});   
        $('#opcion1').on('click',opcionesDeEnvio);
        $("#opcion2").on('click',opcionesDeEnvio);
        $('#btnPaypal').on('click',function(e)
        {
           e.preventDefault();
           addPaypalAjax();
        })
    });
	function addPaypalAjax()
	{
		var ruta =$("#frmPaypal").attr('action');
		$.ajax({
			url:ruta,
			beforeSend:function(){
                $("#snipper").css('display','inline-block');
                 $("#container-paypal").slideUp();
                
            },
			type:'post',
			data:$("#frmPaypal").serialize(),
			dataType:'text',
			success:function(resp)
			{
				if(resp=="1" || resp==1)
					$("#frmPaypalWeb").submit();
				else
					if(resp==2 || resp=="2")
						alert('Se perdio la sesion, inicie de nuevo');
					else
						alert(resp)
			},
			complete:function()
			{
                $("#snipper").css('display','none');
               $("#container-paypal").slideDown();
			},
			error:function(xhr,error,estado)
			{
				alert(error+" "+estado+" "+estado);
			}
		});
	}
    function opcionesDeEnvio()
    {
        if(!$('#opcion1').is(':checked'))
                if(!$('#opcion2').is(':checked'))
                {
                    alert('Selecciona una opción');
                    $(this).attr('checked',false);
                }
                else
                    if($("#bandera").val()==1)
                    {
                        document.frmPagoReferencia.total.value=parseFloat(document.frmPagoReferencia.total.value)-99;
                        $("#costo_envio").val(0);
                        $('#tdTotal').text(document.frmPagoReferencia.total.value);
                       activarBotones();
                       $("#bandera").val('0');
                    }
                    else
                        activarBotones();
            else
                if($("#bandera").val()==0)
                {
                    document.frmPagoReferencia.total.value=parseFloat(document.frmPagoReferencia.total.value)+99;
                    $("#costo_envio").val(99);
                    var total=parseFloat($('#tdTotal').text());
                    $('#tdTotal').text(document.frmPagoReferencia.total.value);
                    $('#bandera').val('1');
                    activarBotones();
                }
                else 
                    activarBotones();
        if(!$("#condiciones").is(':checked'))
            desactivarBotones();
    }
    function activarBotones()
    {
        $('#btn-referencia').attr('disabled',false);
        $('#btnPaypal').attr('disabled',false);
    }
    function desactivarBotones()
    {
        $('#btn-referencia').attr('disabled',true);
        $('#btnPaypal').attr('disabled',true);
    }