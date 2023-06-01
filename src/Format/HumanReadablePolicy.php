<?php

namespace StaySafe\Password\Policy\Format;

use StaySafe\Password\Policy\Policy\PolicyInterface;

class HumanReadablePolicy implements HumanReadablePolicyInterface
{
    /**
     * @var PolicyInterface
     */
    private $policy;

    public function __construct(PolicyInterface $policy)
    {
        $this->policy = $policy;
    }

    public function getHumanReadablePolicySentence(): string
    {
        // Get array of parts
        $collection = $this->getHumanReadableConstraints();
        $firstElement = reset($collection);
        $lastElement = end($collection);

        // Convert to string, handling the first and last parts differently.
        $policy = '';
        $prefix = 'Password should';

        foreach ($collection as $key => $rule) {
            if ($rule === $firstElement) {
                $policy .= (string) $rule.', ';
            } elseif ($rule === $lastElement) {
                if (substr($rule, 0, strlen($prefix)) == $prefix) {
                    $rule = substr($rule, strlen($prefix));
                }
                $policy .= 'and '.trim((string) $rule).', ';
            } else {
                if (substr($rule, 0, strlen($prefix)) == $prefix) {
                    $rule = trim(substr($rule, strlen($prefix)));
                }
                $policy .= (string) $rule.', ';
            }
        }

        $policy = ucfirst(strtolower($policy));

        return substr($policy, 0, -2).'.';
    }

    /**
     * @return array<int, string>
     */
    public function getHumanReadableConstraints(): array
    {
        $collection = [];
        foreach ($this->policy->getConstraints() as $rule) {
            $collection[] = (string) $rule;
        }

        return $collection;
    }

    public function getHumanReadablePolicy(): string
    {
        $policy = '';
        foreach ($this->policy->getConstraints() as $rule) {
            $policy .= (string) $rule.', ';
        }

        $policy = ucfirst(strtolower($policy));

        return substr($policy, 0, -2).'.';
    }
}
