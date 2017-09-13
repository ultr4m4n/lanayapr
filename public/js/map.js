var map = new google.maps.Map(document.getElementById('map-canvas'),{
		center:{
			lat: 2.8904835,
			lng: 101.7884702
		},
		zoom:14
	});

	var marker = new google.maps.Marker({
		position: {
			lat: 2.8904835,
			lng: 101.7884702
		},
		map: map,
		draggable: true
	});

	var searchBox = new google.maps.places.SearchBox(document.getElementById('maploc'));

	google.maps.event.addListener(searchBox,'places_changed',function(){

		var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
		var i, place;

		for(i=0; place=places[i];i++){
			bounds.extend(place.geometry.location);
			marker.setPosition(place.geometry.location); //set marker postion new....
		}

		map.fitBounds(bounds);
		map.setZoom(14);
	});

	google.maps.event.addListener(marker, 'position_changed',function(){

		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();

		$('#lat').val(lat);
		$('#lng').val(lng);

	});