<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 21.08.18
 * Time: 14:55
 */

namespace App\Services;


class ProxyListAdapter
{
    protected $proxyListFields;

    public function __construct($fields)
    {
        $this->proxyListFields = $fields;
    }

    public function transform(array $data):array
    {
        return array_map(function($row){
            return array_combine($this->proxyListFields, $row);

        }, $data);
    }
}