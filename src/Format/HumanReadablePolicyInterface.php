<?php

namespace StaySafe\Password\Policy\Format;

interface HumanReadablePolicyInterface
{
    public function getHumanReadablePolicy(): string;

    public function getHumanReadableConstraints(): array;

    public function getHumanReadablePolicySentence(): string;
}
