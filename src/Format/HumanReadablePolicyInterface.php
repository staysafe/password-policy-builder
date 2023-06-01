<?php

namespace StaySafe\Password\Policy\Format;

interface HumanReadablePolicyInterface
{
    public function getHumanReadablePolicy(): string;

    /**
     * @return array<int, string>
     */
    public function getHumanReadableConstraints(): array;

    public function getHumanReadablePolicySentence(): string;
}
