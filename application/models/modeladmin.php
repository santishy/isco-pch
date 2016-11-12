<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelAdmin extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function numRowsCorreos()
	{
		$query=$this->db->query('select count(id_cotizacion) as nume from cotizaciones where promo=1 group by correo ');
		foreach ($query->result() as $row) {
			$num=$row->nume;
		}
    return $num;
	}
  function obtenerListaCorreos($ini,$tope)
  {
    $query=$this->db->query('select distinct correo,id_cotizacion,promo,nombre from cotizaciones where promo=1 group by correo limit '.$ini.','.$tope);
    return $query;
  }
	function modificarPublicidad($data,$id_cotizacion)
	{
		$this->db->where('id_cotizacion',$id_cotizacion);
		$this->db->update('cotizaciones',$data);
	}
	function buscarListaCorreos($palabra,$ini,$tope)
	{
		$query=$this->db->query('call buscarCorreos("'.$palabra.'",'.$ini.','.$tope.')');
		$query->next_result();
		return $query;
	}
	function numRowsCadenaCorreos($palabra)
	{
		$query=$this->db->query('call numRowsCadenaCorreos("'.$palabra.'")');
		$nume=0;
		$query->next_result();
		foreach ($query->result() as $row) {
			$nume=$row->nume;
		}
		return $nume;
	}
}
?>
