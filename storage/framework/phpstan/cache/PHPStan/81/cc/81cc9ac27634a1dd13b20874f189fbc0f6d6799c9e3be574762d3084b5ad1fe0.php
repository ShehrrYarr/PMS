<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Services\DemoShopResetService.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Services\DemoShopResetService
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-4623538d4fbe5d0f1eb7219a96bf298453e57c58087f8368a9993e54ee6e29b3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Services\\DemoShopResetService',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Services/DemoShopResetService.php',
      ),
    ),
    'namespace' => 'App\\Services',
    'name' => 'App\\Services\\DemoShopResetService',
    'shortName' => 'DemoShopResetService',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Wipes every bit of business data (products, batches, sales, purchases,
 * vendors, customers, ledgers, expenses, ...) out of the shared public demo
 * shop and reseeds a clean baseline — the shop row itself, its role users,
 * and its theme/receipt settings are left untouched so the "See Demo" login
 * and branding keep working. Run on a schedule (routes/console.php) so
 * whatever a visitor does to the demo is only ever temporary.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 40,
    'endLine' => 95,
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
      'SHOP_SCOPED_MODELS' => 
      array (
        'declaringClassName' => 'App\\Services\\DemoShopResetService',
        'implementingClassName' => 'App\\Services\\DemoShopResetService',
        'name' => 'SHOP_SCOPED_MODELS',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\\App\\Models\\Payment::class, \\App\\Models\\SaleReturnItem::class, \\App\\Models\\PurchaseReturnItem::class, \\App\\Models\\SaleReturn::class, \\App\\Models\\PurchaseReturn::class, \\App\\Models\\SaleItem::class, \\App\\Models\\PurchaseItem::class, \\App\\Models\\Sale::class, \\App\\Models\\Purchase::class, \\App\\Models\\CustomerLedger::class, \\App\\Models\\VendorLedger::class, \\App\\Models\\Batch::class, \\App\\Models\\Expense::class, \\App\\Models\\Product::class, \\App\\Models\\Category::class, \\App\\Models\\Company::class, \\App\\Models\\Customer::class, \\App\\Models\\Vendor::class, \\App\\Models\\Bank::class, \\App\\Models\\Banner::class, \\App\\Models\\ExpenseCategory::class]',
          'attributes' => 
          array (
            'startLine' => 51,
            'endLine' => 73,
            'startTokenPos' => 153,
            'startFilePos' => 1673,
            'endTokenPos' => 260,
            'endFilePos' => 2230,
          ),
        ),
        'docComment' => '/**
 * Deletion order would normally have to walk every restrictOnDelete
 * foreign key backwards (payments -> items -> sales/purchases -> ...).
 * Disabling FK checks for the duration of these shop_id-scoped deletes
 * sidesteps that entirely without risking other shops\' data, since every
 * delete below is still filtered to this one shop_id.
 *
 * @var list<class-string<\\Illuminate\\Database\\Eloquent\\Model>>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 51,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'reset' => 
      array (
        'name' => 'reset',
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
        'startLine' => 75,
        'endLine' => 94,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\DemoShopResetService',
        'implementingClassName' => 'App\\Services\\DemoShopResetService',
        'currentClassName' => 'App\\Services\\DemoShopResetService',
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