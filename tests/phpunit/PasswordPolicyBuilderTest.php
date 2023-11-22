<?php

use StaySafe\Password\Policy\Test\Policy\Policy\ArrayPolicy;
use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Test\Policy\PasswordPolicyBuilder;
use StaySafe\Password\Policy\Test\Policy\Policy\JsonPolicy;
use StaySafe\Password\Policy\Test\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Test\Policy\Rule\LowerCaseCharacterRule;
use StaySafe\Password\Policy\Test\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Test\Policy\Rule\SpecialCharacterRule;
use StaySafe\Password\Policy\Test\Policy\Rule\UpperCaseCharacterRule;

final class PasswordPolicyBuilderTest extends TestCase
{

    static function initialise_password_policy(): ArrayPolicy
    {
        $arrayConstraints = [

            MinimumLengthRule::class => 8,
            SpecialCharacterRule::class => 2,
            DigitRule::class => 3,
            UpperCaseCharacterRule::class => 1,
            LowerCaseCharacterRule::class => 1

        ];

        return new ArrayPolicy($arrayConstraints);
    }

    function test_password_policy_object_contains_password_policy()
    {

       $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $actualPolicy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals(self::initialise_password_policy(), $actualPolicy);

    }

    function test_password_that_meets_constraints_is_valid()
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $validConstraint = $passwordPolicyBuilder->isValid('Pho$4r0us!12');

        self::assertTrue($validConstraint);

    }

    function test_rule_from_constraint_can_be_retrieved(){

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $digitRule = $passwordPolicyBuilder->getRuleFromConstraint(new DigitRule());

        var_dump($digitRule);

        self::assertEquals($digitRule, (new DigitRule)->getRule()); //DigitalRule::getRule() is for static methods
    }


}