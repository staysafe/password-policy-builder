<?php

declare(strict_types=1);

namespace StaySafe\Password\Policy\Test\Rule;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\MaximumLengthRule;

class MaximumLengthRuleTest extends TestCase
{
    /**
     * @dataProvider passwordDoesNotExceedMaximumLengthDataProvider
     */
    public function testPasswordDoesNotExceedMaximumLength(int $maxLength, string $password): void
    {
        $rule = new MaximumLengthRule($maxLength);

        static::assertTrue($rule->isValid($password));
    }

    public function passwordDoesNotExceedMaximumLengthDataProvider(): array
    {
        return [
            [16, 'abcdef'],
            [26, 'abcdef'],
            [26, 'abcdefghijklmnopqrstuvwxyz'],
            [27, 'abcdefghijklmnopqrstuvwxyz'],
        ];
    }

    /**
     * @dataProvider passwordDoesExceedMaximumLengthDataProvider
     */
    public function testPasswordDoesMaximumLength(int $maxLength, string $password): void
    {
        $rule = new MaximumLengthRule($maxLength);

        static::assertFalse($rule->isValid($password));
    }

    public function passwordDoesExceedMaximumLengthDataProvider()
    {
        return [
            [15, '01234567890123456789'],
            [19, '01234567890123456789'],
            [20, 'abcdefghijklmnopqrstuvwxyz'],
        ];
    }
}
