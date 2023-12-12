<?php

namespace StaySafe\Password\Policy\Test\Policy;

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Policy\JsonPolicy;
use StaySafe\Password\Policy\Format\HumanReadablePolicy;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;
use StaySafe\Password\Policy\Policy\PasswordPolicy\PasswordPolicyBuilder;

class JsonPolicyTest extends TestCase
{
    /**
     * @param string $password
     * @param bool   $result
     *
     * @dataProvider validatePasswordDataProvider
     *
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_can_validate_password_from_json_policy(string $password, bool $result): void
    {
        $jsonConstraints = file_get_contents(dirname(__DIR__) . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $passwordPolicyBuilder = new PasswordPolicyBuilder($policy);

        $this->assertSame($result, $passwordPolicyBuilder->isValid($password));
    }

    public static function validatePasswordDataProvider(): array
    {
        return [
            ['abc!123#ABC', true],
            ['abc!123ABC', false],
            ['abc123ABC', false],
            ['abcdefghijklm', false],
        ];
    }

    /**
     * @param string $jsonConstraints
     * @dataProvider jsonConstraintsDataProvider
     *
     * @throws InvalidRuleTypeException
     * @throws InvalidConstraintException
     */
    public function test_an_invalid_or_empty_policy_throws_exception(string $jsonConstraints): void
    {
        $this->expectException(InvalidConstraintException::class);
        new JsonPolicy($jsonConstraints);
    }

    public static function jsonConstraintsDataProvider(): array
    {
        return [
            [''],
            ['[]'],
            ['digit']
        ];
    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_rule_does_not_exist_throws_exception(): void
    {
        $jsonConstraints = '{"DoesNotExist":123}';
        $this->expectException(InvalidRuleTypeException::class);
        new JsonPolicy($jsonConstraints);
    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_can_view_human_readable_policy(): void
    {
        $jsonConstraints = file_get_contents(dirname(__DIR__) . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $passwordPolicyBuilder = new PasswordPolicyBuilder($policy);

        $this->assertSame(
            'Password should be at least 8 characters long, have at least 2 special characters, have at least 3 numbers, have at least 1 upper case letter, and have at least 1 lower case letter.',
            (new HumanReadablePolicy($passwordPolicyBuilder->getPolicy()))->getHumanReadablePolicySentence()
        );
    }
}
