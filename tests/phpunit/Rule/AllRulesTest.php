<?php

namespace StaySafe\Password\Policy\Unit\Rule;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Rule\RuleInterface;
use StaySafe\Password\Policy\Rule\MaximumLengthRule;
use StaySafe\Password\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Rule\SpecialCharacterRule;
use StaySafe\Password\Policy\Rule\LowerCaseCharacterRule;
use StaySafe\Password\Policy\Rule\UpperCaseCharacterRule;

final class AllRulesTest extends TestCase
{
    /**
     * @param string $ruleClassName
     * @param int $occurrence
     * @param mixed  $value
     * @param bool $result
     * @param        $ruleDescription
     *
     * @dataProvider rulesDataProvider
     */
    public function test_rule(string $ruleClassName, int $occurrence, mixed $value, bool $result, $ruleDescription): void
    {
        /** @var RuleInterface $rule */
        $rule = new $ruleClassName($occurrence);

        $this->assertSame($result, $rule->isValid($value));
        $this->assertSame($ruleDescription, (string)$rule);
        $this->assertSame([$ruleClassName => $occurrence], $rule->getRule());
    }

    public static function rulesDataProvider(): array
    {
        return [
            [DigitRule::class, 0, 'aaa', true, 'Password should have at least 0 numbers'],
            [DigitRule::class, 1, 'a1', true, 'Password should have at least 1 number'],
            [DigitRule::class, 2, 'a12', true, 'Password should have at least 2 numbers'],
            [DigitRule::class, 1, 'aa', false, 'Password should have at least 1 number'],
            [DigitRule::class, 2, 'aaa', false, 'Password should have at least 2 numbers'],

            [LowerCaseCharacterRule::class, 0, 'AAA', true, 'Password should have at least 0 lower case letter'],
            [LowerCaseCharacterRule::class, 1, 'a1', true, 'Password should have at least 1 lower case letter'],
            [LowerCaseCharacterRule::class, 2, 'aa12', true, 'Password should have at least 2 lower case letters'],
            [LowerCaseCharacterRule::class, 1, 'AA', false, 'Password should have at least 1 lower case letter'],
            [LowerCaseCharacterRule::class, 2, 'AAA', false, 'Password should have at least 2 lower case letters'],

            [MinimumLengthRule::class, 8, 'AAAAAAAA', true, 'Password should be at least 8 characters long'],
            [MinimumLengthRule::class, 8, 'aaaaaaaa', true, 'Password should be at least 8 characters long'],
            [MinimumLengthRule::class, 8, '12345678', true, 'Password should be at least 8 characters long'],
            [MinimumLengthRule::class, 12, 'aaaaaaaa1234', true, 'Password should be at least 12 characters long'],

            [MaximumLengthRule::class, 8, 'AAAAAAAA', true, 'Password should be at most 8 characters long'],
            [MaximumLengthRule::class, 8, 'aaaaaaaa', true, 'Password should be at most 8 characters long'],
            [MaximumLengthRule::class, 8, '12345678', true, 'Password should be at most 8 characters long'],
            [MaximumLengthRule::class, 5, 'aaAA12', false, 'Password should be at most 5 characters long'],

            [SpecialCharacterRule::class, 0, 'a', true, 'Password should have at least 0 special characters'],
            [SpecialCharacterRule::class, 1, '£10', true, 'Password should have at least 1 special character'],
            [SpecialCharacterRule::class, 2, 'One!#', true, 'Password should have at least 2 special characters'],

            [UpperCaseCharacterRule::class, 0, 'a', true, 'Password should have at least 0 upper case letters'],
            [UpperCaseCharacterRule::class, 1, 'A', true, 'Password should have at least 1 upper case letter'],
            [UpperCaseCharacterRule::class, 2, 'AA', true, 'Password should have at least 2 upper case letters'],
        ];
    }

    /**
     * @param string $ruleClassName
     * @param int    $occurrence
     *
     * @dataProvider negativeOccurrenceDataProvider
     */
    public function test_negative_occurrences_throw_invalid_argument_exception(string $ruleClassName, int $occurrence): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new $ruleClassName($occurrence);
    }

    public static function negativeOccurrenceDataProvider(): array
    {
        return [
            [DigitRule::class, -1],
            [LowerCaseCharacterRule::class, -1],
            [DigitRule::class, -1],
            [DigitRule::class, -1],
        ];
    }
}
