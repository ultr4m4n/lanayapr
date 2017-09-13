var lat  = {{ $card->lat}};
var lng  = {{ $card->lng}};

var map = new google.maps.Map(document.getElementById('map-canvas'),{
	canter:{
		lat: lat,
		lng: lng
	},
	zoom: 15
});

var marker = new google.maps.Marker({
	position:{
		lat:lat,
		lng:lng
	},
	map:map
});