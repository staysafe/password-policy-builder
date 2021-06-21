<?php

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR2' => true,
        'php_unit_test_class_requires_covers' => false,
        'ordered_imports' => [ 'sort_algorithm' => 'length' ],
    ])
    ->setFinder($finder)
;