<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		$this->load->library('funciones');
	}

	public function index()
	{


	}
	function detallesproducto(){
		$id = $this->uri->segment(3);
		$query = $this->ModelArticulo->getArticulo($id);
		foreach($query->result() as $prod){
			$sku = $prod->sku;
			$utilidad=$prod->utilidad;
			$ut=$prod->ut;
			$proveedor=$prod->proveedor;
			$precio=$prod->precio;
			$descuento=$prod->descuento;
			$marca=$prod->marca;
			$seccion=$prod->seccion;
			$linea=$prod->linea;
			$descripcion=$prod->descripcion;
		}
		$data['ip']=$this->input->ip_address();
		$data['id_articulo']=$id;
		date_default_timezone_set('America/Monterrey');
		$data['fecha']=date('Y-m-d H:i:s');
		$consulta=$this->ModelArticulo->addContador($data);
		if($utilidad==0)
			$utilidad=$ut;
		if($proveedor=="pchmayoreo")
		{
			$client = $this->socket->conexion();
			$err = $client->getError();
			if ($err) {	echo 'Error en Constructor' . $err ; }
			$param = array('cliente' =>6722,'llave' => '112012', 'sku' => $sku);
			$result = $client->call('ObtenerArticulo', $param);
			if ($client->fault)
			{
				echo 'Fallo';
				print_r($result);
			}
			else
			{	// Chequea errores
				$err = $client->getError();
				if ($err) {		// Muestra el error
					echo 'Error' . $err ;
				}
				else
				{
					//if($result['estatus'] == 1 || $result['estatus'] == '1'){

					$exist=0;
					$arr=array();
						for($i=0;$i<count($result['datos']['inventario']);$i++)
						{
							$exist +=$result['datos']['inventario'][$i]['existencia'];
							$arr[$i]=$result['datos']['inventario'][$i];
						}
					$arr=$this->addSucursal($arr)	;

						$vec = array(
							'exis' => $exist,
							'almacen' => $result['datos']['inventario'][0]['almacen'],
							'sku' => $sku,
							'precio' => $result['datos']['precio'],
							'marca' => $result['datos']['marca'],
							'seccion' => $result['datos']['seccion'],
							'linea' => $result['datos']['linea'],
							'serie' => $result['datos']['serie'],
							'peso' => $result['datos']['peso'],
							'alto' => $result['datos']['alto'],
							'ancho' => $result['datos']['ancho'],
							'largo' => $result['datos']['largo'],
							'proveedor'=>$proveedor,
							'moneda' => $result['datos']['moneda'],
							'descripcion'=>$result['datos']['descripcion'],
							'utilidad'=>$utilidad,
							'descuento'=>$descuento,
							'vec_almacen'=>$arr
						);
						if(!$this->session->userdata('cambio'))
							$this->getParidad($client);
						$this->mostrarProd($id,$vec);
					/*}
					else{
						if(!$this->session->userdata('cambio'))
							$this->getParidad($client);
						$this->mostrarProd($id,$vec);
					}*/

				}
			}
		}
		else
		{
			$inventarios=$this->ModelArticulo->getAlmacenesProd($id);
			$exist=0;
			$ind=0;
			$arr=array();
			foreach ($inventarios->result() as $row)
			{
				$exist+=$row->existencia;
				$arr[$ind++]=array('almacen'=>$row->almacen,'existencia'=>$row->existencia);
			}
			$arr=$this->addSucursal($arr);
			$vec = array(
							'exis' => $exist,
							'almacen' => "",
							'sku' => $sku,
							'precio' => $precio,
							'marca' => $marca,
							'seccion' => $seccion,
							'linea' => $linea,
							'serie' =>$linea,
							'peso' =>"",
							'alto' =>"",
							'ancho' =>"",
							'largo' =>"",
							'moneda' =>"MN",
							'proveedor'=>$proveedor,
							'descripcion'=>$descripcion,
							'utilidad'=>$utilidad,
							'vec_almacen'=>$arr
						);
			/*if(!$this->session->userdata('cambio'))
				$this->getParidad($client);	*/
			$this->mostrarProd($id,$vec);
		}

	}
	function addSucursal($arr)
	{
		$sql=$this->ModelArticulo->getAlmacenes();
		$i=0;
		foreach ($sql->result() as $row)
		{
			$suc[$i++]=$row->almacen;
		}
		//print_r($suc);
		//$suc=array(1,7,16,21,56,74);
		for($i=0;$i<count($suc);$i++)
		{
			$ban=false;
			for ($j=0; $j <count($arr) ; $j++)
				if($arr[$j]['almacen']==$suc[$i])
					$ban=true;
			if($ban)
				$suc[$i]=0;
		}
		$j=count($arr);
		for ($i=0; $i <count($suc) ; $i++)
		{
			if($suc[$i]!=0 || gettype($suc[$i])=="string")
				$arr[$j++]=array("existencia"=>0,"almacen"=>$suc[$i]);
		}
		$this->session->set_userdata($arr);
		return $arr;
	}
	function mostrarProd($id,$vec){
		extract($vec);
		//print_r($arr);
		$sku=$vec['sku'];
		$query = $this->ModelArticulo->getArticulo($id);
		if($query->num_rows() > 0){
			$data['articulo'] = $query;
			$data['secciones'] = $this->ModelArticulo->getSections();
			$data['marcas'] = $this->ModelArticulo->getMarcas();
			$data['articles'] = $this->ModelArticulo->getArticles();
			if(strcmp($vec['moneda'], "MN") != 0){
				$vec['precio'] = $vec['precio'] * $this->session->userdata('cambio');
			}
			$data['costo']=$this->funciones->precio($vec['utilidad'],0,$vec['precio'],$vec['descuento']);
			/*$data['costo']=($vec['precio']*$vec['utilidad'])/100;
			$data['costo']=$data['costo']+$vec['precio'];
			$data['costo']=ceil($data['costo']*1.16);*/
			//$data['costo'] = ceil((($vec['precio']+(($vec['precio']*$vec['utilidad']))/100) )* 1.16);
			if($vec['exis']=="")
				$vec['exis']=0;
			$data['existencia'] = $vec['exis'];
			$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
			$data['file'] = 'main.js';
			$id_articulo=1;
			foreach ($data['articulo']->result() as $row) {
				$id_articulo=$row->id_articulo;
			}
			$data['link']="http://iscocomputadoras.com/productos/detallesproducto/".$id_articulo;
			$data['descripcion_prod']=$vec['descripcion'];
			$data['imagen']="http://www.pchmayoreo.com/media/catalog/product/".substr($sku, 0,1)."/".substr($sku, 1,1)."/".$sku.".jpg";
			$vec['linea']=str_replace('"','',$vec['linea']);
			$consulta=$this->ModelArticulo->getProdCategoria($vec['linea']);
			$data['query']=$this->generarAleatorios(8,$consulta->result_array());
			$data['loginUrl']=$this->funciones->loginFacebook();
			$this->load->view('includes/headersite',$data);
			$this->load->view('includes/scripts');
			$this->load->view('producto',$vec);
			$this->load->view('includes/cart');
			$this->load->view('includes/prefooter');


		}
		else
		{
			echo 'no se encontro el producto';
		}

	}
	public function generarAleatorios($n,$data)
	{
		$max=count($data);

		$vec=array();
		if($max<$n)
			$n=$max;
		for($i=0;$i<$n;$i++)
		{
			$ind=rand(0,$max-1);
			$vec[$i]=$data[$ind];
		}
		return $vec;
	}
	function productSold()
	{
		$vec['agotado'] = 'Lo sentimos no hay existencias disponibles del producto que deseas por ahora.';
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['articles'] = $this->ModelArticulo->getArticles();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('sold',$vec);
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
	}
	function getPaquetes()
	{
		//$data['articulos'] = $this->ModelArticulo->busquedaHome($data['cadena']);
		$id_paquete=$this->uri->segment(3);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['listaMarca']=$this->ModelArticulo->getMarcaBusquedaPalabra($this->input->post('txtSearch'));
		if(strlen($id_paquete)>0)
			$data['query']=$this->ModelArticulo->getPaqueteId($id_paquete);
		else
			$data['query']=$this->ModelArticulo->getPaqueteId(11);
		foreach ($data['query']->result() as $row) {
			$data['nombre_paquete']=$row->nombre_paquete;
			$data['precio_paquete']=$row->precio_paquete;
			$data['id_paquete']=$row->id_paquete;
			$utilidad=$row->pte_utilidad;
			$data['descuento']=$row->pte_descuento;
		}
		$data['precio_paquete']=ceil($data['precio_paquete']+($data['precio_paquete']*$utilidad)/100);
		//$data['precio_paquete']=ceil($data['precio_paquete']*1.16);
		$data['precio_descuento']=ceil($data['precio_paquete']-(($data['precio_paquete']*$data['descuento'])/100));
		$data['paquetes']=$this->ModelArticulo->getNamePaquetes();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('paquetes/paquete');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');

	}
	function addPaqCart()
	{
		/*if($this->input->post('txtCantidad') <= $this->input->post('txtExis'))
		{
			$data=array('id' => $this->input->post('id_articulo'),
			'qty'=> $this->input->post('txtCantidad'),
			'price'=> $this->input->post('txtPrecio'),
			'name'=> $this->input->post('txtNombre'),
			'almacen'=>$this->input->post('txtAlmacen'),
			'existencia'=>$this->input->post('txtExis'),
			'sku' => $this->input->post('txtSku'),
			'proveedor'=>$this->input->post('proveedor'),
			'moneda'=>$this->input->post('moneda'));

			$this->cart->insert($data);
			$arr=$this->cart->contents();
			$this->session->set_userdata('carrito',count($arr));
			$vec = array('ban' => 1 , 'valor' => count($arr));
			echo json_encode($vec);
		}
		else
			{
				$vec = array('ban' => 0 , 'valor' => 0);
				echo json_encode($vec);
				exit();
			}*/
	}
	function getParidad($client)
	{
		$id_dolar=0;
		$query=$this->ModelArticulo->maxIdDolar();
		foreach ($query->result() as $row) {
			$id_dolar=$row->id_dolar;
		}
		$query=$this->ModelArticulo->getDolar($id_dolar);
		foreach ($query->result() as $row) {
			$dolar=$row->precio;
		}

			$this->session->set_userdata('cambio',$dolar);

		/*$param = array('cliente' =>6722,'llave' => '112012');
		$result = $client->call('ObtenerParidad', $param);
		if ($client->fault)
		{
			echo 'Fallo';
			print_r($result);
		}
		else
		{	// Chequea errores
			$err = $client->getError();
			if ($err) {		// Muestra el error
				echo 'Error' . $err ;
			}
			else
			{

				if($result['estatus'])
					$this->session->set_userdata('cambio',$result['datos']);

			}
		}*/

	}

}
?>
