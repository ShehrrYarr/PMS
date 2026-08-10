<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Models\Concerns\BelongsToShop.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Concerns\BelongsToShop
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-3708db7209115b37a0288f18d258c5573a4b13da79c901154a241684cbed5a16',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\Concerns\\BelongsToShop',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Models/Concerns/BelongsToShop.php',
      ),
    ),
    'namespace' => 'App\\Models\\Concerns',
    'name' => 'App\\Models\\Concerns\\BelongsToShop',
    'shortName' => 'BelongsToShop',
    'isInterface' => false,
    'isTrait' => true,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Applied to every tenant-scoped model. Two effects:
 *
 * 1. A global scope that narrows every query to the logged-in shop user\'s
 *    own shop_id. Only ever applies when there IS a logged-in web-guard
 *    user with a shop_id — it\'s a deliberate no-op for artisan commands,
 *    seeders, and tests that aren\'t acting as a user, since those need to
 *    see/create rows across shops explicitly rather than have data silently
 *    hidden from them.
 * 2. Auto-fills shop_id on create from that same user, unless the caller
 *    already set it explicitly (e.g. ShopService seeding a brand-new shop\'s
 *    settings rows before that shop has any logged-in user at all).
 *
 * The query-builder side is the real security boundary here: table-qualify
 * the column so this doesn\'t break on any query that joins another
 * shop-scoped table (which would otherwise throw an ambiguous-column error).
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 88,
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
      'resolvingShopId' => 
      array (
        'declaringClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'implementingClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'name' => 'resolvingShopId',
        'modifiers' => 20,
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
            'startLine' => 42,
            'endLine' => 42,
            'startTokenPos' => 60,
            'startFilePos' => 1795,
            'endTokenPos' => 60,
            'endFilePos' => 1799,
          ),
        ),
        'docComment' => '/**
 * Guards against infinite recursion: resolving the session\'s user
 * (Auth::guard(\'web\')->user()) re-queries the User model, which carries
 * this very trait — so its own global scope would call back into
 * currentShopId() while the outer call is still resolving who the user
 * is. Real browser requests hit this on every session-based lookup;
 * Livewire::actingAs()/$this->actingAs() in tests inject the user
 * directly and never exercise this path, which is why it only surfaces
 * in live/manual verification, not the automated suite.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 49,
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
      'bootBelongsToShop' => 
      array (
        'name' => 'bootBelongsToShop',
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
        'startLine' => 44,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'App\\Models\\Concerns',
        'declaringClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'implementingClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'currentClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'aliasName' => NULL,
      ),
      'currentShopId' => 
      array (
        'name' => 'currentShopId',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
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
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 61,
        'endLine' => 87,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'App\\Models\\Concerns',
        'declaringClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'implementingClassName' => 'App\\Models\\Concerns\\BelongsToShop',
        'currentClassName' => 'App\\Models\\Concerns\\BelongsToShop',
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