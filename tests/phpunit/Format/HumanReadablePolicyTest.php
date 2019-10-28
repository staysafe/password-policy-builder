<?php

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Policy\JsonPolicy;
use StaySafe\Password\Policy\Format\HumanReadablePolicy;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;

final class HumanReadablePolicyTest extends TestCase
{
    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_get_human_readable_policy_sentence(): void
    {
        $jsonConstraints = file_get_contents(dirname(__DIR__) . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $humanReadablePolicy = new HumanReadablePolicy($policy);

        $this->assertSame(
            'Password should be at least 8 characters long, have at least 2 special characters, have at least 3 numbers, have at least 1 upper case letter, and have at least 1 lower case letter.',
            $humanReadablePolicy->getHumanReadablePolicySentence()
        );
    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_get_human_readable_constraints(): void
    {
        $jsonConstraints = file_get_contents(dirname(__DIR__) . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $humanReadablePolicy = new HumanReadablePolicy($policy);

        $result = [
            'Password should be at least 8 characters long',
            'Password should have at least 2 special characters',
            'Password should have at least 3 numbers',
            'Password should have at least 1 upper case letter',
            'Password should have at least 1 lower case letter',
        ];

        $this->assertSame(
            $result,
            $humanReadablePolicy->getHumanReadableConstraints()
        );
    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_get_human_readable_policy(): void
    {
        $jsonConstraints = file_get_contents(dirname(__DIR__) . '/fixtures/policy.json');
        $policy = new JsonPolicy($jsonConstraints);

        $humanReadablePolicy = new HumanReadablePolicy($policy);

        $this->assertSame(
            'Password should be at least 8 characters long, password should have at least 2 special characters, password should have at least 3 numbers, password should have at least 1 upper case letter, password should have at least 1 lower case letter.',
            $humanReadablePolicy->getHumanReadablePolicy()
        );
    }
}
