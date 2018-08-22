<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 21.08.18
 * Time: 14:39
 */

namespace App\Services;


use App\ProxyList;

class ProxyListService
{
    /**
     * @var ProxyListAdapter
     */
    protected $adapter;

    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    public function save(array $data)
    {
        $adaptedData = $this->adapter->transform($data);
        if (!empty($adaptedData)) {
            $proxyListModel = new ProxyList();
            foreach ($adaptedData as $ipData) {
                try {
                    $proxyListModel->updateOrCreate(['ip' => $ipData['ip']], $ipData);
                } catch (\Exception $e) {
                    $this->log->error($e->getMessage() . '  ' . $e->getTraceAsString());
                }
            }
        }
    }

    public function get()
    {
        return ProxyList::where('access', '=', 1)->get();
    }

    public function getByParams($country, $access, $anonymity)
    {
        $query = ProxyList::query();
        if (!is_null($country)) {
            $query->where('country', $country);
        }

        if (!is_null($access)) {
            $query->where('access', intval($access));
        }

        if (!is_null($anonymity)) {
            $query->where('anonymity', $anonymity);
        }

        return $query->get();
    }

    public function getCountries()
    {
        $coll = ProxyList::query()->distinct()->get(['country']);
        return $coll->map(function ($item) {
            return $item->country;
        });
    }

    public function getAnonymities()
    {
        $coll = ProxyList::query()->distinct()->get(['anonymity']);
        return $coll->map(function ($item) {
            return $item->anonymity;
        });
    }
}