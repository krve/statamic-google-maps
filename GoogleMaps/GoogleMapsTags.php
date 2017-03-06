<?php

namespace Statamic\Addons\GoogleMaps;

use Statamic\Extend\Tags;
use Illuminate\Support\Facades\Log;

class GoogleMapsTags extends Tags
{
    /**
     * The {{ google_maps }} tag
     *
     * @return string
     */
    public function index()
    {
        $api_key = $this->getConfig('api_key', 'YOUR_API_KEY');
        $zoom = $this->getParamInt('zoom', 10);
        $address = $this->getParam('address', 'New York');
        $height = $this->getParam('height', '300px');
        $width = $this->getParam('width', 'auto');
        $markers = array_filter(
            explode(';', $this->getParam('markers'))
        );

        $map_id = 'gmap' . uniqid();

        if ($api_key == 'YOUR_API_KEY') {
            Log::error("GoogleMapsAddon: No api key specified");
        }

        return $this->view('partials.map', compact('api_key', 'zoom', 'address', 'height', 'width', 'map_id', 'markers'));
    }
}
