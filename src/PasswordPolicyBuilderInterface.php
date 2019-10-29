<?php

namespace StaySafe\Password\Policy;

use StaySafe\Password\Policy\Policy\PolicyInterface;

interface PasswordPolicyBuilderInterface
{
    public function isValid(string $password): bool;

    public function getPolicy(): PolicyInterface;
}
