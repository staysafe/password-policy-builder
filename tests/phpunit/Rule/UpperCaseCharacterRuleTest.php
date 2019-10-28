<?php

namespace StaySafe\Password\Policy\Unit\Rule;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\UpperCaseCharacterRule;

/**
 * @internal
 */
class UpperCaseCharacterRuleTest extends TestCase
{
    public function testIsValidCountsNumberOfUpperCaseLetters(): void
    {
        $rule = new UpperCaseCharacterRule(5);

        $value = 'abcABCdefDE';

        static::assertTrue($rule->isValid($value));
        static::assertFalse($rule->isValid('abcdefghi'));
    }
}
