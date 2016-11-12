<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUsuarios extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}

	function login($data)
	{
		$query = $this->db->query('select * from usuarios where usuario_user="'.$data['user'].'" and usuario_password="'.$data['pass'].'" and usuario_status = 1;');
		return $query;
	}

	
}