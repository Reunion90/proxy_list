<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProxyListService;
use Illuminate\Http\Request;

class ProxyListController extends Controller
{
    public function index(Request $request, ProxyListService $proxyListService)
    {
        $anonymity = $request->input('anonymity');
        $country = $request->input('country');
        $access = $request->input('access');
        $list = $proxyListService->getByParams($country, $access, $anonymity);

        return [
            'list'=> $list,
        ];
    }
}
