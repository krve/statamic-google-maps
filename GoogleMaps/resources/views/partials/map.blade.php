<div id="{{ $map_id }}" style="height:{{ $height }};width:{{ $width }};"></div>
<script>
    if (typeof GoogleMap === 'undefined') {
        var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

        function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

        window.GoogleMap = function () {
            function GoogleMap(id, options) {
                _classCallCheck(this, GoogleMap);

                this.id = id;
                this.options = options || {};
                this.markers = options.markers || [];
                this.isCentered = false;

                this.init();

                for(var i = 0; i < this.markers.length; i++) {
                    this.geocodeAddress(this.markers[i], function (location) {
                        this.addMarker(location);
                    }.bind(this));
                }
            }

            _createClass(GoogleMap, [{
                key: 'init',
                value: function init() {
                    this.element = document.getElementById(this.id);

                    if (typeof this.element === 'undefined') {
                        throw new Error('The element does not exist [#' + this.id + ']');
                    }

                    this.map = new google.maps.Map(this.element, {
                        zoom: this.options.zoom,
                        center: { lat: -34.397, lng: 150.644 }
                    });

                    if (typeof this.options.address !== 'undefined') {
                        this.geocodeAddress(this.options.address, function (location) {
                            if (this.isCentered == false) {
                                this.map.setCenter(location);
                                this.isCentered = true;
                            }

                            if (this.markers.length <= 0) {
                                this.addMarker(location);
                            }
                        }.bind(this));
                    }
                }
            }, {
                key: 'geocodeAddress',
                value: function geocodeAddress(address, callback) {
                    var geocoder = new google.maps.Geocoder();

                    geocoder.geocode({ address: address }, function (results, status) {
                        if (status === 'OK') {
                            callback(results[0].geometry.location);
                        } else {
                            throw new Error('Geocode was not successful for the following reason: ' + status);
                        }
                    }.bind(this));
                }
            }, {
                key: 'addMarker',
                value: function addMarker(location) {
                    this.markers.push(new google.maps.Marker({
                        map: this.map,
                        position: location
                    }));
                }
            }]);

            return GoogleMap;
        }();

        var script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=GoogleMapInitialize";
        document.getElementsByTagName('head')[0].appendChild(script);
        googleMapsAdded = true;
    }

    if (typeof window.googleMaps === 'undefined') {
        window.googleMaps = [];
    }

    window.googleMaps.push({
        id: "{{ $map_id }}",
        zoom: {{ $zoom}},
        address: "{{ $address }}",
        @if (count($markers) > 0)
            markers: ["{!! implode('", "', $markers) !!}"]
        @endif
    });

    function GoogleMapInitialize() {
        for(var i = 0; i < window.googleMaps.length; i++) {
            new GoogleMap(window.googleMaps[i].id, {
                zoom: window.googleMaps[i].zoom,
                address: window.googleMaps[i].address,
                markers: window.googleMaps[i].markers || [],
            });
        }
    }
</script>