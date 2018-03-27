<div id="map" style="width: 100%; height: 100%">

</div>
<script>
    var uluru = {lat: 10.3944, lng: 105.405};
    var marker;
    var map;
    var geocoder;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: uluru
        });
        marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable: true,
            content:'<p id="hook">Hello World!</p>'
        });
        var infoWindow = new google.maps.InfoWindow({
            content: '<b>Dia chi:</b>  Xuan Khanh, Ninh Kieu, Can Tho'
        });
        infoWindow.setContent('<b>Dia chi:</b>  Xuan Khanh, Ninh Kieu, Can Tho');
        infoWindow.open(map, marker);
        google.maps.event.addListener(marker, 'dragstart', function() {
//            infowindow.setContent('Kéo để xác định vị trí...');
            infoWindow.close(map, marker);
        });
        //Update postal address when the marker is dragged
        geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({latLng: marker.getPosition()}, function(responses) {
                if (responses && responses.length > 0) {
                    infoWindow.setContent(responses[0].formatted_address);
                    infoWindow.open(map, marker);
                } else {
                    alert('Error: Google Maps could not determine the address of this location.');
                }
            });
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDytpr4IJeSaYggorTZ7TagENWYZzpsO1w&callback=initMap">
</script>