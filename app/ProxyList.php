<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProxyList extends Model
{
    protected $fillable = ['ip', 'port', 'country', 'access', 'anonymity'];

    protected $table = 'proxy_list';

    public function insertMany($data)
    {
        return $this->newQuery()->insert($data);
    }
}
