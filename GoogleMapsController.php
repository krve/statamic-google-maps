<?php

namespace Statamic\Addons\GoogleMaps;

use Statamic\Extend\Controller;

class GoogleMapsController extends Controller
{
    /**
     * Maps to your route definition in routes.yaml
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view('index');
    }
}
