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
     */
    public static function setUpPasswordPolicyBuilder(): \StaySafe\Password\Policy\PasswordPolicyBuilderInterface
    {
        $arrayConstraints = [

            MinimumLengthRule::class => 8,
            SpecialCharacterRule::class => 2,
            DigitRule::class => 3,
            UpperCaseCharacterRule::class => 1,
            LowerCaseCharacterRule::class => 1

        ];

        $arrayPolicy = new ArrayPolicy($arrayConstraints);

        return new StaySafe\Password\Policy\Policy\PasswordPolicy\PasswordPolicyBuilder($arrayPolicy);
    }

    /**
     * @throws InvalidRuleTypeException
     * @throws InvalidConstraintException
     */
    public function test_set_up_function_returns_password_builder_correctly(){

        $arrayConstraints = [

            MinimumLengthRule::class => 8,
            SpecialCharacterRule::class => 2,
            DigitRule::class => 3,
            UpperCaseCharacterRule::class => 1,
            LowerCaseCharacterRule::class => 1

        ];

        $arrayPolicy = new ArrayPolicy($arrayConstraints);

        $passwordPolicySetUp = self::setUpPasswordPolicyBuilder();

        $policyFromSetUpFunction = $passwordPolicySetUp->getPolicy();

        self::assertEquals($policyFromSetUpFunction, $arrayPolicy);

    }

    /**
     * @throws InvalidRuleTypeException
     * @throws InvalidConstraintException
     */
    public function test_policy_obtained_from_password_builder_equals_policy_obtained_set_up_password_policy_object(): void
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::setUpPasswordPolicyBuilder());

        $policy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals((self::setUpPasswordPolicyBuilder())->getPolicy(), $policy);

    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_policy_obtained_from_password_builder_equals_policy(): void
    {

        $arrayConstraints = [

            MinimumLengthRule::class => 8,
            SpecialCharacterRule::class => 2,
            DigitRule::class => 3,
            UpperCaseCharacterRule::class => 1,
            LowerCaseCharacterRule::class => 1

        ];

       $arrayPolicy = new ArrayPolicy($arrayConstraints);

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::setUpPasswordPolicyBuilder());

        $policy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals($arrayPolicy, $policy);

    }

    /**
     * @dataProvider providePassword
     */
    public function test_password_that_meets_constraints_is_valid($password): void
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::setUpPasswordPolicyBuilder());

        $validConstraint = $passwordPolicyBuilder->isValid($password);

        self::assertTrue($validConstraint);

    }



    /**
     * @return string[]
     */
    public static function providePassword(): array
    {

        return [
            'password' => ['Phos4rou0$!2']
        ];

    }

    public static function provideConstraints(): array
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
