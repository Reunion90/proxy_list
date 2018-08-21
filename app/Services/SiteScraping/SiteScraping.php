<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 20.08.18
 * Time: 20:11
 */

namespace App\Services\SiteScraping;


use App\Services\SiteScraping\Rules\RuleInterface;

class SiteScraping
{
    /**
     * @var
     */
    protected $ruleResolver;

    public function __construct(RuleResolver $ruleResolver)
    {
        $this->ruleResolver = $ruleResolver;
    }

    public function from(string $site): array
    {
        $rule = $this->ruleResolver->resolve($site);

        return $rule instanceof RuleInterface
            ? $rule->parse()
            : [];
    }
}