<script>
var map;
var NewZealand = new google.maps.LatLng(-41, 175);
var RoadColour = "#0050FF";

var MY_MAPTYPE_ID = 'custom_style';

function initialize() {
	var featureOpts = [
		{
			stylers: [
				{ hue: '#0022FF' },
				{ visibility: 'simplified' },
				{ gamma: 0.5 }
			]
		},
		{
			elementType: 'labels',
			stylers: [{ visibility: 'off' }]
		},
		{
			featureType: 'water',
			stylers: [{ color: '#000000' }]
		},
		{ 
			featureType: "landscape", 
			elementType: "geometry", 
			stylers: [ { color: "#000090" },] 
		},
		
		{
			featureType: "road",
			stylers: [{ "color": RoadColour }]
		},
				
		{featureType: "poi",stylers: [{ "visibility": "off" }]},
		{featureType: "transit",stylers: [{ "visibility": "off" }]}
	];

	var mapOptions = {
		zoom: 5,
		center: NewZealand,
		mapTypeControlOptions: {mapTypeIds: [MY_MAPTYPE_ID]},
		disableDefaultUI: true,
		mapTypeId: MY_MAPTYPE_ID
	};

	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

	var styledMapOptions = {
		name: ''
	};

	var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

	map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
	
	setMarkers(map, Portals);
}
	
//Start of icons
	
var Portals = [
	<?php
		$result = mysqli_query($con,"SELECT * FROM PortalTable");
		while ($Portal = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			echo "['".$Portal['PortalName']."',".($Portal['Lat']/1000000).",".($Portal['Lon']/1000000).",1,'/Ingress/Portals/Info/?Name=".$Portal['PortalName']."'],";
		}
	?>
];

function setMarkers(map, locations) {
	
	var image = {
		url: '/Ingress/Portal.png',
		size: new google.maps.Size(26, 26),
		origin: new google.maps.Point(0,0),
		anchor: new google.maps.Point(13, 13)
	};
	
	for (var i = 0; i < locations.length; i++) {
		var Portal = locations[i];
		var myLatLng = new google.maps.LatLng(Portal[1], Portal[2]);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: image,
			title: Portal[0],
			zIndex: Portal[3],
			url: Portal[4]
		});
			
		google.maps.event.addListener(marker, 'click', function() {
    				window.location.href = this.url;
		});
	}
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
