<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Funciones
{
	function hola()
	{
		echo "Hola mundo";
	}
	function getAlmacen($almacen)
	{
		switch ($almacen) 
		{
			case '1':
			case 1:
				echo 'GUADALAJARA';
				break;
			case '16':
			case 16:
				echo 'MONTERREY';
				break;
			case 7:
			case "7":
				echo "DF";
				break;
			case 21:
			case "21":
				echo "MERIDA";
				break;
			case 56:
			case "56":
				echo "PUEBLA";
				break;
			case 74:
			case "74":
				echo "LEON";
				break;
			default:
				echo $almacen;

				break;
		}
	}
	function precio($utilidad,$ut,$precio,$descuento)
	{
		 $utilidad=$utilidad; 
		 if($utilidad==0)
		 	$utilidad=$ut; 
		 $precio=$precio*1.16;
		$precio= $precio + (($utilidad*$precio)/100);
		 
		 $descuento=(($precio*$descuento)/100);
		 $precio=$precio-$descuento;
		 $cad= number_format(round($precio),2,".",",");
		 return $cad;
	}
	function loginFacebook()
	{	
		require_once ('vendor/autoload.php');
		$fb = new Facebook\Facebook([
			  'app_id' => '463785683829735', // Replace {app-id} with your app id
			  'app_secret' => 'c40d3e4bb9c615b0dfd0b5bfc47bcd7d',
			  'default_graph_version' => 'v2.7',
			  ]);
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://iscocomputadoras.com/inicio/respuesta', $permissions);
		return $loginUrl;
	}
}

?>