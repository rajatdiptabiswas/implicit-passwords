/*
//onclick event following code pansto new markers which are not draggable
function placeMarkerAndPanTo(latLng, map) {
  var marker = new google.maps.Marker({
    position: latLng,
  });
  marker.setMap(map);
  map.panTo(latLng);
}
*/

function placeMarkerAndPanTo(latLng, map, marker) {
  marker.setPosition(latLng);
  map.panTo(latLng);
  //map.setCenter(latLng);	//no animation like panTo
  marker.setMap(map);//redundant
  map.setZoom(map.zoom+2);

  var newlat=latLng.lat();
  var newlng=latLng.lng();
  console.log(newlat);
  console.log(newlng);
  var CityName=getCityName(newlat,newlng);

  // console.log(CityName);
}

function getCityName(newlat, newlng) {
	var geoCodingUrl = "https://api.bigdatacloud.net/data/reverse-geocode?latitude=" + newlat + "&longitude=" + newlng + "&localityLanguage=en&key=67bc62d1f3cf4d2dac703c085a739125";
	//console.log(geoCodingUrl);
	
	$.ajax({
		url: geoCodingUrl,
		method:"GET",
		success:function(response){
     		var city= response.localityInfo.administrative[2].name;
     		var state=response.localityInfo.administrative[1].name;
			var cntry=response.localityInfo.administrative[0].name;
			
			//console.log(response);console.log(city);console.log(state);console.log(cntry);
			
      var address = city + "," + state + "," + cntry;
      var mapInp = $('#map-input');
      mapInp.val(city);
			console.log("@: "+mapInp.val());
			return address;
		}
	})
}