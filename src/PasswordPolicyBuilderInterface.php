<?php

namespace StaySafe\Password\Policy;

interface PasswordPolicyBuilderInterface
{
    public function isValid(string $password): bool;
}
