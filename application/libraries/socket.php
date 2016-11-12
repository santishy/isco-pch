<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Socket {

    public function conexion()
    {
    	include('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		return $client;
    }

    public function webservice(){
    	
    }
    
}


