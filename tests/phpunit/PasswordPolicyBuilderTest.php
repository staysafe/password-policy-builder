<?php


use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Policy\ArrayPolicy;
use StaySafe\Password\Policy\PasswordPolicyBuilder;
use StaySafe\Password\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Rule\SpecialCharacterRule;
use StaySafe\Password\Policy\Rule\LowerCaseCharacterRule;
use StaySafe\Password\Policy\Rule\UpperCaseCharacterRule;

final class PasswordPolicyBuilderTest extends TestCase
{

    //  private const RULE_CLASS_PREFIX = 'StaySafe\\Password\\Policy\\Rule\\';

    public static function initialise_password_policy(): ArrayPolicy
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

    public function test_password_policy_object_contains_password_policy()
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

        $actualPolicy = $passwordPolicyBuilder->getPolicy();

        self::assertEquals(self::initialise_password_policy(), $actualPolicy);

    }

    /**
     * @dataProvider providePassword
     */
    public function test_password_that_meets_constraints_is_valid($password): void
    {

        $passwordPolicyBuilder = new PasswordPolicyBuilder(self::initialise_password_policy());

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
