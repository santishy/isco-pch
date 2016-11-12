<script src="http://maps.googleapis.com/maps/api/js?&sensor=true"></script>
<script>

	$(function(){
		var mapa , dir = $('#rutaMapa').val();
		google.maps.event.addDomListener(window,'load',drawMap);

		function drawMap(){
			//var mapa;
			var opcionesMapa = {
				zoom: 13,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			 
			}
			var options = {
				timeout : Infinity,
				maximumAge: Infinity
			}

			mapa = new google.maps.Map(document.getElementById('mapa'),opcionesMapa);
			navigator.geolocation.getCurrentPosition(coordenadas, errores,options);
			
		}

		function calcRoute(inicioRuta,mapa){
			var directionsService = new google.maps.DirectionsService();
			var directionsRenderer = new google.maps.DirectionsRenderer();
			directionsRenderer.setMap(mapa);
			var posicionNegocio = new google.maps.LatLng(20.058585,-102.721953);
			//var posicionNegocio2 = new google.maps.LatLng(19.9862253,-103.0219393);
			var marcador = new google.maps.Marker({
				map: mapa,
				draggable: false,
				position:posicionNegocio,
				title:'Matriz ISCO COMPUTADORAS',
				visible: true
			});
			var request = {
				origin: inicioRuta,
				destination: posicionNegocio,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			}

			directionsService.route(request,function(response, status){
				if(status == google.maps.DirectionsStatus.OK){
					directionsRenderer.setDirections(response);
				}
			});


		}

		function coordenadas(posicion){
			var geolocalizacion = new google.maps.LatLng(posicion.coords.latitude, posicion.coords.longitude);
			var marcador = new google.maps.Marker({
				map: mapa,
				draggable: false,
				position:geolocalizacion,
				visible: true
			});
			mapa.setCenter(geolocalizacion);
			calcRoute(geolocalizacion,mapa);
		}

		function errores(err){	
			mapDefault();
			if (err.code == 0) {
	              alert("Ha ocurrido un erro al tratar de encontrar tu ubicaciÃ³n");
	            }
	            if (err.code == 1) {
	              alert("No has aceptado compartir tu ubicaciÃ³n y no podemos mostrarte la ruta para llegar a la empresa");
	            }
	            if (err.code == 2) {
	              alert("No se puede obtener la posiciÃ³n actual de donde te encuentras");
	            }
	            if (err.code == 3) {
	              //alert("Hemos superado el tiempo de espera para encontrar tu ubicaciÃ³n");
	            }
	           

		}

		function mapDefault(){
			var geolocalizacion = new google.maps.LatLng(20.058585,-102.721953);
			var marcador = new google.maps.Marker({
				map: mapa,
				draggable: false,
				position:geolocalizacion,
				title:'Matriz ISCO COMPUTADORAS',
				visible: true
			});
			mapa.setCenter(geolocalizacion);

		}

	});

</script>