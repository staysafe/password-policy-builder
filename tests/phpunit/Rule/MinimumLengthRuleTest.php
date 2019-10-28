<?php

namespace StaySafe\Password\Policy\Unit\Rule;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Rule\Exception\MinimalConstraintNotMetException;

final class MinimumLengthRuleTest extends TestCase
{
    /**
     * @throws MinimalConstraintNotMetException
     */
    public function test_below_min_allowed_length_throws_exception(): void
    {
        $this->expectException(MinimalConstraintNotMetException::class);
        new MinimumLengthRule(1);
    }
}
