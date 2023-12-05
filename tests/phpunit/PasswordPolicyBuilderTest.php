<?php


use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Policy\ArrayPolicy;
use StaySafe\Password\Policy\PasswordPolicyBuilder;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Rule\SpecialCharacterRule;
use StaySafe\Password\Policy\Rule\LowerCaseCharacterRule;
use StaySafe\Password\Policy\Rule\UpperCaseCharacterRule;

final class PasswordPolicyBuilderTest extends TestCase
{

    //  private const RULE_CLASS_PREFIX = 'StaySafe\\Password\\Policy\\Rule\\';


    /**
     * @throws InvalidRuleTypeException
     * @throws InvalidConstraintException
     * @dataProvider provideConstraints
     */
    public static function setUpPasswordPolicyBuilder($constraints): \StaySafe\Password\Policy\PasswordPolicyBuilderInterface
    {

        $arrayPolicy = new ArrayPolicy($constraints);

        return new StaySafe\Password\Policy\Policy\PasswordPolicy\PasswordPolicyBuilder($arrayPolicy);
    }

    /**
     * @throws InvalidRuleTypeException
     * @throws InvalidConstraintException
     * @dataProvider provideConstraints
     */
    public function test_set_up_function_returns_password_builder_correctly($constraints)
    {

        $arrayPolicy = new ArrayPolicy($constraints);

        $passwordPolicySetUp = self::setUpPasswordPolicyBuilder($constraints);

        $policyFromSetUpFunction = $passwordPolicySetUp->getPolicy();

        self::assertEquals($policyFromSetUpFunction, $arrayPolicy);

    }

    /**
     * @throws InvalidRuleTypeException
     * @throws InvalidConstraintException
     * @dataProvider provideConstraints
     */
    public function test_policy_obtained_from_password_builder_equals_policy_obtained_from_set_up_password_policy_object($constraints): void
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::setUpPasswordPolicyBuilder($constraints));

        $policy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals((self::setUpPasswordPolicyBuilder($constraints))->getPolicy(), $policy);

    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     * @dataProvider provideConstraints
     */
    public function test_policy_obtained_from_password_builder_equals_new_instance_of_same_policy($constraints): void
    {

        $arrayPolicy = new ArrayPolicy($constraints);

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::setUpPasswordPolicyBuilder($constraints));

        $policy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals($arrayPolicy, $policy);

    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     * @dataProvider providePassword
     */
    public function test_password_that_meets_constraints_is_valid($password): void
    {
        $constraints = [
            MinimumLengthRule::class => 8,
            SpecialCharacterRule::class => 2,
            DigitRule::class => 3,
            UpperCaseCharacterRule::class => 1,
            LowerCaseCharacterRule::class => 1
        ];

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::setUpPasswordPolicyBuilder($constraints));

        $validConstraint = $passwordPolicyBuilder->isValid($password);

        self::assertTrue($validConstraint);

    }

    /**
     * @return void
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_object_created_from_constructor_can_be_used_to_create_equal_object_using_enforced_rules_method(): void
    {
        $constraints = [
            MinimumLengthRule::class => 8,
            SpecialCharacterRule::class => 2,
            DigitRule::class => 3,
            UpperCaseCharacterRule::class => 1,
            LowerCaseCharacterRule::class => 1
        ];

        $rules = [
            new MinimumLengthRule(),
            new SpecialCharacterRule(),
            new DigitRule(),
            new UpperCaseCharacterRule(),
            new LowerCaseCharacterRule()
        ];

        $passwordPolicyBuilder = self::setUpPasswordPolicyBuilder($constraints);

        $decoupledPasswordPolicyBuilder = new PasswordPolicyBuilder($passwordPolicyBuilder);

        $policy = $decoupledPasswordPolicyBuilder->getPolicy();

        $enforcedRulesPolicy = $decoupledPasswordPolicyBuilder::createWithEnforcedRules($policy, $rules);

        self::assertEquals($enforcedRulesPolicy, $decoupledPasswordPolicyBuilder);

    }


    /**
     * @return string[]
     */
    public static function providePassword(): array
    {

        return [
            ['Phos4rou0$!2']
        ];

    }

    /**
     * @return array[]
     */
    public static function provideConstraints(): array
    {
        return [
            [
                //dataset #0
                [
                    MinimumLengthRule::class => 8,
                    SpecialCharacterRule::class => 2,
                    DigitRule::class => 3,
                    UpperCaseCharacterRule::class => 1,
                    LowerCaseCharacterRule::class => 1
                ]

            ]
        ];
    }

    /**
     * @return array[]
     */
    public static function provideRules(): array
    {
        return [
            [
                //dataset #0
                [
                    new MinimumLengthRule(),
                    new SpecialCharacterRule(),
                    new DigitRule(),
                    new UpperCaseCharacterRule(),
                    new LowerCaseCharacterRule()
                ],

            ]
        ];
    }

}
