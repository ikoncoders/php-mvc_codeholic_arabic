<?php 

namespace Ikonc\PhpMvc\Validation;

use Ikonc\PhpMvc\Validation\Rules\MaxRule;
use Ikonc\PhpMvc\Validation\Rules\EmailRule;
use Ikonc\PhpMvc\Validation\Rules\UniqueRule;
use Ikonc\PhpMvc\Validation\Rules\BetweenRule;
use Ikonc\PhpMvc\Validation\Rules\AlphaNumRule;
use Ikonc\PhpMvc\Validation\Rules\RequiredRule;
use Ikonc\PhpMvc\Validation\Rules\ConfirmedRule;

trait RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'alnum' => AlphaNumRule::class,
        'max' => MaxRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
        'confirmed' => ConfirmedRule::class,
        'unique' => UniqueRule::class,
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}
