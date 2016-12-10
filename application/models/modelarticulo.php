<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelArticulo extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}

	function countCat($id,$ban){
		if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos where
				id_marca='.$id.' ');
		else
			$query = $this->db->query('select count(*)as cantidad from articulos where
				id_seccion='.$id.' ');
		return $query;

	}
	function createShoppingCart()
	{
		$data['status']="incompleto";
		$data['created_at']=date("Y-m-d H:i:s");  
		$query=$this->db->insert('shopping_carts',$data);
		return $this->maxIdShoppingCarts();
	}
	function maxIdShoppingCarts()
	{
		$query=$this->db->query('select  id from shopping_carts order by id desc limit 1');
		foreach ($query->result() as $row) {
			$id=$row->id;
		}
		return $id;
	}
	function updateInShoppingCart($id_articulo,$data)
	{
		$this->db->where('id_articulo',$id_articulo);
		$query=$this->db->update('in_shopping_carts',$data);
		return $query;
	}
	function deleteInShoppingCart($id_articulo,$shopping_cart_id)
	{
		$query=$this->db->query('delete from in_shopping_carts where
								id_articulo='.$id_articulo.' and 
								shopping_cart_id='.$shopping_cart_id);
	}
	function inShoppingCarts($data)
	{
		$query=$this->db->insert('in_shopping_carts',$data);
		return $query;
	}
	function getNamePaquetes()
	{
		$query=$this->db->get('paquetes');
		return $query;
	}
	function getPaqueteId($id)
	{
		$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca
			join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea 
			join utilidades u on a.id_utilidad=u.id_utilidad join detpaquete dp on dp.id_articulo=a.id_articulo join paquetes pte on dp.id_paquete=pte.id_paquete where pte.id_paquete='.$id);
		return $query;
	}
	function getNews($desde,$hasta,$orden)
	{
		$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca
			join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea 
			join utilidades u on a.id_utilidad=u.id_utilidad where fecha between "'.$desde.'" and "'.$hasta.'" and (a.utilidad>0 or u.ut>0) and activo=1 order by precio '.$orden.' limit 52;');
		return $query;
	}
	function countCantPrecio($id,$ban,$precio){
		if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos a join utilidades u on 
				u.id_utilidad=a.id_utilidad where
				id_marca='.$id.'  AND (((precio*u.ut/100)+precio)*1.16) >='.$precio.'activo=1;');
		else
			$query = $this->db->query('select count(*)as cantidad from articulos  a join utilidades u on 
				u.id_utilidad=a.id_utilidad where
				id_seccion='.$id.' AND (((precio*u.ut/100)+precio)*1.16) >='.$precio.'activo=1;');
	
		/*if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos where
				id_marca='.$id.'  AND precio BETWEEN '.$precio. ' AND '. $precioF);
		else
			$query = $this->db->query('select count(*)as cantidad from articulos where
				id_seccion='.$id.' AND precio BETWEEN '.$precio. ' AND '. $precioF);*/
	
				
		return $query;
	}
	function countCantPrecioL($id,$ban,$precio,$linea){
		if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos  a join utilidades u on 
				u.id_utilidad=a.id_utilidad where
				id_marca='.$id.'  AND (((precio*u.ut/100)+precio)*1.16)>='.$precio.' and id_linea='.$linea.'activo=1;');
		else
			$query = $this->db->query('select count(*)as cantidad from articulos a join utilidades u on 
				u.id_utilidad=a.id_utilidad where
				id_seccion='.$id.' AND (((precio*u.ut/100)+precio)*1.16) >='.$precio.' and id_linea='.$linea.'activo=1;');
		/*if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos where
				id_marca='.$id.'  AND precio BETWEEN '.$precio. ' AND '. $precioF);
		else
			$query = $this->db->query('select count(*)as cantidad from articulos where
				id_seccion='.$id.' AND precio BETWEEN '.$precio. ' AND '. $precioF);*/		
		return $query;
	}
	function countRange($id,$ban,$precio,$preciof){
		if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos a join 
				utilidades u on a.id_utilidad=u.id_utilidad where activo=1 and
				id_marca='.$id.'  AND (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio. ' AND '. $preciof);
		else
			$query = $this->db->query('select count(*)as cantidad from articulos a join 
				utilidades u on a.id_utilidad=u.id_utilidad where activo=1 and
				id_seccion='.$id.' AND (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio. ' AND '. $preciof);
		return $query;
	}
	function countRangeL($id,$ban,$precio,$preciof,$linea){
		if($ban == 1)
			$query = $this->db->query('select count(*)as cantidad from articulos a join 
				utilidades u on a.id_utilidad=u.id_utilidad where activo=1 and
				id_marca='.$id.'  AND id_linea='.$linea.' and (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio. ' AND '. $preciof);
		else
			$query = $this->db->query('select count(*)as cantidad from articulos a join 
				utilidades u on a.id_utilidad=u.id_utilidad where activo=1 and
				id_seccion='.$id.' AND id_linea='.$linea.' and (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio. ' AND '. $preciof);
		return $query;
	}
	function getArticulo($id)
	{
		$this->db->where('articulos.id_articulo',$id);
		
		//$this->db->where('activo',1);
		//$this->db->where('articulos.utilidad >',0);
		//$this->db->where('utilidades.ut >',0);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		//$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		//$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$query = $this->db->get();
		return $query;
	}
	function getAlmacenesProd($id)
	{
		$query=$this->db->query('select *from inventario i join detinvart d on
			i.id_inventario=d.id_inventario join articulos a on a.id_articulo=
			d.id_articulo where a.id_articulo='.$id);
		return $query;
	}
	function getAlmacenes()
	{
		$query=$this->db->query('select almacen from inventario');
		return $query;
	}
	function getArticles()
	{

		$this->db->where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		//$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		//$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');	
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->limit(8,106);
		$query = $this->db->get();
		return $query;
	}
	function getPortatil()
	{
		$query=$this->db->query('select a.sku, a.id_articulo from articulos a join secciones s on a.id_seccion=s.id_seccion join marcas m on m.id_marca
		=a.id_marca join lineas l on a.id_linea=l.id_linea join utilidades u on u.id_utilidad=a.id_utilidad
		where a.activo=1 and s.seccion="COMPUTADORAS" order by a.id_articulo desc limit 15');
		return $query;
	}
	// filtro de articulos por marca 1 y seccion 2
	function getArticlesBrand($id,$ban,$inicio,$tope,$orden)
	{
		if($ban==1)
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca
			join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea 
			join utilidades u on a.id_utilidad=u.id_utilidad where (a.utilidad>0 or u.ut>0) and 
			a.id_marca='.$id.' and activo=1 order by precio '.$orden.' limit '.$inicio.','.$tope);
		else
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca
			join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea 
			join utilidades u on a.id_utilidad=u.id_utilidad where (a.utilidad>0 or u.ut>0) and 
			 a.id_seccion='.$id.' and activo=1 order by precio '.$orden.' limit '.$inicio.','.$tope);
		return $query;
	}
	function getArticlesBrand2($id,$ban,$inicio,$tope,$orden,$linea)
	{	
		if($ban==1)
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca
			join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea 
			join utilidades u on a.id_utilidad=u.id_utilidad where (a.utilidad>0 or u.ut>0) and 
			l.linea="'.$linea.'" and a.id_marca='.$id.' and activo=1 order by precio '.$orden.' limit '.$inicio.','.$tope);
		else
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca
			join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea 
			join utilidades u on a.id_utilidad=u.id_utilidad where (a.utilidad>0 or u.ut>0) and 
			l.linea="'.$linea.'" and a.id_seccion='.$id.' and activo=1 order by precio '.$orden.' limit '.$inicio.','.$tope);
		/*$this->db->or_where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->where('lineas.linea',$linea);
		$this->db->where('activo',1);
		if($ban == 1)
			$this->db->where('articulos.id_marca',$id);
		else
			$this->db->where('articulos.id_seccion',$id);	
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->order_by('articulos.precio',$orden);
		$this->db->limit($tope,$inicio);
		$query = $this->db->get();*/
		return $query;
	}/*
	function getArticlesBrand2($id,$ban,$inicio,$tope,$orden,$linea,$op){
		
		$this->db->or_where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->where('activo',1);
		switch ($op) {
			case '1':
			case 1:
				$this->db->where('lineas.id_linea',$linea);
				break;
			case 2:
			case '2':
				$this->db->where('marcas.id_marca',$linea);
				break;
			case 3:
			case '3':
				$this->db->where('secciones.id_seccion',$linea);
				break;
			default:
				# code...
				break;
		}
		if($ban == 1)
			$this->db->where('articulos.id_marca',$id);
		else
			$this->db->where('articulos.id_seccion',$id);
		
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		//$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		//$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->order_by('articulos.precio',$orden);
		$this->db->limit($tope,$inicio);
		$query = $this->db->get();
		return $query;
	}*/
	function countArticlesBrand($id,$ban,$linea){
		$this->db->where('activo',1);
		$this->db->or_where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->where('lineas.id_linea',$linea);
		if($ban == 1)
			$this->db->where('articulos.id_marca',$id);
		else
			$this->db->where('articulos.id_seccion',$id);
		$this->db->select('count(articulos.id_articulo) as cantidad');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		//$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		//$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$query = $this->db->get();
		return $query;
	}
	function getArticlesPrecio($id,$precio,$ban,$inicio,$tope)
	{
		if($ban==1)
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16) >='.$precio.' and (a.utilidad>0 or 
				u.ut>0) and a.id_marca='.$id.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		else
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut)+precio/100)*1.16)>='.$precio.' and (a.utilidad>0 or 
				u.ut>0) and a.id_seccion='.$id.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		/*$this->db->where('precio >=',$precio);
		$this->db->where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		if($ban == 1)
			$this->db->where('articulos.id_marca',$id);
		else
			$this->db->where('articulos.id_seccion',$id);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->order_by('articulos.precio','asc');
		$this->db->limit($tope,$inicio);
		$query = $this->db->get();*/
		return $query;
	}
	function getArticlesPrecioL($id,$precio,$ban,$inicio,$tope,$linea){
		if($ban==1)
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16)>='.$precio.' and (a.utilidad>0 or 
				u.ut>0) and a.id_marca='.$id.' and a.id_linea='.$linea.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		else
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16)>='.$precio.' and (a.utilidad>0 or 
				u.ut>0) and a.id_seccion='.$id.' and a.id_linea='.$linea.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		/*$this->db->where('precio >=',$precio);
		$this->db->where('articulos.id_linea',$linea);
		$this->db->or_where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		if($ban == 1)
			$this->db->where('articulos.id_marca',$id);
		else
			$this->db->where('articulos.id_seccion',$id);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->order_by('articulos.precio','asc');
		$this->db->limit($tope,$inicio);
		$query = $this->db->get();*/
		return $query;
	}
	function getArticlesRango($id,$precio,$precioF,$ban,$inicio,$tope)
	{

		/*$this->db->where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		if($ban == 1)
			$this->db->where('articulos.id_marca',$id);
		else
			$this->db->where('articulos.id_seccion',$id);
		$this->db->where('precio BETWEEN '. $precio .' AND '. $precioF);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->order_by('articulos.descripcion','asc');
		$this->db->limit($tope,$inicio);
		$query = $this->db->get();*/
		if($ban==1)
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio.' and '.$precioF.' and (a.utilidad>0 or 
				u.ut>0) and a.id_marca='.$id.' and activo=1  order by precio asc limit '.$inicio.','.$tope.' ;');
		else
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio.' and '.$precioF.' and (a.utilidad>0 or 
				u.ut>0) and a.id_seccion='.$id.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		return $query;
	}

function getArticlesRangoL($id,$precio,$precioF,$ban,$inicio,$tope,$linea)
	{
		if($ban==1)
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio.' and '.$precioF.' and (a.utilidad>0 or 
				u.ut>0) and a.id_marca='.$id.' and a.id_linea='.$linea.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		else
			$query=$this->db->query('select *from articulos a join marcas m on a.id_marca=m.id_marca join
			secciones s on a.id_seccion=s.id_seccion join detinvart d on a.id_articulo=d.id_articulo join
			inventario i on i.id_inventario=d.id_inventario join lineas l on l.id_linea=a.id_linea
			join utilidades u on u.id_utilidad=a.id_utilidad where (((precio*u.ut/100)+precio)*1.16) BETWEEN '.$precio.' and '.$precioF.' and (a.utilidad>0 or 
				u.ut>0) and a.id_seccion='.$id.' and a.id_linea='.$linea.' and activo=1 order by precio asc limit '.$inicio.','.$tope.' ;');
		return $query;
	}
	
	function getMarca($id){
		
		$this->db->where('id_marca',$id);
		$this->db->select('id_marca,marca');
		$query = $this->db->get('marcas');
		return $query;

	}

	function getSeccion($id){
	
		$this->db->where('id_seccion',$id);
		$this->db->select('id_seccion,seccion');
		$query = $this->db->get('secciones');
		return $query;
	}

	// para ofertas
	function Oferts(){
		//$this->db->where('existencia >',0);
		$this->db->where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
		$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		
		$this->db->limit(8,106);
		$query = $this->db->get();

		return $query;
	}

	// para los destacados o más vendidos (como lo hallas pensado)
	function Destacados(){
		//$this->db->where('existencia >',0);
		$this->db->where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
			$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->limit(12,70);
		$query = $this->db->get();
		return $query;
	}

	// Recomendados o aleatorios

	function Recomendados(){
		//$this->db->where('existencia >',0);
		$this->db->where('articulos.utilidad >',0);
		$this->db->or_where('utilidades.ut >',0);
		$this->db->select('*');
		$this->db->from('articulos');
		$this->db->join('marcas','marcas.id_marca = articulos.id_marca','left');
		$this->db->join('secciones','secciones.id_seccion = articulos.id_seccion','left');
		$this->db->join('lineas','lineas.id_linea = articulos.id_linea','left');
		$this->db->join('detinvart','detinvart.id_articulo=articulos.id_articulo','left');
		$this->db->join('inventario','inventario.id_inventario=detinvart.id_inventario','left');
			$this->db->join('utilidades','utilidades.id_utilidad=articulos.id_utilidad','left');
		$this->db->limit(8,114);
		$query = $this->db->get();

		return $query;
	}

	function searchHome($cadena){
		$query = $this->db->query('select * from articulos a INNER JOIN marcas m ON a.id_marca=m.id_marca
			JOIN secciones s ON a.id_seccion = s.id_seccion JOIN lineas l ON a.id_linea= l.id_linea
			WHERE a.descripcion like "%'.$cadena.'%" OR a.descripcion like "'.$cadena.'_%" OR a.sku="'.$cadena.'"');
		return $query;
	}

	function busquedaHome($cadena){
		$query = $this->db->query('call busqueda("'.$cadena.'")');
		$query->next_result();
		return $query;
	}

	function busquedaPrecio($cadena,$precio){
		$query = $this->db->query('call busquedaPrecio("'.$cadena.'",'.$precio.')');
		$query->next_result();
		return $query;
	}

	function busquedaRango($cadena,$precio,$preciof){
		$query = $this->db->query('call busquedaRango("'.$cadena.'",'.$precio.','.$preciof.')');
		$query->next_result();
		return $query;
	}

	function getMarcas(){
		$query=$this->db->query('select distinct m.marca, m.id_marca from articulos a join marcas m 
			on m.id_marca=a.id_marca where a.activo=1 order by marca asc');
		return $query;
	}

	function getSections(){

		$query=$this->db->query('select distinct s.seccion,s.id_seccion from secciones s join articulos a on
			a.id_seccion=s.id_seccion where a.activo=1 order by s.seccion asc');
		return $query;

	}

	function showArticle($id){
		$this->db->where('id_articulo',$id);
		$query = $this->db->get('articulos');
		return $query;
	}

	function updateStore($data,$inventario)
	{
		$caracteres=array('""','"',"''","'");
		$query=$this->db->query('call updateStore("'.str_replace($caracteres,'',$data['sku']).'","'.str_replace($caracteres,'',$data['descripcion']).'",'.$data['precio'].',"'.str_replace($caracteres,'', $data['moneda']).'",'.$inventario['almacen'].','.$inventario['existencia'].',"'.str_replace($caracteres,'',$data['linea']).'","'.str_replace($caracteres,'',$data['marca']).'","'.str_replace($caracteres,'',$data['seccion']).'","'.str_replace($caracteres,'',$data['skuFabricante']).'");');
		$query->next_result();
	}
	function updateStore2($data,$inventario,$dollar,$fecha)
	{
		$caracteres=array('""','"',"''","'");
		if($data['moneda'] != 'MN'){
			//$data['moneda'] = 'MN';
			$data['precio'] = $data['precio'] * $dollar;
		}
		$query=$this->db->query('call updateStore("'.$fecha.'","'.str_replace($caracteres,'',$data['sku']).'","'.str_replace($caracteres,'',$data['descripcion']).'",'.$data['precio'].',"'.str_replace($caracteres,'', $data['moneda']).'",'.$inventario['almacen'].','.$inventario['existencia'].',"'.str_replace($caracteres,'',$data['linea']).'","'.str_replace($caracteres,'',$data['marca']).'","'.str_replace($caracteres,'',$data['seccion']).'","'.str_replace($caracteres,'',$data['skuFabricante']).'");');
		$query->next_result();
	}
	function descuento($data)
	{
		$query=$this->db->query('call descuento("'.$data['marca'].'","'.$data['seccion'].'","'.$data['sku'].'","'.$data['descmarca'].'","'.$data['descseccion'].'","'.$data['descsku'].'");');
		$query->next_result();
	}
	function likeSeccion($seccion)
	{
		$query=$this->db->query('select seccion from secciones where seccion like "%'.$seccion.'%"');
		return $query;
	}
	function likeMarca($marca)
	{
		$query=$this->db->query('select marca from marcas where marca like "%'.$marca.'%"');
		return $query;
	}
	function likeSku($sku)
	{
		$query=$this->db->query('select sku from articulos where sku like "%'.$sku.'%";');
		return $query;
	}
	function utilidadSeccion($data)
	{
		$query=$this->db->query('call utilidadSeccion('.$data['utilidad'].','.$data['desde'].', '.$data['hasta'].',"'.$data['seccion'].'",'.$data['prioridad'].',@ban);');
		$query->next_result();
		$res=$this->db->query('select @ban');
		foreach ($res->result_array() as $row) 
		{
			$query=$row['@ban'];
		}
		return $query;
	}
	function utilidadMarca($data)
	{
		$query=$this->db->query('call utilidadMarca('.$data['utilidad'].','.$data['desde'].', '.$data['hasta'].',"'.$data['marca'].'",'.$data['prioridad'].',@ban);');
		$query->next_result();
		$res=$this->db->query('select @ban');
		foreach ($res->result_array() as $row) 
		{
			$query=$row['@ban'];
		}
		return $query;
	}
	function utilidadSku($data)
	{
		$query=$this->db->query('call utilidadSku('.$data['utilidad'].',"'.$data['sku'].'");');
		return $query;
	}

	function obtenerListaUtilidad($uri,$tope)
	{
		$query=$this->db->query('call obtenerArticulosUtilidad('.$uri.','.$tope.');');
		$query->next_result();
		return $query;
	}
	function numRows()
	{
		$query=$this->db->query('select count(id_articulo) as numero from articulos; ');
		foreach ($query->result() as $row) 
		{
			$num=$row->numero;
		}
		return $num;
	}
	function listaUtilidad($id,$utilidad)
	{
		$query=$this->db->query('update articulos set utilidad='.$utilidad.' where id_articulo='.$id.';');
	}

	function obtenerEnvios($uri,$tope,$estado)
	{
		$query=$this->db->query('call obtenerEnvios('.$uri.','.$tope.',"'.$estado.'");');
		$query->next_result();
		return $query;
	}
	function obtenerEnviosF($uri,$tope,$inicio,$fin)
	{
		$query=$this->db->query('call obtenerEnviosF('.$uri.','.$tope.',"'.$inicio.'","'.$fin.'");');
		$query->next_result();
		return $query;
	}
	function numRows_envios($estado)
	{
		$query=$this->db->query('select count(dp.id_cliente) as numero from usuarios u join envios e on u.id_usuario=e.id_usuario join detenvpagos dp on e.id_cliente=dp.id_cliente join pagos p on
   								 p.id_pago=dp.id_pago where dp.estatus="'.$estado.'";');
		foreach ($query->result() as $row) 
		{
			$num=$row->numero;
		}
		return $num;
	}
	function numRows_enviosF($inicio, $fin)
	{
		$query=$this->db->query('select count(dp.id_cliente) as numero from usuarios u join envios e on u.id_usuario=e.id_usuario join detenvpagos dp on e.id_cliente=dp.id_cliente join pagos p on
   		p.id_pago=dp.id_pago where fecha_pago between "'.$inicio.'" and "'.$fin.'";');
		foreach ($query->result() as $row) 
		{
			$num=$row->numero;
		}
		return $num;
	}

	function consultaAleatoria($sql)
	{
		$query=$this->db->query($sql);
		return $query;
	}
	function getRemisiones($id)
	{
		$query=$this->db->query('select *from envios e join detenvpagos d on e.id_cliente=d.id_cliente join pagos p on p.id_pago=d.id_pago join remisiones r on p.id_pago=r.id_pago where p.id_pago='.$id.';');
		return $query;
	}
	function busquedaMayor($cad)
	{
		$query=$this->db->query('call busquedaMayor("'.$cad.'");');
		$query->next_result();
		return $query;
	}
	function busquedaMenor($cad)
	{
		$query=$this->db->query('call busquedaMenor("'.$cad.'");');
		$query->next_result();
		return $query;
	}
	function buscarLista($cadena,$uri,$tope)
	{
		$query=$this->db->query('call buscarLista("'.$cadena.'",'.$uri.','.$tope.');');
		$query->next_result();
		return $query;
	}
	function numRowsCadena($cadena)
	{
		$num=$this->db->query('select numRowsCadena("'.$cadena.'") as nume;');
		foreach ($num->result() as $row) {
			$filas=$row->nume;
		}
		return $filas;
	}
	function getRangos($uri,$tope,$categoria)
	{
		$this->db->order_by('ut','asc');
		$this->db->like('categoria',$categoria);
		$this->db->select('*');
		$this->db->from('utilidades');
		$this->db->limit($tope,$uri);
		$query = $this->db->get();
		return $query;
	}
	function numRowsRangos($categoria)
	{
		$query=$this->db->query('select count(id_utilidad) as nume from utilidades where categoria like "'.$categoria.'";');
		foreach($query->result() as $row)
			$nume=$row->nume;
		return $nume;
	}
	function comprobarRango($data)
	{
		$query=$this->db->query('select *from utilidades where ((desde<='.$data['hasta'].' and hasta>='.$data['desde'].') or
		(desde<='.$data['desde'].' and hasta>='.$data['desde'].')) and id_utilidad!='.$data['id_utilidad'].' and categoria="'.$data['categoria'].'"	;');
		return $query;
	}
	function modificarRango($data,$id)
	{
		$this->db->query('update articulos set id_utilidad=0 where  id_utilidad='.$id.';');
		$this->db->where('id_utilidad',$id);
		$query=$this->db->update('utilidades',$data);
		$query=$this->db->query('call modificarRango('.$id.','.$data['desde'].','.$data['hasta'].',"'.$data['categoria'].'",@ban);');
		$query->next_result();
		$res=$this->db->query('select @ban');
		foreach ($res->result_array() as $row) 
		{
			$query=$row['@ban'];
		}
		return $query;
	}
	function eliminarRango($id)
	{
		$this->db->query('update articulos set id_utilidad=0 where  id_utilidad='.$id.';');
		$this->db->where('id_utilidad',$id);
		$query=$this->db->delete('utilidades');
		return $query;
	}
	function getCategoriaS($id)
	{
		$query=$this->db->query('select distinct linea,numCatProd('.$id.',linea) as nume,l.id_linea from articulos a join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea join marcas m on 
								m.id_marca=a.id_marca where s.id_seccion='.$id.' and a.activo=1;');
		return $query;
	}
	function getCategoriaM($id)
	{
		$query=$this->db->query('select distinct linea,numCatProdM('.$id.',linea) as nume,l.id_linea from articulos a join secciones s on a.id_seccion=s.id_seccion join lineas l on l.id_linea=a.id_linea join marcas m on 
								m.id_marca=a.id_marca where m.id_marca='.$id.' and a.activo=1;');
		return $query;
	}
	function getMarcaSeccion($id)
	{
		$query=$this->db->query('select distinct m.marca, numMarca('.$id.',marca) as nume, m.id_marca from secciones s join articulos a on
			s.id_seccion=a.id_seccion join marcas m on a.id_marca=m.id_marca where a.activo=1 and                        
			s.id_seccion='.$id);
		return $query;
	}
	function getMarcaBusquedaPalabra($palabra)
	{
		$query=$this->db->query('select distinct m.marca, numMarcaPalabra("'.$palabra.'",m.id_marca) as nume, m.id_marca from secciones s join articulos a on
			s.id_seccion=a.id_seccion join marcas m on a.id_marca=m.id_marca where seccion like "%'.$palabra.'%" or descripcion like "%'.$palabra.'%"');
		return $query;
	}
	function countMarcaPalabra($palabra,$id_marca)
	{
		$query=$this->db->query('select count(a.id_articulo) as nume from secciones s left join articulos a on
			s.id_seccion=a.id_seccion left join marcas m on a.id_marca=m.id_marca left join 
			lineas l on a.id_linea=l.id_linea left join utilidades u on u.id_utilidad=a.id_utilidad  where m.id_marca='.$id_marca.' and (seccion like "%'.$palabra.'%" or descripcion like "%'.$palabra.'%" ) and activo=1;');
		return $query;
	}
	function getMarcaPalabraArt($palabra,$id_marca,$uri,$tope,$orden)
	{
		$query=$this->db->query('select * from secciones s left join articulos a on
			s.id_seccion=a.id_seccion left join marcas m on a.id_marca=m.id_marca left join 
			lineas l on a.id_linea=l.id_linea left join utilidades u on u.id_utilidad=a.id_utilidad where m.id_marca='.$id_marca.' and (descripcion like "%'.$palabra.'%" or seccion like "%'.$palabra.'%")
			 order by precio '.$orden.' limit '.$uri.','.$tope);
		return $query;
	}
	function countMarcaSeccion($id_seccion,$id_marca)
	{
		$query=$this->db->query('select count(a.id_articulo) as nume from secciones s join articulos a on
			s.id_seccion=a.id_seccion join marcas m on a.id_marca=m.id_marca where 
			s.id_seccion='.$id_seccion.' and a.activo=1 and  m.id_marca='.$id_marca);
		return $query;
	}
	function getMarcaSeccionArt($id_seccion,$id_marca,$uri,$tope,$orden)
	{
		$query=$this->db->query('select * from secciones s join articulos a on
			s.id_seccion=a.id_seccion join marcas m on a.id_marca=m.id_marca join 
			lineas l on a.id_linea=l.id_linea join utilidades u on u.id_utilidad=a.id_utilidad where 
			s.id_seccion='.$id_seccion.' and m.id_marca='.$id_marca.' and a.activo=1 order by precio '.$orden.' limit '.$uri.','.$tope);
		return $query;
	}
	function getProdCategoria($linea)
	{
		$query=$this->db->query('select *from articulos a join detinvart ea on a.id_articulo=ea.id_articulo join inventario i on i.id_inventario=ea.id_inventario join marcas m on m.id_marca=a.id_marca join lineas l on l.id_linea=a.id_linea join secciones s on s.id_seccion=a.id_seccion join utilidades u on u.id_utilidad=a.id_utilidad where linea="'.$linea.'";');
		return $query;
	}
	function cambiarEstado($id_cliente,$id_pago,$data)
	{
		$this->db->where('id_cliente',$id_cliente);
		$this->db->where('id_pago',$id_pago);
		$query=$this->db->update('detenvpagos',$data);
		return $query;
	}
	function BuscarNombre($nombre)
	{
		$query=$this->db->query('call buscarNombre("'.$nombre.'")');
		$query->next_result();
		return $query;
	}
	function buscarReferencia($referencia)
	{
		$query=$this->db->query('call buscarReferencia("'.$referencia.'")');
		$query->next_result();
		return $query;
	}
	function busquedaAjax($cad)
	{
		$query=$this->db->query('call busquedaAjax("'.$cad.'");');
		$query->next_result();
		return $query;
	}
	function dolar($precio)
	{
		$query=$this->db->query('call dolar('.$precio.');');
		$query->next_result();
		return $query;
	}
	function maxIdDolar()
	{
		$query=$this->db->query('select max(id_dolar) as id_dolar from dolares');
		return $query;
	}
	function getDolar($id_dolar)
	{
		$query=$this->db->query('select  *from dolares where id_dolar='.$id_dolar.';');
		return $query;
	}
	function addCotizacion($data)
	{
		$this->db->insert('cotizaciones',$data);
		$query=$this->db->query('select max(id_cotizacion) as id_cotizacion
			from cotizaciones;');
		$id_cotizacion=0;
		foreach ($query->result() as $row) 
		{
			$id_cotizacion=$row->id_cotizacion;
		}
		$this->db->where('id_cotizacion',$id_cotizacion);
		$query=$this->db->get('cotizaciones');
		return $query;
	}
	function updateCotizacion($data,$id_cotizacion)
	{
		$this->db->where('id_cotizacion',$id_cotizacion);
		$query=$this->db->update('cotizaciones',$data);
		return $query;
	}
	function addContador($data)
	{
		$query=$this->db->query('call addContador("'.$data['fecha'].'",'.$data['id_articulo'].',"'.$data['ip'].'");');
		$query->next_result();
		return $query;
	}
	function masVistos()
	{
		$query=$this->db->query('select distinct(a.id_articulo) , numVisitas(a.id_articulo) as visitas,
		a.id_articulo,a.sku,a.descuento,a.precio,a.skuFabricante,a.utilidad,u.ut,a.descripcion,m.marca,m.id_marca from articulos a left join marcas m on m.id_marca=a.id_marca left join lineas l on l.id_linea=a.id_linea left join secciones s on s.id_seccion=a.id_seccion left join utilidades u on u.id_utilidad=a.id_utilidad join contador cont on a.id_articulo=cont.id_articulo order by visitas desc limit 10;');
		return $query;
	}
	function desactivarArticulos()
	{
		$this->db->where('id_articulo >',0);
		$query=$this->db->update('articulos',array("activo"=>0));
		return $query;
	}
	function insertarPaquete($data)
	{
		$this->db->insert('paquetes',$data);
		$query=$this->db->query('select max(id_paquete) as id_paquete from paquetes');
		return $query;
	}
	function insertarDetPaquete($data)
	{
		$query=$this->db->insert('detpaquete',$data);
		return $query;
	}
	function getPaquete($name)
	{
		$this->db->where('nombre_paquete',$name);
		$query=$this->db->get('paquetes');
		return $query;
	}
}	

?>
