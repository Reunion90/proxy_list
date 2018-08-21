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

    public function __construct( $adapter)
    {
        $this->adapter = $adapter;
    }

    public function save(array $data)
    {
        $adaptedData = $this->adapter->transform($data);
        if(!empty($adaptedData)){
            $proxyListModel = new ProxyList();
            foreach ($adaptedData as $ipData){
                try {
                    $proxyListModel->updateOrCreate(['ip' => $ipData['ip']], $ipData);
                } catch(\Exception $e){
                    $this->log->error($e->getMessage() . '  ' . $e->getTraceAsString() );
                }
            }
        }
    }
}