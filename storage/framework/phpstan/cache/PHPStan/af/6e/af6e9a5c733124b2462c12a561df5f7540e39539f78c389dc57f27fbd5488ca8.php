<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Livewire\Admin\BannerManager.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Livewire\Admin\BannerManager
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-ad26c083e49c56737e2f8b1d10eb3abc5a49b5e07cc10804211e7d28a9883c36',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Livewire\\Admin\\BannerManager',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Livewire/Admin/BannerManager.php',
      ),
    ),
    'namespace' => 'App\\Livewire\\Admin',
    'name' => 'App\\Livewire\\Admin\\BannerManager',
    'shortName' => 'BannerManager',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
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
              'startLine' => 17,
              'endLine' => 17,
              'startTokenPos' => 63,
              'startFilePos' => 386,
              'endTokenPos' => 63,
              'endFilePos' => 398,
            ),
          ),
        ),
      ),
    ),
    'startLine' => 17,
    'endLine' => 75,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Livewire\\Component',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Livewire\\WithFileUploads',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'banner' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'name' => 'banner',
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
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 98,
            'startFilePos' => 555,
            'endTokenPos' => 98,
            'endFilePos' => 558,
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
                'code' => '\'nullable|image|max:2048\'',
                'attributes' => 
                array (
                  'startLine' => 22,
                  'endLine' => 22,
                  'startTokenPos' => 85,
                  'startFilePos' => 483,
                  'endTokenPos' => 85,
                  'endFilePos' => 507,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 22,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'intervalSeconds' => 
      array (
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'name' => 'intervalSeconds',
        'modifiers' => 1,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '5',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 26,
            'startTokenPos' => 116,
            'startFilePos' => 645,
            'endTokenPos' => 116,
            'endFilePos' => 645,
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
                'code' => '\'required|integer|min:2|max:60\'',
                'attributes' => 
                array (
                  'startLine' => 25,
                  'endLine' => 25,
                  'startTokenPos' => 104,
                  'startFilePos' => 577,
                  'endTokenPos' => 104,
                  'endFilePos' => 607,
                ),
              ),
            ),
          ),
        ),
        'startLine' => 25,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 36,
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
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Admin',
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'currentClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'aliasName' => NULL,
      ),
      'addBanner' => 
      array (
        'name' => 'addBanner',
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
        'startLine' => 35,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Admin',
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'currentClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'aliasName' => NULL,
      ),
      'delete' => 
      array (
        'name' => 'delete',
        'parameters' => 
        array (
          'bannerId' => 
          array (
            'name' => 'bannerId',
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
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 28,
            'endColumn' => 40,
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
        'startLine' => 48,
        'endLine' => 56,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Admin',
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'currentClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'aliasName' => NULL,
      ),
      'saveInterval' => 
      array (
        'name' => 'saveInterval',
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
        'startLine' => 58,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Admin',
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'currentClassName' => 'App\\Livewire\\Admin\\BannerManager',
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
        'startLine' => 69,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Livewire\\Admin',
        'declaringClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'implementingClassName' => 'App\\Livewire\\Admin\\BannerManager',
        'currentClassName' => 'App\\Livewire\\Admin\\BannerManager',
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