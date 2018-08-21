<?php

namespace Tests\Unit;

use App\Services\SiteScraping\RuleResolver;
use App\Services\SiteScraping\Rules\FreeProxyListNetRule;
use App\Services\SiteScraping\Rules\RuleInterface;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RuleResolverTest extends TestCase
{
    /**
     * @var RuleResolver
     */
    private $ruleResolver;

    public function setUp()
    {
        parent::setUp();
        $this->ruleResolver = new RuleResolver();
    }

    public function ruleDataProvider()
    {
        return [
            ['free-proxy-list.net', true],
            ['invalid_site.net', false],
        ];
    }

    /**
     * @dataProvider ruleDataProvider
     * @param string $siteName
     * @param bool $expected
     */
    public function testResolve($siteName, $expected)
    {
        $rule = $this->ruleResolver->resolve($siteName);
        $this->assertEquals($expected, $rule instanceof RuleInterface);
    }


}
