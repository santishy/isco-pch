<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends CI_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		ini_set('memory_limit', '-1');
		$this->load->library('funciones');
		$this->load->library('session');
	}
	public function cargaAjax()
	{
		$vec=$this->generarAleatorios(8);
		$query= $this->consultaAleatoria($vec);

		echo json_encode($query->result_array());
	}

	public function index()
	{
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		/*$vec=$this->generarAleatorios(10); ESTOS SON LOS ALEATORIOS
		$data['articles']=$this->consultaAleatoria($vec);*/
		$data['articles']=$this->ModelArticulo->masVistos();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$data['loginUrl']=$this->funciones->loginFacebook();
		$this->load->view('includes/headersite',$data);
		$this->load->view('includes/scripts');
		//echo '<a href="' . htmlspecialchars($loginUrl) .'">Log in with Facebook!</a>';
		$this->load->view('inicio');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
	}
	function terminos()
	{
		$this->load->view('envios/terminos');
	}
	function respuesta()
	{
		session_start();
		require_once ('vendor/autoload.php');
		$fb = new Facebook\Facebook([
								  'app_id' => '463785683829735', // Replace {app-id} with your app id
								  'app_secret' => 'c40d3e4bb9c615b0dfd0b5bfc47bcd7d',
								  'default_graph_version' => 'v2.7',
								  ]);
		$helper=$fb->getRedirectLoginHelper();
		try{
			$accessToken=$helper->getAccessToken();
			$oAuth2client=$fb->getoAuth2client();
			$longLiveAccessToken  = $oAuth2client->getLongLivedAccessToken($accessToken);
			$fb->setDefaultTokenAccess($accessToken);
		}catch(Facebook\Exceptions\FacebookResponseException $e){
			echo 'Graph returned an error: '.$e->getMessage();
			exit;
		}catch(Facebook\Exceptions\FacebookSDKException $e){
			echo 'Facebook SDK returned an error: '.$e->getMessage();
			exit;
		}
		if(isset($accessToken)){
			$this->session->set_userdata('userFB',(string)$accessToken);
		}

		//redirect('inicio');
	}
	function menu()
	{
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$this->load->view('includes/menu',$data);
	}
	function consultaAleatoria($id)
	{
		$cadena="select *from articulos a left join marcas m on m.id_marca=a.id_marca left join lineas l on l.id_linea=a.id_linea left join secciones s on s.id_seccion=a.id_seccion left join utilidades u on u.id_utilidad=a.id_utilidad where ";
		//$cadena="select *from articulos a left join detinvart ea on a.id_articulo=ea.id_articulo left join inventario i on i.id_inventario=ea.id_inventario left join marcas m on m.id_marca=a.id_marca left join lineas l on l.id_linea=a.id_linea left join secciones s on s.id_seccion=a.id_seccion left join utilidades u on u.id_utilidad=a.id_utilidad where ";
		for($i=0;$i<count($id);$i++)
		{
			$cadena.=' a.id_articulo='.$id[$i];
			if($i==(count($id)-1))
				$cadena.=';';
			else
				$cadena.=' or';
		}
		$query=$this->ModelArticulo->consultaAleatoria($cadena);
		return $query;
	}
 function generarAleatorios($n)
	{
		$max=$this->ModelArticulo->numRows();
		for($i=0;$i<$n;$i++)
		{
			$num[$i]=rand(1,$max);
		}
		return $num;
	}
	public function p(){
		echo 'debe de mostrar el mensaje';
	}
	public function cliente()
	{
		ini_set('memory_limit', '-1');
		include('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
		$param = array('cliente' =>6722,'llave' => '112012');
		$result = $client->call('ObtenerListaArticulos', $param);
		if ($client->fault)
			{
				echo 'Fallo';
				print_r($result);
			}
			else
			{	// Chequea errores
				$err = $client->getError();
				if ($err) {		// Muestra el error!
					echo 'Error' . $err ;
				}
				else
				{		// Muestra el resultado
						var_dump($result);
						date_default_timezone_set('America/Monterrey');
						$fecha=date('Y-m-d');
					  	$id_dolar=0;
					  	$query=$this->ModelArticulo->maxIdDolar();
					  	foreach ($query->result() as $row) {
					  		$id_dolar=$row->id_dolar;
					  	}
					  	$query=$this->ModelArticulo->getDolar($id_dolar);
						foreach ($query->result() as $row) {
							$dolar=$row->precio;
						}
						$this->session->set_userdata('dollarCambio',$dolar);
					for($i=0;$i<count($result['datos']);$i++)
					 	$this->ModelArticulo->updateStore2($result['datos'][$i],$result['datos'][$i]['inventario'][0],$this->session->userdata('dollarCambio'),$fecha);

				}
			}
	}
	public function Obarticulo()
	{
		include('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
		$param = array('cliente' =>6722,'llave' => '112012','sku'=>'AC-366503-18');
		$result = $client->call('ObtenerArticulo', $param);
		if ($client->fault)
			{
				echo 'Fallo';
				print_r($result);
			}
			else
			{	// Chequea errores
				$err = $client->getError();
				if ($err) {		// Muestra el error!
					print_r($result);
					echo 'Error:' . $err ;
				}
				else
				{		// Muestra el resultado

					print_r($result);
					/*if(!$this->session->userdata('dollarCambio'))
						$this->getParidad($client);

					for($i=0;$i<count($result['datos']);$i++)
					 	$this->ModelArticulo->updateStore2($result['datos'][$i],$result['datos'][0]['inventario'][0],$this->session->userdata('dollarCambio'));*/

				}
			}
	}
	function apartado(){
		include('lib/nusoap.php');
		$strUrl = "http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl";
		try{
			$client = new nusoap_client($strUrl, array("cache_wsdl" => WSDL_CACHE_NONE));
			$result = $client->call("GenerarRemision", array(
				6722,
				"112012",
				1,
				"MN",
				array(
						array(
							"strSku" => "DD-475503-02",
							"iCantidad" => 3
							)

					),

				"0012code"

			));
			print_r($result);
		}
		catch(Exception $ex){
			 print_r($ex->getMessage());
		}
	}
	function login()
	{
		$this->load->view('login');
	}

	function getParidad()
	{
		include('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$param = array('cliente' =>6722,'llave' => '112012');
		$result = $client->call('ObtenerParidad', $param);
		if ($client->fault)
		{
			echo 'Fallo';
			print_r($result);
		}
		else
		{	// Chequea errores
			$err = $client->getError();
			if ($err) {		// Muestra el error
				echo 'Error' . $err ;
			}
			else
			{

				if($result['estatus'])
					$this->ModelArticulo->dolar($result['datos']);

			}
		}

	}

}
?>
