<?php

namespace StaySafe\Password\Policy\Unit\Rule;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\SpecialCharacterRule;

class SpecialCharacterRuleTest extends TestCase
{
    public function testPasswordContainsSpecialCharacters(): void
    {
        $rule = new SpecialCharacterRule(2);

        static::assertTrue($rule->isValid('abc!3<2'));
    }

    public function testPasswordDoesNotContainSpecialCharacters(): void
    {
        $rule = new SpecialCharacterRule(2);

        static::assertFalse($rule->isValid('abc123'));
    }
}
