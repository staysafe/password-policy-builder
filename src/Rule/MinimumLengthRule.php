<?php

namespace StaySafe\Password\Policy\Rule;

use StaySafe\Password\Policy\Rule\Exception\MinimalConstraintNotMetException;

final class MinimumLengthRule implements RuleInterface
{
    private const MIN_ALLOWED_LENGTH = 8;

    /**
     * @var int
     */
    private $minLength;

    /**
     * @param int $minLength
     * @throws MinimalConstraintNotMetException
     */
    public function __construct(int $minLength = 8)
    {
        if ($minLength < self::MIN_ALLOWED_LENGTH) {
            throw new MinimalConstraintNotMetException(
                sprintf('Length rule is below the minimum threshold of %s', self::MIN_ALLOWED_LENGTH)
            );
        }
        $this->minLength = $minLength;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Password should be at least %s character%s long',
            $this->minLength,
            $this->minLength > 1 ? 's' : ''
        );
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool
    {
        return strlen($value) >= $this->minLength;
    }

    /**
     * Returns the rule as an associative array
     * self::class => rule.
     *
     * @return array
     */
    public function getRule(): array
    {
        return [self::class => $this->minLength];
    }
}
