<?php


use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\PasswordPolicyBuilder;
use StaySafe\Password\Policy\Policy\ArrayPolicy;
use StaySafe\Password\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Rule\LowerCaseCharacterRule;
use StaySafe\Password\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Rule\SpecialCharacterRule;
use StaySafe\Password\Policy\Rule\UpperCaseCharacterRule;

final class PasswordPolicyBuilderTest extends TestCase
{

    private const RULE_CLASS_PREFIX = 'StaySafe\\Password\\Policy\\Rule\\';

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

    /**
     * @dataProvider providePassword
     */
    function test_password_that_meets_constraints_is_valid($password)
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $validConstraint = $passwordPolicyBuilder->isValid($password);

        self::assertTrue($validConstraint);

    }

    function test_rule_from_constraint_can_be_retrieved()
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $rule = $passwordPolicyBuilder->getRuleFromConstraint(new DigitRule());

        self::assertIsArray($rule);
        self::assertEquals($rule, (new DigitRule)->getRule());
    }

    /**
     * @param $constraints
     * @dataProvider provideConstraints
     */
    function test_rules_from_multiple_constraints_can_be_retrieved($constraints)
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $rules = $passwordPolicyBuilder->getRulesFromConstraints($constraints);

        print_r($rules);

        foreach ($rules as $rule){
            print_r($rule);

            if($constraints->includes($rule)){

                self::assertEquals($rule, (new self::RULE_CLASS_PREFIX)->getRule());
            }
        }

        //get a rule from constraint similar to how it's done in the method
        //do it for each constraint

        self::assertIsArray($rules);

    }

    /**
     * @param $constraints
     * @dataProvider provideConstraints
     */
    function test_flattened_arrays($constraints)
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $collection = $passwordPolicyBuilder->
        flattenRules($passwordPolicyBuilder->getRulesFromConstraints($constraints));
        self::assertIsArray($collection);

    }

    /**
     * @return string[]
     */
    static function providePassword(): array
    {

        return [
            'password' => ['Phos4rou0$!2']
        ];

    }

    static function provideConstraints(): array
    {
        return [
            ['constraints' => [
                new DigitRule(),
                new MinimumLengthRule(),
                new UpperCaseCharacterRule()]
            ],
        ];
    }

}