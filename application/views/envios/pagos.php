<div class="container-fluid renglon">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="titulo">Productos Comprados</p>
                    <hr>
                    <table class="table table-bordered tabla">
                        <thead>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            <?php foreach ($this->cart->contents() as $item) 
                            {?>
                                <tr>
                                    <td><?=$item['name']?></td>
                                    <td><?=$item['price']?></td>
                                    <td><?=$item['qty']?></td>
                                    <td><?php echo ($item['price']*$item['qty']);?></td>
                                </tr>
                            <?php }?>
                            <tr><td class="font-size:.7em"colspan="2">Se incluye el costo del envio $99.00</td><td class="titulo">Total:</td><td style="font-weight:bold" id="tdTotal"><?='$'.number_format($this->cart->total(),2)?></td></tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div><!--div-col-md-4-->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a style="color:#cc5200" href="<?=base_url()?>envios/crearNota " target="_blank" class="btn btn-default"><span class="glyphicon glyphicon-print" ></span> Imprimir Cotizacion</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                   <p class="titulo"> Rellena los requisitos</p>
                    <hr>
                        <div class="radio">
                          <label>
                            <input type="radio" name="opcion" id="opcion1" value="99">
                            Pagar envio, el costo es de $ 99.00 (aplica restricciones).
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="opcion" id="opcion2" value="0">
                            Recoger en sucursal.
                          </label>
                        </div>
                        <a class="link" id="link-condiciones" href="#">Leer terminos y condiciones</a>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" id="condiciones" value="acepto">
                            <input type="hidden" id="bandera" name="bandera" value="0">
                            Acepto
                          </label>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p style="font-weight:bold;font-size:1.4em">Sitio en construcción, podra comprar en breve!</p>
                    <hr>
                    <!--<p class="titulo">Pagos</p>
                    <hr>
                    <div style="height:90px" class="col-md-12 pagos">
                        <p>Pago por Referencia</p>
                        <form action="<?=base_url()?>envios/agregarPago" method="post">
                            <input type="hidden" name="tipo_pago" value="referencia">
                            <input type="hidden" name="fecha_pago" value="<?=$fecha_pago?>">
                            <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                            <button class="btn btn-primary">Listo</button>
                        </form>
                    </div>
                    <div style="height:90px" class="col-md-12 pagos">
                        <p>Paypal</p>
                        <form action="<?=base_url()?>envios/agregarPago" method="post">
                            <input type="hidden" name="tipo_pago" value="paypal">
                            <input type="hidden" name="fecha_pago" value="<?=$fecha_pago?>">
                            <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                            <button class="btn btn-primary">Listo</button>
                        </form>   
                    </div>
                    <div style="height:90px" class="col-md-12 pagos">
                        <p>Oxxo</p>
                        <form action="<?=base_url()?>envios/agregarPago" method="post">
                            <input type="hidden" name="tipo_pago" value="oxxo">
                            <input type="hidden" name="fecha_pago" value="<?=$fecha_pago?>">
                            <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                            <button class="btn btn-primary">Listo</button>
                        </form>
                    </div>-->
                    
                    <div style="height:90px" class="col-md-12 pagos">
                        <p class="titulo-pago">
                            PAGO POR REFERENCIA
                        </p>
                        <form name="frmPagoReferencia" action="<?=base_url()?>envios/agregarPago" method="post" style="display:inline-block;margin-top:0;">
                            <input type="hidden" name="tipo_pago" value="referencia">
                            <input type="hidden" name="fecha_pago" value="<?=$fecha_pago?>">
                            <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                            <button id="btn-referencia" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Se le enviara un correo, con nuestras referencias bancarias. Realizar el pago en una de ellas." disabled>Listo</button>
                        </form>
                        <div class="figura" style="position:absolute;right:15px">
                            <img src="<?=base_url()?>/img/bancomer.jpg" class="img-responsive" alt="Responsive image">
                        </div>

                        <div class="figura"  style="position:absolute;right:22%">
                            <img src="<?=base_url()?>/img/scotiabank.jpg" class="img-responsive" alt="Responsive image">
                        </div>
                    </div>
                    <img id="snipper"style="display:none;width:50px;text-align:center" src="<?=base_url()?>img/sn.GIF">
                    <div id="container-paypal" style="height:90px" class="col-md-12 pagos">
                        <p>Paypal</p>
                        <form id="frmPaypalWeb" action="https://www.paypal.com/mx/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="upload" value="1">
                            <input type="hidden" name="business" value="iscosahuayo@gmail.com">
                            <?php $i=1; foreach($this->cart->contents() as $item){?>
                                <input type="hidden" name="item_name_<?=$i?>" value="<?=$item['name']?>">
                                <input type="hidden" name="item_number_<?=$i?>" value="<?=$item['id']?>">
                                <input type="hidden" name="amount_<?=$i?>" value="<?=$item['price']?>">
                                <input type="hidden" name="quantity_<?=$i?>" value="<?=$item['qty']?>">
                            <?php $i++;}?>
                            <input type="hidden" name="cn" value="Comentarios" />
                            <input id="costo_envio"type="hidden" name="shipping_1" value="" />
                        <input type="hidden" name="currency_code" value="MXN" />
                        <input type="hidden" name="lc" value="EU" />
                        <input type="hidden" name="bn" value="PP-BuyNowBF" />
                        <input type="hidden" name="rm" value="2">
                        <input type="hidden" name="return" value="<?=base_url()?>envios/paypal" />
                        <input type="hidden" name="cbt" value = "Volver a la tienda" >
                        <input type="hidden" name="cancel_return" value = "http://localhost/carrito_php/cancel.php" >
                        <input type="image" id="btnPaypal" src="https://www.paypal.com/en_US/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" disabled />
                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                        </form>
                        <form id="frmPaypal" action="<?=base_url()?>envios/agregarPagoPaypal">
                            <input type="hidden" name="tipo_pago" value="paypal">
                            <input type="hidden" name="fecha_pago" value="<?=$fecha_pago?>">
                            <input type="hidden" name="total" value="<?=$this->cart->total()?>">  
                        </form>   
                    </div>
                    <?php if($this->session->userdata('id_user')){?>
                    <div style="height:90px" class="col-md-12 pagos">
                        <p class="titulo-pago">PAGO DESDE ISCO</p>
                        <form action="<?=base_url()?>envios/agregarPago" method="post"  style="display:inline-block;margin-top:0;">
                            <input type="hidden" name="tipo_pago" value="isco">
                            <input type="hidden" name="fecha_pago" value="<?=$fecha_pago?>">
                            <input type="hidden" name="total" value="<?=$this->cart->total()?>">
                            <button class="btn btn-primary" >Listo</button>
                        </form>
                        <div class="figura" style="width:30%">
                             <img src="<?=base_url()?>/img/logotipo.png" class="img-responsive" alt="Responsive image">
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div><!--panel-->
        </div><!--col-md-4-->
    </div>
</div>
<div id="modalCondiciones" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Terminos y Condiciones</h4>
      </div>
      <div class="modal-body">
        
                    
                    <p class="titulo">  Condiciones de Compra MX </p>
                    <p>
                        Las presentes condiciones generales de contratación se aplican a todas las transacciones comerciales realizadas por la empresa ISCO COMPUTADORAS SA DE CV en adelante "El Vendedor", a traves de nuestras tienda virtual www.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com. Para más información sobre El Vendedor y nuestra Política de Privacidad consulte el Aviso Legal alojado al pie de cada página de esta tienda.
                        <p>Le rogamos que lea atentamente las presentes Condiciones de Compra y nuestra Polítca de Privacidad antes de realizar el pedido. Si usted no está de acuerdo con todas las Condiciones de Compra y con la Política de Privacidad, no debe realizar ningún pedido.</p>
                    </p>
                    <p class="titulo">1.Identificación</p>
                    <p>
                        El Vendedor es una empresa, con demominación social ISCO COMPUTADORAS SA DE CV, provista de RFC ICO080107337, con domicilio en Madero #101, Colonia Centro de la Ciudad de Sahuayo, Michoacán, México;  Cualquier comunicación se podrá dirigir al domicilio antes descrito, al teléfono 353 5327373 o a la dirección de correo electrónico ventas@grupoisco.com.
                    </p>
                    <p class="titulo">
                        1. Actividad
                    </p>
                    <p>
                        El Vendedor se dedica a la venta a distancia, preferentemente por internet, de Accesorios, Equipo de computo en todas sus modalidades, electrónica de consumo, consumibles, Software, sistemas administrativos, y todo lo referente a TI .
                    </p>
                    <p class="titulo">2. Contenidos e información suministrada en el sitio web</p>
                    <p>
                        El Vendedor se reserva el derecho a modificar la oferta comercial presentada en el sitio web (modificaciones sobre productos, precios, promociones y otras condiciones comerciales y de servicio) en cualquier momento. El Vendedor hace todos los esfuerzos dentro de sus medios para ofrecer la información contenida en el sitio web de forma veraz y sin errores tipográficos. En el caso que en algún momento se produjera algún error de este tipo, ajeno en todo momento a la voluntad del Vendedor, se procedería inmediatamente a su corrección. De existir un error tipográfico en alguno de los precios mostrados y algún cliente hubiera tomado una decisión de compra basada en dicho error, el Vendedor le comunicará al cliente dicho error y el cliente tendrá derecho a rescindir su compra sin penalizacion alguna.
                        Los contenidos del sitio web www.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com podrían, en ocasiones, mostrar información provisional sobre algunos productos. En el caso de que la información facilitada no correspondiera a las características del producto, el cliente tendrá derecho a rescindir su compra sin penalizacion alguna.
                        <p>
                        El Vendedor no es responsable ni directa ni indirectamente de ninguna de las informaciones, contenidos, afirmaciones y expresiones que contengan los productos comercializados enwww.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com; Dicha responsabilidad recae en todo momento en los fabricantes o distribuidores de los propios productos. El cliente entiende que el Vendedor es un mero intermediario entre él y el fabricante o distribuidor.
                        </p>

                    </p>
                    <p class="titulo">
                        3. Sistema de venta
                    </p>
                    <p>
                        Para realizar una compra, el usuario puede elegir entre diversas formas de hacernos llegar su pedido:
                        <ul>
                            <li>Internet a través del «carrito de la compra»</li>
                            <li>Internet a través del «pedido off-line»</li>
                            <li>Telefónicamente al teléfono de atención al cliente: (353) 5325959,5327373,5325500</li>
                            <li>Carta a la dirección indicada más arriba o correo electrónico ventas@grupoisco.com.</li>
                        </ul>
                    </p>
                    <p class="titulo">4. Impuestos aplicables</p>
                    <p>
                        Los precios de los productos expuestos en la página webwww.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com, incluyen el Impuesto al Valor Agregado (IVA) que, en su caso, sea procedente aplicar.
                        Las compras que vayan a ser entregadas dentro del territorio nacional estarán sujetas al IVA.
                    </p>
                    <p class="titulo">
                        5. Forma de pago
                    </p>
                    <p>
                        Al formular el pedido, el cliente puede elegir libremente abonar las compras que realice mediante tarjeta [ESPECIFICAR TIPOS DE TARJETA DE PAGO], PayPal, deposito bancario y deposito en tiendas Oxxo. En determinados casos y para prevenir posibles fraudes, el Vendedor se reserva la posibilidad de solicitar a un cliente una forma de pago concreta en el caso de que no se acredite fehacientemente la identidad del comprador. El sitio web utiliza técnicas de seguridad de la información generalmente aceptada en la industria, tales como firewalls, procedimientos de control de acceso y mecanismos criptográficos, todo ello con el objeto de evitar el acceso no autorizado de datos. Para lograr estos fines, el usuario/cliente acepta que el prestador obtenga datos para efecto de la correspondiente autenticación de los controles de acceso. Todo proceso de contratación o que conlleve la introducción de datos personales (salud, ideología,…) serán siempre transmitidos mediante protocolo de comunicación segura (HTTPS://) de tal forma que ningún tercero tenga acceso a la información transmitida vía electrónica.
                    </p>
                    <p class="titulo">
                        6. Forma, gastos y plazo de envío
                    </p>
                    <p>
                        El cliente podrá seleccionar la forma de envío de entre las posibles para su zona de envío. Deberá tener en cuenta que los plazos de entrega, la calidad del servicio, el punto de entrega y el costo será diferente para cada forma de transporte.
                        El Vendedor envía los pedidos a sus clientes a través de diferentes empresas de paqueteria de reconocido prestigio nacional e internacional. La fecha de entrega en el domicilio del cliente depende de la disponibilidad del producto escogido y de la zona de envío. Los plazos de transporte orientativos están disponibles en el apartado de nuestra web «Gastos de Envío». Antes de confirmar su pedido se le informará al cliente sobre los gastos de envío y plazos de transporte, ambos orientativos, que aplican a su pedido en concreto; no obstante, ambos podrán variar en función de las circunstancias concretas de cada pedido en especial, la mercancias enviadas viajan bajo la responsabilidad del cliente:
                        <ul>
                            <li>Los plazos de transporte se pueden ver alterados por incidencias extraordinarias en el transportista y por dificultades en la entrega de la mercancía.</li>
                            <li>Los gastos de envío que aparecen en la web al realizar el pedido son orientativos y se calculan en base a un peso estadístico de hasta 5 Kg. El Vendedor se reserva el derecho a alterar los costos de envío cuando el peso solicitado varíe en más/menos un 10% con respecto al peso medio mencionado. En caso de producirse una variación de precio, el Vendedor comunicará por medio de correo electrónico la variacion de precio al cliente y este ultimo podrá optar por anular su pedido sin que se le pueda imputar ningún cargo o penalizacion.</li>
                        </ul>
                    </p>
                    <p class="titulo">
                        7. Derechos del comprador y política de devoluciones
                    </p>
                    <p>
                        <p>El Vendedor no garantiza a sus clientes la disponibilidad ni el plazo de entrega de los productos que se ofrecen en su sitio web, excepto la de los productos en los que expresamente se cite una determinada garantía. El catálogo que se muestra es meramente orientativo ya que los fabricantes o distribuidores no comunican anticipadamente las existencias ni garantizan plazos de entrega. Esta situación impide al Vendedor la posibilidad de informar con exactitud a sus clientes sobre la disponibilidad de los productos, así como a garantizar un plazo de entrega determinado que, en todo caso, dependerá del tiempo que tarde el fabricante o el distribuidor en suministrar el producto.</p>
                        <p>El Vendedor garantiza a sus clientes la posibilidad de anular su pedido en cualquier momento y sin ningún coste siempre que la anulación se comunique antes de que el pedido haya sido puesto a disposición del transportista para su envío.</p>
                        <p>El cliente dispondrá de un plazo de siete días desde la recepción del pedido para realizar una devolución, en cuyo caso, el cliente deberá comunicarse con el Vendedor dentro del plazo estipulado por cualquier medio admitido. El pedido devuelto deberá ser entregado al Vendedor junto con la nota de compra y en su caso factura emitida, de manera personal o por paqueteria corriendo los gastos a cuenta del cliente.</p>
                        <p>El cliente podrá devolver cualquier artículo que haya comprado enwww.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com siempre y cuando el/los productos no hayan sido abiertos ni usados y conserven su envoltura o empaque original. En estos casos, el Vendedor, devolverá el dinero de la compra a través de un abono en una cuenta indicada por el cliente, mediante una transferencia bancaria.</p>
                        <p>Si un producto distinto al solicitado por el cliente fuera entregado por error del Vendedor, éste le será retirado y se le entregará el producto correcto sin ningún cargo adicional para el comprador.
                        Para cualquier incidencia relacionada con la devolución de artículos de nuestra tienda puede contactar con nuestro Departamento de Atención al cliente vía email: ventas@grupoisco.com IL] o por teléfono35 5325959.</p>
                    </p>
                    <p class="titulo">
                        8. Obligaciones del cliente
                    </p>
                    <p>
                        <p>El cliente de www.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com se compromete en todo momento a facilitar información veraz sobre los datos solicitados en los formularios de registro de usuario o de realización del pedido, y a mantenerlos actualizados en todo momento.</p>
                        <p>El cliente se compromete a aceptar todas las disposiciones y condiciones recogidas en las presentes Condiciones Generales de Compra, entendiendo que recogen la mejor voluntad de servicio posible para el tipo de actividad que desarrolla el Venedor.</p>
                        <p>Asimismo, se compromete a guardar de forma confidencial y con la máxima diligencia sus claves de acceso personal a nuestro sitio web.
                        El cliente se compromete a posibilitar la entrega del pedido solicitado facilitando una dirección de entrega en la que pueda ser entregado dentro del horario habitual de entrega de mercancías (de lunes a viernes de 10:00 a 13:30 y de 16:00 a 18:00). En caso de incumplimiento por parte del cliente de esta obligación, el Vendedor no tendrá ninguna responsabilidad sobre el retraso o imposibilidad de entrega del pedido solicitado por el cliente.</p>
                    </p>
                    <p class="titulo">  9. Legislación aplicable y jurisdicción competente</p>
                    <p>
                        Las compra-ventas realizadas en www.iscocomputadoras.com, www.iscocomputadoras.mx, www.grupoisco.com, se someten a las leyes de aplicables en el territorio nacional. En caso de cualquier conflicto o discrepancia, el fuero aplicable será el de los Juzgados o Tribunales locales.
                    </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <script src="<?=base_url()?>js/pago.js">
        
</script>