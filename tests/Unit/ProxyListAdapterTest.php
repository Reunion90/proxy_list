<?php

namespace Tests\Unit;

use App\Services\ProxyListAdapter;
use Tests\TestCase;

class ProxyListAdapterTest extends TestCase
{
    /**
     * @var ProxyListAdapter
     */
    private $proxyListAdapter;

    private $fields = ['foo', 'bar'];

    public function setUp()
    {
        parent::setUp();
        $this->proxyListAdapter = new ProxyListAdapter($this->fields);
    }


    /**
     * @dataProvider adapterDataProvider
     * @param array $input
     * @param array $expected
     */
    public function testTransform($input, $expected)
    {
        $result = $this->proxyListAdapter->transform($input);
        $this->assertSame($result, $expected);
    }

    public function adapterDataProvider()
    {
        return [
            [
                [['super','puper']], [['foo'=>'super','bar'=>'puper']]
            ]
        ];
    }
}
