<?php

namespace App\Http\Controllers;

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
        $countries = $proxyListService->getCountries();
        $anonymities = $proxyListService->getAnonymities();

        return view('home', [
            'list'=> $list,
            'anonymity' => $anonymity,
            'country' => $country,
            'access' => $access,
            'anonymities' => $anonymities,
            'countries' => $countries
        ]);
    }
}
