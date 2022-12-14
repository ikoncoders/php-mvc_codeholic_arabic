<?php

use PHPUnit\Framework\TestCase;
use Ikonc\PhpMvc\Validation\RulesResolver;
use Ikonc\PhpMvc\Validation\Rules\EmailRule;
use Ikonc\PhpMvc\Validation\Rules\AlphaNumRule;
use Ikonc\PhpMvc\Validation\Rules\RequiredRule;


class RulesResolverTest extends TestCase
{
    public function test_it_gets_rules_from_a_string()
    {
        $stringToMap = 'required';

        $instance = RulesResolver::getRuleFromString($stringToMap);

        $this->assertInstanceOf(RequiredRule::class, $instance);
    }

    public function test_it_makes_an_array_of_rules_out_of_piped_string()
    {
        $rules = 'required|alnum';

        $instances = RulesResolver::make($rules);

        foreach ($instances as $instance) {
            $this->assertInstanceOf(Rule::class, $instance);
        }
    }

    public function test_it_resolves_array_of_strings_to_array_of_rules()
    {
        $rules = ['alnum', 'required'];

        $instances = RulesResolver::make($rules);

        foreach ($instances as $instance) {
            $this->assertInstanceOf(Rule::class, $instance);
        }
    }

    public function test_it_accepts_array_of_rule_instances()
    {
        $rules = [
            new RequiredRule(),
            new EmailRule(),
            new AlphaNumRule()
        ];

        $instances = RulesResolver::make($rules);

        $this->assertContainsOnlyInstancesOf(Rule::class, $instances);
    }
}
