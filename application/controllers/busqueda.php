<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		$this->load->library('pagination');
		$this->load->library('funciones');
	}
	public function index()
	{
		$data['cadena'] = $this->input->post('txtSearch');
		$data['precio'] = '';
		//echo $this->getParidad();
		//$data['articulos'] = $this->ModelArticulo->searchHome($data['cadena']);
		$data['artmarca'] = $this->ModelArticulo->busquedaHome($data['cadena']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['listaMarca']=$this->ModelArticulo->getMarcaBusquedaPalabra($this->input->post('txtSearch'));
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$data['opcion']=0;
		$data['id']=0;
		$data['marcaSeccion']=$this->ModelArticulo->getMarcaSeccion($data['id']);
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('seccion');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}
	function busquedaAjax()
	{
		$cadena=$this->input->post('palabra');
		$query=$this->ModelArticulo->busquedaAjax($cadena);
		echo json_encode($query->result());
	}
	function precio()
	{
		$data['cadena'] = $this->input->post('txtCadena');
		$data['precio'] = $this->input->post('txtPrecio');
		$data['preciof'] = '';
		$data['articulos'] = $this->ModelArticulo->busquedaPrecio($data['cadena'],$data['precio']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}

	function rango()
	{
		$data['cadena'] = $this->input->post('txtCad');
		$data['precio'] = $this->input->post('txtRange1');
		$data['preciof'] = $this->input->post('txtRange2');
		$data['articulos'] = $this->ModelArticulo->busquedaRango($data['cadena'],$data['precio'],$data['preciof']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}
	function mayorMenor()
	{
		$data['cadena'] = $this->uri->segment(4);
		$data['precio'] = '';
		$data['preciof'] = '';
		$cadena=$this->uri->segment(4);
		$op=$this->uri->segment(3);
		if($op==1 || $op=="1")
			$data['articulos'] = $this->ModelArticulo->busquedaMenor($cadena);
		else
			$data['articulos'] = $this->ModelArticulo->busquedaMayor($cadena);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}
	function palabraBusqueda()
	{
		$palabra=$this->uri->segment(3);
		$id_marca=$this->uri->segment(4);
		if(!$this->session->userdata('orden'))
		{
			$uri_segment=5;
			$this->session->set_userdata('orden','desc');
			$config['base_url']=base_url().'busqueda/palabraBusqueda/'.$palabra.'/'.$id_marca.'/2';
		}
		else
		{
			$uri_segment=6;
			$config['base_url']=base_url().'busqueda/palabraBusqueda/'.$palabra.'/'.$id_marca.'/2';
		}
		$data['precio'] =  '';
		$data['preciof']='';
		$data['linea']='';
		//if(!empty($this->uri->segment())
		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$query=$this->ModelArticulo->countMarcaPalabra($palabra,$id_marca);
		$nume=0;
		foreach ($query->result() as $row)
		{
			$nume=$row->nume;
		}
		$config['total_rows']=$nume;
		$config['per_page']=20;
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
		$data['cont']=$this->uri->segment($uri_segment);
		$data['articulos']=$this->ModelArticulo->getMarcaPalabraArt($palabra,$id_marca,$offset,$config['per_page'],$this->session->userdata('orden'));
		$data['num']=$config['total_rows'];
		//$data['categorias']=$this->ModelArticulo->getCategoriaS($id_seccion);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['ban'] = 2;
		//$data['id']=$id_seccion;
		//$data['marcaSeccion']=$this->ModelArticulo->getMarcaSeccion($id_seccion);
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['cadena']=$palabra;
		$data['id_marca']=$id_marca;
		$data['listaMarca']=$this->ModelArticulo->getMarcaBusquedaPalabra($palabra);
		//$data['nombremarca'] = $this->ModelArticulo->getSeccion($id_seccion);
		//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}
	function getParidad()
	{
		$cambio = 0;
		require_once('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
		$param = array('cliente' =>6722,'llave' => '112012');
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
					$cambio = $result['datos'];
			}
		}
		return $cambio;
	}
	function marcaSeccion()
	{
		if(!$this->session->userdata('orden'))
		{
			$uri_segment=5;
			$this->session->set_userdata('orden','desc');
		}
		else
			$uri_segment=6;
		$id_seccion=$this->uri->segment(3);
		$id_marca=$this->uri->segment(4);
		$data['precio'] =  '';
		$data['preciof']='';
		$data['linea']='';
		//if(!empty($this->uri->segment())

		$offset=$this->uri->segment($uri_segment);
		if(empty($offset))
			$offset=0;
		$config['base_url']=base_url().'busqueda/marcaSeccion/'.$id_seccion.'/'.$id_marca.'/'.$this->uri->segment(5).'/';
		$query=$this->ModelArticulo->countMarcaSeccion($id_seccion,$id_marca);
		$nume=0;
		foreach ($query->result() as $row) {
			$nume=$row->nume;
		}
		$config['total_rows']=$nume;
		$config['per_page']=50;
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
		$data['cont']=$this->uri->segment($uri_segment);
		$data['artmarca']=$this->ModelArticulo->getMarcaSeccionArt($id_seccion,$id_marca,$offset,$config['per_page'],$this->session->userdata('orden'));
		$data['num']=$config['total_rows'];
		$data['categorias']=$this->ModelArticulo->getCategoriaS($id_seccion);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['ban'] = 2;
		$data['id']=$id_seccion;
		$data['marcaSeccion']=$this->ModelArticulo->getMarcaSeccion($id_seccion);
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['nombremarca'] = $this->ModelArticulo->getSeccion($id_seccion);
		//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->vistaPaginacion($data);
	}
	function deMayorMenor()
	{
		$id_seccion=$this->uri->segment(3);
		$id_marca=$this->uri->segment(4);
		$op=$this->uri->segment(5);
		if($this->uri->segment(6)!= 1 and $this->uri->segment(6)!=2)
		{
			$pag=$this->uri->segment(6);
			$ruta=$this->uri->segment(7);
		}
		else
		{
			$pag=$this->uri->segment(7);
			$ruta=$this->uri->segment(6);
		}

		if ($op==1)
			$orden='desc';
		else
			$orden='asc';
		$this->session->set_userdata('orden',$orden);
		if($ruta==1 || $ruta=="1")
			redirect(base_url().'busqueda/marcaSeccion/'.$id_seccion.'/'.$id_marca.'/'.$pag);
		else
			redirect(base_url().'busqueda/palabraBusqueda/'.$id_seccion.'/'.$id_marca.'/'.$pag);
	}
	function vistaPaginacion($data)
	{
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('productosmarca');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
