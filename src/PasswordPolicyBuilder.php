<?php

namespace StaySafe\Password\Policy;

use StaySafe\Password\Policy\Rule\RuleInterface;
use StaySafe\Password\Policy\Policy\PolicyInterface;

class PasswordPolicyBuilder implements PasswordPolicyBuilderInterface
{
    /**
     * @var PolicyInterface
     */
    private $policy;

    /**
     * @param PolicyInterface $policy
     */
    public function __construct(PolicyInterface $policy)
    {
        $this->policy = $policy;
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function isValid(string $password): bool
    {
        foreach ($this->policy->getConstraints() as $constraint) {
            /** @var RuleInterface $constraint */
            if (!$constraint->isValid($password)) {
                return false;
            }
        }

        return true;
    }

    public function getPolicy(): PolicyInterface
    {
        return $this->policy;
    }

    /**
     * @param RuleInterface[] $enforcedRules
     */
    public static function createWithEnforcedRules(PolicyInterface $policy, array $enforcedRules = []): self
    {
        return new self(
            new PasswordPolicyBuilder(
                self::createPolicy($policy, $enforcedRules)
            )
        );
    }

    /**
     * @param RuleInterface[] $enforcedRules
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

}
