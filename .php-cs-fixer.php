<?php

$finder = PhpCsFixer\Finder::create()
                           ->notPath( 'assets/*' )
                           ->in( [
                               __DIR__ . '/src',
                               __DIR__ . '/tests',
                           ] )
                           ->name( '*.php' )
                           ->notName( '*.stub' )
                           ->ignoreDotFiles( true )
                           ->ignoreVCS( true );

$config = new PhpCsFixer\Config();

return $config->setRules( [
    '@PSR2'                             => true,
    'array_syntax'                      => [ 'syntax' => 'short' ],
    'ordered_imports'                   => [ 'sort_algorithm' => 'alpha' ],
    'no_unused_imports'                 => true,
    'single_quote'                      => true,
    'not_operator_with_successor_space' => false,
    'trailing_comma_in_multiline'       => true,
    'phpdoc_scalar'                     => true,
    'unary_operator_spaces'             => true,
    'binary_operator_spaces'            => [ 'default' => 'align' ],
    'blank_line_before_statement'       => [
        'statements' => [ 'break', 'continue', 'declare', 'return', 'throw', 'try' ],
    ],
    'phpdoc_single_line_var_spacing'    => true,
    'phpdoc_var_without_name'           => true,
    'method_argument_space'             => [
        'on_multiline'                     => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => true,
    ],
] )
              ->setFinder( $finder );
