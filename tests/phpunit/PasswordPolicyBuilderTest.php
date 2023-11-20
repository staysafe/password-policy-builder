<?php

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\PasswordPolicyBuilder;
use StaySafe\Password\Policy\Policy\JsonPolicy;

final class PasswordPolicyBuilderTest extends TestCase {

    function initialise_password_policy(){
        $jsonConstraints = file_get_contents(__DIR__ . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        return $passwordPolicyBuilder = new PasswordPolicyBuilder($policy);
    }

    function test_password_policy_object_contains_password_policy(){

        $jsonConstraints = file_get_contents(__DIR__ . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $passwordPolicyBuilder = new PasswordPolicyBuilder($policy);

        $actualPolicy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals($policy, $actualPolicy);

    }

    function test_password_that_meets_constraints_is_valid(){

        $passwordPolicyBuilder = $this->initialise_password_policy();

        $validConstraint = $passwordPolicyBuilder->isValid('Pho$4r0us!12');

        self::assertTrue($validConstraint);

    }


}