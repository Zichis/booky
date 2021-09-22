<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FireAndIceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FireAndIceController extends Controller
{
    protected $fireAndIceService;

    public function __construct(FireAndIceService $fireAndIceService)
    {
        $this->fireAndIceService = $fireAndIceService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $name = $request->get('name');

        $data = $this->fireAndIceService->prepareData($name);

        return $data;
    }
}
