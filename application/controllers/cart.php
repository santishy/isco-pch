<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		$this->load->library('cart');
		$this->load->library('session');
	}

	public function index()
	{
		
	}

	function addCart(){
		$cant = 0; $arr=array();
		if($this->input->post('txtCantidad') <= $this->input->post('txtExis'))
		{
			$data=array('id' => $this->input->post('id_articulo'),
			'qty'=> $this->input->post('txtCantidad'),
			'price'=> $this->input->post('txtPrecio'),
			'name'=> $this->input->post('txtNombre'),
			'almacen'=>$this->input->post('txtAlmacen'),
			'existencia'=>$this->input->post('txtExis'),
			'sku' => $this->input->post('txtSku'),
			'proveedor'=>$this->input->post('proveedor'),
			'moneda'=>$this->input->post('moneda'));

			$this->cart->insert($data);
			if(!$this->session->userdata('shopping_cart_id'))
			{
				$this->session->set_userdata('shopping_cart_id',$this->ModelArticulo->createShoppingCart());
			}
			$data['shopping_cart_id']=$this->session->userdata('shopping_cart_id');
			unset($data['name']);
			unset($data['existencia']);
			unset($data['sku']);
			unset($data['proveedor']);
			unset($data['moneda']);
			$data['id_articulo']=$data['id'];
			unset($data['id']);
			$this->ModelArticulo->inShoppingCarts($data);
			$arr=$this->cart->contents();
			$this->session->set_userdata('carrito',count($arr));
			$vec = array('ban' => 1 , 'valor' => count($arr),
				'shopping_cart_id'=>$data['shopping_cart_id']);
			echo json_encode($vec);
		}
		else
			{
				$vec = array('ban' => 0 , 'valor' => 0,'shopping_cart_id'=>$this->session->userdata('shopping_cart_id'));
				echo json_encode($vec);
				exit();
			}
	}
	function destroyCart(){
		$this->cart->destroy();
		$this->session->set_userdata('carrito',0);
		$this->session->unset_userdata('shopping_cart_id');
		redirect('inicio/index');
	}

	function showCart(){
		
	}
	function updateInShoppingCart($id_articulo,$cant)
	{
		$data['qty']=$cant;
		$query=$this->ModelArticulo->updateInShoppingCart($id_articulo,$data);
		return $query;
	}
	function update()
	{
		$id = $this->input->post('id');
		$cant = $this->input->post('cant');
		$exis = $this->input->post('exis');
		foreach ($this->cart->contents() as $item) 
		{
			if($item['id'] == $id){
				/*if($cant > 0)
					$cant = $cant + $item['qty'];*/
				if($cant > $exis){
					$this->updateInShoppingCart($id,$exis);
					$this->updateCar($item['rowid'],$exis);	
				}
				else{
					if($cant==0)
						$this->ModelArticulo->deleteInShoppingCart($id,$this->session->userdata('shopping_cart_id'));
					else 
						$this->updateInShoppingCart($id,$cant);
					$this->updateCar($item['rowid'],$cant);
				}
				
			}
		
		}
		
	}

	function updateCar($id,$quantity){
		$data = array(
 			'rowid' => $id,
 			'qty' => $quantity
 		);
 		$this->cart->update($data);
 		$arr=$this->cart->contents();
		$this->session->set_userdata('carrito',count($arr));
 		if($quantity == 0)
 			$vec = array('ban' => 0 , 'valor' => count($arr),'cantidad' => $quantity);
 		else
 			$vec = array('ban' => 1 , 'valor' => count($arr),'cantidad' => $quantity);

 		echo json_encode($vec);
	}

}
?>
