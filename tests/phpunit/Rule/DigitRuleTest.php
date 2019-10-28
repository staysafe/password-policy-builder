<?php

namespace StaySafe\Password\Policy\Unit\Rule;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\DigitRule;

class DigitRuleTest extends TestCase
{
    public function testIsValidMatchesNumberOfDigitsInString(): void
    {
        $rule = new DigitRule(2);

        static::assertTrue($rule->isValid('a1b2c'));
        static::assertTrue($rule->isValid('a1b2c3'));
    }

    public function testIsValidDoesNotMatchNumberOfDigitsInString(): void
    {
        $rule = new DigitRule(2);

        static::assertFalse($rule->isValid('abcdef'));
        static::assertFalse($rule->isValid('1abc'));
        static::assertFalse($rule->isValid('abc2'));
    }
}
