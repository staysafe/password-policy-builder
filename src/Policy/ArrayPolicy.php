<?php

namespace StaySafe\Password\Policy\Policy;

use StaySafe\Password\Policy\Rule\RuleInterface;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;

final class ArrayPolicy implements PolicyInterface
{
    /** @var RuleInterface[] */
    private array $constraints = [];

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function __construct(array $policy)
    {
        $this->loadConstraints($policy);
    }

    /**
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    private function loadConstraints(array $policy): void
    {
        if (empty($policy)) {
            throw new InvalidConstraintException('Policy cannot be empty');
        }

        foreach ($policy as $ruleClassName => $number) {
            $this->constraints[$ruleClassName] = $this->getRule($ruleClassName, $number);
        }
    }

    /**
     * @return RuleInterface
     * @throws InvalidRuleTypeException
     */
    private function getRule(string $ruleClassName, int $number): RuleInterface
    {
        if (!is_subclass_of($ruleClassName, RuleInterface::class)) {
            throw new InvalidRuleTypeException(sprintf('Rule class %s is not valid', $ruleClassName));
        }

        return new $ruleClassName($number);
    }

    /**
     * @return RuleInterface[]
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }
}
