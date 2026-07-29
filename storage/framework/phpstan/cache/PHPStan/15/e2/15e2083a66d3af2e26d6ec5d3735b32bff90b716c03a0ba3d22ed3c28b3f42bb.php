<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Services\PaymentSplitService.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Services\PaymentSplitService
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-9e10875804660bf3b8922a578211e2b80b1cb9114293f624b00517f59512654b',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Services\\PaymentSplitService',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Services/PaymentSplitService.php',
      ),
    ),
    'namespace' => 'App\\Services',
    'name' => 'App\\Services\\PaymentSplitService',
    'shortName' => 'PaymentSplitService',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Decimal-safe sum-to-total validator, shared by every flow that accepts a
 * split payment (purchases now, sales/POS in Phase 5) — see rules.md §2
 * rule 3. Never compares floats; every amount is handled as a bcmath string.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 33,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'assertBalanced' => 
      array (
        'name' => 'assertBalanced',
        'parameters' => 
        array (
          'paymentLines' => 
          array (
            'name' => 'paymentLines',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 21,
            'endLine' => 21,
            'startColumn' => 36,
            'endColumn' => 54,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'expectedTotal' => 
          array (
            'name' => 'expectedTotal',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 21,
            'endLine' => 21,
            'startColumn' => 57,
            'endColumn' => 77,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param  list<array{amount: string}>  $paymentLines
 *
 * @throws UnbalancedPaymentSplitException
 */',
        'startLine' => 21,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\PaymentSplitService',
        'implementingClassName' => 'App\\Services\\PaymentSplitService',
        'currentClassName' => 'App\\Services\\PaymentSplitService',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));