<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Livewire\Forms\ExpenseForm.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Livewire\Forms\ExpenseForm
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-a198c58e7aa0a0a977b54a7c435a5d4c4df6b1f04914c73733889cea44ee209f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Livewire\\Forms\\ExpenseForm',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Livewire/Forms/ExpenseForm.php',
      ),
    ),
    'namespace' => 'App\\Livewire\\Forms',
    'name' => 'App\\Livewire\\Forms\\ExpenseForm',
    'shortName' => 'ExpenseForm',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 101,
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
      'expense' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'expense',
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
                  'name' => 'App\\Models\\Expense',
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
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 64,
            'startFilePos' => 331,
            'endTokenPos' => 64,
            'endFilePos' => 334,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'date' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'date',
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
            'startTokenPos' => 82,
            'startFilePos' => 397,
            'endTokenPos' => 82,
            'endFilePos' => 398,
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
                'code' => '\'required|date\'',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 70,
                  'startFilePos' => 353,
                  'endTokenPos' => 70,
                  'endFilePos' => 367,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 18,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'amount' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'amount',
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
            'startTokenPos' => 100,
            'startFilePos' => 475,
            'endTokenPos' => 100,
            'endFilePos' => 476,
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
                'code' => '\'required|numeric|min:0.01\'',
                'attributes' => 
                array (
                  'startLine' => 21,
                  'endLine' => 21,
                  'startTokenPos' => 88,
                  'startFilePos' => 417,
                  'endTokenPos' => 88,
                  'endFilePos' => 443,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 21,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 31,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'expense_category_id' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'expense_category_id',
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
                  'name' => 'int',
                  'isIdentifier' => true,
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
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 119,
            'startFilePos' => 576,
            'endTokenPos' => 119,
            'endFilePos' => 579,
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
                'code' => '\'required|exists:expense_categories,id\'',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 106,
                  'startFilePos' => 495,
                  'endTokenPos' => 106,
                  'endFilePos' => 533,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 24,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'payment_method' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'payment_method',
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
          'code' => '\'cash\'',
          'attributes' => 
          array (
            'startLine' => 28,
            'endLine' => 28,
            'startTokenPos' => 137,
            'startFilePos' => 660,
            'endTokenPos' => 137,
            'endFilePos' => 665,
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
                'code' => '\'required|in:cash,bank\'',
                'attributes' => 
                array (
                  'startLine' => 27,
                  'endLine' => 27,
                  'startTokenPos' => 125,
                  'startFilePos' => 598,
                  'endTokenPos' => 125,
                  'endFilePos' => 620,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 27,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'bank_id' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'bank_id',
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
                  'name' => 'int',
                  'isIdentifier' => true,
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
            'startLine' => 31,
            'endLine' => 31,
            'startTokenPos' => 156,
            'startFilePos' => 740,
            'endTokenPos' => 156,
            'endFilePos' => 743,
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
                'code' => '\'nullable|exists:banks,id\'',
                'attributes' => 
                array (
                  'startLine' => 30,
                  'endLine' => 30,
                  'startTokenPos' => 143,
                  'startFilePos' => 684,
                  'endTokenPos' => 143,
                  'endFilePos' => 709,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 30,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 32,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'vendor_id' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'vendor_id',
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
                  'name' => 'int',
                  'isIdentifier' => true,
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
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 175,
            'startFilePos' => 822,
            'endTokenPos' => 175,
            'endFilePos' => 825,
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
                'code' => '\'nullable|exists:vendors,id\'',
                'attributes' => 
                array (
                  'startLine' => 33,
                  'endLine' => 33,
                  'startTokenPos' => 162,
                  'startFilePos' => 762,
                  'endTokenPos' => 162,
                  'endFilePos' => 789,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 33,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'description',
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
            'startLine' => 37,
            'endLine' => 37,
            'startTokenPos' => 193,
            'startFilePos' => 906,
            'endTokenPos' => 193,
            'endFilePos' => 907,
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
                  'startLine' => 36,
                  'endLine' => 36,
                  'startTokenPos' => 181,
                  'startFilePos' => 844,
                  'endTokenPos' => 181,
                  'endFilePos' => 869,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 36,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'receiptPhoto' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'name' => 'receiptPhoto',
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
                  'name' => 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile',
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
            'startLine' => 40,
            'endLine' => 40,
            'startTokenPos' => 212,
            'startFilePos' => 1004,
            'endTokenPos' => 212,
            'endFilePos' => 1007,
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
                'code' => '\'nullable|image|max:5120\'',
                'attributes' => 
                array (
                  'startLine' => 39,
                  'endLine' => 39,
                  'startTokenPos' => 199,
                  'startFilePos' => 926,
                  'endTokenPos' => 199,
                  'endFilePos' => 950,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 39,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 55,
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
      'rules' => 
      array (
        'name' => 'rules',
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
        'docComment' => NULL,
        'startLine' => 42,
        'endLine' => 51,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'currentClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'aliasName' => NULL,
      ),
      'setExpense' => 
      array (
        'name' => 'setExpense',
        'parameters' => 
        array (
          'expense' => 
          array (
            'name' => 'expense',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Expense',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 32,
            'endColumn' => 47,
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
        'startLine' => 53,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'currentClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
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
        'startLine' => 69,
        'endLine' => 80,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'currentClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'aliasName' => NULL,
      ),
      'storePhotoFor' => 
      array (
        'name' => 'storePhotoFor',
        'parameters' => 
        array (
          'expense' => 
          array (
            'name' => 'expense',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Expense',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 82,
            'endLine' => 82,
            'startColumn' => 35,
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
        'startLine' => 82,
        'endLine' => 91,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'currentClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
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
        'startLine' => 93,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Forms',
        'declaringClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'implementingClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
        'currentClassName' => 'App\\Livewire\\Forms\\ExpenseForm',
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