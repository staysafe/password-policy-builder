<?php

namespace StaySafe\Password\Policy\Rule;

final class LowerCaseCharacterRule implements RuleInterface
{
    /**
     * @var int
     */
    private $noOfLowerCaseLetters;

    public function __construct(int $noOfLowerCaseLetters = 0)
    {
        $this->noOfLowerCaseLetters = (new PositiveOccurrence($noOfLowerCaseLetters))->getOccurrence();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Password should have at least %s lower case letter%s',
            $this->noOfLowerCaseLetters,
            $this->noOfLowerCaseLetters > 1 ? 's' : ''
        );
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool
    {
        if ($this->noOfLowerCaseLetters === 0) {
            return true;
        }

        $matches = [];
        preg_match_all('/[a-z]/', $value, $matches);

        if (1 === count($matches) && empty($matches[0])) {
            return false;
        }

        return count($matches[0]) >= $this->noOfLowerCaseLetters;
    }

    /**
     * Returns the rule as an associative array
     * self::class => rule.
     *
     * @return array<class-string, int>
     */
    public function getRule(): array
    {
        return [self::class => $this->noOfLowerCaseLetters];
    }
}
