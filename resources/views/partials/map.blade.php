<div id="gmap" style="height:{{ $height }};width:{{ $width }};"></div>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('gmap'), {
            zoom: {{ $zoom }},
            center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        geocodeAddress(geocoder, map);
    }
    function geocodeAddress(geocoder, resultsMap) {
        var address = "{!! $address !!}";
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=initMap"
async defer></script>
