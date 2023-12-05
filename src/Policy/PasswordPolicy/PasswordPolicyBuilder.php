<?php

namespace StaySafe\Password\Policy\Policy\PasswordPolicy;

use StaySafe\Password\Policy\PasswordPolicyBuilderInterface;
use StaySafe\Password\Policy\Policy\PolicyInterface;
use StaySafe\Password\Policy\Rule\RuleInterface;

class PasswordPolicyBuilder implements PasswordPolicyBuilderInterface
{
    /**
     * @var PolicyInterface
     */
    private $policy;

    /**
     * @param PolicyInterface $policy
     */
    public function __construct(PolicyInterface $policy)
    {
        $this->policy = $policy;
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function isValid(string $password): bool
    {
        foreach ($this->policy->getConstraints() as $constraint) {
            /** @var RuleInterface $constraint */
            if (!$constraint->isValid($password)) {
                return false;
            }
        }

        return true;
    }

    public function getPolicy(): PolicyInterface
    {
        return $this->policy;
    }
}