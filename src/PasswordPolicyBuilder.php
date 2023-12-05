<?php

namespace StaySafe\Password\Policy;

use StaySafe\Password\Policy\Policy\ArrayPolicy;
use StaySafe\Password\Policy\Rule\RuleInterface;
use StaySafe\Password\Policy\Policy\PolicyInterface;
use StaySafe\Password\Policy\Rule\Exception\InvalidRuleTypeException;
use StaySafe\Password\Policy\Rule\Exception\InvalidConstraintException;

class PasswordPolicyBuilder implements PasswordPolicyBuilderInterface
{
    public function __construct(
        private readonly PasswordPolicyBuilderInterface $passwordPolicyBuilder,
    ) {
    }

    /**
     * @param RuleInterface[] $enforcedRules
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    public static function createWithEnforcedRules(PolicyInterface $policy, array $enforcedRules = []): self
    {
        return new self(
            new Policy\PasswordPolicy\PasswordPolicyBuilder(
                self::createPolicy($policy, $enforcedRules)
            )
        );
    }

    /**
     * @param RuleInterface[] $enforcedRules
     * @throws InvalidConstraintException
     * @throws InvalidRuleTypeException
     */
    private static function createPolicy(PolicyInterface $policy, array $enforcedRules): PolicyInterface
    {
        $rules = self::getRules($policy->getConstraints());
        $rules += self::getRules($enforcedRules);

        return new ArrayPolicy($rules);
    }

    /**
     * @param RuleInterface[] $constraints
     *
     * @return array<class-string, int>
     */
    private static function getRules(array $constraints): array
    {
        return self::flattenRules(self::getRulesFromConstraints($constraints));
    }

    /**
     * @param array<int, array<class-string, int>> $rules
     *
     * @return array<class-string, int>
     */
    private static function flattenRules(array $rules): array
    {
        return array_merge(...$rules);
    }

    /**
     * @param RuleInterface[] $constraints
     *
     * @return array<int, array<class-string, int>>
     */
    private static function getRulesFromConstraints(array $constraints): array
    {
        return array_map(self::getRuleFromConstraint(...), $constraints, []);
    }

    /**
     * @return array<class-string, int>
     */
    private static function getRuleFromConstraint(RuleInterface $constraint): array
    {
        return $constraint->getRule();
    }

    public function isValid(string $password): bool
    {
        return $this->passwordPolicyBuilder->isValid($password);
    }

    public function getPolicy(): PolicyInterface
    {
        return $this->passwordPolicyBuilder->getPolicy();
    }

}
