<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUser extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function comprobarUser($usuario)
	{
		$this->db->where('usuario',$usuario);
		$query=$this->db->get('administradores');
		return $query;
	}
	function comprobarUsuario($nombre,$direccion)
	{
		$this->db->where('nombre_user',$nombre);
		$this->db->where('direccion',$direccion);
		$query=$this->db->get('administradores');
		return $query;
	}
	function agregarUser($data)
	{
		$query=$this->db->insert('administradores',$data);
		return $query;
	}
	function getUsuarios()
	{
		$this->db->select('*');
		$query=$this->db->get('administradores');
		return $query;
	}
	function eliminarUsuario($id)
	{
		$this->db->where('id_user',$id);
		$query=$this->db->delete('administradores');
		return $query;
	}
	function login($usuario,$pass)
	{
		$this->db->where('usuario',$usuario);
		$this->db->where('pass',$pass);
		$query=$this->db->get('administradores');
		return $query;
	}
}
?>