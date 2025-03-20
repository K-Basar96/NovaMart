<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixerCustomFixers\Fixers as CustomFixers;

$finder = Finder::create()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/routes')
    ->name('*.php')
    ->exclude('storage')
    ->exclude('vendor');

return (new Config())
    ->registerCustomFixers(new CustomFixers())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_whitespace_before_comma_in_array' => true,
        'trim_array_spaces' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_spaces_after_function_name' => true,
        'indentation_type' => true,
        // Enable specific custom fixers as needed
        // 'CustomFixerName' => true,
    ])
    ->setIndent('    ') // 4 spaces
    ->setFinder($finder)
    ->setUsingCache(false);  // Disable cache file creation
