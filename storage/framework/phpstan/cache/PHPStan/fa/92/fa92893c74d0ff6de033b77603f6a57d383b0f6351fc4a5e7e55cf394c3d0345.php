<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Services\ExpiryAlertService.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Services\ExpiryAlertService
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-810fc7c555f72fd943e51a6b37789bdae6a5f4170ffa90da4476e0d58156459a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Services\\ExpiryAlertService',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Services/ExpiryAlertService.php',
      ),
    ),
    'namespace' => 'App\\Services',
    'name' => 'App\\Services\\ExpiryAlertService',
    'shortName' => 'ExpiryAlertService',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Read-side query service backing the "Expiring Soon" dashboard (see
 * prd.md §2.3) and the scheduled sweep (CheckExpiringBatches). Always
 * computed live from batches — there is no separate alerts table, so the
 * list is queryable on-demand at any time, not just via the schedule.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 17,
    'endLine' => 34,
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
      'expiringWithin' => 
      array (
        'name' => 'expiringWithin',
        'parameters' => 
        array (
          'days' => 
          array (
            'name' => 'days',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 25,
                'endLine' => 25,
                'startTokenPos' => 52,
                'startFilePos' => 690,
                'endTokenPos' => 52,
                'endFilePos' => 691,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 25,
            'endLine' => 25,
            'startColumn' => 36,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Collection',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Batches within the given window that still have stock to sell,
 * soonest-expiring first.
 *
 * @return Collection<int, Batch>
 */',
        'startLine' => 25,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\ExpiryAlertService',
        'implementingClassName' => 'App\\Services\\ExpiryAlertService',
        'currentClassName' => 'App\\Services\\ExpiryAlertService',
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