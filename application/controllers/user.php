<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelUser');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('cart');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	public function logueado()
	{
		if(!$this->session->userdata('id_user'))
			redirect(base_url().'login/cerrarSesion');
		else
			if($this->session->userdata('tipo')!=1)
				redirect(base_url());
	}
	
	function agregarUser()
	{
		$this->logueado();
		$this->form_validation->set_rules('nombre_user','Nombre','required|callback_comprobarUser');
		$this->form_validation->set_rules('usuario','Us','required|comprobarUsuario');
		$this->form_validation->set_rules('pass','Password','required|md5');
		$this->form_validation->set_rules('correo','Correo','required|valid_email');
		$this->form_validation->set_rules('tipo','Tipo','required');
		$this->form_validation->set_rules('direccion','Direccion','required');
		if($this->form_validation->run()==false)
		{
			$this->vistaAU("");
		}
		else
		{
			$data=$this->input->post();
			$query=$this->ModelUser->agregarUser($data);
			$this->vistaAU("Usuario Agregado");
		}

	}
	function vistaAU($mns="")//vista agregarUsuario
	{
		$this->logueado();
		$vec['query']=$this->ModelUser->getUsuarios();
		$vec['mensaje']=$mns;

		$this->load->view('includes/header',$vec);
		//$this->load->view('includes/scripts');	
		$this->load->view('users/agregar');
		
	}
	function comprobarUser()
	{
		$this->logueado();
		$usuario=$this->input->post('usuario');
		$nombre=$this->input->post('nombre_user');
		$direccion=$this->input->post('direccion');
		$query=$this->ModelUser->comprobarUser($usuario);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('comprobarUser','Ese user ya existe ');
			return false;
		}
		else
		{
			$query=$this->ModelUser->comprobarUsuario($nombre,$direccion);
			if($query->num_rows()>0)
			{
				$this->form_validation->set_message('comprobarUser','ya existe un usuario con el mismo nombre y direccion');
				return false;
			}
			else
				return true;
		}
	}
	function eliminarUser()
	{
		$this->logueado();
		$id=$this->input->post('id_user');
		$query=$this->ModelUser->eliminarUsuario($id);
		$this->vistaAU('Usuario Eliminado');
	}

}
?>