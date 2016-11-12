<script src="<?=base_url()?>js/envios.js"></script>
<div class="modal fade" id="modalGeneral" data-rutaf="<?=base_url()?>factura/getFactura">
  <div id="rutaRemision" class="modal-dialog" data-verremision="<?=base_url()?>configuracion/verRemisiones">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #D6EBFF">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="cuerpoMG">
         
      </div>
      <div class="modal-footer" style="background-color:  #D6EBFF">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modalFactura" data-rutaf="<?=base_url()?>factura/getFactura">
  <div id="rutaRemision" class="modal-dialog" data-verremision="<?=base_url()?>configuracion/verRemisiones">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Datos de Factura</h4>
      </div>
      <div class="modal-body">
         <form class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="nombre"></p>
            </div>
            <label class="col-sm-2 control-label">R. Social</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="razon_social"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">RFC</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="rfc"></p>
            </div>
            <label class="col-sm-2 control-label">C.P.</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="cp"></p>
            </div>
            
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Numero</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="numero"></p>
            </div>
            <label class="col-sm-2 control-label">Colonia</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="colonia"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Ciudad</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="ciudad"></p>
            </div>
            <label class="col-sm-2 control-label">Estado</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="estado"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Calle</label>
            <div class="col-sm-10">
              <p class="form-control-static" id="calle"></p>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="background-color:  #D6EBFF">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  