<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		$this->load->library('cart');
	}

	public function index()
	{
		
	}

	function addCart(){

		$cant = 0; $arr=array();
		/*foreach ($this->cart->contents() as $item) {
			if($item['id'] == $this->input->post('id_articulo')){

				$cant = $this->input->post('txtCantidad') + $item['qty'];
				if($cant <= $item['existencia'])
				{
					$data = array(
			 			'rowid' => $item['rowid'],
			 			'qty' => $cant
			 		);

			 		$this->cart->update($data);
			 		$arr=$this->cart->contents();
			 		$vec = array('ban' => 2 , 'valor' => $cant , 'qty' => $item['qty'] ,'codigo' => $this->input->post('id_articulo'));
					echo json_encode($vec);
					exit();
				}
				else
				{
					$vec = array('ban' => 0 , 'valor' => 0);
					echo json_encode($vec);
					exit();
				}
				
			}
			
		}*/
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
			$arr=$this->cart->contents();
			$this->session->set_userdata('carrito',count($arr));
			$vec = array('ban' => 1 , 'valor' => count($arr));
			echo json_encode($vec);
		}
		else
			{
				$vec = array('ban' => 0 , 'valor' => 0);
				echo json_encode($vec);
				exit();
			}
	}
	function destroyCart(){
		$this->cart->destroy();
		$this->session->set_userdata('carrito',0);
		redirect('inicio/index');
	}

	function showCart(){
		
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
					$this->updateCar($item['rowid'],$exis);	
				}
				else{
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
