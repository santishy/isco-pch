<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		$this->load->model('ModelAdmin');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('cart');
	}
	function addPaquete()
	{
		$temp=$this->cart->total_items();
		if(!isset($temp))
			$temp=0;
		$data=$this->input->post();
	/*	$data['price']=$data['price']+(($data['price']*$data['utilidad'])/100);
		$data['price']=ceil(($data['price']*1.16));
		unset($data['utilidad']);*/
		$this->cart->insert($data);
		$data['items']=$this->cart->total_items();
		$arr=$this->getPaquete();
		echo json_encode($arr);
	}
	function getPaquete()
	{
		$i=0;
		foreach ($this->cart->contents() as $item)
		{
			$arr['name']=$item['name'];
			$arr['price']=$item['price'];
			$arr['id']=$item['id'];
			$arr['qty']=$item['qty'];
			$arr['rowid']=$item['rowid'];
			$array[$i++]=$arr;
		}
		$array[$i++]=$this->cart->total();
		return $array;
	}
	public function updatePaquete()
	{
		$data=$this->input->post();
		$this->cart->update($data);
		if($data['qty']==0)
			$data['ban']=1;
		else
			$data['ban']=0;
		echo json_encode($data);
	}
	public function insertarPaquete()
	{
		$data=$this->input->post();
		date_default_timezone_set('America/Monterrey');
		$data['fecha_paquete']=date('Y-m-d H:i:s');
		$query=$this->ModelArticulo->getPaquete($data['nombre_paquete']);
		if($query->num_rows()==0)
		{
			if($data['pte_utilidad']>0)
			{
				$data['precio_paquete']=$this->cart->total();
				$data['precio_paquete']=(($data['precio_paquete']*$data['pte_utilidad'])/100)+$data['precio_paquete'];
				$data['precio_paquete']=ceil(($data['precio_paquete']*1.16));
			}
			else
				$data['precio_paquete']=$this->precioPaqueteUtilidad();
			$vec['ban']=1;
			$query=$this->ModelArticulo->insertarPaquete($data);
			foreach ($query->result() as $row)
			{
				$id_paquete=$row->id_paquete;
			}
			$i=0;
			foreach ($this->cart->contents() as $item)
			{
				$det['id_articulo']=$item['id'];
				$det['id_paquete']=$id_paquete;
				$det['qty']=$item['qty'];
				$vec[$i++]=$this->ModelArticulo->insertarDetPaquete($det);
			}
			$this->cart->destroy();
		}
		else
			$vec['ban']=0;
		echo json_encode($vec);
	}
	function precioPaqueteUtilidad()
	{
		$total=0;
		foreach ($this->cart->contents() as $data) {
			$data['price']=$data['price']+(($data['price']*$data['utilidad'])/100);
			$data['price']=ceil(($data['price']*1.16));
			$total+=$data['price'];
		}
		return $total;
	}
	public function vista_descuentos()
	{
		$this->logueado();
		$this->load->view('includes/header');
		$this->load->view('admin/configuraciones');
	}
	public function logueado()
	{
		if(!$this->session->userdata('id_user'))
			redirect(base_url().'login/cerrarSesion');
		else
			if($this->session->userdata('tipo')!=1)
				redirect(base_url());
	}
	public function descuento()
	{
		$this->logueado();
		$data=$this->input->post();
		$this->ModelArticulo->descuento($data);
		redirect(base_url().'configuracion/obtenerListaUtilidad/');
	}
	public function likeSeccion()
	{
		$this->logueado();
		$seccion=$this->input->post('seccion');
		$query=$this->ModelArticulo->likeSeccion($seccion);
		$i=0;
		foreach ($query->result() as $row ) {
			$data[$i]=$row->seccion;
			$i++;
		}
		echo json_encode($data);
	}

	public function likeMarca()
	{
		$this->logueado();
		$marca=$this->input->post('marca');
		$query=$this->ModelArticulo->likeMarca($marca);
		$i=0;
		foreach ($query->result() as $row ) {
			$data[$i]=$row->marca;
			$i++;
		}
		echo json_encode($data);
	}
	public function likeSku()
	{
		$this->logueado();
		$sku=$this->input->post('sku');
		$query=$this->ModelArticulo->likeSku($sku);
		$i=0;
		foreach ($query->result() as $row ) {
			$data[$i]=$row->sku;
			$i++;
		}
		echo json_encode($data);
	}
	public function utilidadSeccion()
	{
		$this->logueado();
		$this->form_validation->set_rules('seccion','Seccion','required');
		$this->form_validation->set_rules('utilidad','Utilidad','required');
		$this->form_validation->set_rules('desde','Desde','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===FALSE)
		{
			$this->obtenerListaUtilidad();
		}
		else
		{
			$data=$this->input->post();
			if(!isset($data['prioridad']))
				$data['prioridad']="";
			if(strlen($data['prioridad'])==1)
				$data['prioridad']=1;
			else
				$data['prioridad']=0;
			$query=$this->ModelArticulo->utilidadSeccion($data);
			//$this->vista_descuentos();
			//redirect(base_url().'configuracion/obtenerListaUtilidad/');
			$this->obtenerListaUtilidad(0,$query);
		}
	}
	public function utilidadMarca()
	{
		$this->logueado();
		$this->form_validation->set_rules('marca','Marca','required');
		$this->form_validation->set_rules('utilidad','Utilidad','required');
		$this->form_validation->set_rules('desde','Desde','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===FALSE)
		{
			//$this->vista_descuentos();
			$this->obtenerListaUtilidad();
		}
		else
		{
			$data=$this->input->post();
			if(!isset($data['prioridad']))
				$data['prioridad']="";
			if(strlen($data['prioridad'])==1)
				$data['prioridad']=1;
			else
				$data['prioridad']=0;
			$query=$this->ModelArticulo->utilidadMarca($data);
			//$this->vista_descuentos();
			$this->obtenerListaUtilidad(0,$query);
		}
	}
	public function utilidadSku()
	{
		$this->logueado();
		$this->form_validation->set_rules('sku','Sku','required');
		$this->form_validation->set_rules('utilidad','Utilidad','required');
		//$this->form_validation->set_rules('desde','Desde','required');
		//$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===FALSE)
		{
			//$this->vista_descuentos();
			$this->obtenerListaUtilidad();
		}
		else
		{
			$data=$this->input->post();

			$query=$this->ModelArticulo->utilidadSku($data);
			//$this->vista_descuentos();
			redirect(base_url().'configuracion/obtenerListaUtilidad/');
		}
	}
	function listaUtilidad()
	{
		$this->logueado();
		$ind=$this->input->post('ind');
		$utilidad=$this->input->post('utilidad');
		for($i=0;$i<$ind;$i++)
		{
			if($this->input->post('item'.$i)==1)
				$this->ModelArticulo->listaUtilidad($this->input->post('id_articulo'.$i),$utilidad);
		}
		$this->obtenerListaUtilidad();
	}
	function busquedaLista()
	{
		$this->logueado();
		if($this->session->userdata('cadena'))
			$this->session->unset_userdata('cadeana');
		$this->session->set_userdata('cadena',$this->input->post('cadena'));
		$this->obtenerListaUtilidad(1);
	}
	function modificarPublicidad()
	{
		$data['promo']=$this->input->post('promo');
		$id_cotizacion=$this->input->post('id_cotizacion');
		$this->ModelAdmin->modificarPublicidad($data,$id_cotizacion);
		redirect('configuracion/correos');
	}
	function buscarCorreo()
	{
			$cadena=$this->input->post('cadena');
			$this->session->set_userdata('cadena',$cadena);
			redirect('configuracion/correos');
	}
	function getCorreos()
	{
		if($this->session->userdata('cadena'))
		{
			$this->session->unset_userdata('cadena');
		}
		redirect('configuracion/correos');
	}
	function correos()
	{
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
				$offset=0;
		$config['base_url']=base_url().'configuracion/correos';
		$config['per_page']=50;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		if($this->session->userdata('cadena'))
		{
			$data['query']=$this->ModelAdmin->buscarListaCorreos($this->session->userdata('cadena'),$offset,$config['per_page']);
			$config['total_rows']=$this->ModelAdmin->numRowsCadenaCorreos($this->session->userdata('cadena'));
		}
		else
		{
			$data['query']=$this->ModelAdmin->obtenerListaCorreos($offset,$config['per_page']);
			$config['total_rows']=$this->ModelAdmin->numRowsCorreos();
		}
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		//$data['query']=$this->ModelAdmin->getCorreoCotizaciones();
		$this->load->view('includes/header',$data);
		$this->load->view('admin/listaCorreos');
	}
	function obtenerListaUtilidad($op=0,$bandera="")
	{
		$this->logueado();
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
				$offset=0;
		$config['base_url']=base_url().'configuracion/obtenerListaUtilidad';


		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		if($op==1 || $this->session->userdata('cadena'))
		{
			$data['query']=$this->ModelArticulo->buscarLista($this->session->userdata('cadena'),$offset,$config['per_page']);
			$config['total_rows']=$this->ModelArticulo->numRowsCadena($this->session->userdata('cadena'));
		}
		else
		{
			$data['query']=$this->ModelArticulo->obtenerListaUtilidad($offset,$config['per_page']);
			$config['total_rows']=$this->ModelArticulo->numRows();
		}
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="clientesgeneral.js";
		$data['bandera']="";

		switch ($bandera)
		{
			case '1':
				$data['bandera']='Se aplico la utilidad correctamente';
				break;
			case '2':
				$data['bandera']='El limite del rango, ya se encuentra dentro de otro. Incorrecto "hasta"';
				break;
			case '3':
				$data['bandera']='El limite del rango, ya se encuentra dentro de otro. Incorrecto "desde"';
				break;
			default:
				# code...
				break;
		}

		$this->load->view('includes/header',$data);
		$this->load->view('admin/configuraciones');
	}
	function verEstado()
	{
		$this->session->set_userdata('estado',$this->uri->segment(3));
		if(!$this->session->userdata('estado'))
			$this->session->set_userdata('estado',"pendiente");
		redirect(base_url().'configuracion/verEnvios');
	}
	function buscar()
	{
		$this->logueado();
		$clave=$this->input->post('clave');
		$temp=$this->input->post('clave');
		if(ctype_digit($clave))
		{
			$query=$this->ModelArticulo->buscarReferencia($clave);
			$this->mostrarBusqueda($query);
		}
		else
			{
				$query=$this->ModelArticulo->buscarNombre($temp);
				$this->mostrarBusqueda($query);
			}
	}
	function mostrarBusqueda($query)
	{
		$data['title']="";
		$data['query']=$query;
		$this->load->view('includes/header',$data);
		$this->load->view('envios/verenvios');
		$this->load->view('envios/modales');
	}
	function verEnvios($offset=0)
	{
		$this->logueado();
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
				$offset=0;
		$config['base_url']=base_url().'configuracion/verEnvios';
		$config['total_rows']=$this->ModelArticulo->numRows_envios($this->session->userdata('estado'));
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['query']=$this->ModelArticulo->obtenerEnvios($offset,$config['per_page'],$this->session->userdata('estado'));
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$this->load->view('includes/header',$data);

		$this->load->view('envios/verenvios');
		$this->load->view('envios/modales');
	}
	function postFechas()
	{
		$this->logueado();
		$this->session->set_userdata('inicio',$this->input->post('inicio'));
		$this->session->set_userdata('fin',$this->input->post('fin'));
		redirect(base_url().'configuracion/verEnviosFechas');
	}
	function verEnviosFechas($offset=0)
	{
		$this->logueado();
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
				$offset=0;
		$config['base_url']=base_url().'configuracion/verEnviosFechas';
		$config['total_rows']=$this->ModelArticulo->numRows_enviosF($this->session->userdata('inicio'),$this->session->userdata('fin'));
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['query']=$this->ModelArticulo->obtenerEnviosF($offset,$config['per_page'],$this->session->userdata('inicio'),$this->session->userdata('fin'));
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$this->load->view('includes/header',$data);
		$this->load->view('includes/scripts');
		$this->load->view('envios/verenvios');
		$this->load->view('envios/modales');
	}
	function verRemisiones()
	{
		$this->logueado();
		$id=$this->input->post('id_pago');
		$query=$this->ModelArticulo->getRemisiones($id);
		echo json_encode($query->result());
	}
	function cambiarEstado()
	{
		$id_cliente=$this->uri->segment(4);
		$id_pago=$this->uri->segment(5);
		$data['estatus']=$this->uri->segment(3);
		$this->ModelArticulo->cambiarEstado($id_cliente,$id_pago,$data);
		redirect(base_url().'configuracion/verenvios',"refresh");
	}
	function editarRangos($offset=0)
	{
		$this->logueado();
		$categoria=$this->input->post('categoria');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
				$offset=0;
		$config['base_url']=base_url().'configuracion/editarRangos';
		$config['total_rows']=$this->ModelArticulo->numRowsRangos($categoria);
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['query']=$this->ModelArticulo->getRangos($offset,$config['per_page'],$categoria);
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$this->load->view('includes/header',$data);
		$this->load->view('admin/rangos');
	}
	function modificarRango()
	{
		$this->form_validation->set_rules('id_utilidad','ID','required');
		$this->form_validation->set_rules('ut','Utilidad','required|number|callback_comprobarRango');
		$this->form_validation->set_rules('desde','Desde','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()==false)
		{
			$this->editarRangos();
		}
		else
		{
			$data=$this->input->post();
			$id=$data['id_utilidad'];
			unset($data['id_utilidad']);
			$this->ModelArticulo->modificarRango($data,$id);
			redirect(base_url().'configuracion/editarRangos');
		}
	}
	function comprobarRango()
	{
		$data=$this->input->post();
		$query=$this->ModelArticulo->comprobarRango($data);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('comprobarRango','Este rango se encuentra dentro de otro, verificalo');
			return false;
		}
		else
			return true;
	}
	function eliminarRango()
	{
		$id=$this->input->post('id_utilidad');
		$query=$this->ModelArticulo->eliminarRango($id);
		redirect(base_url().'configuracion/editarRangos');
	}
}
