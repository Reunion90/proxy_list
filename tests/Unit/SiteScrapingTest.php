<?php

namespace Tests\Unit;

use App\Services\SiteScraping\RuleResolver;
use App\Services\SiteScraping\Rules\RuleInterface;
use App\Services\SiteScraping\SiteScraping;
use Tests\TestCase;

class SiteScrapingTest extends TestCase
{
    /**
     * @var SiteScraping
     */
    private $siteScripting;

    protected $parsingData = ['ip' => '127.0.0.1', 'country' => 'local', 'access' => 1, 'anonym' => 'anonym'];

    public function setUp()
    {
        parent::setUp();
        $ruleMock = $this->createMock(RuleInterface::class);
        $ruleMock->method('parse')->willReturn($this->parsingData);
        $ruleResolveMock = $this->createMock(RuleResolver::class);
        $ruleResolveMock->method('resolve')->withAnyParameters()->willReturn($ruleMock);
        $this->siteScripting = new SiteScraping($ruleResolveMock);
    }

    public function SiteScrapDataProvider()
    {
        return [
            ['mockSite', $this->parsingData]
        ];
    }

    /**
     * @dataProvider SiteScrapDataProvider
     * @param string $site
     * @param array $expected
     */
    public function testFrom(string $site, array $expected)
    {
        $this->assertEquals($expected, $this->siteScripting->from($site));
    }
}
