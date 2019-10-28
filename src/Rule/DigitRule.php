<?php

namespace StaySafe\Password\Policy\Rule;

final class DigitRule implements RuleInterface
{
    /**
     * @var int
     */
    private $digits;

    /**
     * @param int $digits
     */
    public function __construct(int $digits = 0)
    {
        $this->digits = (new PositiveOccurrence($digits))->getOccurrence();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Password should have at least %s number%s',
            $this->digits,
            $this->digits !== 1 ? 's' : ''
        );
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool
    {
        if ($this->digits === 0) {
            return true;
        }

        $matches = [];
        preg_match_all('/\d/', $value, $matches);

        if (1 === count($matches) && empty($matches[0])) {
            return false;
        }

        return count($matches[0]) >= $this->digits;
    }

    /**
     * Returns the rule as an associative array
     * self::class => rule.
     *
     * @return array
     */
    public function getRule(): array
    {
        return [self::class => $this->digits];
    }
}
