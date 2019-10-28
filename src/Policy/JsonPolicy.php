<?php

namespace StaySafe\Password\Policy\Policy;

use StaySafe\Password\Policy\Rule\RuleInterface;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;

class JsonPolicy implements PolicyInterface
{
    private const RULE_CLASS_PREFIX = 'StaySafe\\Password\\Policy\\Rule\\';

    /**
     * @var array
     */
    private $constraints = [];

    /**
     * @param string $constraints
     *
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public function __construct(string $constraints)
    {
        $this->loadConstraints($constraints);
    }

    /**
     * @param string $constraints
     *
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    private function loadConstraints(string $constraints): void
    {
        $policy = json_decode($constraints, true);

        if (empty($policy)) {
            throw new InvalidConstraintException('Policy is not a valid json string');
        }

        foreach ($policy as $constraintClass => $number) {
            $this->constraints[$constraintClass] = $this->get($constraintClass, $number);
        }
    }

    /**
     * @param string $ruleClassName
     * @param int    $value
     *
     * @return RuleInterface
     *
     * @throws InvalidRuleTypeException
     */
    private function get(string $ruleClassName, int $value): RuleInterface
    {
        $ruleClassName = self::RULE_CLASS_PREFIX . $ruleClassName;
        if (!class_exists($ruleClassName)) {
            throw new InvalidRuleTypeException(sprintf('Rule class %s does not exist', $ruleClassName));
        }

        return new $ruleClassName($value);
    }

    /**
     * @return RuleInterface[]
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }
}
