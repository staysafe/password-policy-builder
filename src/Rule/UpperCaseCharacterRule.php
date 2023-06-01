<?php

namespace StaySafe\Password\Policy\Rule;

final class UpperCaseCharacterRule implements RuleInterface
{
    private $noOfUpperCaseLetters;

    public function __construct(int $noOfUpperCaseLetters = 0)
    {
        $this->noOfUpperCaseLetters = (new PositiveOccurrence($noOfUpperCaseLetters))->getOccurrence();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Password should have at least %s upper case letter%s',
            $this->noOfUpperCaseLetters,
            $this->noOfUpperCaseLetters !== 1 ? 's' : ''
        );
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool
    {
        if ($this->noOfUpperCaseLetters === 0) {
            return true;
        }

        $matches = [];
        preg_match_all('/[A-Z]/', $value, $matches);

        if (1 === count($matches) && empty($matches[0])) {
            return false;
        }

        return count($matches[0]) >= $this->noOfUpperCaseLetters;
    }

    /**
     * Returns the rule as an associative array
     * self::class => rule.
     *
     * @return array<class-string, int>
     */
    public function getRule(): array
    {
        return [self::class => $this->noOfUpperCaseLetters];
    }
}
