<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('ModelArticulo');
		$this->load->library('funciones');
	}

	public function index()
	{
		
	}
	public function galeria()
	{
		$data['cadena'] = $this->input->post('txtSearch');
		$data['precio'] = '';
		//echo $this->getParidad();
		//$data['articulos'] = $this->ModelArticulo->searchHome($data['cadena']);
		$data['articulos'] = $this->ModelArticulo->busquedaHome($data['cadena']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['listaMarca']=$this->ModelArticulo->getMarcaBusquedaPalabra($this->input->post('txtSearch'));
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$data['query']=$this->ModelArticulo->getPortatil();
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('sidebar');
		$this->load->view('galeria');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');	
	}
	
	function getArticulo()
	{
		$id_articulo=$this->input->post('id_articulo');
		$query=$this->ModelArticulo->getArticulo($id_articulo);
		echo json_encode($query->result());
	}
	function articulosMarca(){
		$id = $this->uri->segment(2);
		$op=$this->uri->segment(4);
		$data['precio'] =  ''; 
		$data['cadena'] ='';
		if(isset($op) && ($op==2 || $op==1))
			$uri_segment=5;
		else
			$uri_segment=4;
		/* pagination  */
		$cantidad = 0;
		//$uri_segment=4;
		$offset=$this->uri->segment($uri_segment);
		if (empty($offset))
			$offset=0;
		/* cantidad de elementos que regresa la consulta */
		$qty = $this->ModelArticulo->countCat($id);
		foreach($qty->result() as $cant)
			$cantidad = $cant->cantidad;
		$config['base_url']=base_url().'articulos/'.$id.'/';
		$config['total_rows'] = $cantidad;
		$config['per_page'] = 20; 
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link']="Último";
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link']="&raquo;";
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link']="&laquo;";
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open']='<li class="active">';
		$config['cur_tag_close']='</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config); 
		$data['paginacion'] = $this->pagination->create_links();
		if ($op==1)
			$orden='desc';
		else
			$orden='asc';
		$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id,$offset,$config['per_page'],$orden);
		/* */
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['nombremarca'] = $this->ModelArticulo->getMarca($id);
		$data['preciof']='';
		$data['rango'] = '';
		//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('productosmarca');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
	}
	function marcas(){
		$bandera=false;
		$id = $this->uri->segment(3);
		$op=$this->uri->segment(4);
		$data['precio'] =  ''; 
		$data['preciof']='';
		$cantidad = 0;
		switch ($op) 
		{
			case '2':
			case 2:
			case '1':
			case 1:
				$uri_segment=5;
				$data['linea']='';
				break;
			case 'linea':
				if($this->uri->segment(6)=='1' || $this->uri->segment(6)=='2')
				{
					$op=$this->uri->segment(6);
					$uri_segment=7;
				}
				else
					$uri_segment=6;
				$linea=$this->uri->segment(5);
				$data['linea']=$linea;
				$bandera=true;
				break;
			default:
				$uri_segment=4;
				$data['linea']='';
				break;
		}
		$offset=$this->uri->segment($uri_segment);
		if (empty($offset))
			$offset=0;
		/* cantidad de elementos que regresa la consulta */
		if($bandera)
		{
			if($op=='1' || $op='2')
				$config['url']=base_url().'articulos/secciones/'.$id.'/linea/'.$linea.'/'.$op;
			else
				$config['url']=base_url().'articulos/secciones/'.$id.'/linea/'.$linea;
			$qty=$this->ModelArticulo->countArticlesBrand($id,1,$linea);
		}		
		else
		{
			if($op=='1' || $op='2')
				$config['url']=base_url().'articulos/secciones/'.$id.'/'.$op;
			else
				$config['url']=base_url().'articulos/secciones/'.$id.'/';
			$qty = $this->ModelArticulo->countCat($id,1);
		}
		foreach($qty->result() as $cant)
			$cantidad = $cant->cantidad;
		
		$config['qty']=$cantidad;
		$config['uri_segment']=$uri_segment;
		$tope=$this->configPagination($config);
		$data['paginacion'] = $this->pagination->create_links();
		if ($op==1)
			$orden='desc';
		else
			$orden='asc';
		if($bandera)
			$data['artmarca'] = $this->ModelArticulo->getArticlesBrand2($id,1,$offset,$tope,$orden,$linea);
		else
			$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id,1,$offset,$tope,$orden);
		/* */
		//echo $id;
		//print_r($data['artmarca']);
		$data['categorias']=$this->ModelArticulo->getCategoriaM($id);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['ban'] = 1;
		$data['id']=$id;
		$data['opcion']=1;
		$query=$this->ModelArticulo->getMarca($id);
		foreach ($query->result() as $row) 
		{
			$data['seccion']=$row->marca;
		}
		$data['marcaSeccion']=$this->ModelArticulo->getMarcaSeccion($id);
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['nombremarca'] = $this->ModelArticulo->getSeccion($id);
		//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->vistaPaginacion($data);
	}

	
	public function searchGaleria($offset="")
	{
		$id=$this->uri->segment(3);
		$uri_segment=$this->uri->segment(4);
		$offset=$uri_segment;
		if($offset=="")
			$offset=0;
		$config['url']=base_url().'articulos/searchGaleria/';
		$qty=$this->ModelArticulo->countCat($id,2);
		foreach($qty->result() as $cant)
			$cantidad = $cant->cantidad;
		
		$config['qty']=$cantidad;
		$config['uri_segment']=$uri_segment;
		$tope=$this->configPagination($config);
		$data['paginacion'] = $this->pagination->create_links();
		$data['artsec'] = $this->ModelArticulo->getArticlesBrand($id,2,$offset,$tope,'asc');
		$data['cadena'] = $this->input->post('txtSearch');
		$data['precio'] = '';
		//echo $this->getParidad();
		//$data['articulos'] = $this->ModelArticulo->searchHome($data['cadena']);
		$data['articulos'] = $this->ModelArticulo->busquedaHome($data['cadena']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['listaMarca']=$this->ModelArticulo->getMarcaBusquedaPalabra($this->input->post('txtSearch'));
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$data['query']=$this->ModelArticulo->getPortatil();
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		$this->load->view('sidebar');
		$this->load->view('galeriasec');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');	
	}
	function secciones()
	{
		$bandera=false;
		$id = $this->uri->segment(3);
		$op=$this->uri->segment(4);
		$data['precio'] =  ''; 
		$data['preciof']='';
		$cantidad = 0;
		switch ($op) 
		{
			case '2':
			case 2:
			case '1':
			case 1:
				$uri_segment=5;
				$data['linea']='';
				break;
			case 'linea':
				if($this->uri->segment(6)=='1' || $this->uri->segment(6)=='2')
				{
					$op=$this->uri->segment(6);
					$uri_segment=7;
				}
				else
					$uri_segment=6;
				$linea=$this->uri->segment(5);
				$data['linea']=$linea;
				$bandera=true;
				break;
			default:
				$uri_segment=4;
				$data['linea']='';
				break;
		}
		$offset=$this->uri->segment($uri_segment);
		if (empty($offset))
			$offset=0;
		/* cantidad de elementos que regresa la consulta */
		if($bandera)
		{
			if($op=='1' || $op='2')
				$config['url']=base_url().'articulos/secciones/'.$id.'/linea/'.$linea.'/'.$op;
			else
				$config['url']=base_url().'articulos/secciones/'.$id.'/linea/'.$linea;
			$qty=$this->ModelArticulo->countArticlesBrand($id,2,$linea);
		}		
		else
		{
			if($op=='1' || $op='2')
				$config['url']=base_url().'articulos/secciones/'.$id.'/'.$op;
			else
				$config['url']=base_url().'articulos/secciones/'.$id.'/';
			$qty = $this->ModelArticulo->countCat($id,2);
		}
		foreach($qty->result() as $cant)
			$cantidad = $cant->cantidad;
		
		$config['qty']=$cantidad;
		$config['uri_segment']=$uri_segment;
		$tope=$this->configPagination($config);
		$data['paginacion'] = $this->pagination->create_links();
		if ($op==1)
			$orden='desc';
		else
			$orden='asc';
		if($bandera)
			$data['artmarca'] = $this->ModelArticulo->getArticlesBrand2($id,2,$offset,$tope,$orden,$linea);
		else
			$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id,2,$offset,$tope,$orden);
		/* */
		//echo $id;
		//print_r($data['artmarca']);
		$data['categorias']=$this->ModelArticulo->getCategoriaS($id);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['ban'] = 2;
		$data['id']=$id;
		$query=$this->ModelArticulo->getSeccion($id);
		foreach ($query->result() as $row) 
		{
			$data['seccion']=$row->seccion;
		}
		$data['opcion']=2;
		$data['marcaSeccion']=$this->ModelArticulo->getMarcaSeccion($id);
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['nombremarca'] = $this->ModelArticulo->getSeccion($id);
		//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->vistaPaginacion($data);
	}
	function cargaAjax()
	{
		$id= $this->input->post('id');
		$pag=$this->input->post('pagina');
		$op=$this->input->post('op');
		$orden=$this->input->post('orden');
		$linea=$this->input->post('linea');
		$id_marca=$this->input->post('id_marca');
		if($op==1)
			$op=1;
		else 
			$op=2;
		if ($orden==1)
			$orden='asc';
		else
			$orden='desc';
		if(strlen($id_marca)==0)
			if(strlen($linea)>0)
			{
				$data['artmarca'] = $this->ModelArticulo->getArticlesBrand2($id,$op,$pag,21,$orden,$linea);
			}
			else	
				$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id,$op,$pag,21,$orden);
		else 
		{
			$data['artmarca']=$this->ModelArticulo->getMarcaSeccionArt($id,$id_marca,$pag,21,$orden);
			
		}
			
		$data['id']=$id;
		echo json_encode($data['artmarca']->result());
	}
	public function nuevosProductos()
	{	
		date_default_timezone_set('America/Monterrey');
		$hasta=date('Y-m-d'); 
		$desde=date('Y-m-d',strtotime('-2 month')); 
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['artmarca']=$this->ModelArticulo->getNews($desde,$hasta,'desc');
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		//$this->load->view('productosmarca');
		$this->load->view('new');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');	
	}
	function vistaPaginacion($data)
	{
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		//$this->load->view('productosmarca');
		$this->load->view('seccion');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');	
	}
	function configPagination($data)
	{
		$config['base_url']=$data['url'];
		$config['total_rows'] = $data['qty'];
		$config['per_page'] = 21; 
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link']="Último";
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link']="&raquo;";
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link']="&laquo;";
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open']='<li class="active"><a href="#">';
		$config['cur_tag_close']='</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['uri_segment']=$data['uri_segment'];
		$this->pagination->initialize($config);
		return $config['per_page'];
	}
	function precio(){
		if($this->input->post('txtRang')){
			$session_data = array(
				'idArt' => $this->input->post('txtId'),
				'bandera' => $this->input->post('txtBan'),
				'precio' => $this->input->post('txtRang')
			);
			$this->session->set_userdata($session_data);
		}
			if($this->session->userdata('idArt')){
				$cantidad = 0;
				$uri_segment=4;
				$offset=$this->uri->segment($uri_segment);
				if (empty($offset))
				{
					$offset=0;
					$linea=$this->input->post('linea');
				}
				else
					if($offset=='linea')
					{
						$offset=$this->uri->segment(6);
						$linea=$this->uri->segment(5);
					}
					else
					{
						$linea=$this->input->post('linea');
						//$offset=$this->uri->segment(5);	
					}
					if (empty($offset))
							$offset=0;
						
				/* cantidad de elementos que regresa la consulta */
				if($linea)
				{
					$qty = $this->ModelArticulo->countCantPrecioL($this->session->userdata('idArt'),
					$this->session->userdata('bandera'),$this->session->userdata('precio'),$linea);	
				}
				else
				{
					$qty = $this->ModelArticulo->countCantPrecio($this->session->userdata('idArt'),
						$this->session->userdata('bandera'),$this->session->userdata('precio'));
				}
				foreach($qty->result() as $cant)
					$cantidad = $cant->cantidad;
				if($this->session->userdata('bandera') == 1)
				{
					if($this->uri->segment(4)=='linea')
						$config['base_url']=base_url().'articulos/precio/'.$this->session->userdata('idArt').'/linea/'.$this->uri->segment(5);
					else	
						$config['base_url']=base_url().'articulos/precio/'.$this->session->userdata('idArt').'/';
					$data['categorias']=$this->ModelArticulo->getCategoriaM($this->session->userdata('idArt'));
				}
				else
				{	if($this->uri->segment(4)=='linea')
						$config['base_url']=base_url().'articulos/precio/'.$this->session->userdata('idArt').'/linea/'.$this->uri->segment(5);
					else
						$config['base_url']=base_url().'articulos/precio/'.$this->session->userdata('idArt').'/';
					$data['categorias']=$this->ModelArticulo->getCategoriaS($this->session->userdata('idArt'));
				}
				$config['total_rows'] = $cantidad;
				$config['per_page'] = 20; 
				$connfig['num_links']=5;
				$config['first_link']="Primero";
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_link']="Último";
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['next_link']="&raquo;";
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['prev_link']="&laquo;";
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
				$config['full_tag_close'] = '</ul>';
				$config['cur_tag_open']='<li class="active"><a href="#">';
				$config['cur_tag_close']='</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['uri_segment']=$uri_segment;
				$this->pagination->initialize($config); 
				$data['paginacion'] = $this->pagination->create_links();
				if($linea)
					$data['artmarca'] = $this->ModelArticulo->getArticlesPrecioL(
					$this->session->userdata('idArt'),$this->session->userdata('precio'),
					$this->session->userdata('bandera'),$offset,$config['per_page'],$linea);
				else	
					$data['artmarca'] = $this->ModelArticulo->getArticlesPrecio(
					$this->session->userdata('idArt'),$this->session->userdata('precio'),
					$this->session->userdata('bandera'),$offset,$config['per_page']);
				/* */
				$data['secciones'] = $this->ModelArticulo->getSections();
				$data['ban'] = $this->session->userdata('bandera');
				$data['marcas'] = $this->ModelArticulo->getMarcas();
				//$data['categorias']=$this->ModelArticulo->getCategoriaS($);
				if($this->session->userdata('bandera') == 1)
					$data['nombremarca'] = $this->ModelArticulo->getMarca($this->session->userdata('idArt'));
				else
					$data['nombremarca'] = $this->ModelArticulo->getSeccion($this->session->userdata('idArt'));
				//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
				$data['precio'] = $this->session->userdata('precio');
				$data['preciof']='';
				$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
				$data['file'] = "main.js";
				$data['id']=$this->session->userdata('idArt');
				$data['linea']=$linea;
				$this->load->view('includes/headersite',$data);
				$this->load->view('includes/scripts');
				$this->load->view('productosmarca');
				$this->load->view('includes/cart');
				$this->load->view('includes/prefooter');
			}		
	}
	function rango(){
		if($this->input->post()){

			$session_data = array(
				'idArt' => $this->input->post('txtIdArt'),
				'bandera' => $this->input->post('txtban'),
				'precio' => $this->input->post('txtRange1'),
				'preciof'=> $this->input->post('txtRange2')
			);
			$this->session->set_userdata($session_data);
		}	
		if($this->session->userdata('idArt')){
			$cantidad = 0;
			$uri_segment=4;
			$offset=$this->uri->segment($uri_segment);
			if (empty($offset))
			{
				$offset=0;
				$linea=$this->input->post('linea');
			}
			else
				if($offset=='linea')
				{
					$offset=$this->uri->segment(6);
					$linea=$this->uri->segment(5);
				}
				else
				{
					$linea=$this->input->post('linea');
				}
			if (empty($offset))
				$offset=0;
			/* cantidad de elementos que regresa la consulta */
			if($linea)
			{
				$qty = $this->ModelArticulo->countRangeL($this->session->userdata('idArt'),
				$this->session->userdata('bandera'),$this->session->userdata('precio'),
				$this->session->userdata('preciof'),$linea);
			}
			else
			{
				$qty = $this->ModelArticulo->countRange($this->session->userdata('idArt'),
				$this->session->userdata('bandera'),$this->session->userdata('precio'),
				$this->session->userdata('preciof'));
			}
			foreach($qty->result() as $cant)
				$cantidad = $cant->cantidad;
			if($this->session->userdata('bandera') == 1)
			{
				if($this->uri->segment(4)=='linea')
					$config['base_url']=base_url().'articulos/rango/'.$this->session->userdata('idArt').'/linea/'.$this->uri->segment(5).'/';
				else
					$config['base_url']=base_url().'articulos/rango/'.$this->session->userdata('idArt').'/';
				$data['categorias']=$this->ModelArticulo->getCategoriaM($this->session->userdata('idArt'));
			}
			else
			{
				if($this->uri->segment(4)=='linea')
					$config['base_url']=base_url().'articulos/rango/'.$this->session->userdata('idArt').'/linea/'.$this->uri->segment(5).'/';
				else	
					$config['base_url']=base_url().'articulos/rango/'.$this->session->userdata('idArt').'/';
				$data['categorias']=$this->ModelArticulo->getCategoriaS($this->session->userdata('idArt'));
			}
			$config['total_rows'] = $cantidad;
			$config['per_page'] = 20; 
			$connfig['num_links']=5;
			$config['first_link']="Primero";
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link']="Último";
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link']="&raquo;";
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link']="&laquo;";
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
			$config['full_tag_close'] = '</ul>';
			$config['cur_tag_open']='<li class="active"><a href="#">';
			$config['cur_tag_close']='</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['uri_segment']=$uri_segment;
			$this->pagination->initialize($config); 
			$data['paginacion'] = $this->pagination->create_links();
			if($linea)
			{
				$data['artmarca'] = $this->ModelArticulo->getArticlesRangoL(
				$this->session->userdata('idArt'),$this->session->userdata('precio'),
				$this->session->userdata('preciof'),$this->session->userdata('bandera'),
				$offset,$config['per_page'],$linea);
			}
			else
			{
				$data['artmarca'] = $this->ModelArticulo->getArticlesRango(
				$this->session->userdata('idArt'),$this->session->userdata('precio'),
				$this->session->userdata('preciof'),$this->session->userdata('bandera'),
				$offset,$config['per_page']);

			}
			$data['secciones'] = $this->ModelArticulo->getSections();
			$data['ban'] = $this->session->userdata('bandera');
			$data['marcas'] = $this->ModelArticulo->getMarcas();
			if($this->session->userdata('bandera') == 1)
				$data['nombremarca'] = $this->ModelArticulo->getMarca($this->session->userdata('idArt'));
			else
				$data['nombremarca'] = $this->ModelArticulo->getSeccion($this->session->userdata('idArt'));
			//$data['artmarca'] = $this->ModelArticulo->getArticlesBrand($id);
			$data['precio'] = $this->session->userdata('precio');
			$data['preciof']= $this->session->userdata('preciof');
			$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
			$data['file'] = "main.js";
			$data['id']=$this->session->userdata('idArt');
			$data['linea']=$this->input->post('linea');
			$this->load->view('includes/headersite',$data);
			$this->load->view('includes/scripts');
			$this->load->view('productosmarca');
			$this->load->view('includes/cart');
			$this->load->view('includes/prefooter');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */