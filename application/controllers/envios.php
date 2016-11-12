<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Envios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelEnvios');
		$this->load->model('ModelArticulo');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('cart');
		$this->load->library('email');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	public function registrarUsuario()
	{
		$this->form_validation->set_rules('correo','Correo','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|md5');
		$this->form_validation->set_rules('confirmacionPass','Password','required|md5');
		if($this->form_validation->run()===false)
		{
			$data['mensaje']="";
			$data['mensaje2']="";
			$this->vistaRegistroUsuario($data);
		}
		else
		{
			$data['correo']=$this->input->post('correo');
			$data['pass']=$this->input->post('pass');
			$confirmacionPass=$this->input->post('confirmacionPass');
			$query=$this->ModelEnvios->buscarUsuario($data['correo']);
			if($query->num_rows()==0)
			{
				if($data['pass']==$confirmacionPass)
				{
					$query=$this->ModelEnvios->registrarUsuario($data);
					$this->vistaRegistroEnvio($data);
				}
				else
				{
					$vec['mensaje']="Confirme su password";
					$vec['mensaje2']="";
					$this->vistaRegistroUsuario($vec);
				}
			}
			else
			{
				$vec['mensaje']="Ya existe ese usuario";
				$this->vistaRegistroUsuario($vec);
			}
		}
	}
	public function vistaRegistroEnvio($data)
	{
		if(!$this->session->userdata('id_usuario'))
		{
			$query=$this->ModelEnvios->buscarUsuario($data['correo']);
			foreach ($query->result() as $row)
			{
				$data['id_usuario']=$row->id_usuario;
			}
		}
		else
			$data['id_usuario']=$this->session->userdata('id_usuario');
		$this->vistaPrincipal();
		$this->load->view('includes/scripts');
		$data['envios']=$this->ModelEnvios->getLastSends($data['id_usuario']);
		$this->load->view('envios/datosenvio',$data);
		$this->vistaFooter();
	}
	public function ingresarUsuario()
	{
		$this->form_validation->set_rules('correo','Correo','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|md5');
		if($this->form_validation->run()===false)
		{
			$data['mensaje']="";
			$this->vistaRegistroUsuario($data);
		}
		else
		{
			$data['correo']=$this->input->post('correo');
			$data['pass']=$this->input->post('pass');
			$query=$this->ModelEnvios->comprobarUsuario($data['correo'],$data['pass']);
			if($query->num_rows()>0)
			{
				$this->vistaRegistroEnvio($data);
			}
			else
				{
					$data['mensaje2']="Compruebe sus datos";
					$this->vistaRegistroUsuario($data);
				}
		}
	}
	public function vistaRegistroUsuario($data)
	{
		if($this->session->userdata('id_usuario'))
		{
			//redirect(base_url().'envios/vistaRegistroEnvio');
		$query=$this->ModelEnvios->getUsuario($this->session->userdata('id_usuario'));
		$row=$query->row_array();
		$this->vistaRegistroEnvio($row);
		}
		else
		{
		$data=$this->generarAleatorios(4);
		$consulta['query']=$this->consultaAleatoria($data);
		$this->vistaPrincipal();
		$this->load->view('envios/usuario',$consulta); //vista para agregar o loguearte e ir a llenar los datos
		$this->vistaFooter();
		}
	}
	function consultaAleatoria($id)
	{
		$cadena="select *from articulos a join detinvart ea on a.id_articulo=ea.id_articulo join inventario i on i.id_inventario=ea.id_inventario join marcas m on m.id_marca=a.id_marca join lineas l on l.id_linea=a.id_linea join secciones s on s.id_seccion=a.id_seccion where ";
		for($i=0;$i<count($id);$i++)
		{
			$cadena.=' a.id_articulo='.$id[$i];
			if($i==(count($id)-1))
				$cadena.=';';
			else
				$cadena.=' or';
		}
		$query=$this->ModelArticulo->consultaAleatoria($cadena);
		return $query;
	}
	public function generarAleatorios($n)
	{
		$max=$this->ModelArticulo->numRows();
		for($i=0;$i<$n;$i++)
		{
			$num[$i]=rand(1,$max);
		}
		return $num;
	}
	public function registroEnvio()
	{
		$this->form_validation->set_rules('nombre','Nombre','required|trim');
		$this->form_validation->set_rules('apellido_paterno','Apellido Paterno','required|trim');
		$this->form_validation->set_rules('apellido_materno','Apellido Materno','required|trim');
		$this->form_validation->set_rules('calle','Calle','required|trim');
		$this->form_validation->set_rules('n_interior','Número Interior','required|trim');
		$this->form_validation->set_rules('n_exterior','Número Exterior','required|trim');
		$this->form_validation->set_rules('referencia','Referencia','required|trim');
		$this->form_validation->set_rules('ciudad','Ciudad','required|trim');
		$this->form_validation->set_rules('estado','','required|trim');
		$this->form_validation->set_rules('colonia','Colonia','required|trim');
		$this->form_validation->set_rules('telefono','Telefono','required|trim');
		$this->form_validation->set_rules('codigo_postal','Codigo Postal','required|trim');
		$this->form_validation->set_rules('razon_social','Razon Social','trim');
		$this->form_validation->set_rules('rfc','RFC','trim');
		if($this->form_validation->run()===false)
		{
			$data['correo']=$this->input->post('correo');
			$data['id_usuario']=$this->input->post('id_usuario');
			$this->vistaRegistroEnvio($data);
			$data=$this->input->post();

		}
		else
		{
			$data=$this->input->post();
			$correo=$data['correo'];
			unset($data['correo']);
			if(!empty($data['id_cliente']) )
			{
				$id_cliente=$data['id_cliente'];
			}
			else
			{
				$this->ModelEnvios->registroEnvio($data);
				$query=$this->ModelEnvios->obtenerUltimoEnvio($correo);
				foreach ($query->result() as $row)
				{
					$id_cliente=$row->id_cliente;

				}
			}
			$this->session->set_userdata('id_cliente',$id_cliente);
			$this->agregarDetEnvArt();
			$this->vistaPagos();
		}
	}
	function ordenamiento()
	{
		$data[0]=array('almacen'=>5,'moneda'=>'usd');
		$data[1]=array('almacen'=>3,'moneda'=>'mn');
		$data[2]=array('almacen'=>1,'moneda'=>'mn');
		$data[3]=array('almacen'=>4,'moneda'=>'usd');
		$data[4]=array('almacen'=>2,'moneda'=>'mn');
		print_r($data);
		//echo '<br>';
		$arr=$this->quicksort($data,0,count($data)-1);
		print_r($arr);
	}
	function quicksort($data,$izq,$der)
	{
		if($izq>=$der)
			return $data;
		 $i=$izq;$d=$der;
		if($izq!=$der)
		{
			$aux=0;
			$pivote=$izq;
			while($izq!=$der)
			{
				while($data[$der]['almacen']>=$data[$pivote]['almacen'] && $izq<$der)
					$der--;
				while($data[$izq]['almacen']<$data[$pivote]['almacen'] && $izq<$der)
					$izq++;
				if($der!=$izq)
				{
					$aux=$data[$der];
					$data[$der]=$data[$izq];
					$data[$izq]=$aux;
				}
				if($der==$izq)
				{
					$data=$this->quicksort($data,$i,$izq-1);
					$data=$this->quicksort($data,$izq+1,$d);
				}
			}
		}
		else
			return $data;
		return $data;
	}
	#funcion ajax, para sacar el ultimo envio del cliente
	function obtenerUltimoEnvio()
	{
		$id_cliente=$this->input->post('id_cliente');
		$data=array();
		$query=$this->ModelEnvios->obtenerEnvio($id_cliente);
		echo json_encode($query->result());
	}
	function ordenarArticulos()
	{
		$i=0;
		$j=0;
		$res=0;

		foreach ($this->cart->contents() as $item)
		{
			if($item['moneda']=="MN" && $item['proveedor']=="pchmayoreo")
			{

				$mn[$i++]=array('almacen'=>$item['almacen'],'moneda'=>$item['moneda'],'strSku'=>$item['sku'],'iCantidad'=>$item['qty']);
			}
			else
				if($item['proveedor']=="pchmayoreo")
					$usd[$j++]=array('almacen'=>$item['almacen'],'moneda'=>$item['moneda'],'strSku'=>$item['sku'],'iCantidad'=>$item['qty']);
		}
		if(isset($mn))
		{
			$mn=$this->quicksort($mn,0,count($mn)-1);
			$res=$this->procesoApartado($mn);
		}
		if(isset($usd))
		{
			$usd=$this->quicksort($usd,0,count($usd)-1);
			$res=$this->procesoApartado($usd);
		}
		return $res;
	}

	function procesoApartado($data)
	{
	 	$folio=array();
		$i=0;
		$carrito=array();
		$j=0;
		$temp=$data[0]['almacen'];
		$l=0;
		$t=0;
		while($i<count($data))
		{
			while($j<count($data))
			{
				if($temp==$data[$j]['almacen'])
				{
					$moneda=$data[$j]['moneda'];
					$almacen=$data[$j]['almacen'];
					$carrito[]=array('strSku' => $data[$j]['strSku'],'iCantidad'=>$data[$j]['iCantidad'] );
					$ban=true;
				}
				else
				{
					$ban=false;
					$temp=$data[$j]['almacen'];
					$t=$j;
					$j=count($data);
				}
				if($ban)
				{
					$j++;
					$i=$j;
					$t=$i;
				}
			}
			$j=$t;
			if(!empty($carrito) )
				{
					$vec[$l++]=array("carrito"=>$carrito,"moneda"=>$moneda,"almacen"=>$almacen);
					$carrito= array();
				}

		}

		for($i=0;$i<count($vec);$i++)
		{

			$folio=$this->apartado($vec[$i]['almacen'],$vec[$i]['moneda'],$vec[$i]['carrito']);
			//$folio['estatus']=1;
			print_r($folio);
			$campos['moneda']=$vec[$i]['moneda'];
			$campos['almacen']=$vec[$i]['almacen'];
			$campos['estado_remision']=$folio['estatus'];
			$campos['id_pago']=$this->session->userdata('id_pago');
			if($folio['estatus'])
			{
				$campos['remision']=$folio['datos'];
			}
			else
			{
				$campos['mensaje']=$folio['mensaje'];
			}
			$this->ModelEnvios->agregarRemision($campos);
			$carrito=array();
		} //while

		if(isset($folio['estatus']))
			return $folio['estatus'];
		else
			return 0;

	}
			/*

		$folio=$this->apartado($almacen,$moneda,$carrito);

			//$folio['estatus']=1;
			$campos['moneda']=$moneda;
			$campos['almacen']=$almacen;
			$campos['estado_remision']=$folio['estatus'];
			$campos['id_pago']=$this->session->userdata('id_pago');
			if($folio['estatus'])
			{
				$campos['remision']=$folio['datos'];
			}
			else
			{
				$campos['mensaje']=$folio['mensaje'];
			}
			$this->ModelEnvios->agregarRemision($campos);
			$carrito=array();
		} //while
		if(isset($folio['estatus']))
			return $folio['estatus'];
		else
			return 0;
	}*/
	function agregarDetEnvArt()
	{

		foreach ($this->cart->contents() as $item)
		{

			$data['id_cliente']=$this->session->userdata('id_cliente');
			$data['id_articulo']=$item['id'];
			$data['cant']=$item['qty'];
			$this->ModelEnvios->agregarDetEnvArt($data);
		}
	}
	function vistaPrincipal()
	{
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['articles'] = $this->ModelArticulo->Oferts();
		$data['destacados'] = $this->ModelArticulo->Destacados();
		$data['recomendados'] = $this->ModelArticulo->Recomendados();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
	}
	function vistaFooter()
	{
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');

	}
	function apartado($almacen,$moneda,$data){
		include_once('lib/nusoap.php');
		$strUrl = "http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl";
		try{
			$client = new nusoap_client($strUrl, array("cache_wsdl" => WSDL_CACHE_NONE));
			$result = $client->call("GenerarRemision", array(
				6722,
				"112012",
				$almacen,
				$moneda,

					$data,

				"0012code"
			));
			return $result;
		}
		catch(Exception $ex)
		{
			 print_r($ex->getMessage());
		}
	}
	function agregarPago()
	{
		$this->form_validation->set_rules('tipo_pago','Pago','required');
		$this->form_validation->set_rules('fecha_pago','Fecha','required');
		$this->form_validation->set_rules('total','Total','required');
		if($this->form_validation->run()===false)
		{
			$this->vistaPagos();
		}
		else
		{
			$data=$this->input->post();
			$data['id_cliente']=$this->session->userdata('id_cliente');
			$query=$this->ModelEnvios->agregarPago($data);
			$consulta=$this->ModelEnvios->maxIdPago();
			$sql=$this->ModelEnvios->obtenerEnvio($this->session->userdata('id_cliente'));
			$vec=array();
			if($sql->num_rows()>0)
				$vec=$sql->row_array();
			if($this->session->userdata('id_factura'))
			{
				foreach ($consulta->result() as $row) {
					$id_pago=$row->id_pago;
				}
				$fac['id_factura']=$this->session->userdata('id_factura');
				$fac['id_pago']=$id_pago;
				$this->ModelEnvios->addDetFac($fac);
			}

			switch ($data['tipo_pago']) {
				case 'referencia':
					//$this->crearCotizacion();
						$mensaje='<!DOCTYPE html><html><head><title>ISCO COMPUTADORAS</title>';
						$estilo='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
						<style>
							hr{
								background-color:white;
							}
							.tabla thead {
							  background-color: #b88ae6;
							  color: #fff;
							}
							.tabla tbody tr:nth-child(even) {
							  background-color: #e6ccff;
							}
							.tabla tbody tr:nth-child(odd) {
							  background-color: #f5ebff;
							}
							.titulo{
								color:#001A66;
								font-weight:bold;
							}
							.well{
								display:inline-block;
								width:40%;
								margin-left:25px !important;
							}
							.container
							{
								width:80%;
								margin-left:9%;
								background-color:#F5FFFF;
							}
						</style><body>';
						$mensaje.=$estilo;
						$mensaje.='<div class="container">';
						$mensaje.='<h2 class="titulo">ISCO COMPUTADORAS</h2>';
						$mensaje.='<b>ISCO COMPUTADORAS AGRADECE TU PREFERENCIA, A CONTINUACION SE MUESTRA TU COMPRA Y LAS REFERENCIAS PARA QUE HAGAS EL PAGO INDICADO EN ESTE CORREO</b><HR style="color:white">';
						$mensaje.='Nombre del cliente: <b>'.$vec['nombre'].' '.$vec['apellido_paterno'].' '.$vec['apellido_materno'].'</b>';
						$carrito='<table class="table table-bordered tabla">
                        <thead>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>';
                             foreach ($this->cart->contents() as $item)
                            {
                               $carrito.= '<tr>
                                    <td>'.$item['name'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['qty'].'</td>
                                    <td>'.($item['price']*$item['qty']).'</td>
                                </tr>';
                             }
                            $carrito.='<tr><td class="font-size:.7em"colspan="2">Se incluye el costo del envio $99.00</td><td class="titulo">Total:</td><td style="font-weight:bold">$'.number_format($this->cart->total()+99,2).'</td></tr>
                        </tbody>
                        <img  style="width:100%;max-width:100%" src="http://iscocomputadoras.com/img/firma.jpg"></img>
                   </table>';
                    $mensaje.=$carrito;
                    $mensaje.='<hr style="color:white"><h2 class="titulo">Referencias Bancarias</h2>';
                    $mensaje.='<div><div class="well" style="margin-left:9%;">';
                    $mensaje.='<p><b>SCOTIABANK</b></p>';
                    $mensaje.='<p>1) No. cuenta: 03100155144 ';
                    $mensaje.='<p>2) Clabe Interbancaria: 044512031001551440';
					$mensaje.='</div>';
					/*$mensaje.='<div style="width:7%;display:inline-block;"></div>';
					$mensaje.='<div class="well" style="margin-left:9%;height:100%;">';
					$mensaje.='<p><b>BANCOMER</b></p>';
					$mensaje.='<p>1) No. cuenta: 00165304288</p></div></div>';
					$mensaje.='</div>';*/
                    $mensaje.='</body></html>';
                    $this->sendEmail('ventas@grupoisco.com',$vec['correo'],$mensaje);
					break;
				case 'isco':
					break;
				default:
					break;
			}

			if($query>0)
			{
				$this->session->set_userdata('id_pago',$query);
			}
			$this->ordenarArticulos();
			$this->destruirCarro();
			$arreglo['exito']="Gracias por tu compra, se a enviado a tu correo la información para concluirla.";
			$this->vistaPrincipal();
			$this->load->view('inicio',$arreglo);
			$this->vistaFooter();
		}
	}
	function prueba()
	{
		$mensaje='<!DOCTYPE html><html><head><title>ISCO COMPUTADORAS</title>';
						$estilo='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
						<style>
							hr{
								background-color:white;
							}
							.tabla thead {
							  background-color: #b88ae6;
							  color: #fff;
							}
							.tabla tbody tr:nth-child(even) {
							  background-color: #e6ccff;
							}
							.tabla tbody tr:nth-child(odd) {
							  background-color: #f5ebff;
							}
							.titulo{
								color:#001A66;
								font-weight:bold;
							}
							.well{
								display:inline-block;
								width:40%;
								margin-left:25px !important;
							}
							.container
							{
								width:80%;
								margin-left:9%;
								background-color:#F5FFFF;
							}
						</style><body>';
						$mensaje.=$estilo;
						$mensaje.='<div class="container">';
						$mensaje.='<h2 class="titulo">ISCO COMPUTADORAS</h2>';
						$mensaje.='<b>ISCO COMPUTADORAS AGRADECE TU PREFERENCIA, A CONTINUACION SE MUESTRA TU COMPRA Y LAS REFERENCIAS PARA QUE HAGAS EL PAGO INDICADO EN ESTE CORREO</b><HR style="color:white">';
						$mensaje.='Nombre del cliente: <b> SANTIAGO MARTIN OCHOA ESTRADA</b>';
						$carrito='<table class="table table-bordered tabla">
                        <thead>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>';
                             foreach ($this->cart->contents() as $item)
                            {
                               $carrito.= '<tr>
                                    <td>'.$item['name'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['qty'].'</td>
                                    <td>'.($item['price']*$item['qty']).'</td>
                                </tr>';
                             }
                            $carrito.='<tr><td class="font-size:.7em"colspan="2">Se incluye el costo del envio $99.00</td><td class="titulo">Total:</td><td style="font-weight:bold">$'.number_format($this->cart->total()+99,2).'</td></tr>
                        </tbody>
                   </table>';
                    $mensaje.=$carrito;
                    $mensaje.='<hr style="color:white"><h2 class="titulo">Referencias Bancarias</h2>';
                    $mensaje.='<div><div class="well" style="margin-left:9%;">';
                    $mensaje.='<p><b>SCOTIABANK</b></p>';
                    $mensaje.='<p>1) No. cuenta: 03100155144 ';
                    $mensaje.='<p>2) Clabe Interbancaria: 044512031001551440';
					$mensaje.='</div>';
					$mensaje.='<div style="width:7%;display:inline-block;"></div>';
					$mensaje.='<div class="well" style="margin-left:9%;height:100%;">';
					$mensaje.='<p><b>BANCOMER</b></p>';
					$mensaje.='<p>1) No. cuenta: 00165304288</p></div></div>';
					$mensaje.='</div>';
                    $mensaje.='</body></html>';
                    echo $mensaje;
	}
	function mensajeCliente()
	{
		$data=$this->input->post();
		$mensaje='<!DOCTYPE html><html><head><title>ISCO COMPUTADORAS</title>';
		$estilo='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<style>
					hr{
						background-color:white;
					}
					.tabla thead {
					  background-color: #b88ae6;
					  color: #fff;
					}
					.tabla tbody tr:nth-child(even) {
					  background-color: #e6ccff;
					}
					.tabla tbody tr:nth-child(odd) {
					  background-color: #f5ebff;
					}
					.titulo{
						color:#001A66;
						font-weight:bold;
					}
					.well{
						display:inline-block;
						width:40%;
						margin-left:25px !important;
						}
						.container
						{
							width:80%;
							margin-left:9%;
							background-color:#F5FFFF;
						}
				</style><body>';
		$mensaje.=$estilo;
		$mensaje.='<div class="container">';
		$mensaje.='<h2 class="titulo">ISCO COMPUTADORAS</h2>';
		$mensaje.='<p>'.$data['mensaje'].'</p>';
		$mensaje.='</div>';
		$mensaje.='</body></html>';
		$this->sendEmail($data['correo'],'ventas@grupoisco.com',$mensaje);
		//$this->sendEmail('santi_shy@hotmail.com','santi_shy@hotmail.com',$mensaje);
		echo 'Listo';
	}
	FUNCTION contar()
	{
		var_dump(count($this->cart->contents()));
	}
	function rellenarCart($id_paquete)
	{
		$query=$this->ModelArticulo->getPaqueteId($id_paquete);
		$i=0;
		$arr=$query->row_array();
		if($arr['pte_utilidad']>0)
			foreach ($query->result() as $row)
			{
				$data['id']=$row->id_articulo;
				$data['price']=ceil((($row->precio*$row->pte_utilidad)/100)+$row->precio);
				$data['price']=ceil($data['price']*1.16);
				$data['price']=ceil($data['price']-(($data['price']*$row->pte_descuento)/100));
				$data['qty']=$row->qty;
				$data['sku']=$row->sku;
				$data['name']=$row->descripcion;
				$vec[$i++]=$data;
			}
		else
			foreach ($query->result() as $row)
			{
				$data['id']=$row->id_articulo;
				$data['price']=$row->precio+(($row->precio*$row->ut)/100);
				$data['price']=ceil(($data['price']*1.16));
				$data['qty']=$row->qty;
				$data['sku']=$row->sku;
				$data['name']=$row->descripcion;
				$vec[$i++]=$data;
			}
		$this->cart->insert($vec);
	}
	function crearNota()
	{
		$correo=$this->input->post('correo');
		$nombre=$this->input->post('nombre');
		$id_paquete=$this->input->post('id_paquete');
		$data=$this->input->post();
		if(strlen($id_paquete)>0)
		{
			unset($data['id_paquete']);
		/*	if($correo=="isco_masivo")
				$correo=*/

			$this->rellenarCart($id_paquete);
		}
		unset($data['id_paquete']);
		/*$data['correo']="santi_shy@hotmail.com";
		$data['nombre']="SANTIAGO MARTIN";
		$correo=$data['correo'];
		$nombre=$data['nombre'];* pruebas******/
		$query=$this->ModelArticulo->addCotizacion($data);
		foreach ($query->result() as $row)
		{
			$id_cotizacion=$row->id_cotizacion;
		}
		date_default_timezone_set('America/Monterrey');
		$fecha=date('Y-m-d H:i:s');
		include_once('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->Image('img/logotipo.png',10,10,40,20);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Times','B','10');
		$pdf->SetX(65);
		//$pdf->cell(70,5,'WWW.ISCOCOMPUTADORAS.COM',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetX(65);
		$pdf->cell(70,5,'ISCOCOMPUTADORAS SA DE CV',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetX(65);
		//$pdf->cell(70,5,'RFC. XNE1203082B1',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetFont('Times','','10');
		$pdf->SetX(65);
		//$pdf->cell(70,5,'Madero 121',0,0,'C');
		$pdf->SetX(65);
		$pdf->cell(70,5,utf8_decode('Tel. 01 800 001 ISCO '),0,0,'C');
		$pdf->SetY(10);
		$pdf->SetX(160);
		$pdf->SetFont('Times','B','11');
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(40,10,"COTIZACION",0,1,'C');
		$pdf->Ln();
		$pdf->SetFont('Times','','11');
		$pdf->SetY(20);
		$pdf->SetX(160);
		$pdf->Cell(40,10,$fecha,0,0,'C');
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(51, 153, 255);
		$pdf->SetDrawColor(51, 153, 255);
		$pdf->SetFont('Times','B','15');
		$pdf->SetX(20);
		$pdf->SetY(40);
		$pdf->Cell(0,10,'Cliente: '.$nombre,'B',1,'L');
		$pdf->SetFont('Times','B','12');
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(30,10,'Imagen',1,0,'C',true);
		$pdf->Cell(20,10,'Cantidad',1,0,'C',true);
		$pdf->Cell(90,10,utf8_decode('Descripción'),1,0,'C',true);
		$pdf->Cell(25,10,'P.Unitario',1,0,'C',true);
		$pdf->Cell(25,10,'Total',1,1,'C',true);
		$pdf->SetFont('Times','','10');
		$pdf->SetFont('Times','','10');
		$pdf->SetTextColor(0,0,0);
		$subtotal=0;
		$ind=1;
		$ban=true;
		$l=0;
		foreach($this->cart->contents() as $item)
		{
			$skus[$l++]=$item['sku'];
			$ind++;
			$contents=file_get_contents('http://www.pchmayoreo.com/media/catalog/product/'.substr($item['sku'], 0,1).'/'.substr($item['sku'],1,1).'/'.$item['sku'].'.jpg');
			//if(@fopen("http://www.pchmayoreo.com/media/catalog/product/".substr($item['sku'], 0,1)."/".substr($item['sku'],1,1)."/".$item['sku'].".jpg","r"))
			if($contents)
				if(exif_imagetype('http://www.pchmayoreo.com/media/catalog/product/'.substr($item['sku'], 0,1).'/'.substr($item['sku'],1,1).'/'.$item['sku'].'.jpg')==IMAGETYPE_PNG)
					$pdf->Image('http://www.pchmayoreo.com/media/catalog/product/'.substr($item['sku'], 0,1).'/'.substr($item['sku'],1,1).'/'.$item['sku'].'.jpg',10,$pdf->GetY()+1,30,20,'png');
				else
					$pdf->Image('http://www.pchmayoreo.com/media/catalog/product/'.substr($item['sku'], 0,1).'/'.substr($item['sku'],1,1).'/'.$item['sku'].'.jpg',10,$pdf->GetY()+1,30,20,'jpg');
			else
				$pdf->Image('http://iscocomputadoras.com/img/noimg.jpg',10,$pdf->GetY()+1,30,20,'jpg');
			$y=$pdf->GetY();
			$pdf->SetXY(40,$y);
			$pdf->MultiCell(20,20,$item['qty'],'L','C');
			$pdf->SetXY(60,$y);
			if(strlen($item['name'])>42)
				$pdf->MultiCell(90,10,$item['name'],0,'L');
			else
				$pdf->MultiCell(90,20,$item['name'],0,'L');
			$pdf->SetXY(150,$y);
			$pdf->MultiCell(25,20,'$'.number_format($item['price'],2),0,'C');
			$pdf->SetXY(175,$y);
			$pdf->MultiCell(25,20,'$'.number_format($item['price']*$item['qty'],2),'R','C');
			$subtotal+=$item['qty']*$item['price'];
			if($pdf->GetY()>240)
			{
				$pdf->Image('banner/firma.jpg',10,267,0,20);
				$ban=false;
			}

		}
		if($ban)
			$pdf->Image('banner/firma.jpg',10,267,0,20);
		$pdf->Cell(140,10,'Sino requiere envio, esta cantidad seria el total a pagar','BT',0,'R');
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFont('Times','B','11');
		$pdf->Cell(25,10,'Subtotal',1,0,'C',true);
		$pdf->SetFont('Times','','10');
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(25,10,'$'.number_format($subtotal,2, ".", ","),1,1,'C');//
		$pdf->Cell(140,10,'Costo del Envio','B',0,'R');
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFont('Times','B','11');
		$pdf->Cell(25,10,'Costo',1,0,'C',true);
		$pdf->SetFont('Times','','11');
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(25,10,'$'.number_format('99',2, ".", ","),1,1,'C');//
		$pdf->Cell(140);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFont('Times','B','11');
		$pdf->Cell(25,10,'Total',1,0,'C',true);
		$pdf->SetFont('Times','','11');
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(25,10,'$'.number_format($subtotal+99,2, ".", ","),1,1,'C');//
		$pdf->Ln(5);
		$pdf->SetFont('Times','B','10');
		$pdf->SetFillColor(51, 153, 255);
		$pdf->Cell(80,10,'DATOS DEL DEPOSITO',1,0,'L',1);
		$pdf->SetFont('Times','','9');
		$pdf->Cell(110,10,'Politicas de venta: Anticipo de 50%, precios sujetos a cambio sin previo aviso.',0,1,'C');
		$pdf->SetFont('Times','','10');
		$pdf->Cell(80,5,'Scotiabank','RL',1,'L');
		$pdf->Cell(80,5,'Cuenta: 03100155144','RL',1,'L');
		$pdf->Cell(80,5,'Transferencia: 044512031001551440','RLB',1,'L');
		$ruta="cotizaciones/cotizacion-".$id_cotizacion.'.pdf';
		$vec['ruta']=$ruta;
		$this->ModelArticulo->updateCotizacion($vec,$id_cotizacion);
		$pdf->output($ruta,'F');
		//$pdf->output();
		/* aki hay que kitar cuando se habilite el boton de vender paquete*/
		if(strlen($id_paquete)>0)
			$this->cart->destroy();
		$this->load->library('email');
		$msg='
			<!DOCTYPE html>
			<html>
			<HEAD>
				<title>Cotizacion</title>
			</HEAD>
			<body>
			<img style="width:150px;max-width:100%" src="http://iscocomputadoras.com/img/logotipo.png"></img>
			<div style="width:50%">
			<h3 style="border-bottom:solid 3px #5c9ccc">Cotizacion recibida</h3>
			<div class="advertencia" style="text-align:justify;">Hola estimado Cliente <br>
			Se envío adjunto a este correo, un pdf con su cotizacion realizada.
			<center><b>ISCO COMPUTADORAS a su servicio</b></center>
			</div></div>
				<img style="width:100%;max-width:100%" src="http://iscocomputadoras.com/banner/firma.jpg"></img>
			</body></html>';
		$this->enviarEmail('ventas@grupoisco.com',$correo,$msg,$ruta,$skus);
	}
	function enviarEmail($from="",$to="",$cadena="",$ruta="",$skus=0)
	{
		$to.=',ventas@grupoisco.com';
		$config['mailtype']='html';
		$config['protocol']='mail';
		$config['priority']=3;
		$this->email->initialize($config);
		$this->email->from($from,'ISCO COMPUTADORAS');
		$this->email->to($to);

		$this->email->subject('ISCO Cotizacion ');
		$this->email->message($cadena);
		$this->email->attach($ruta);
		for ($i=0; $i < count($skus); $i++) {
			if(file_exists('imagenes/'.$skus[$i].'.pdf'))
			{
				$this->email->attach('imagenes/'.$skus[$i].'.pdf');
			}
		}
		$json['ban']=$this->email->send();
		echo json_encode($json);
	}
	function sendEmail($from="",$to="",$cadena="")
	{
		$to.=',ventas@grupoisco.com';
		$config['mailtype']='html';
		$config['protocol']='mail';
		$config['priority']=5;
		$this->email->initialize($config);
		$this->email->from($from,'ISCO COMPUTADORAS');
		$this->email->to($to);
		$this->email->subject('ISCO TIENDA ONLINE');
		$this->email->message($cadena);
		$this->email->send();
	}
	function destruirCarro()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('id_pago');
		$this->session->unset_userdata('id_cliente');
		$this->session->unset_userdata('carrito');
	}
	function vistaPagos()
	{
		date_default_timezone_set('America/Monterrey');
		$prop['fecha_pago']=date('Y-m-d H:i:s');
		$this->vistaPrincipal();
		$this->load->view('includes/scripts');
		$this->load->view('envios/pagos',$prop);
		$this->vistaFooter();
	}
	function agregarPagoPaypal()
	{
		$data=$this->input->post();
		$data['id_cliente']=$this->session->userdata('id_cliente');
		if($this->session->userdata('id_cliente'))
		{
			$query=$this->ModelEnvios->agregarPago($data);
			$sql=$this->ModelEnvios->obtenerEnvio($this->session->userdata('id_cliente'));
			$vec=array();
			if($sql->num_rows()>0)
				$vec=$sql->row_array();
			if($query>0)
				{
					$this->session->set_userdata('id_pago',$query);
				}
			$mensaje=$this->cadEmail($vec);
			$mensaje.='<h2>PAYPAL</h2>';
			$mensaje.='<p>Tu pago sera verificado dentro de un momento, se te enviara el articulo al domicilio indicado';
			$mensaje.=' (dependiendo de tu opcion elegida) gracias por tu compra.</p>';
			$this->sendEmail('ventas@grupoisco.com',$vec['correo'],$mensaje);
			$res=$this->ordenarArticulos();
			//$this->destruirCarro();
			$this->cart->destroy();
			echo $res;
		}
		else
		{
			$res=2;
			echo $res;
		}
	}
	function paypal()
	{
		$data['estado']=$this->input->post('payment_status');
		if($data['estado']=='Completed')
		{
			$data['estado']="COMPLETADO";
			$query=$this->ModelEnvios->modiEstadoPago($data,$this->session->userdata('id_pago'));
		}
		$this->cart->destroy();
		$this->vistaPrincipal();
		$this->load->view('inicio');
		$this->vistaFooter();
	}
	function loginCliente()
	{
		$user=$this->input->post('usuario');
		$pass=md5($this->input->post('password'));
		$query=$this->ModelEnvios->comprobarUsuario($user,$pass);
		if($query->num_rows()>0)
		{
			$row=$query->row_array();
			$this->session->set_userdata('id_usuario',$row['id_usuario']);
			$this->session->set_userdata('correo',$user);
			echo 1;
		}
		else
			echo 0;
	}
	function cerrarSesion()
	{
		$this->session->sess_destroy();
		$this->cart->destroy();
		redirect(base_url());
	}
	function cadEmail($vec)
	{
		$mensaje='<!DOCTYPE html><html><head><title>ISCO COMPUTADORAS</title>';
		$estilo='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<style>
			hr{
				background-color:white;
			}
			.tabla thead {
				background-color: #b88ae6;
				color: #fff;
			}
			.tabla tbody tr:nth-child(even) {
				background-color: #e6ccff;
			}
			.tabla tbody tr:nth-child(odd) {
				background-color: #f5ebff;
			}
			.titulo{
				color:#001A66;
				font-weight:bold;
			}
			.well{
				display:inline-block;
				width:40%;
				margin-left:25px !important;
			}
			.container
			{
				width:80%;
				margin-left:9%;
				background-color:#F5FFFF;
			}
			</style><body>';
		$mensaje.=$estilo;
		$mensaje.='<div class="container">';
		$mensaje.='<h2 class="titulo">ISCO COMPUTADORAS</h2>';
		$mensaje.='<b>ISCO COMPUTADORAS AGRADECE TU PREFERENCIA, A CONTINUACION SE MUESTRA TU COMPRA Y LAS REFERENCIAS PARA QUE HAGAS EL PAGO INDICADO EN ESTE CORREO</b><HR style="color:white">';
		$mensaje.='Nombre del cliente: <b>'.$vec['nombre'].' '.$vec['apellido_paterno'].' '.$vec['apellido_materno'].'</b>';
		$carrito='<table class="table table-bordered tabla">
	             <thead>
	                <th>Nombre</th>
	                 <th>Precio</th>
	                 <th>Cantidad</th>
	                 <th>Subtotal</th>
	             </thead>
	             <tbody>';
	                  foreach ($this->cart->contents() as $item)
	                 {
	                    $carrito.= '<tr>
	                         <td>'.$item['name'].'</td>
	                         <td>'.$item['price'].'</td>
	                         <td>'.$item['qty'].'</td>
	                         <td>'.($item['price']*$item['qty']).'</td>
	                     </tr>';
	                  }
	                 $carrito.='<tr><td class="font-size:.7em"colspan="2">Se incluye el costo del envio $99.00</td><td class="titulo">Total:</td><td style="font-weight:bold">$'.number_format($this->cart->total()+99,2).'</td></tr>
	             </tbody>
	       	</table>
	       	<img  style="width:100%;max-width:100%" src="http://iscocomputadoras.com/img/firma.jpg"></img>
	       	';
	   	$mensaje.=$carrito;
	   	return $mensaje;
	}
	function crearPdf()
	{
		$id_cliente=1;
		$id_pago=$this->uri->segment(3);
		$id_cliente=$this->uri->segment(4);
		$query=$this->ModelEnvios->obtenerEnvio($id_cliente);
		if($query->num_rows()>0)
			$cliente=$query->row_array();
		$rem=$this->ModelEnvios->obtenerRemisiones($id_pago);
		include_once('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->Image('img/logotipo.png',10,10,40,20);
		$pdf->SetTextColor(9,84,204);
		$pdf->SetFont('Times','B','10');
		$pdf->SetX(65);
		$pdf->cell(70,5,'WWW.ISCOCOMPUTADORAS.COM',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetX(65);
		$pdf->cell(70,5,'ISCOCOMPUTADORAS SA DE CV',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetX(65);
		$pdf->cell(70,5,'RFC. XNE1203082B1',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetFont('Times','','10');
		$pdf->SetX(65);
		$pdf->cell(70,5,'Madero 121',0,0,'C');
		$pdf->Ln(3);
		$pdf->SetX(65);
		$pdf->cell(70,5,utf8_decode('Sahuayo, Michoacan C.P.59000 Tel.(353) 5325959 '),0,0,'C');
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(51, 153, 255);
		$pdf->SetDrawColor(51, 153, 255);
		$pdf->SetFont('Times','B','15');
		$pdf->SetX(20);
		$pdf->SetY(40);
		$pdf->cell(0,10,'Datos de Envio',1,1,'C',1);
		$pdf->SetFont('Times','B','11');
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Nombre','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['nombre'].' '.$cliente['apellido_paterno'].' '.$cliente['apellido_materno']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Ciudad','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['ciudad']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Calle','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['calle'].' - Nom. Ext. '.$cliente['n_exterior'].' - Nom. Int. '.$cliente['n_interior']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Colonia','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['colonia']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Referencia','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['referencia']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Codigo Postal','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['codigo_postal']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Estado','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['estado']),'RTB',1,'L',0);
		$pdf->SetFont('Times','B','11');
		$pdf->cell(30,10,'Telefono','LTB',0,'C',1);
		$pdf->SetFont('Times','','11');
		$pdf->cell(0,10,utf8_decode($cliente['telefono']),'RTB',1,'L',0);
		//$pdf->cell(0,10,"",'RTB',1,'L',1);
		$pdf->Ln();
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFillColor(51, 153, 255);
		$pdf->SetDrawColor(51, 153, 255);
		$pdf->SetFont('Times','B','15');
		$pdf->cell(70,10,'Remisiones',1,1,'C',1);
		$pdf->SetFont('Times','','12');
		$pdf->SetTextColor(0,0,0);
		foreach ($rem->result() as $row) {
			$pdf->cell(70,10,$row->remision,1,1,'C',0);
		}
		$pdf->output();
	}
}
?>
