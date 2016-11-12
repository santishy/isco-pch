<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Factura extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelEnvios');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	public function addFactura()
	{
		$data=$this->input->post();
		$arr['ban']=$this->validarEmpty($data);
		if($arr['ban'])
		{
			if(isset($data['nombre']))
				$query=$this->ModelEnvios->comprobarFactura($data);
			else
				$query=$this->ModelEnvios->comprobarFacturaRS($data);
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) {
					$id_factura=$row->id_factura;
				}
				
			}
			else
			{
				$this->ModelEnvios->addFactura($data);
				$query=$this->ModelEnvios->maxFactura();
				$row=$query->row_array();
				$id_factura=$row['id_factura'];
			}
			$this->session->set_userdata('id_factura',$id_factura);
			$arr['id_factura']=$id_factura;
		}
		echo json_encode($arr);
	}
	function validarEmpty($data)
	{
		//$this->logueado();
		if(empty($data))
			$ban=false;
		else
			$ban=true;
		foreach($data as $key => $value) 
		{
			if(empty($data[$key]))
			{
				$ban=false;
				continue;
			}
		}
		return $ban;
	}
	function getFactura()
	{
		$id_pago=$this->input->post('id_pago');
		$query=$this->ModelEnvios->getFactura($id_pago);
		echo json_encode($query->result());
	}
}