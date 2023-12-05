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
     * @dataProvider provideInvalidData
     */
    public function test_passing_wrong_data_type_throws_exception($data): void
    {

        $this->expectException(TypeError::class);

        new ArrayPolicy([DigitRule::class => $data]);

    }


    /* function test_get_constraints_returns_the_array_passed_to_constructor()
     {

         $policy = self::set_up();

         $constraints = $policy->getConstraints();

         $arrayConstraints = [

             MinimumLengthRule::class => 8,
             SpecialCharacterRule::class => 2,
             DigitRule::class => 3,
             UpperCaseCharacterRule::class => 1,
             LowerCaseCharacterRule::class => 1

         ];

         //  self::assertSame($arrayConstraints, $constraints);

     }*/


}
