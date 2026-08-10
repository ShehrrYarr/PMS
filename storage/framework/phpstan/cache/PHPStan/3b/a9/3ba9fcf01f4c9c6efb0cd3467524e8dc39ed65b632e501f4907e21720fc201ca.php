<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Livewire\Pos\SyncConflicts.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Livewire\Pos\SyncConflicts
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-d19a175b6ac0f44ca88d4a2c133078467ddac341136475ff9b78aa266a2cd59c',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Livewire\\Pos\\SyncConflicts',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Livewire/Pos/SyncConflicts.php',
      ),
    ),
    'namespace' => 'App\\Livewire\\Pos',
    'name' => 'App\\Livewire\\Pos\\SyncConflicts',
    'shortName' => 'SyncConflicts',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Admin review of offline sales that oversold their batch on sync.
 *
 * These are never errors to be dismissed blindly: each one means the shop
 * physically handed over stock it didn\'t have on record, so the batch is now
 * negative until a purchase or a stock correction squares it up.
 */',
    'attributes' => 
    array (
      0 => 
      array (
        'name' => 'Livewire\\Attributes\\Layout',
        'isRepeated' => false,
        'arguments' => 
        array (
          0 => 
          array (
            'code' => '\'layouts.app\'',
            'attributes' => 
            array (
              'startLine' => 21,
              'endLine' => 21,
              'startTokenPos' => 50,
              'startFilePos' => 582,
              'endTokenPos' => 50,
              'endFilePos' => 594,
            ),
          ),
        ),
      ),
    ),
    'startLine' => 21,
    'endLine' => 75,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Livewire\\Component',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Livewire\\WithPagination',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'showResolved' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'implementingClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'name' => 'showResolved',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 26,
            'startTokenPos' => 77,
            'startFilePos' => 695,
            'endTokenPos' => 77,
            'endFilePos' => 699,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 38,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'mount' => 
      array (
        'name' => 'mount',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 28,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Pos',
        'declaringClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'implementingClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'currentClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'aliasName' => NULL,
      ),
      'updatingShowResolved' => 
      array (
        'name' => 'updatingShowResolved',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 33,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Pos',
        'declaringClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'implementingClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'currentClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'aliasName' => NULL,
      ),
      'resolve' => 
      array (
        'name' => 'resolve',
        'parameters' => 
        array (
          'conflictId' => 
          array (
            'name' => 'conflictId',
            'default' => NULL,
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
            'startLine' => 38,
            'endLine' => 38,
            'startColumn' => 29,
            'endColumn' => 43,
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
        'docComment' => NULL,
        'startLine' => 38,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Pos',
        'declaringClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'implementingClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'currentClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'aliasName' => NULL,
      ),
      'render' => 
      array (
        'name' => 'render',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Contracts\\View\\View',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 56,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Pos',
        'declaringClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'implementingClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'currentClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'aliasName' => NULL,
      ),
      'conflictsQuery' => 
      array (
        'name' => 'conflictsQuery',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return LengthAwarePaginator<int, SaleSyncConflict>
 */',
        'startLine' => 67,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Livewire\\Pos',
        'declaringClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'implementingClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
        'currentClassName' => 'App\\Livewire\\Pos\\SyncConflicts',
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