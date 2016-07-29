<div id="{{ $map_id }}" style="height:{{ $height }};width:{{ $width }};"></div>
<script>
var maps = typeof maps === "undefined" ? [] : maps;

maps.push({
    map_id: "{{ $map_id }}",
    zoom: {{ $zoom }},
    address: "{{ $address }}"
});

function createNewGMAP() {
    for (var i = 0; i < maps.length; i++) {
        var element = document.getElementById(maps[i].map_id);
        var map = new google.maps.Map(element, {
            zoom: maps[i].zoom,
            center: {lat: -34.397, lng: 150.644}
        });

        geocodeAddress(map, maps[i].address);
    }

    maps = [];
}
function geocodeAddress(resultsMap, address) {
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);

            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}
var googleMapsAdded = typeof googleMapsAdded === "undefined" ? false : true;

if (typeof google === 'undefined' && googleMapsAdded == false) {
    var script = document.createElement('script');
    script.src = "https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=createNewGMAP";
    document.getElementsByTagName('head')[0].appendChild(script);
    googleMapsAdded = true;
}
</script>
