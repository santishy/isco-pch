<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('ModelArticulo');
		$this->load->library('funciones');
	}
	public function desactivarArticulos()
	{
		$query=$this->ModelArticulo->desactivarArticulos();
	}

}