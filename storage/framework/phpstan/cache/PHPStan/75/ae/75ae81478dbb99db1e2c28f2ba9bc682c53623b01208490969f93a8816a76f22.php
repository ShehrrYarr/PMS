<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Livewire\Forms\CustomerForm.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Livewire\Forms\CustomerForm
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-0dd8c772181094266cb86a72192026425b00f842d82d4b3ce2b71e9ba6d61b60',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Livewire\\Forms\\CustomerForm',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Livewire/Forms/CustomerForm.php',
      ),
    ),
    'namespace' => 'App\\Livewire\\Forms',
    'name' => 'App\\Livewire\\Forms\\CustomerForm',
    'shortName' => 'CustomerForm',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 55,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Livewire\\Form',
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
      'customer' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'name' => 'customer',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'App\\Models\\Customer',
                  'isIdentifier' => false,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'default' => 
        array (
          'code' => 'null',
          'attributes' => 
          array (
            'startLine' => 13,
            'endLine' => 13,
            'startTokenPos' => 49,
            'startFilePos' => 210,
            'endTokenPos' => 49,
            'endFilePos' => 213,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 13,
        'endLine' => 13,
        'startColumn' => 5,
        'endColumn' => 38,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'name' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'name' => 'name',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '\'\'',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 67,
            'startFilePos' => 286,
            'endTokenPos' => 67,
            'endFilePos' => 287,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'Livewire\\Attributes\\Validate',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '\'required|string|max:255\'',
                'attributes' => 
                array (
                  'startLine' => 15,
                  'endLine' => 15,
                  'startTokenPos' => 55,
                  'startFilePos' => 232,
                  'endTokenPos' => 55,
                  'endFilePos' => 256,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 15,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'phone' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'name' => 'phone',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '\'\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 85,
            'startFilePos' => 360,
            'endTokenPos' => 85,
            'endFilePos' => 361,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'Livewire\\Attributes\\Validate',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '\'nullable|string|max:30\'',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 73,
                  'startFilePos' => 306,
                  'endTokenPos' => 73,
                  'endFilePos' => 329,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 18,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 30,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'address' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'name' => 'address',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '\'\'',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 22,
            'startTokenPos' => 103,
            'startFilePos' => 438,
            'endTokenPos' => 103,
            'endFilePos' => 439,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'Livewire\\Attributes\\Validate',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '\'nullable|string|max:1000\'',
                'attributes' => 
                array (
                  'startLine' => 21,
                  'endLine' => 21,
                  'startTokenPos' => 91,
                  'startFilePos' => 380,
                  'endTokenPos' => 91,
                  'endFilePos' => 405,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 21,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 32,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'opening_balance' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'name' => 'opening_balance',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '\'0\'',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 121,
            'startFilePos' => 522,
            'endTokenPos' => 121,
            'endFilePos' => 524,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'Livewire\\Attributes\\Validate',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '\'required|numeric|min:0\'',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 109,
                  'startFilePos' => 458,
                  'endTokenPos' => 109,
                  'endFilePos' => 481,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 24,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 41,
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
      'setCustomer' => 
      array (
        'name' => 'setCustomer',
        'parameters' => 
        array (
          'customer' => 
          array (
            'name' => 'customer',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Customer',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 27,
            'endLine' => 27,
            'startColumn' => 33,
            'endColumn' => 50,
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
        'startLine' => 27,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'currentClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'aliasName' => NULL,
      ),
      'attributesForSave' => 
      array (
        'name' => 'attributesForSave',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array<string, mixed>
 */',
        'startLine' => 39,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'currentClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'aliasName' => NULL,
      ),
      'resetForm' => 
      array (
        'name' => 'resetForm',
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
        'startLine' => 49,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\CustomerForm',
        'currentClassName' => 'App\\Livewire\\Forms\\CustomerForm',
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