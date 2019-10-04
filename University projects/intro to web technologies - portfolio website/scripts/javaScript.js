function showScrollToggle() {
    var self = $(this),
		height = 250,
        top = self.scrollTop(),
        button = $('.scrollToTop');
    displayTop = top;	
			
	if (displayTop > height){		
		if (!button.is(':visible')){
			button.css('bottom', '0%');
			button.show();
			button.animate({bottom: '5%'}, 300);
		}			
	} else{		
		button.fadeOut();
	}	
}


var fields = ['first', 'last', 'email', 'reason', 'comment'];

function clearError() {
	for (i = 0; i < fields.length; i++) {
		if (document.getElementById(fields[i] + "Error").style.display == 'block')
			document.getElementById(fields[i] + "Error").style.display = 'none';
	}
}


function submitForm() {
	var fieldsValue = [];

	for (i = 0; i < fields.length; i++) {
		fieldsValue.push(document.getElementById(fields[i]).value);
		if (fieldsValue[i] == "") {				
			document.getElementById(fields[i]).classList.add("input-error");
			document.getElementById(fields[i] + "Error").style.display = 'block';
			$('html, body').animate({scrollTop: $('#' + fields[i]).offset().top - $('.colorContainer').height() - 40}, 500);
			return false;
		} 
	}
	addSubmit();
	return true;
}


function addSubmit() {
	if (typeof(Storage) !== "undefined") {
		for (i = 0; i < fields.length; i++) {
			localStorage.setItem(fields[i], document.getElementById(fields[i]).value);
		}	
		localStorage.setItem("shown", false);
	} else {
		console.log("Localstorage is not currently supported by this browser")
	}
}


if (localStorage.getItem("first") != null) {
	document.getElementById("nameOutput").innerHTML = (localStorage.getItem("first") + " " + localStorage.getItem("last"));
	document.getElementById("emailOutput").innerHTML = localStorage.getItem("email");
	document.getElementById("reasonOutput").innerHTML = localStorage.getItem("reason");
	document.getElementById("commentOutput").innerHTML = localStorage.getItem("comment");
}


function initMap() {
	var map = new google.maps.Map(document.getElementById('googleMap'), {
	  zoom: 13,
	  center: {lat: 53.805471, lng: -1.553438}
	});
  
	marker = new google.maps.Marker({
	  map: map,
	  draggable: false,
	  animation: google.maps.Animation.DROP,
	  position: {lat: 53.805471, lng: -1.553438}
	});
	marker.addListener('click', toggleBounce);

	var infowindow = new google.maps.InfoWindow({
		content:"Our Location"
	});
	
	infowindow.open(map,marker);
	


	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};

			  
			marker = new google.maps.Marker({
				map: map,
				draggable: false,
				animation: google.maps.Animation.DROP,
				position: pos
			});

			var infowindow = new google.maps.InfoWindow({
				content:"Your Location"
			});
			
			infowindow.open(map,marker);

			
			map.setCenter(pos);
		}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		});
	} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	}
}
	

function toggleBounce() {
	if (marker.getAnimation() !== null) {
		marker.setAnimation(null);
	} else {
		marker.setAnimation(google.maps.Animation.BOUNCE);
	}
}


function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
												'Error: The Geolocation service failed.' :
												'Error: Your browser doesn\'t support geolocation.');
	infoWindow.open(map);
}
