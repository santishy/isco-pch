<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelEnvios extends CI_Model {
	function __construct ()
	{
		parent::__construct();
	}
	function registrarUsuario($data)
	{
		$query=$this->db->insert('usuarios',$data);
		return $query;
	}
	function buscarUsuario($correo)
	{
		$query=$this->db->query('select id_usuario from usuarios where correo="'.$correo.'";');
		return $query;
	}
	function comprobarUsuario($correo,$pass)
	{
		$query=$this->db->query('select id_usuario from usuarios where correo="'.$correo.'" and pass="'.$pass.'";');
		return $query;	
	}
	function getUsuario($id)
	{
		$this->db->where('id_usuario',$id);
		$query=$this->db->get('usuarios');
		return $query;
	}
	function registroEnvio($data)
	{
		$query=$this->db->insert('envios',$data);
		return $query;
	}
	function obtenerUltimoEnvio($correo)
	{
		$query=$this->db->query('select id_cliente, nombre,apellido_paterno,apellido_materno,telefono,calle,colonia,codigo_postal,razon_social,estado,ciudad,rfc,n_interior,n_exterior,referencia from envios e join usuarios u on u.id_usuario=e.id_usuario where correo="'.$correo.'" and id_cliente=(select max(id_cliente) from envios e join usuarios u on u.id_usuario=e.id_usuario where correo="'.$correo.'"); ');
		return $query;
	}
	function obtenerEnvio($id_cliente)
	{
		$query=$this->db->query('select id_cliente,correo, nombre,apellido_paterno,apellido_materno,telefono,calle,colonia,codigo_postal,razon_social,estado,ciudad,rfc,n_interior,n_exterior,referencia from envios e join usuarios u on u.id_usuario=e.id_usuario where e.id_cliente='.$id_cliente.';');
		return $query;
	}
	function obtenerArtEnvArt($id_cliente)
	{
		$query=$this->db->query('select *from detenvarticulos d join articulos a on d.id_articulo=a.id_articulo where d.id_cliente='.$id_cliente.';');
		return $query;
	}
	function obtenerRemisiones($id_pago)
	{
		$this->db->where('id_pago',$id_pago);
		$query=$this->db->get('remisiones');
		return $query;
	}
	function agregarDetEnvArt($data)
	{
		$query=$this->db->insert('detenvarticulos',$data);
		return $query;
	}
	function agregarRemision($data)
	{
		$query=$this->db->insert('remisiones',$data);
		return $query;
	}
	function maxIdPago()
	{
		$query=$this->db->query('select max(id_pago) as id_pago from pagos ; ');
		return $query;
	}
	function agregarPago($data)
	{
		$query=$this->db->query('call agregarPago('.$data['id_cliente'].',"'.$data['fecha_pago'].'",'.$data['total'].',"'.$data['tipo_pago'].'",@ban);');
		$query->next_result();
		$res=$this->db->query('select @ban');
		foreach ($res->result_array() as $row) 
		{
			$query=$row['@ban'];
		}
		return $query;
	}
	function getLastSends($id_usuario)
	{
		$query=$this->db->query('select *from envios where id_usuario='.$id_usuario.' order by id_cliente desc limit 3;');
		return $query;
	}
	function modiEstadoPago($data,$id)
	{
		$this->db->where('id_pago',$id);
		$query=$this->db->update('pagos',$data);
		return $query;
	}
	function comprobarFactura($data)
	{
		$query=$this->db->query('select *from facturaciones where nombre="'.$data['nombre'].'" and ap_paterno="'.$data['ap_paterno'].'" and
			ap_materno="'.$data['ap_materno'].'"  and
			rfc="'.$data['rfc'].'" and calle="'.$data['calle'].'" and numero="'.$data['numero'].'" and
			colonia="'.$data['colonia'].'" and ciudad="'.$data['ciudad'].'" and estado="'.$data['estado'].'" and
			cp="'.$data['cp'].'"
			; ');
		return $query;
	}
	function comprobarFacturaRS($data)
	{
		$query=$this->db->query('select *from facturaciones where razon_social="'.$data['razon_social'].'" and
			rfc="'.$data['rfc'].'" and calle="'.$data['calle'].'" and numero="'.$data['numero'].'" and
			colonia="'.$data['colonia'].'" and ciudad="'.$data['ciudad'].'" and estado="'.$data['estado'].'" and
			cp="'.$data['cp'].'"
			; ');
		return $query;

	}
	function maxFactura()
	{
		$query=$this->db->query('select max(id_factura) as id_factura from facturaciones');
		return $query;
	}
	function addFactura($data)
	{
		$query=$this->db->insert('facturaciones',$data);
		return $data;
	}
	function addDetFac($data)
	{
		$query=$this->db->insert('detfacpag',$data);
		return $query;
	}
	function getFactura($id_pago)
	{
		$query=$this->db->query('select *from pagos p join detfacpag d on p.id_pago=
		d.id_pago join facturaciones f on f.id_factura=d.id_factura where p.id_pago='.$id_pago.'; ');
		return $query;
	}
}
?>