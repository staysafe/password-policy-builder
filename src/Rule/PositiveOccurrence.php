<?php

namespace StaySafe\Password\Policy\Rule;

final class PositiveOccurrence
{
    /**
     * @var int
     */
    private $occurrence;

    /**
     * @param int $occurrence
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(int $occurrence)
    {
        if ($occurrence < 0) {
            throw new \InvalidArgumentException('Occurrence must be a positive number.');
        }
        $this->occurrence = $occurrence;
    }

    public function getOccurrence(): int
    {
        return $this->occurrence;
    }
}
