<?php

use StaySafe\Password\Policy\Rule\DigitRule;
use StaySafe\Password\Policy\Rule\LowerCaseCharacterRule;
use StaySafe\Password\Policy\Rule\MinimumLengthRule;
use StaySafe\Password\Policy\Rule\SpecialCharacterRule;
use StaySafe\Password\Policy\Rule\UpperCaseCharacterRule;

return [

    MinimumLengthRule::class => 8,
    SpecialCharacterRule::class => 2,
    DigitRule::class => 3,
    UpperCaseCharacterRule::class => 1,
    LowerCaseCharacterRule::class => 1

];