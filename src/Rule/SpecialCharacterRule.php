<?php

namespace StaySafe\Password\Policy\Rule;

final class SpecialCharacterRule implements RuleInterface
{
    private $frequency;

    public function __construct(int $frequency = 0)
    {
        $this->frequency = (new PositiveOccurrence($frequency))->getOccurrence();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Password should have at least %s special character%s',
            $this->frequency,
            $this->frequency !== 1 ? 's' : ''
        );
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool
    {
        if ($this->frequency === 0) {
            return true;
        }

        $matches = [];
        preg_match_all('/[^a-zA-Z0-9]/', $value, $matches);

        if (1 === count($matches) && empty($matches[0])) {
            return false;
        }

        return count($matches[0]) >= $this->frequency;
    }

    /**
     * Returns the rule as an associative array
     * self::class => rule.
     *
     * @return array<class-string, int>
     */
    public function getRule(): array
    {
        return [self::class => $this->frequency];
    }
}
