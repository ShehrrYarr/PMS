<?php declare(strict_types = 1);

// odsl-C:\Users\shehr\OneDrive\Desktop\Personal Projects\PesticidesManagmentSystem\app\Services\DashboardReportService.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Services\DashboardReportService
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.26-656104793dc3ba4344e8a13d1af5b0f55adcf4a64e159484cbf3595228094476',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Services\\DashboardReportService',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/app/Services/DashboardReportService.php',
      ),
    ),
    'namespace' => 'App\\Services',
    'name' => 'App\\Services\\DashboardReportService',
    'shortName' => 'DashboardReportService',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Powers the dashboard\'s "Today\'s Report" widget. All money values are
 * bcmath-normalized strings (see rules.md §2), never floats.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 176,
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
      'todaysSummary' => 
      array (
        'name' => 'todaysSummary',
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
 * @return array{
 *     sales_total: string,
 *     returns_total: string,
 *     payment_ins_total: string,
 *     expenses_total: string,
 *     cash_total: string,
 *     bank_total: string,
 *     bank_breakdown: list<array{bank_id: int, name: string, amount: string}>,
 * }
 */',
        'startLine' => 34,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\DashboardReportService',
        'implementingClassName' => 'App\\Services\\DashboardReportService',
        'currentClassName' => 'App\\Services\\DashboardReportService',
        'aliasName' => NULL,
      ),
      'salesTrend' => 
      array (
        'name' => 'salesTrend',
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
                'startLine' => 90,
                'endLine' => 90,
                'startTokenPos' => 573,
                'startFilePos' => 3190,
                'endTokenPos' => 573,
                'endFilePos' => 3191,
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
            'startLine' => 90,
            'endLine' => 90,
            'startColumn' => 32,
            'endColumn' => 45,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Daily sales totals for the trailing $days days (oldest first), with
 * zero-filled entries for any day that had no sales.
 *
 * @return list<array{date: string, total: string}>
 */',
        'startLine' => 90,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\DashboardReportService',
        'implementingClassName' => 'App\\Services\\DashboardReportService',
        'currentClassName' => 'App\\Services\\DashboardReportService',
        'aliasName' => NULL,
      ),
      'cashVsBankBreakdown' => 
      array (
        'name' => 'cashVsBankBreakdown',
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
                'startLine' => 120,
                'endLine' => 120,
                'startTokenPos' => 773,
                'startFilePos' => 4106,
                'endTokenPos' => 773,
                'endFilePos' => 4107,
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
            'startLine' => 120,
            'endLine' => 120,
            'startColumn' => 41,
            'endColumn' => 54,
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
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Cash vs. per-bank totals for sale payments over the trailing $days days.
 *
 * @return array{cash: string, banks: list<array{name: string, amount: string}>}
 */',
        'startLine' => 120,
        'endLine' => 147,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\DashboardReportService',
        'implementingClassName' => 'App\\Services\\DashboardReportService',
        'currentClassName' => 'App\\Services\\DashboardReportService',
        'aliasName' => NULL,
      ),
      'topSellingProducts' => 
      array (
        'name' => 'topSellingProducts',
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
                'startLine' => 154,
                'endLine' => 154,
                'startTokenPos' => 1054,
                'startFilePos' => 5364,
                'endTokenPos' => 1054,
                'endFilePos' => 5365,
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
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 40,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'limit' => 
          array (
            'name' => 'limit',
            'default' => 
            array (
              'code' => '8',
              'attributes' => 
              array (
                'startLine' => 154,
                'endLine' => 154,
                'startTokenPos' => 1063,
                'startFilePos' => 5381,
                'endTokenPos' => 1063,
                'endFilePos' => 5381,
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
            'startLine' => 154,
            'endLine' => 154,
            'startColumn' => 56,
            'endColumn' => 69,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
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
 * Best-selling products by quantity sold over the trailing $days days.
 *
 * @return list<array{name: string, quantity: string}>
 */',
        'startLine' => 154,
        'endLine' => 170,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\DashboardReportService',
        'implementingClassName' => 'App\\Services\\DashboardReportService',
        'currentClassName' => 'App\\Services\\DashboardReportService',
        'aliasName' => NULL,
      ),
      'normalize' => 
      array (
        'name' => 'normalize',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
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
            'startLine' => 172,
            'endLine' => 172,
            'startColumn' => 32,
            'endColumn' => 44,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 172,
        'endLine' => 175,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\DashboardReportService',
        'implementingClassName' => 'App\\Services\\DashboardReportService',
        'currentClassName' => 'App\\Services\\DashboardReportService',
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