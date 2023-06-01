<?php

namespace StaySafe\Password\Policy\Rule;

interface RuleInterface
{
    /**
     * Evaluates constraint.
     *
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool;

    /**
     * Returns the rule as an associative array
     * self::class => rule.
     *
     * @return array<class-string, int>
     */
    public function getRule(): array;

    /**
     * Returns the Rule description
     *
     * @return string
     */
    public function __toString(): string;
}
