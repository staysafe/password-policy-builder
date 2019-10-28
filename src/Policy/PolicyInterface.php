<?php

namespace StaySafe\Password\Policy\Policy;

use StaySafe\Password\Policy\Rule\RuleInterface;

interface PolicyInterface
{
    /**
     * @return RuleInterface[]
     */
    public function getConstraints(): array;
}
