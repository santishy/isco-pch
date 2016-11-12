<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRango extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function getRangos($uri,$tope)
	{
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad');	
		$this->db->limit($uri,$tope);
		$query = $this->db->get();
		return $query;
	}
}