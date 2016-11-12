<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary">
      <div class="panel-heading">Correos de Cotizaciones</div>
        <div class="panel-body">
          <div class="col-md-offset-8 col-md-4">
            <form action="<?=base_url()?>configuracion/buscarCorreo" method="post" >
    					<div class="input-group">
    					  <span class="input-group-addon " id="basic-addon1 "><span class="glyphicon glyphicon-search"></span></span>
    					  <input type="search" name="cadena"class="form-control" placeholder="correo" aria-describedby="basic-addon1">
    					</div>
    				</form>
          </div>
        </div>
          <table class="table table-bordered">
            <thead>
              <th>
                Nombre
              </th>
              <th>
                Correo
              </th>
              <th>
                activo
              </th>
              <th>
                Op
              </th>
            </thead>
            <?php foreach ($query->result() as $row){ ?>
              <tr>
                <td>
                  <?=$row->nombre?>
                </td>
                <td>
                  <?=$row->correo?>
                </td>
                <td>
                  <?=$row->promo?>
                </td>
                <td>
                  <form  action="<?=base_url()?>configuracion/modificarPublicidad" method="post">
                    <input type="hidden" name="id_cotizacion" value="<?=$row->id_cotizacion?>">
                    <input type="hidden" name="promo" value="0">
                    <button class"btn btn-default btn-xs" name="button">Desactivar</button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </table>
      </div>
      <div class="well">
        <?=$paginacion?>
      </div>
  </div>
</div>
