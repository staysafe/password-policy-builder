<?php

namespace StaySafe\Password\Policy\Rule;

final class MaximumLengthRule implements RuleInterface
{
    /**
     * @var int
     */
    private $maxLength;

    public function __construct(int $maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function __toString(): string
    {
        return sprintf(
            'Password should be at most %d characters long',
            $this->maxLength
        );
    }

    public function isValid(string $value): bool
    {
        return $this->maxLength >= strlen($value);
    }

    public function getRule(): array
    {
        return [self::class => $this->maxLength];
    }
}
