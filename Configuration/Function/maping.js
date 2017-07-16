
var geocoder;
var latlng
var pref = document.getElementById('pref').value;
var addr1 = document.getElementById('addr1').value;
var addr2 = document.getElementById('addr2').value;
var address = pref + addr1 + addr2;
var lat = document.getElementById('lat').value;
var lng = document.getElementById('lng').value;
var map;

  function initialize(address) {
    geocoder = new google.maps.Geocoder();
    if(lat == '' && lng == '') {
	    latlng = new google.maps.LatLng(35.658517, 139.745493);
	} else {
		latlng = new google.maps.LatLng(lat, lng);
	}
    var myOptions = {
      zoom: 17,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
  
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    if(lat == '' && lng == '') {
	    codeAddress(address);
	} else {
		var mapLatLng = new google.maps.LatLng(lat, lng); 
		var marker = new google.maps.Marker({
            map: map, 
            position: mapLatLng,
            draggable: true
        });

        document.getElementById('lat').value = mapLatLng.lat();
        document.getElementById('lng').value = mapLatLng.lng();

		google.maps.event.addListener( marker, 'dragend', function(ev){
		  document.getElementById('lat').value = ev.latLng.lat();
		  document.getElementById('lng').value = ev.latLng.lng();	
		});
	}
  }

  function codeAddress(address) {
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
         map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
              map: map, 
              position: results[0].geometry.location,
              draggable: true
          });

          document.getElementById('lat').value = results[0].geometry.location.lat();
          document.getElementById('lng').value = results[0].geometry.location.lng();

		  google.maps.event.addListener( marker, 'dragend', function(ev){
		    document.getElementById('lat').value = ev.latLng.lat();
		    document.getElementById('lng').value = ev.latLng.lng();	
		  });

        } else {
          console.log("Geocode was not successful for the following reason: " + status);
        }
      });
    }
  }

  $('#map-click').on('click', function() {
  	lat = '';
  	lng = '';
  	var pref = document.getElementById('pref').value;
	var addr1 = document.getElementById('addr1').value;
	var addr2 = document.getElementById('addr2').value;
	var address = pref + addr1 + addr2;
	initialize(address);
  });

initialize(address);