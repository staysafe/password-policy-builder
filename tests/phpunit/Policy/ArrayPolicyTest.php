<?php

use PHPUnit\Framework\TestCase;
use StaySafe\Password\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Policy\ArrayPolicy;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;

/**
 * @covers StaySafe\Password\Policy\Policy\ArrayPolicy
 */
final class ArrayPolicyTest extends TestCase
{

    /**
     * @return array
     */
    public static function provideInvalidData(): array
    {

        return [
            ['abc'],
            [date("l", mktime(0, 0, 0, 7, 1, 2000))],
            [1000000000000000000000000000000008888800000000000000000]
            // [true], passes as boolean converted to int 1
            // [0.0001] passes as decimal converted to int 0
        ];
    }

    /**
     * @throws InvalidRuleTypeException
     */
    public function test_loading_empty_array_throws_exception(): void
    {

        $this->expectException(InvalidConstraintException::class);

        new ArrayPolicy([]);

    }

    /**
     * @throws InvalidConstraintException
     */
    public function test_passing_rule_with_invalid_name_throws_exception(): void
    {

        $this->expectException(InvalidRuleTypeException::class);

        new ArrayPolicy(['StaySafe\Password\Policy\Rule\NonExistentRuleName' => 9]);

    }

    /**
     * @throws InvalidConstraintException
     */
    public function test_passing_existent_class_that_is_not_rule_throws_exception(): void
    {

        $this->expectException(InvalidRuleTypeException::class);

        new ArrayPolicy([TestCase::class => 123]);

    }

    /**
     * @return void
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_passing_negative_occurrence_throws_exception(): void
    {

        $this->expectException(InvalidArgumentException::class);

        new ArrayPolicy([DigitRule::class => -1]);

    }

    /**
     * @param $data
     * @return void
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     * @dataProvider provideInvalidData
     */
    public function test_passing_wrong_data_type_throws_exception($data): void
    {

        $this->expectException(TypeError::class);

        new ArrayPolicy([DigitRule::class => $data]);

    }

    /**
     * @param $data
     * @return void
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function test_passing_valid_data_type_creates_instance_of_policy()
    {
        $policy = new ArrayPolicy([DigitRule::class => 9]);

        self::assertObjectHasProperty('constraints', $policy);

    }


    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    function test_get_constraints_method_returns_same_array_key_of_rule_passed_to_constructor()
    {

        $arrayConstraints = [DigitRule::class => 9];

        $constraints = (new ArrayPolicy($arrayConstraints))->getConstraints();

        self::assertSame(array_keys($arrayConstraints), array_keys($constraints));

    }


}
