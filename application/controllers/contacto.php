<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->library("email");
		$this->load->model('ModelArticulo');
	
	}

	public function index()
	{
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['articles'] = $this->ModelArticulo->Oferts();
		$data['destacados'] = $this->ModelArticulo->Destacados();
		$data['recomendados'] = $this->ModelArticulo->Recomendados();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('contacto');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
		$this->load->view('includes/mapa');
	}

	function mensaje(){

	}

	function sendCorreo(){
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;	
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($this->input->post('txtemail'), $this->input->post('txtname'));
		$this->email->to('njl27@hotmail.com'); 
		$this->email->cc($this->input->post('txtemail')); 
		//$this->email->bcc('escuela@primariamelchorocampo.com'); 

		$this->email->subject($this->input->post('txtAsunto'));
		$this->email->message('<p>Mensaje</p> '.$this->input->post('txtMensaje'));
		$data['msj']='';
	  	if($this->email->send())
	  		$data['msj'] = "Tu correo ha sido enviado correctamente , en breve estaremos en contacto ";
	  	else
	  		$data['msj'] = 'No hemos podido enviar tu mensaje intentalo mas tarde';

	  	//var_dump($this->email->print_debugger());
	  	$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['articles'] = $this->ModelArticulo->Oferts();
		$data['destacados'] = $this->ModelArticulo->Destacados();
		$data['recomendados'] = $this->ModelArticulo->Recomendados();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('mensaje',$data);
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
		$this->load->view('includes/mapa');

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */