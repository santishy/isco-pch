<input type="hidden" id="ruta" value="<?=base_url()?>" />   
<input type="hidden" id="rutaExterna" value="http://localhost/administrador/" />   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>js/menu.js"></script>
<script src="<?=base_url()?>js/thumbnail.js"></script>
<script src="<?=base_url()?>js/cart.js"></script>
<!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

<!-- lightgallery plugins -->

<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="<?=base_url()?>js/galeria/lightgallery.js"></script>
<script src="<?=base_url()?>js/galeria/lg-fullscreen.js"></script>
<script src="<?=base_url()?>js/galeria/lg-thumbnail.js"></script>
<script src="<?=base_url()?>js/galeria/lg-video.js"></script>
<script src="<?=base_url()?>js/galeria/lg-autoplay.js"></script>
<script src="<?=base_url()?>js/galeria/lg-zoom.js"></script>
<script src="<?=base_url()?>js/galeria/lg-hash.js"></script>
<script src="<?=base_url()?>js/galeria/lg-pager.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#lightgallery").lightGallery({
                thumbnail: true
            }); 
    });
</script>
<script>
        /*$(document).on('ready',function(){
              var dispositivo = navigator.userAgent.toLowerCase();

      if( dispositivo.search(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/) > -1 ){
        $('.descripcion').each(function(index)
                {
                    $(this).text($(this).text().substring(0,27)+'...');

                });
 }
            $(window).resize(function(){
                if($(document).width()<800)
                $('.descripcion').each(function(index)
                {
                    $(this).text($(this).text().substring(0,27)+'...');

                });
            })*/
            
            /*if($.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()))){
                $('.descripcion').each(function(index)
                {
                    $(this).text($(this).text().substring(0,27)+'...');
                });
            }*/
        /*});*/
    </script>
<script src="<?=base_url()?>js/<?=$file?>"></script>
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
      $('#lnkCart').on('click',function(e){
                e.stopPropagation();
                $('#modalCart').modal('show');
            });

    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".thumb").thumbs();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#aniimated-thumbnials').lightGallery({
            thumbnail:true
        }); 
    });
</script>
<script src="<?=base_url()?>js/search.js"></script>
<script src="<?=base_url()?>js/medida.js">
</script>