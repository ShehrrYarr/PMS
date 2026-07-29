<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Observers\BatchObserver.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Observers\BatchObserver
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-7229d36dd8ea42dd9e9d24abb21966f2c3b2b3b9b028ba3461b8de1ed8dc292c',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Observers\\BatchObserver',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Observers/BatchObserver.php',
      ),
    ),
    'namespace' => 'App\\Observers',
    'name' => 'App\\Observers\\BatchObserver',
    'shortName' => 'BatchObserver',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 25,
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
      'saved' => 
      array (
        'name' => 'saved',
        'parameters' => 
        array (
          'batch' => 
          array (
            'name' => 'batch',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Batch',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 19,
            'endLine' => 19,
            'startColumn' => 27,
            'endColumn' => 38,
            'parameterIndex' => 0,
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
 * Dispatch a freshness-check event whenever a batch is created or
 * updated and already falls within the expiry alert window — a
 * side-effect only, never a ledger/stock write (see rules.md §1.2).
 * The scheduled sweep (CheckExpiringBatches) covers batches that age
 * into the window without being saved again.
 */',
        'startLine' => 19,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Observers',
        'declaringClassName' => 'App\\Observers\\BatchObserver',
        'implementingClassName' => 'App\\Observers\\BatchObserver',
        'currentClassName' => 'App\\Observers\\BatchObserver',
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