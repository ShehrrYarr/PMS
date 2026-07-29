<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1785287522,
	'meta' => array (
  'cacheVersion' => 'v13-packageDependencies',
  'phpstanVersion' => '2.2.6',
  'fnsr' => false,
  'metaExtensions' => 
  array (
  ),
  'phpVersion' => 80226,
  'projectConfig' => '{conditionalTags: {Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule: {phpstan.rules.rule: %noEnvCallsOutsideOfConfig%}, Larastan\\Larastan\\Rules\\NoModelMakeRule: {phpstan.rules.rule: %noModelMake%}, Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule: {phpstan.rules.rule: %noUnnecessaryCollectionCall%}, Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule: {phpstan.rules.rule: %noUnnecessaryEnumerableToArrayCalls%}, Larastan\\Larastan\\Rules\\OctaneCompatibilityRule: {phpstan.rules.rule: %checkOctaneCompatibility%}, Larastan\\Larastan\\Rules\\UnusedViewsRule: {phpstan.rules.rule: %checkUnusedViews%}, Larastan\\Larastan\\Rules\\NoMissingTranslationsRule: {phpstan.rules.rule: %checkMissingTranslations%}, Larastan\\Larastan\\Rules\\ModelAppendsRule: {phpstan.rules.rule: %checkModelAppends%}, Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule: {phpstan.rules.rule: %checkModelMethodVisibility%}, Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %generalizeEnvReturnType%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension: {phpstan.broker.dynamicMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension: {phpstan.broker.dynamicStaticMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\Rules\\ConfigCollectionRule: {phpstan.rules.rule: %checkConfigTypes%}}, parameters: {universalObjectCratesClasses: [Illuminate\\Http\\Request, Illuminate\\Support\\Optional], earlyTerminatingFunctionCalls: [abort, dd], mixinExcludeClasses: [Eloquent], bootstrapFiles: [bootstrap.php], checkOctaneCompatibility: false, noEnvCallsOutsideOfConfig: true, noModelMake: true, noUnnecessaryCollectionCall: true, noUnnecessaryCollectionCallOnly: [], noUnnecessaryCollectionCallExcept: [], noUnnecessaryEnumerableToArrayCalls: false, squashedMigrationsPath: [], databaseMigrationsPath: [], disableMigrationScan: false, disableSchemaScan: false, configDirectories: [], viewDirectories: [], translationDirectories: [], checkModelProperties: false, checkUnusedViews: false, checkMissingTranslations: false, checkModelAppends: true, checkModelMethodVisibility: false, generalizeEnvReturnType: false, checkConfigTypes: false, checkAuthCallsWhenInRequestScope: false, parseModelCastsMethod: false, enableMigrationCache: false, paths: [C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app], level: 5, tmpDir: C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\storage\\framework\\phpstan}, rules: [Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessWithFunctionCallsRule, Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessValueFunctionCallsRule, Larastan\\Larastan\\Rules\\DeferrableServiceProviderMissingProvidesRule, Larastan\\Larastan\\Rules\\ConsoleCommand\\UndefinedArgumentOrOptionRule], services: {{class: Larastan\\Larastan\\Methods\\RelationForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\EloquentBuilderForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderTapProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderCollectionProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\StorageMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ContractsMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\FacadesMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ManagersMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\AuthsMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelFactoryMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\RedirectResponseMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\MacroMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ViewWithMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelAccessorExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\HigherOrderCollectionProxyPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\HigherOrderTapProxyExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\Properties\\ModelRelationsExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelOnlyDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelFactoryDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthManagerExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DateExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestFileExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestRouteExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestUserExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentBuilderExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RelationCollectionExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TestCaseExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Support\\CollectionHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AuthExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\CollectExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\NowAndTodayExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ResponseExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValidatorExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\LiteralExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionFilterRejectDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionWhereNotNullDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\NewModelQueryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\FactoryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: true}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: true}}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AppExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValueExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\StrExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\TapExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\StorageDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\GenericEloquentCollectionTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Types\\ViewStringTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Rules\\OctaneCompatibilityRule}, {class: Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule, arguments: {configDirectories: %configDirectories%}}, {class: Larastan\\Larastan\\Rules\\NoModelMakeRule}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule, arguments: {onlyMethods: %noUnnecessaryCollectionCallOnly%, excludeMethods: %noUnnecessaryCollectionCallExcept%}}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule}, {class: Larastan\\Larastan\\Rules\\ModelAppendsRule}, {class: Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule}, {class: Larastan\\Larastan\\Types\\GenericEloquentBuilderTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppFacadeEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\ModelProperty\\ModelPropertyTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension], arguments: {active: %checkModelProperties%}}, {class: Larastan\\Larastan\\Types\\CollectionOf\\CollectionOfTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Properties\\MigrationHelper, arguments: {databaseMigrationPath: %databaseMigrationsPath%, disableMigrationScan: %disableMigrationScan%, parser: @migrationsParser, reflectionProvider: @reflectionProvider}}, iamcalSqlParser: {class: Larastan\\Larastan\\SQL\\IamcalSqlParser, autowired: false}, sqlParserFactory: {class: Larastan\\Larastan\\SQL\\SqlParserFactory, arguments: {iamcalSqlParser: @iamcalSqlParser}}, sqlParser: {type: Larastan\\Larastan\\SQL\\SqlParser, factory: [@sqlParserFactory, create]}, {class: Larastan\\Larastan\\Properties\\SquashedMigrationHelper, arguments: {schemaPaths: %squashedMigrationsPath%, disableSchemaScan: %disableSchemaScan%}}, {class: Larastan\\Larastan\\Properties\\ModelCastHelper, arguments: {parser: @currentPhpVersionSimpleDirectParser, parseModelCastsMethod: %parseModelCastsMethod%}}, {class: Larastan\\Larastan\\Properties\\MigrationCache, arguments: {cacheDirectory: %tmpDir%, enabled: %enableMigrationCache%}}, {class: Larastan\\Larastan\\Properties\\ModelPropertyHelper}, {class: Larastan\\Larastan\\Rules\\ModelRuleHelper}, {class: Larastan\\Larastan\\Methods\\BuilderHelper, arguments: {checkProperties: %checkModelProperties%}}, {class: Larastan\\Larastan\\Rules\\RelationExistenceRule, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Bus\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Events\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Properties\\Schema\\MySqlDataTypeToPhpTypeConverter}, {class: Larastan\\Larastan\\LarastanStubFilesExtension, tags: [phpstan.stubFilesExtension]}, {class: Larastan\\Larastan\\Rules\\UnusedViewsRule}, {class: Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedEmailViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewFacadeMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedRouteFacadeViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewInAnotherViewCollector}, {class: Larastan\\Larastan\\Support\\ViewFileHelper, arguments: {viewDirectories: %viewDirectories%}}, {class: Larastan\\Larastan\\Support\\ViewParser, arguments: {parser: @currentPhpVersionSimpleDirectParser}}, {class: Larastan\\Larastan\\Rules\\NoMissingTranslationsRule, arguments: {translationDirectories: %translationDirectories%}}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationTranslatorCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFacadeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationViewCollector}, {class: Larastan\\Larastan\\ReturnTypes\\ApplicationMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\ArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\OptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasOptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TranslatorGetReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\LangGetReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TransHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DoubleUnderscoreHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeHelper}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationResolver}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationHelper}, {class: Larastan\\Larastan\\Support\\HigherOrderCollectionProxyHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension}, {class: Larastan\\Larastan\\Support\\ConfigParser, arguments: {parser: @currentPhpVersionSimpleDirectParser, configPaths: %configDirectories%, treatPhpDocTypesAsCertain: %treatPhpDocTypesAsCertain%}}, {class: Larastan\\Larastan\\Internal\\ConfigHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\FormRequestSafeDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentCollectionMapDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\ConfigCollectionRule}, {class: Illuminate\\Filesystem\\Filesystem, autowired: self}, migrationsParser: {class: PHPStan\\Parser\\CachedParser, arguments: {originalParser: @currentPhpVersionSimpleDirectParser, cachedNodesByStringCountMax: %cache.nodesByStringCountMax%}, autowired: false}}}',
  'analysedPaths' => 
  array (
    0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app',
  ),
  'scannedFiles' => 
  array (
  ),
  'composerLocks' => 
  array (
    'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/composer.lock' => '2cb06b0880514c149cb74915d36a31e12a851a4317698cbe903ca30b0adc6ca7',
  ),
  'composerInstalled' => 
  array (
    'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'brick/math' => 
        array (
          'pretty_version' => '0.14.8',
          'version' => '0.14.8.0',
          'reference' => '63422359a44b7f06cae63c3b429b59e8efcc0629',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../brick/math',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'carbonphp/carbon-doctrine-types' => 
        array (
          'pretty_version' => '3.2.0',
          'version' => '3.2.0.0',
          'reference' => '18ba5ddfec8976260ead6e866180bd5d2f71aa1d',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../carbonphp/carbon-doctrine-types',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'cordoval/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'davedevelopment/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'dflydev/dot-access-data' => 
        array (
          'pretty_version' => 'v3.0.3',
          'version' => '3.0.3.0',
          'reference' => 'a23a2bf4f31d3518f3ecb38660c95715dfead60f',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../dflydev/dot-access-data',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/inflector' => 
        array (
          'pretty_version' => '2.1.0',
          'version' => '2.1.0.0',
          'reference' => '6d6c96277ea252fc1304627204c3d5e6e15faa3b',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../doctrine/inflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/lexer' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => '31ad66abc0fc9e1a1f2d9bc6a42668d2fbbcd6dd',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../doctrine/lexer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dragonmantank/cron-expression' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => 'd61a8a9604ec1f8c3d150d09db6ce98b32675013',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../dragonmantank/cron-expression',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'egulias/email-validator' => 
        array (
          'pretty_version' => '4.0.4',
          'version' => '4.0.4.0',
          'reference' => 'd42c8731f0624ad6bdc8d3e5e9a4524f68801cfa',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../egulias/email-validator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'fakerphp/faker' => 
        array (
          'pretty_version' => 'v1.24.1',
          'version' => '1.24.1.0',
          'reference' => 'e0ee18eb1e6dc3cda3ce9fd97e5a0689a88a64b5',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../fakerphp/faker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'filp/whoops' => 
        array (
          'pretty_version' => '2.18.4',
          'version' => '2.18.4.0',
          'reference' => 'd2102955e48b9fd9ab24280a7ad12ed552752c4d',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../filp/whoops',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fruitcake/php-cors' => 
        array (
          'pretty_version' => 'v1.4.0',
          'version' => '1.4.0.0',
          'reference' => '38aaa6c3fd4c157ffe2a4d10aa8b9b16ba8de379',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../fruitcake/php-cors',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'graham-campbell/result-type' => 
        array (
          'pretty_version' => 'v1.1.4',
          'version' => '1.1.4.0',
          'reference' => 'e01f4a821471308ba86aa202fed6698b6b695e3b',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../graham-campbell/result-type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/guzzle' => 
        array (
          'pretty_version' => '7.15.2',
          'version' => '7.15.2.0',
          'reference' => '744101956d78b7c1384d0cbf379db13e859167bf',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../guzzlehttp/guzzle',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/promises' => 
        array (
          'pretty_version' => '2.5.1',
          'version' => '2.5.1.0',
          'reference' => '9ad1e4fc607446a055b95870c7f668e93b5cff29',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../guzzlehttp/promises',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/psr7' => 
        array (
          'pretty_version' => '2.13.0',
          'version' => '2.13.0.0',
          'reference' => 'dad89620b7a6edb60c15858442eb2e408b45d8f4',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../guzzlehttp/psr7',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/uri-template' => 
        array (
          'pretty_version' => 'v1.0.10',
          'version' => '1.0.10.0',
          'reference' => 'f6c24c21f42b990e9a58912b332d0874df6ba839',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../guzzlehttp/uri-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'hamcrest/hamcrest-php' => 
        array (
          'pretty_version' => 'v2.1.1',
          'version' => '2.1.1.0',
          'reference' => 'f8b1c0173b22fa6ec77a81fe63e5b01eba7e6487',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../hamcrest/hamcrest-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'iamcal/sql-parser' => 
        array (
          'pretty_version' => 'v0.7',
          'version' => '0.7.0.0',
          'reference' => '610392f38de49a44dab08dc1659960a29874c4b8',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../iamcal/sql-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'illuminate/auth' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/broadcasting' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/bus' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/cache' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/collections' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/concurrency' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/conditionable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/config' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/console' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/container' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/contracts' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/cookie' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/database' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/encryption' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/events' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/filesystem' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/hashing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/http' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/json-schema' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/log' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/macroable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/mail' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/notifications' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/pagination' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/pipeline' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/process' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/queue' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/redis' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/reflection' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/routing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/session' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/support' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/testing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/translation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/validation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/view' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'kodova/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'larastan/larastan' => 
        array (
          'pretty_version' => 'v3.10.0',
          'version' => '3.10.0.0',
          'reference' => '2970f83398154178a739609c244577267c7ee8eb',
          'type' => 'phpstan-extension',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../larastan/larastan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/breeze' => 
        array (
          'pretty_version' => 'v2.4.2',
          'version' => '2.4.2.0',
          'reference' => '4f20e7b2cc8d25daa85d8647241a89c8e0930305',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/breeze',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/framework' => 
        array (
          'pretty_version' => 'v12.64.0',
          'version' => '12.64.0.0',
          'reference' => '727a8ea2949c23ca8b5316b86a00984b6017b7a0',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/framework',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/pail' => 
        array (
          'pretty_version' => 'v1.2.7',
          'version' => '1.2.7.0',
          'reference' => '2f7d27dada8effc48b8c424445a69cca7007daaa',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/pail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/pint' => 
        array (
          'pretty_version' => 'v1.29.3',
          'version' => '1.29.3.0',
          'reference' => 'da1d1111a6aa2e082d2a388b194afe1ba0a05d14',
          'type' => 'project',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/pint',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/prompts' => 
        array (
          'pretty_version' => 'v0.3.21',
          'version' => '0.3.21.0',
          'reference' => '7753c65c281c2550c7c183f14e18062073b7d821',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/prompts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/sail' => 
        array (
          'pretty_version' => 'v1.64.0',
          'version' => '1.64.0.0',
          'reference' => '08cacd3e72d6798df3fa8bd4b5d55d0f7f920625',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/sail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/serializable-closure' => 
        array (
          'pretty_version' => 'v2.0.15',
          'version' => '2.0.15.0',
          'reference' => 'dccd8bcb851bb03fcc005df650b708b57cc52661',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/serializable-closure',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/tinker' => 
        array (
          'pretty_version' => 'v2.11.1',
          'version' => '2.11.1.0',
          'reference' => 'c9f80cc835649b5c1842898fb043f8cc098dd741',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../laravel/tinker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/commonmark' => 
        array (
          'pretty_version' => '2.8.3',
          'version' => '2.8.3.0',
          'reference' => '1902f60f984235023acbe03db6ad614a37b3c3e7',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/commonmark',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/config' => 
        array (
          'pretty_version' => 'v1.2.0',
          'version' => '1.2.0.0',
          'reference' => '754b3604fb2984c71f4af4a9cbe7b57f346ec1f3',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/config',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem' => 
        array (
          'pretty_version' => '3.35.2',
          'version' => '3.35.2.0',
          'reference' => 'b277b5dc3d56650b68904117124e79c851e12376',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/flysystem',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem-local' => 
        array (
          'pretty_version' => '3.31.0',
          'version' => '3.31.0.0',
          'reference' => '2f669db18a4c20c755c2bb7d3a7b0b2340488079',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/flysystem-local',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/mime-type-detection' => 
        array (
          'pretty_version' => '1.17.0',
          'version' => '1.17.0.0',
          'reference' => 'f5f47eff7c48ed1003069a2ca67f316fb4021c76',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/mime-type-detection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri' => 
        array (
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '08cf38e3924d4f56238125547b5720496fac8fd4',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/uri',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri-interfaces' => 
        array (
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '85d5c77c5d6d3af6c54db4a78246364908f3c928',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../league/uri-interfaces',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'livewire/livewire' => 
        array (
          'pretty_version' => 'v3.8.2',
          'version' => '3.8.2.0',
          'reference' => 'e77fce60d0615d68dc6b8fafe98a6739d9752a24',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../livewire/livewire',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'livewire/volt' => 
        array (
          'pretty_version' => 'v1.11.1',
          'version' => '1.11.1.0',
          'reference' => 'c921edbc4ff2c90e2ca1e87a9e7358e253e33b29',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../livewire/volt',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'milon/barcode' => 
        array (
          'pretty_version' => 'v13.1',
          'version' => '13.1.0.0',
          'reference' => 'ce84b0ba0d9c0f19f1ef058cd39187bd9468dfc8',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../milon/barcode',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mockery/mockery' => 
        array (
          'pretty_version' => '1.6.12',
          'version' => '1.6.12.0',
          'reference' => '1f4efdd7d3beafe9807b08156dfcb176d18f1699',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../mockery/mockery',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'monolog/monolog' => 
        array (
          'pretty_version' => '3.10.0',
          'version' => '3.10.0.0',
          'reference' => 'b321dd6749f0bf7189444158a3ce785cc16d69b0',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../monolog/monolog',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mtdowling/cron-expression' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '^1.0',
          ),
        ),
        'myclabs/deep-copy' => 
        array (
          'pretty_version' => '1.13.4',
          'version' => '1.13.4.0',
          'reference' => '07d290f0c47959fd5eed98c95ee5602db07e0b6a',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../myclabs/deep-copy',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nesbot/carbon' => 
        array (
          'pretty_version' => '3.13.1',
          'version' => '3.13.1.0',
          'reference' => '2937ad3d1d2c506fd2bc97d571438a95641f44e2',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../nesbot/carbon',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/schema' => 
        array (
          'pretty_version' => 'v1.3.5',
          'version' => '1.3.5.0',
          'reference' => 'f0ab1a3cda782dbc5da270d28545236aa80c4002',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../nette/schema',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/utils' => 
        array (
          'pretty_version' => 'v4.1.5',
          'version' => '4.1.5.0',
          'reference' => 'b043439dbdf954e6c28b5ea7e34b0100f83165e0',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../nette/utils',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nikic/php-parser' => 
        array (
          'pretty_version' => 'v5.8.0',
          'version' => '5.8.0.0',
          'reference' => '044a6a392ff8ad0d61f14370a5fbbd0a0107152f',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../nikic/php-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nunomaduro/collision' => 
        array (
          'pretty_version' => 'v8.9.5',
          'version' => '8.9.5.0',
          'reference' => 'fb53eacd509a1d303858e2d20cfebf2d630254ec',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../nunomaduro/collision',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nunomaduro/termwind' => 
        array (
          'pretty_version' => 'v2.4.0',
          'version' => '2.4.0.0',
          'reference' => '712a31b768f5daea284c2169a7d227031001b9a8',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../nunomaduro/termwind',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phar-io/manifest' => 
        array (
          'pretty_version' => '2.0.4',
          'version' => '2.0.4.0',
          'reference' => '54750ef60c58e43759730615a392c31c80e23176',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phar-io/manifest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phar-io/version' => 
        array (
          'pretty_version' => '3.2.1',
          'version' => '3.2.1.0',
          'reference' => '4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phar-io/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpoption/phpoption' => 
        array (
          'pretty_version' => '1.9.5',
          'version' => '1.9.5.0',
          'reference' => '75365b91986c2405cf5e1e012c5595cd487a98be',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpoption/phpoption',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpstan/phpstan' => 
        array (
          'pretty_version' => '2.2.6',
          'version' => '2.2.6.0',
          'reference' => 'a6e9b5a9420f6109c091e87d82683bd1a80b87ed',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpstan/phpstan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-code-coverage' => 
        array (
          'pretty_version' => '11.0.12',
          'version' => '11.0.12.0',
          'reference' => '2c1ed04922802c15e1de5d7447b4856de949cf56',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpunit/php-code-coverage',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-file-iterator' => 
        array (
          'pretty_version' => '5.1.1',
          'version' => '5.1.1.0',
          'reference' => '2f3a64888c814fc235386b7387dd5b5ed92ad903',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpunit/php-file-iterator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-invoker' => 
        array (
          'pretty_version' => '5.0.1',
          'version' => '5.0.1.0',
          'reference' => 'c1ca3814734c07492b3d4c5f794f4b0995333da2',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpunit/php-invoker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-text-template' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => '3e0404dc6b300e6bf56415467ebcb3fe4f33e964',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpunit/php-text-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-timer' => 
        array (
          'pretty_version' => '7.0.1',
          'version' => '7.0.1.0',
          'reference' => '3b415def83fbcb41f991d9ebf16ae4ad8b7837b3',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpunit/php-timer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/phpunit' => 
        array (
          'pretty_version' => '11.5.56',
          'version' => '11.5.56.0',
          'reference' => '5f83edffa6967c3db468d48a695ec7bcb02e9256',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../phpunit/phpunit',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'psr/clock' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'e41a24703d4560fd0acb709162f73b8adfc3aa0d',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/clock-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/container' => 
        array (
          'pretty_version' => '2.0.2',
          'version' => '2.0.2.0',
          'reference' => 'c71ecc56dfe541dbd90c5360474fbc405f8d5963',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/container',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/container-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.1|2.0',
          ),
        ),
        'psr/event-dispatcher' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-client' => 
        array (
          'pretty_version' => '1.0.3',
          'version' => '1.0.3.0',
          'reference' => 'bb5906edc1c324c9a05aa0873d40117941e5fa90',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/http-client',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-factory' => 
        array (
          'pretty_version' => '1.1.0',
          'version' => '1.1.0.0',
          'reference' => '2b4765fddfe3b508ac62f829e852b1501d3f6e8a',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/http-factory',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-factory-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-message' => 
        array (
          'pretty_version' => '2.0',
          'version' => '2.0.0.0',
          'reference' => '402d35bcb92c70c026d1a6a9883f06b2ead23d71',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/http-message',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-message-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/log' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => 'f16e1d5863e37f8d8c2a01719f5b34baa2b714d3',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/log',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/log-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
            1 => '3.0.0',
          ),
        ),
        'psr/simple-cache' => 
        array (
          'pretty_version' => '3.0.0',
          'version' => '3.0.0.0',
          'reference' => '764e0b3939f5ca87cb904f570ef9be2d78a07865',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psr/simple-cache',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/simple-cache-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
          ),
        ),
        'psy/psysh' => 
        array (
          'pretty_version' => 'v0.12.24',
          'version' => '0.12.24.0',
          'reference' => 'ca0fdcf8a7617afa3adfdf1b5fef573dffb69ca1',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../psy/psysh',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ralouphie/getallheaders' => 
        array (
          'pretty_version' => '3.0.3',
          'version' => '3.0.3.0',
          'reference' => '120b605dfeb996808c31b6477290a714d356e822',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../ralouphie/getallheaders',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/collection' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '344572933ad0181accbf4ba763e85a0306a8c5e2',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../ramsey/collection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/uuid' => 
        array (
          'pretty_version' => '4.9.3',
          'version' => '4.9.3.0',
          'reference' => '1df15849d00943a67d677dc9cfd80795f038c9f8',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../ramsey/uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'rhumsaa/uuid' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '4.9.3',
          ),
        ),
        'sebastian/cli-parser' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => '15c5dd40dc4f38794d383bb95465193f5e0ae180',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/cli-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/code-unit' => 
        array (
          'pretty_version' => '3.0.3',
          'version' => '3.0.3.0',
          'reference' => '54391c61e4af8078e5b276ab082b6d3c54c9ad64',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/code-unit',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/code-unit-reverse-lookup' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => '183a9b2632194febd219bb9246eee421dad8d45e',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/code-unit-reverse-lookup',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/comparator' => 
        array (
          'pretty_version' => '6.3.3',
          'version' => '6.3.3.0',
          'reference' => '2c95e1e86cb8dd41beb8d502057d1081ccc8eca9',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/comparator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/complexity' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => 'ee41d384ab1906c68852636b6de493846e13e5a0',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/complexity',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/diff' => 
        array (
          'pretty_version' => '6.0.2',
          'version' => '6.0.2.0',
          'reference' => 'b4ccd857127db5d41a5b676f24b51371d76d8544',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/diff',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/environment' => 
        array (
          'pretty_version' => '7.2.1',
          'version' => '7.2.1.0',
          'reference' => 'a5c75038693ad2e8d4b6c15ba2403532647830c4',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/environment',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/exporter' => 
        array (
          'pretty_version' => '6.3.2',
          'version' => '6.3.2.0',
          'reference' => '70a298763b40b213ec087c51c739efcaa90bcd74',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/exporter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/global-state' => 
        array (
          'pretty_version' => '7.0.2',
          'version' => '7.0.2.0',
          'reference' => '3be331570a721f9a4b5917f4209773de17f747d7',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/global-state',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/lines-of-code' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => 'd36ad0d782e5756913e42ad87cb2890f4ffe467a',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/lines-of-code',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-enumerator' => 
        array (
          'pretty_version' => '6.0.1',
          'version' => '6.0.1.0',
          'reference' => 'f5b498e631a74204185071eb41f33f38d64608aa',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/object-enumerator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-reflector' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => '6e1a43b411b2ad34146dee7524cb13a068bb35f9',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/object-reflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/recursion-context' => 
        array (
          'pretty_version' => '6.0.3',
          'version' => '6.0.3.0',
          'reference' => 'f6458abbf32a6c8174f8f26261475dc133b3d9dc',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/recursion-context',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/type' => 
        array (
          'pretty_version' => '5.1.3',
          'version' => '5.1.3.0',
          'reference' => 'f77d2d4e78738c98d9a68d2596fe5e8fa380f449',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/version' => 
        array (
          'pretty_version' => '5.0.2',
          'version' => '5.0.2.0',
          'reference' => 'c687e3387b99f5b03b6caa64c74b63e2936ff874',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../sebastian/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'spatie/laravel-permission' => 
        array (
          'pretty_version' => '6.25.0',
          'version' => '6.25.0.0',
          'reference' => 'd7d4cb0d58616722f1afc90e0484e4825155b9b3',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../spatie/laravel-permission',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'spatie/once' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'staabm/side-effects-detector' => 
        array (
          'pretty_version' => '1.0.5',
          'version' => '1.0.5.0',
          'reference' => 'd8334211a140ce329c13726d4a715adbddd0a163',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../staabm/side-effects-detector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'symfony/clock' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '674fa3b98e21531dd040e613479f5f6fa8f32111',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/console' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '92f58bc4bf97a92ed1b9f367f0cd44f20bde0e87',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/console',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/css-selector' => 
        array (
          'pretty_version' => 'v7.4.9',
          'version' => '7.4.9.0',
          'reference' => 'b75663ed96cf4756e28e3105476f220f92886cc4',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/css-selector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/deprecation-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'f3202fa1b5097b0af062dc978b32ecf63404e31d',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/deprecation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/error-handler' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '4e1a093b481f323e6e326451f9760c3868430673',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/error-handler',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '51fe3d170227be8d1772214b82ae506e15ed78ff',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'c7de7a00ffb67842132da02ea92988a39ccd9f4e',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/event-dispatcher-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.0|3.0',
          ),
        ),
        'symfony/finder' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '13b38720174286f55d1761152b575a8d1436fc25',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/finder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-foundation' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '06db5ae1552177bf8572f8908839f12e3c06aed3',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/http-foundation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-kernel' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'e99af79b1e776646eda0e1c23b7b45c184ff99be',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/http-kernel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mailer' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'f88ce03ae73e3edb5c176ce1f337709996e88495',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/mailer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mime' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => 'a845722765c4f6b2ce88beaf4f4479975b186770',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/mime',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-ctype' => 
        array (
          'pretty_version' => 'v1.37.0',
          'version' => '1.37.0.0',
          'reference' => '141046a8f9477948ff284fa65be2095baafb94f2',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-ctype',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-grapheme' => 
        array (
          'pretty_version' => 'v1.41.0',
          'version' => '1.41.0.0',
          'reference' => 'bb899c1db0aa8127dc3afe8cda4a67eb24915f8d',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-intl-grapheme',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-idn' => 
        array (
          'pretty_version' => 'v1.38.1',
          'version' => '1.38.1.0',
          'reference' => 'dc21118016c039a66235cf93d96b435ffb282412',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-intl-idn',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-normalizer' => 
        array (
          'pretty_version' => 'v1.38.0',
          'version' => '1.38.0.0',
          'reference' => '2d446c214bdbe5b71bde5011b060a05fece3ae6b',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-intl-normalizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-mbstring' => 
        array (
          'pretty_version' => 'v1.38.2',
          'version' => '1.38.2.0',
          'reference' => 'd3d318bad5e7a1bfbd026009c8bfb8d8f99ae6b6',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-mbstring',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php80' => 
        array (
          'pretty_version' => 'v1.37.0',
          'version' => '1.37.0.0',
          'reference' => 'dfb55726c3a76ea3b6459fcfda1ec2d80a682411',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-php80',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php83' => 
        array (
          'pretty_version' => 'v1.41.0',
          'version' => '1.41.0.0',
          'reference' => '5ea99087fb99c273a9b9236ed4c31e78b16103c6',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-php83',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php84' => 
        array (
          'pretty_version' => 'v1.38.1',
          'version' => '1.38.1.0',
          'reference' => 'f4e1dfaee5b74aba5964fe1fd4dfc7ba5e3085fa',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-php84',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php85' => 
        array (
          'pretty_version' => 'v1.41.0',
          'version' => '1.41.0.0',
          'reference' => '255fab485aaa1006ed411040c42aecd7b5302d7a',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-php85',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-uuid' => 
        array (
          'pretty_version' => 'v1.37.0',
          'version' => '1.37.0.0',
          'reference' => '26dfec253c4cf3e51b541b52ddf7e42cb0908e94',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/polyfill-uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/process' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => 'f5804be144caceb570f6747519999636b664f24c',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/process',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/routing' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => '3a162171bb008e5e0f15dce6581373a4c0e8390d',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/routing',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/service-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'c0a284bab1ed8aa0417e3d69250ab437739563a0',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/service-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/string' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => '961683010db3b27ec6ebcd7308e6e1ee8fa7ffde',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/string',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'a1af4dacb24eb7ef4f1ca71b94da8ddbce572281',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/translation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'ccb206b98faccc511ebae8e5fad50f2dc0b30621',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/translation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.3|3.0',
          ),
        ),
        'symfony/uid' => 
        array (
          'pretty_version' => 'v7.4.9',
          'version' => '7.4.9.0',
          'reference' => '2676b524340abcfe4d6151ec698463cebafee439',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/uid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/var-dumper' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '9a3a56a4a1e65a5cb4f8d13801fe8ab0a170e358',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/var-dumper',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/yaml' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'f8f328665ace2370d1e10645b807ba1646dc7dcc',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../symfony/yaml',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'theseer/tokenizer' => 
        array (
          'pretty_version' => '1.3.1',
          'version' => '1.3.1.0',
          'reference' => 'b7489ce515e168639d17feec34b8847c326b0b3c',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../theseer/tokenizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'tijsverkoyen/css-to-inline-styles' => 
        array (
          'pretty_version' => 'v2.4.0',
          'version' => '2.4.0.0',
          'reference' => 'f0292ccf0ec75843d65027214426b6b163b48b41',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../tijsverkoyen/css-to-inline-styles',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'vlucas/phpdotenv' => 
        array (
          'pretty_version' => 'v5.6.4',
          'version' => '5.6.4.0',
          'reference' => '416df702837983f8d5ff48c9c3fee4f5f57b980b',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../vlucas/phpdotenv',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'voku/portable-ascii' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '8e1051fe39379367aecf014f41744ce7539a856f',
          'type' => 'library',
          'install_path' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\composer/../voku/portable-ascii',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
      ),
    ),
  ),
  'executedFilesHashes' => 
  array (
    'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\larastan\\larastan\\bootstrap.php' => '5a3eacbf63b3e41659adfee92facededf8e020a932800f93c9a8b0e67f235805',
    'phar://C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\Attribute85.php' => 'cb8b31e82c61ce197871c9e8a6f122256751f2ab606dd2be90846d4fa5f8933e',
    'phar://C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionAttribute.php' => 'c0068e383717870a304781d462f7e2afe1c6f24e9133851852a2aca96b4fa26f',
    'phar://C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionIntersectionType.php' => '65fe0a8bc6fe285d8ddc8798ab5b9299920af70db5ad74596bc08df823e7c5d9',
    'phar://C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionUnionType.php' => '1e2fe940e4ba4e00d9ee6adb2af3ee1bf333e6f8afe61c61deb038886d293427',
  ),
  'phpExtensions' => 
  array (
    0 => 'Core',
    1 => 'PDO',
    2 => 'Phar',
    3 => 'Reflection',
    4 => 'SPL',
    5 => 'SimpleXML',
    6 => 'Zend OPcache',
    7 => 'bcmath',
    8 => 'calendar',
    9 => 'com_dotnet',
    10 => 'ctype',
    11 => 'curl',
    12 => 'date',
    13 => 'dom',
    14 => 'exif',
    15 => 'fileinfo',
    16 => 'filter',
    17 => 'gd',
    18 => 'gettext',
    19 => 'gmp',
    20 => 'hash',
    21 => 'iconv',
    22 => 'imap',
    23 => 'intl',
    24 => 'json',
    25 => 'ldap',
    26 => 'libxml',
    27 => 'mbstring',
    28 => 'mysqli',
    29 => 'mysqlnd',
    30 => 'openssl',
    31 => 'pcre',
    32 => 'pdo_mysql',
    33 => 'pdo_sqlite',
    34 => 'random',
    35 => 'readline',
    36 => 'session',
    37 => 'soap',
    38 => 'sockets',
    39 => 'sqlite3',
    40 => 'standard',
    41 => 'tokenizer',
    42 => 'xml',
    43 => 'xmlreader',
    44 => 'xmlwriter',
    45 => 'xsl',
    46 => 'zip',
    47 => 'zlib',
  ),
  'stubFiles' => 
  array (
  ),
  'level' => '5',
),
	'projectExtensionFiles' => array (
),
	'errorsCallback' => static function (): array { return array (
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Cannot call method toDateString() on string.',
       'file' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php',
       'line' => 42,
       'canBeIgnored' => true,
       'filePath' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 42,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'method.nonObject',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Cannot call method toDateString() on string.',
       'file' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php',
       'line' => 43,
       'canBeIgnored' => true,
       'filePath' => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 43,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'method.nonObject',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
); },
	'locallyIgnoredErrorsCallback' => static function (): array { return array (
); },
	'linesToIgnore' => array (
),
	'unmatchedLineIgnores' => array (
),
	'collectedDataCallback' => static function (): array { return array (
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\BatchExpiringSoon',
        1 => 'dispatch',
        2 => 32,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Events\\BatchExpiringSoon.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\BatchExpiringSoon',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Foundation\\Events\\Dispatchable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InsufficientStockException.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Exceptions\\InsufficientStockException',
        1 => 'forBatch',
        2 => 'App\\Exceptions\\InsufficientStockException',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InvalidReturnQuantityException.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Exceptions\\InvalidReturnQuantityException',
        1 => 'exceedsReturnable',
        2 => 'App\\Exceptions\\InvalidReturnQuantityException',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\UnbalancedPaymentSplitException.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Exceptions\\UnbalancedPaymentSplitException',
        1 => 'forMismatch',
        2 => 'App\\Exceptions\\UnbalancedPaymentSplitException',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Auth\\VerifyEmailController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'event',
        1 => 22,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Actions\\Logout.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\Session',
        1 => 'invalidate',
        2 => 17,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\BankAccountManager.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.admin.bank-account-manager',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\DeveloperTools.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'settings.dev_migrate',
        1 => 42,
      ),
      1 => 
      array (
        0 => 'settings.dev_migrate',
        1 => 44,
      ),
      2 => 
      array (
        0 => 'settings.dev_optimize',
        1 => 54,
      ),
      3 => 
      array (
        0 => 'settings.dev_optimize',
        1 => 56,
      ),
      4 => 
      array (
        0 => 'settings.dev_config_cache',
        1 => 66,
      ),
      5 => 
      array (
        0 => 'settings.dev_config_cache',
        1 => 68,
      ),
      6 => 
      array (
        0 => 'settings.dev_git_pull',
        1 => 77,
      ),
      7 => 
      array (
        0 => 'settings.dev_git_not_a_repo',
        1 => 77,
      ),
      8 => 
      array (
        0 => 'settings.dev_git_pull',
        1 => 85,
      ),
      9 => 
      array (
        0 => 'settings.dev_no_output',
        1 => 92,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.admin.developer-tools',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Admin\\DeveloperTools',
        1 => 'render',
        2 => 'App\\Livewire\\Admin\\DeveloperTools',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\SettingsPage.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'settings.saved',
        1 => 129,
      ),
      1 => 
      array (
        0 => 'settings.saved',
        1 => 150,
      ),
      2 => 
      array (
        0 => 'settings.saved',
        1 => 193,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.admin.settings-page',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Admin\\SettingsPage',
        1 => 'render',
        2 => 'App\\Livewire\\Admin\\SettingsPage',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'ledger.bank_required',
        1 => 68,
      ),
      1 => 
      array (
        0 => 'ledger.payment_received',
        1 => 89,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.customers.customer-ledger',
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Connection',
        1 => 'transaction',
        2 => 73,
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'customer',
        3 => 84,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'type',
        3 => 85,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'amount',
        3 => 86,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceType',
        3 => 87,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceId',
        3 => 88,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'description',
        3 => 89,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'user',
        3 => 90,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.customers.customer-list',
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Connection',
        1 => 'transaction',
        2 => 57,
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'customer',
        3 => 66,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'type',
        3 => 67,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'amount',
        3 => 68,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceType',
        3 => 69,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceId',
        3 => 70,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'description',
        3 => 71,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'user',
        3 => 72,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Forms\\BatchForm',
        1 => 'rules',
        2 => 'App\\Livewire\\Forms\\BatchForm',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Livewire\\Forms\\BatchForm',
        1 => 'attributesForCreate',
        2 => 'App\\Livewire\\Forms\\BatchForm',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Livewire\\Forms\\BatchForm',
        1 => 'attributesForUpdate',
        2 => 'App\\Livewire\\Forms\\BatchForm',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\CustomerForm.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Forms\\CustomerForm',
        1 => 'attributesForSave',
        2 => 'App\\Livewire\\Forms\\CustomerForm',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\LoginForm.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'auth.failed',
        1 => 37,
      ),
      1 => 
      array (
        0 => 'auth.throttle',
        1 => 58,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'event',
        1 => 53,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\RateLimiter',
        1 => 'hit',
        2 => 34,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\ProductForm.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Forms\\ProductForm',
        1 => 'attributesForSave',
        2 => 'App\\Livewire\\Forms\\ProductForm',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\VendorForm.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Forms\\VendorForm',
        1 => 'attributesForSave',
        2 => 'App\\Livewire\\Forms\\VendorForm',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.inventory.batch-list',
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\CategoryManager.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.inventory.category-manager',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ExpiryAlertsDashboard.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.inventory.expiry-alerts-dashboard',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.inventory.product-list',
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'pos.barcode_not_found',
        1 => 63,
      ),
      1 => 
      array (
        0 => 'pos.out_of_stock',
        1 => 69,
      ),
      2 => 
      array (
        0 => 'pos.out_of_stock',
        1 => 80,
      ),
      3 => 
      array (
        0 => 'ledger.bank_required',
        1 => 200,
      ),
      4 => 
      array (
        0 => 'pos.customer_required_for_ledger',
        1 => 206,
      ),
      5 => 
      array (
        0 => 'pos.sale_completed',
        1 => 241,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.pos.pos',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Pos\\Pos',
        1 => 'getCartTotalProperty',
        2 => 'App\\Livewire\\Pos\\Pos',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\SaleService',
        1 => 'create',
        2 => 'customer',
        3 => 222,
      ),
      1 => 
      array (
        0 => 'App\\Services\\SaleService',
        1 => 'create',
        2 => 'items',
        3 => 223,
      ),
      2 => 
      array (
        0 => 'App\\Services\\SaleService',
        1 => 'create',
        2 => 'paymentLines',
        3 => 224,
      ),
      3 => 
      array (
        0 => 'App\\Services\\SaleService',
        1 => 'create',
        2 => 'user',
        3 => 225,
      ),
      4 => 
      array (
        0 => 'App\\Services\\SaleService',
        1 => 'create',
        2 => 'photo',
        3 => 226,
      ),
      5 => 
      array (
        0 => 'Livewire\\Component',
        1 => 'dispatch',
        2 => 'params',
        3 => 240,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithFileUploads',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleList.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.pos.sale-list',
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'purchases.return_recorded',
        1 => 68,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.pos.sale-show',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Pos\\SaleShow',
        1 => 'render',
        2 => 'App\\Livewire\\Pos\\SaleShow',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\SaleReturnService',
        1 => 'create',
        2 => 'sale',
        3 => 55,
      ),
      1 => 
      array (
        0 => 'App\\Services\\SaleReturnService',
        1 => 'create',
        2 => 'lines',
        3 => 56,
      ),
      2 => 
      array (
        0 => 'App\\Services\\SaleReturnService',
        1 => 'create',
        2 => 'reason',
        3 => 57,
      ),
      3 => 
      array (
        0 => 'App\\Services\\SaleReturnService',
        1 => 'create',
        2 => 'user',
        3 => 58,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'ledger.bank_required',
        1 => 106,
      ),
      1 => 
      array (
        0 => 'purchases.created',
        1 => 127,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.purchases.purchase-create',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Purchases\\PurchaseCreate',
        1 => 'getTotalProperty',
        2 => 'App\\Livewire\\Purchases\\PurchaseCreate',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Livewire\\Purchases\\PurchaseCreate',
        1 => 'rules',
        2 => 'App\\Livewire\\Purchases\\PurchaseCreate',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\PurchaseService',
        1 => 'create',
        2 => 'vendor',
        3 => 116,
      ),
      1 => 
      array (
        0 => 'App\\Services\\PurchaseService',
        1 => 'create',
        2 => 'items',
        3 => 117,
      ),
      2 => 
      array (
        0 => 'App\\Services\\PurchaseService',
        1 => 'create',
        2 => 'paymentLines',
        3 => 118,
      ),
      3 => 
      array (
        0 => 'App\\Services\\PurchaseService',
        1 => 'create',
        2 => 'user',
        3 => 119,
      ),
      4 => 
      array (
        0 => 'Livewire\\Component',
        1 => 'redirect',
        2 => 'navigate',
        3 => 129,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseList.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.purchases.purchase-list',
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'purchases.return_recorded',
        1 => 68,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.purchases.purchase-show',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Livewire\\Purchases\\PurchaseShow',
        1 => 'render',
        2 => 'App\\Livewire\\Purchases\\PurchaseShow',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\PurchaseReturnService',
        1 => 'create',
        2 => 'purchase',
        3 => 55,
      ),
      1 => 
      array (
        0 => 'App\\Services\\PurchaseReturnService',
        1 => 'create',
        2 => 'lines',
        3 => 56,
      ),
      2 => 
      array (
        0 => 'App\\Services\\PurchaseReturnService',
        1 => 'create',
        2 => 'reason',
        3 => 57,
      ),
      3 => 
      array (
        0 => 'App\\Services\\PurchaseReturnService',
        1 => 'create',
        2 => 'user',
        3 => 58,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Shared\\LanguageSwitcher.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.shared.language-switcher',
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'session',
        1 => 24,
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\Component',
        1 => 'redirect',
        2 => 'navigate',
        3 => 26,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'ledger.bank_required',
        1 => 67,
      ),
      1 => 
      array (
        0 => 'ledger.payment_made',
        1 => 88,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.vendors.vendor-ledger',
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Connection',
        1 => 'transaction',
        2 => 72,
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'vendor',
        3 => 83,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'type',
        3 => 84,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'amount',
        3 => 85,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceType',
        3 => 86,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceId',
        3 => 87,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'description',
        3 => 88,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'user',
        3 => 89,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'livewire.vendors.vendor-list',
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Connection',
        1 => 'transaction',
        2 => 57,
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'vendor',
        3 => 66,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'type',
        3 => 67,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'amount',
        3 => 68,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceType',
        3 => 69,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceId',
        3 => 70,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'description',
        3 => 71,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'user',
        3 => 72,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Bank.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Bank',
        1 => 'casts',
        2 => 'App\\Models\\Bank',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Batch.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Batch',
        1 => 'casts',
        2 => 'App\\Models\\Batch',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Category.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Category',
        1 => 'casts',
        2 => 'App\\Models\\Category',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Customer.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Customer',
        1 => 'casts',
        2 => 'App\\Models\\Customer',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\CustomerLedger.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\CustomerLedger',
        1 => 'casts',
        2 => 'App\\Models\\CustomerLedger',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Payment',
        1 => 'casts',
        2 => 'App\\Models\\Payment',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Product.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Product',
        1 => 'casts',
        2 => 'App\\Models\\Product',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Purchase',
        1 => 'casts',
        2 => 'App\\Models\\Purchase',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\PurchaseItem',
        1 => 'casts',
        2 => 'App\\Models\\PurchaseItem',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Models\\PurchaseItem',
        1 => 'returnableQuantity',
        2 => 'App\\Models\\PurchaseItem',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\PurchaseReturn',
        1 => 'casts',
        2 => 'App\\Models\\PurchaseReturn',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\PurchaseReturnItem',
        1 => 'casts',
        2 => 'App\\Models\\PurchaseReturnItem',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ReceiptSetting.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ReceiptSetting',
        1 => 'casts',
        2 => 'App\\Models\\ReceiptSetting',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Sale',
        1 => 'casts',
        2 => 'App\\Models\\Sale',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleItem.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\SaleItem',
        1 => 'casts',
        2 => 'App\\Models\\SaleItem',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Models\\SaleItem',
        1 => 'returnableQuantity',
        2 => 'App\\Models\\SaleItem',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\SaleReturn',
        1 => 'casts',
        2 => 'App\\Models\\SaleReturn',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\SaleReturnItem',
        1 => 'casts',
        2 => 'App\\Models\\SaleReturnItem',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ThemeSetting.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'nav.app_name',
        1 => 37,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ThemeSetting',
        1 => 'displayName',
        2 => 'App\\Models\\ThemeSetting',
        3 => 
        array (
          0 => 'f' . "\0" . '__',
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\User.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'casts',
        2 => 'App\\Models\\User',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Spatie\\Permission\\Traits\\HasRoles',
        2 => 'Illuminate\\Notifications\\Notifiable',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Vendor.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Vendor',
        1 => 'casts',
        2 => 'App\\Models\\Vendor',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\VendorLedger.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\VendorLedger',
        1 => 'casts',
        2 => 'App\\Models\\VendorLedger',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Observers\\BatchObserver.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\BatchExpiringSoon',
        1 => 'dispatch',
        2 => 22,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\BarcodeService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\BarcodeService',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\PurchaseReturnService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'vendor',
        3 => 81,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'type',
        3 => 82,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'amount',
        3 => 83,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceType',
        3 => 84,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceId',
        3 => 85,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'description',
        3 => 86,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'user',
        3 => 87,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\PurchaseService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'vendor',
        3 => 101,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'type',
        3 => 102,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'amount',
        3 => 103,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceType',
        3 => 104,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'referenceId',
        3 => 105,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'description',
        3 => 106,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postVendorEntry',
        2 => 'user',
        3 => 107,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'receipts.thermal-receipt',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\SaleReturnService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'customer',
        3 => 79,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'type',
        3 => 80,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'amount',
        3 => 81,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceType',
        3 => 82,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceId',
        3 => 83,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'description',
        3 => 84,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'user',
        3 => 85,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\SaleService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\NamedArgumentParameterMethodCallsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'customer',
        3 => 104,
      ),
      1 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'type',
        3 => 105,
      ),
      2 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'amount',
        3 => 106,
      ),
      3 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceType',
        3 => 107,
      ),
      4 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'referenceId',
        3 => 108,
      ),
      5 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'description',
        3 => 109,
      ),
      6 => 
      array (
        0 => 'App\\Services\\LedgerService',
        1 => 'postCustomerEntry',
        2 => 'user',
        3 => 110,
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\AppLayout.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'layouts.app',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\View\\Components\\AppLayout',
        1 => 'render',
        2 => 'App\\View\\Components\\AppLayout',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\GuestLayout.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'layouts.guest',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\View\\Components\\GuestLayout',
        1 => 'render',
        2 => 'App\\View\\Components\\GuestLayout',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
  ),
); },
	'dependencies' => array (
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php' => 
  array (
    'fileHash' => '41a58a124ab1fee66014ac111280b6b6400b3e9129834acbf2dbb3c395640903',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\LedgerEntryType.php' => 
  array (
    'fileHash' => 'b8c8a7497c7609f822db75a7f5db4bd45869e6ea25b2dc2342e9addef5556714',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\PayableType.php' => 
  array (
    'fileHash' => 'd02e09a694d42c3a31b071304c22cec53d77d757404b05a51a954436dc3c480d',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\PaymentMethod.php' => 
  array (
    'fileHash' => 'f66588872532f87060bd37ba4844908be19a398d43556c5076dbeb1f465d9234',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\TransactionReferenceType.php' => 
  array (
    'fileHash' => '4364c1bc6f84651b7e7514fa91bcea3f37842b70681c22c10f8313ef64cee913',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\UserRole.php' => 
  array (
    'fileHash' => 'a20d432a09e03d5a055c74acf6c8720a4bdeb0874f4d6c292c4712dd3d3564b8',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Events\\BatchExpiringSoon.php' => 
  array (
    'fileHash' => '98f4e3c42bc16e9d0ee693cacadcfb573ed67b9e77408a93194b0345a0bf152a',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Observers\\BatchObserver.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InsufficientStockException.php' => 
  array (
    'fileHash' => '64a2a402d77950c650169f8e67cc2279a02be413fc4b485487fa7e50591d5f37',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InvalidReturnQuantityException.php' => 
  array (
    'fileHash' => '42bb9c4b9b1373d4491a7738506c34014277fcf0e4f5b6d03a25f93c05285d0b',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\UnbalancedPaymentSplitException.php' => 
  array (
    'fileHash' => 'dba714d2547b3e570d4e4c7bcaeef6776c2d0daa89918d7ac6d91329141b4d02',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PaymentSplitService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Auth\\VerifyEmailController.php' => 
  array (
    'fileHash' => '5f6080a239709740135d9138085ceb1857c5570a0fea35e62c976fc90929631e',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Controller.php' => 
  array (
    'fileHash' => '25d1c1ef8e6cc8a376553faacfba2b07d9dfaee9bdbb84f14f77517580e9deb1',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Auth\\VerifyEmailController.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Middleware\\SetLocale.php' => 
  array (
    'fileHash' => 'ca19272baf211a3cf866eebb7b82ca457e95ce666db20253f9e724e83771e2a8',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Actions\\Logout.php' => 
  array (
    'fileHash' => '532ca69887d29fca08357614fa08f7d95c37edd701520657960836c541bb2e9d',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\BankAccountManager.php' => 
  array (
    'fileHash' => '10185b246a7e19d769f14dd4d6c31c928e74d4343d021a03bb56d1e81d3c70e4',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\DeveloperTools.php' => 
  array (
    'fileHash' => '5107446e1c27db2cd00de15d0f025d62232942d9e99b893c1d42014c08a7152f',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\SettingsPage.php' => 
  array (
    'fileHash' => 'fe652f83009c475a303db595c9f05fb1cf65d4d3f9a15bb1c687f0f97b739c41',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php' => 
  array (
    'fileHash' => 'eea485f9447233cf4e9a94196d755dac7ee763490fac9a7bc9481bdc785dea75',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php' => 
  array (
    'fileHash' => 'ec04dcd30ecf666afd16f106a026b62aa82b1c97313cd0f6ac7fb24d53cbf07e',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php' => 
  array (
    'fileHash' => 'a6b9009f95761a4a22a8324e87ec7666896f9b27ea3e0ec1c2742d1cba1e948b',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\CustomerForm.php' => 
  array (
    'fileHash' => '0dd8c772181094266cb86a72192026425b00f842d82d4b3ce2b71e9ba6d61b60',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\LoginForm.php' => 
  array (
    'fileHash' => 'ee0f249f099995a399a40e8ed86ec12dad1a39085ab199462a67a47b36476663',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\ProductForm.php' => 
  array (
    'fileHash' => '4042a73f84d218032ef131ef3861fa1c26ff81346446268e7fbc41f9f7f5b393',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\VendorForm.php' => 
  array (
    'fileHash' => '7a8a104205b7253eaa83540805641f2fb21ea1b0a3fc9ad3f00bf7f659c3ff9b',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php' => 
  array (
    'fileHash' => 'e0189d125ec638803edeb1279b73f97689cb9e950fa3be8b1bd12b7b7ef837af',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\CategoryManager.php' => 
  array (
    'fileHash' => '57683245d77f272391444608c2702358fd291f6dcf652d4febfa107289de36a3',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ExpiryAlertsDashboard.php' => 
  array (
    'fileHash' => 'fc6a0c665b6d9c739d92e2282b6ca399481f6956e75cd58a9d78a3d0dd545bc0',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php' => 
  array (
    'fileHash' => '7276eff03851f2dfd843aac47edc58cfb5002239647823d2d355621d37b0176a',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php' => 
  array (
    'fileHash' => '34db9954afd7a62321bfa65654fa0f3a9a2b6fafa903975271bfe31d114ada2e',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleList.php' => 
  array (
    'fileHash' => '44be311dfd1ce3e0b60c4c86e22eb16e143ed0a6fd825bc07816137c199136d5',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php' => 
  array (
    'fileHash' => '4f385fd9e892f6d1934a8fa4773b793be69c5573bcb2959522b40b62a2bc39ef',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php' => 
  array (
    'fileHash' => 'ea02093acdaf21e9f4f499fe21eb8ea5b0491a47b519d64d5a4d239480a59bf9',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseList.php' => 
  array (
    'fileHash' => 'f34e9ecdac1b07387831d3f2b329c469bb4f3a1caa21d3aca5e1bd283ac7e425',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php' => 
  array (
    'fileHash' => '0bd5c974d27bee6b6643e827d5da9b48d706302e1f51b1844d710c512e951ada',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Shared\\LanguageSwitcher.php' => 
  array (
    'fileHash' => '4bd46c18085d02e572f476d8b3327004dc23aca9a295831524b492af59a61d2c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php' => 
  array (
    'fileHash' => '07768ec26da3090010fede90e529108bcb88c06677704e4c710e9d4a9c39930f',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php' => 
  array (
    'fileHash' => '37d4b8670a8c494a31b5dc69ce097af69ca7c24261173c6ffdcef55e5d92c0be',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Bank.php' => 
  array (
    'fileHash' => 'c46dc4e14793f9fb02a01320d86157dd131ee4e3e86848cd1a2551e1a10cc799',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\BankAccountManager.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Batch.php' => 
  array (
    'fileHash' => '4700e942629920eaa8ca4481dc87073964e5ceb9cdd9929740f210611f7c0f38',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Events\\BatchExpiringSoon.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ExpiryAlertsDashboard.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Product.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php',
      9 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleItem.php',
      10 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php',
      11 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Observers\\BatchObserver.php',
      12 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\AppServiceProvider.php',
      13 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\BarcodeService.php',
      14 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ExpiryAlertService.php',
      15 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      16 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      17 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      18 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Category.php' => 
  array (
    'fileHash' => '56a5370e69560f41af3250741faa57ff53fd2ede25c41d3784dc7ad173e0ae85',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\CategoryManager.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Product.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Customer.php' => 
  array (
    'fileHash' => 'ffa747fe6ee1bd449b80d9905af0bc9b07eaf9216fd4643f187b73560f70ef9f',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\CustomerForm.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\CustomerLedger.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\CustomerPolicy.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      9 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      10 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\CustomerLedger.php' => 
  array (
    'fileHash' => '9c61af823a1455b16a51827779e626cdaf697a7ef1fbf2e9899abd1051374128',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Customer.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php' => 
  array (
    'fileHash' => '7cc5d69859cc53257624b4dc484d89e2e4aacbe4bf8236e97219f8e5619a5cee',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Product.php' => 
  array (
    'fileHash' => '244bab63260e3de25e9efb0182a81c05ac4e61d986643be106f713d65f574aff',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\ProductForm.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Batch.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Category.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php' => 
  array (
    'fileHash' => 'e9885382f145bba91ea679f4875a6ebae593f78b4567e2df2554dfc6bd163712',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\PurchasePolicy.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php' => 
  array (
    'fileHash' => 'b9afd26c3a6be10feb2a1df01bea3ab5fd38901585c945d61f50769676981652',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Batch.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php' => 
  array (
    'fileHash' => '77a1b1348bea8521a70584d8d34984fcc52725f55e2e0e6adac8d2dce96b268b',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php' => 
  array (
    'fileHash' => 'ce49c5e09c403cf3d97c1c6ad41fa3e5bf2bbe75a6ceae742c1d2c2fbe63a2db',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ReceiptSetting.php' => 
  array (
    'fileHash' => '0f9da687b7c3c7955d56c64af95a4657c80ac835848e3a6b6c2ef47b3c572010',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\SettingsPage.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php' => 
  array (
    'fileHash' => 'e72a101eabf8b29c045d9687243033ff046643b9fe353237a3d78c583c6629a8',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleItem.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\SalePolicy.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleItem.php' => 
  array (
    'fileHash' => 'd2e61234fe9cc36e2e896e2d295f6e5bf2f60d564f2bb630c9a496a8f0292749',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php' => 
  array (
    'fileHash' => '3b15420d5193757cbc12aa46852873987bd5092ca6157bbe834db50b26232cdc',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php' => 
  array (
    'fileHash' => 'a697af289d133e4becd85e1be7c38386bfa6f4bc3c8808779a984070bef2e740',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ThemeSetting.php' => 
  array (
    'fileHash' => 'd6c2197f4e34501874675aa4cc86abef1636f4afbd3210b449dfbb3b1872c716',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Middleware\\SetLocale.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\SettingsPage.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\User.php' => 
  array (
    'fileHash' => '9ca319a73f3746671252922b9cbd0d31fb35e0a1362a0c4861e85ec5939880fe',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Auth\\VerifyEmailController.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\DeveloperTools.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      9 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
      10 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\CustomerLedger.php',
      11 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php',
      12 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php',
      13 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php',
      14 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php',
      15 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php',
      16 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\VendorLedger.php',
      17 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\CustomerPolicy.php',
      18 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\PurchasePolicy.php',
      19 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\SalePolicy.php',
      20 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\VendorPolicy.php',
      21 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      22 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      23 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      24 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      25 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Vendor.php' => 
  array (
    'fileHash' => '7d6205adceb4ac6934547f302ead6a38034c729403f872e40c51c4a5d759d9ab',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\VendorForm.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\VendorLedger.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\VendorPolicy.php',
      8 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      9 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      10 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\VendorLedger.php' => 
  array (
    'fileHash' => '089113385745d107fc6bfc74de464f59cca14872badb05a71c72b980766f44ba',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Vendor.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Observers\\BatchObserver.php' => 
  array (
    'fileHash' => '7229d36dd8ea42dd9e9d24abb21966f2c3b2b3b9b028ba3461b8de1ed8dc292c',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\AppServiceProvider.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\CustomerPolicy.php' => 
  array (
    'fileHash' => '95eeffefe3adc2dc5c7e57000d20c59b471da55d82d6867ea78a888cee5e7621',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\PurchasePolicy.php' => 
  array (
    'fileHash' => '4ece730e2d03ec7f51dc0533b683a45c3b825d36789da4e38502b26c884adc1e',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\SalePolicy.php' => 
  array (
    'fileHash' => '37bf61539c781e5d8b5fc1044a1286ea70373707ff7dacce5a1ade05e5397c3a',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\VendorPolicy.php' => 
  array (
    'fileHash' => '04331877a386c71121cc69c37cfcdbb34391541b3bef5fca8436fd31b8b99478',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\AppServiceProvider.php' => 
  array (
    'fileHash' => '101f39a8e73fdf94dfdfbeca29175c9023f0dc11bf3965263a00d3b8059a557c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\VoltServiceProvider.php' => 
  array (
    'fileHash' => 'c3f1fc1718e6133d3af395ab954518e0965a8ef15ba61ed35da90ae14a6fd54e',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\BarcodeService.php' => 
  array (
    'fileHash' => '3afc3952787f77f92d7fdf6df0abacb0a58326a5dbae45d85a4092ae867d231b',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ExpiryAlertService.php' => 
  array (
    'fileHash' => '810fc7c555f72fd943e51a6b37789bdae6a5f4170ffa90da4476e0d58156459a',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ExpiryAlertsDashboard.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php' => 
  array (
    'fileHash' => '5fbbef7b45819ac2f64011455088b03e3309d62a69e4f7897a1c30a43ac9e220',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php',
      2 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php',
      3 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php',
      4 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php',
      5 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      6 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php',
      7 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PaymentSplitService.php' => 
  array (
    'fileHash' => '9e10875804660bf3b8922a578211e2b80b1cb9114293f624b00517f59512654b',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php',
      1 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php' => 
  array (
    'fileHash' => '6e1619602616f0b486a921054ff922912a4f4d31bc4c2008ccd9e1e82e7ecc75',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php' => 
  array (
    'fileHash' => '538b99b2b572a7aec26ea06ec648a07ad3fecda4dbe50588dfc88a854bd12640',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php' => 
  array (
    'fileHash' => '9fce87009c229269f606573e972db42dc1338af7d911c48bcda3b0843f4a8bfb',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php' => 
  array (
    'fileHash' => '26094b7d9d4875c9625c0d2097f7d9d2cc4e89540925138625222a518e83935d',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php' => 
  array (
    'fileHash' => 'ab5c8b264148f2043488cc1b0207a8e3cea9a066a4722fac558dc8b721a202b8',
    'dependentFiles' => 
    array (
      0 => 'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php',
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\AppLayout.php' => 
  array (
    'fileHash' => 'c57c4ac36e5603ca09b66674a3a01b427528948ecf1f7a93d06d52818d9319b5',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\GuestLayout.php' => 
  array (
    'fileHash' => '35663740cd39dc5f726b24e402babb41d0af62e09567c0e717235586fa3d9f80',
    'dependentFiles' => 
    array (
    ),
  ),
),
	'packageDependencies' => array (
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php' => 
  array (
    0 => 'symfony/console',
    1 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\LedgerEntryType.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\PayableType.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\UnbalancedPaymentSplitException.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\CustomerForm.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\LoginForm.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
    2 => 'symfony/http-foundation',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleList.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ReceiptSetting.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\User.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\CustomerPolicy.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PaymentSplitService.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
    2 => 'ramsey/uuid',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\AppLayout.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\PaymentMethod.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Events\\BatchExpiringSoon.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InvalidReturnQuantityException.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Middleware\\SetLocale.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/console',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
    3 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseList.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleItem.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Vendor.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\VendorLedger.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\SalePolicy.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\AppServiceProvider.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\BarcodeService.php' => 
  array (
    0 => 'milon/barcode',
    1 => 'laravel/framework',
    2 => 'ramsey/uuid',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\UserRole.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Auth\\VerifyEmailController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Actions\\Logout.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\VendorForm.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ExpiryAlertsDashboard.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Customer.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\CustomerLedger.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Observers\\BatchObserver.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\VoltServiceProvider.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/volt',
    2 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
    2 => 'symfony/http-foundation',
    3 => 'ramsey/uuid',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\GuestLayout.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\TransactionReferenceType.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InsufficientStockException.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Controller.php' => 
  array (
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\BankAccountManager.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\ProductForm.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Shared\\LanguageSwitcher.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
    2 => 'symfony/http-kernel',
    3 => 'psr/container',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php' => 
  array (
    0 => 'livewire/livewire',
    1 => 'laravel/framework',
    2 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Bank.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Batch.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Product.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ThemeSetting.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\PurchasePolicy.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\VendorPolicy.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'spatie/laravel-permission',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ExpiryAlertService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\CategoryManager.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Category.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\SettingsPage.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\DeveloperTools.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'livewire/livewire',
    2 => 'symfony/finder',
    3 => 'spatie/laravel-permission',
    4 => 'psr/log',
    5 => 'monolog/monolog',
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Console\\Commands\\CheckExpiringBatches.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Console\\Commands\\CheckExpiringBatches',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Console\\Command',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'signature',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The name and signature of the console command.
     *
     * @var string
     */',
             'namespace' => 'App\\Console\\Commands',
             'uses' => 
            array (
              'batchexpiringsoon' => 'App\\Events\\BatchExpiringSoon',
              'expiryalertservice' => 'App\\Services\\ExpiryAlertService',
              'command' => 'Illuminate\\Console\\Command',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'description',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The console command description.
     *
     * @var string
     */',
             'namespace' => 'App\\Console\\Commands',
             'uses' => 
            array (
              'batchexpiringsoon' => 'App\\Events\\BatchExpiringSoon',
              'expiryalertservice' => 'App\\Services\\ExpiryAlertService',
              'command' => 'Illuminate\\Console\\Command',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'expiryAlertService',
               'type' => 'App\\Services\\ExpiryAlertService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\LedgerEntryType.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\LedgerEntryType',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Debit',
           'value' => '\'debit\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Credit',
           'value' => '\'credit\'',
           'phpDoc' => NULL,
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\PayableType.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\PayableType',
       'scalarType' => 'string',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * What a payments row settles. sale/purchase back a transaction line item
 * (see architecture.md §3.17); vendor/customer back a standalone ledger
 * settlement recorded outside of any sale/purchase (see phases.md Phase 2).
 */',
         'namespace' => 'App\\Enums',
         'uses' => 
        array (
        ),
         'constUses' => 
        array (
        ),
      )),
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Sale',
           'value' => '\'sale\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Purchase',
           'value' => '\'purchase\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Vendor',
           'value' => '\'vendor\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Customer',
           'value' => '\'customer\'',
           'phpDoc' => NULL,
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\PaymentMethod.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\PaymentMethod',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Cash',
           'value' => '\'cash\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Bank',
           'value' => '\'bank\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Ledger',
           'value' => '\'ledger\'',
           'phpDoc' => NULL,
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\TransactionReferenceType.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\TransactionReferenceType',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Sale',
           'value' => '\'sale\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Purchase',
           'value' => '\'purchase\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'SaleReturn',
           'value' => '\'sale_return\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'PurchaseReturn',
           'value' => '\'purchase_return\'',
           'phpDoc' => NULL,
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Payment',
           'value' => '\'payment\'',
           'phpDoc' => NULL,
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Enums\\UserRole.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\UserRole',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Admin',
           'value' => '\'Admin\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'InventoryManager',
           'value' => '\'Inventory Manager\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Accountant',
           'value' => '\'Accountant\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Salesman',
           'value' => '\'Salesman\'',
           'phpDoc' => NULL,
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Events\\BatchExpiringSoon.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Events\\BatchExpiringSoon',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Foundation\\Events\\Dispatchable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'batch',
               'type' => 'App\\Models\\Batch',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 65,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InsufficientStockException.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Exceptions\\InsufficientStockException',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Exception',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'forBatch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'barcode',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'requested',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'available',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\InvalidReturnQuantityException.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Exceptions\\InvalidReturnQuantityException',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Exception',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exceedsReturnable',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'requested',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'returnable',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Exceptions\\UnbalancedPaymentSplitException.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Exception',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'forMismatch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'expectedTotal',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actualTotal',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Auth\\VerifyEmailController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mark the authenticated user\'s email address as verified.
     */',
             'namespace' => 'App\\Http\\Controllers\\Auth',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'verified' => 'Illuminate\\Auth\\Events\\Verified',
              'emailverificationrequest' => 'Illuminate\\Foundation\\Auth\\EmailVerificationRequest',
              'redirectresponse' => 'Illuminate\\Http\\RedirectResponse',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\RedirectResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Foundation\\Auth\\EmailVerificationRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Controllers\\Controller.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Controller',
       'phpDoc' => NULL,
       'abstract' => true,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Http\\Middleware\\SetLocale.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\SetLocale',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Resolve the active locale for this request: session choice first,
     * falling back to the shop\'s configured default_locale (theme_settings),
     * falling back to the app config default.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'themesetting' => 'App\\Models\\ThemeSetting',
              'closure' => 'Closure',
              'request' => 'Illuminate\\Http\\Request',
              'app' => 'Illuminate\\Support\\Facades\\App',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Actions\\Logout.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Actions\\Logout',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Log the current user out of the application.
     */',
             'namespace' => 'App\\Livewire\\Actions',
             'uses' => 
            array (
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
              'session' => 'Illuminate\\Support\\Facades\\Session',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\BankAccountManager.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Admin\\BankAccountManager',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'editingBankId',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'name',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|string|max:255\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'accountNumber',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:100\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'bankId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toggleActive',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'bankId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\DeveloperTools.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Admin\\DeveloperTools',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Admin-only server maintenance actions, each a fixed, hardcoded command —
 * none of these ever take user input, so there is no injection surface.
 * Every action re-checks \'developer-tools.manage\' itself (not just the
 * parent Settings page) as defense in depth, and is logged with who ran it.
 */',
         'namespace' => 'App\\Livewire\\Admin',
         'uses' => 
        array (
          'view' => 'Illuminate\\Contracts\\View\\View',
          'artisan' => 'Illuminate\\Support\\Facades\\Artisan',
          'file' => 'Illuminate\\Support\\Facades\\File',
          'log' => 'Illuminate\\Support\\Facades\\Log',
          'process' => 'Illuminate\\Support\\Facades\\Process',
          'component' => 'Livewire\\Component',
          'throwable' => 'Throwable',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'lastLabel',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'output',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'success',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hasRun',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'runMigrate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'runOptimize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'runConfigCache',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'runGitPull',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Admin\\SettingsPage.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Admin\\SettingsPage',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'PRESET_THEMES',
               'value' => '[[\'name\' => \'Forest\', \'navbar_primary_color\' => \'#2f6f4f\', \'navbar_accent_color\' => \'#e8f5ee\', \'sidebar_primary_color\' => \'#1f4d38\', \'sidebar_accent_color\' => \'#eaf6f0\', \'sidebar_gradient_from\' => \'#1f4d38\', \'sidebar_gradient_to\' => \'#0d2b1f\'], [\'name\' => \'Ocean\', \'navbar_primary_color\' => \'#1e5f8c\', \'navbar_accent_color\' => \'#e6f2fa\', \'sidebar_primary_color\' => \'#123a56\', \'sidebar_accent_color\' => \'#e3f0f9\', \'sidebar_gradient_from\' => \'#123a56\', \'sidebar_gradient_to\' => \'#0a2438\'], [\'name\' => \'Sunset\', \'navbar_primary_color\' => \'#c1552c\', \'navbar_accent_color\' => \'#fbeee7\', \'sidebar_primary_color\' => \'#7a3418\', \'sidebar_accent_color\' => \'#fbeee7\', \'sidebar_gradient_from\' => \'#7a3418\', \'sidebar_gradient_to\' => \'#4a1f0d\'], [\'name\' => \'Royal\', \'navbar_primary_color\' => \'#5b3a8e\', \'navbar_accent_color\' => \'#efe9f8\', \'sidebar_primary_color\' => \'#3a2459\', \'sidebar_accent_color\' => \'#efe9f8\', \'sidebar_gradient_from\' => \'#3a2459\', \'sidebar_gradient_to\' => \'#1f1330\']]',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Four curated palettes an admin can apply with one click, then still
     * fine-tune — each sets both the solid navbar colors and the sidebar\'s
     * two-stop gradient together for a cohesive look.
     *
     * @var list<array{name: string, navbar_primary_color: string, navbar_accent_color: string, sidebar_primary_color: string, sidebar_accent_color: string, sidebar_gradient_from: string, sidebar_gradient_to: string}>
     */',
             'namespace' => 'App\\Livewire\\Admin',
             'uses' => 
            array (
              'receiptsetting' => 'App\\Models\\ReceiptSetting',
              'themesetting' => 'App\\Models\\ThemeSetting',
              'view' => 'Illuminate\\Contracts\\View\\View',
              'layout' => 'Livewire\\Attributes\\Layout',
              'validate' => 'Livewire\\Attributes\\Validate',
              'component' => 'Livewire\\Component',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'shopName',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:255\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'receiptHeaderText',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:1000\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'receiptFooterText',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:1000\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'receiptShowLogo',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'boolean\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'receiptPaperWidth',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|in:58mm,80mm\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'navbarPrimaryColor',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|regex:/^#[0-9a-fA-F]{6}$/\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'navbarAccentColor',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|regex:/^#[0-9a-fA-F]{6}$/\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'sidebarPrimaryColor',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|regex:/^#[0-9a-fA-F]{6}$/\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'sidebarAccentColor',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|regex:/^#[0-9a-fA-F]{6}$/\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'sidebarGradientFrom',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|regex:/^#[0-9a-fA-F]{6}$/\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'sidebarGradientTo',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|regex:/^#[0-9a-fA-F]{6}$/\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saveGeneral',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saveReceipt',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'applyPreset',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        16 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saveTheme',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        17 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerLedger.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Customers\\CustomerLedger',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'customer',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Models\\Customer',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'dateFrom',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'dateTo',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'paymentAmount',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|numeric|min:0.01\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'paymentMethod',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|in:cash,bank\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'bankId',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|exists:banks,id\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showPaymentModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customer',
               'type' => 'App\\Models\\Customer',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openPaymentForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'recordPayment',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Customers\\CustomerList.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Customers\\CustomerList',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'form',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Livewire\\Forms\\CustomerForm',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'search',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updatingSearch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customerId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toggleActive',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customerId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\BatchForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Forms\\BatchForm',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Form',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'batch',
          ),
           'phpDoc' => NULL,
           'type' => '?App\\Models\\Batch',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'product_id',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'manufacturing_date',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'expiry_date',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'cost_price',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'quantity_received',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'setBatch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'batch',
               'type' => 'App\\Models\\Batch',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attributesForCreate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attributesForUpdate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Dates/cost only — quantity changes must go through purchase/return
     * flows (Phase 4/5), never a raw batch edit.
     *
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resetForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\CustomerForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Forms\\CustomerForm',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Form',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'customer',
          ),
           'phpDoc' => NULL,
           'type' => '?App\\Models\\Customer',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'name',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|string|max:255\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'phone',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:30\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'address',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:1000\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'opening_balance',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|numeric|min:0\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'setCustomer',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customer',
               'type' => 'App\\Models\\Customer',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attributesForSave',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'customer' => 'App\\Models\\Customer',
              'validate' => 'Livewire\\Attributes\\Validate',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resetForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\LoginForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Forms\\LoginForm',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Form',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'email',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|string|email\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'password',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|string\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'remember',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'boolean\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authenticate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Attempt to authenticate the request\'s credentials.
     *
     * @throws ValidationException
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'lockout' => 'Illuminate\\Auth\\Events\\Lockout',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
              'ratelimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
              'str' => 'Illuminate\\Support\\Str',
              'validationexception' => 'Illuminate\\Validation\\ValidationException',
              'validate' => 'Livewire\\Attributes\\Validate',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ensureIsNotRateLimited',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Ensure the authentication request is not rate limited.
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'lockout' => 'Illuminate\\Auth\\Events\\Lockout',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
              'ratelimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
              'str' => 'Illuminate\\Support\\Str',
              'validationexception' => 'Illuminate\\Validation\\ValidationException',
              'validate' => 'Livewire\\Attributes\\Validate',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'throttleKey',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the authentication rate limiting throttle key.
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'lockout' => 'Illuminate\\Auth\\Events\\Lockout',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
              'ratelimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
              'str' => 'Illuminate\\Support\\Str',
              'validationexception' => 'Illuminate\\Validation\\ValidationException',
              'validate' => 'Livewire\\Attributes\\Validate',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\ProductForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Forms\\ProductForm',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Form',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'product',
          ),
           'phpDoc' => NULL,
           'type' => '?App\\Models\\Product',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'name',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'sku',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'category_id',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'unit',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'default_sale_price',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'product' => 'App\\Models\\Product',
              'rule' => 'Illuminate\\Validation\\Rule',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'setProduct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'product',
               'type' => 'App\\Models\\Product',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attributesForSave',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'product' => 'App\\Models\\Product',
              'rule' => 'Illuminate\\Validation\\Rule',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resetForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Forms\\VendorForm.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Forms\\VendorForm',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Form',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'vendor',
          ),
           'phpDoc' => NULL,
           'type' => '?App\\Models\\Vendor',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'name',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|string|max:255\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'phone',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:30\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'address',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|string|max:1000\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'opening_balance',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|numeric|min:0\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'setVendor',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendor',
               'type' => 'App\\Models\\Vendor',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attributesForSave',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Livewire\\Forms',
             'uses' => 
            array (
              'vendor' => 'App\\Models\\Vendor',
              'validate' => 'Livewire\\Attributes\\Validate',
              'form' => 'Livewire\\Form',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resetForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\BatchList.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Inventory\\BatchList',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'form',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Livewire\\Forms\\BatchForm',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'productFilter',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Url',
               'args' => 
              array (
                'as' => '\'product\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'batchId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'barcodeService',
               'type' => 'App\\Services\\BarcodeService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'clearFilter',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\CategoryManager.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Inventory\\CategoryManager',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'editingCategoryId',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'name',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'categoryId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toggleActive',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'categoryId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ExpiryAlertsDashboard.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Inventory\\ExpiryAlertsDashboard',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'expiryAlertService',
               'type' => 'App\\Services\\ExpiryAlertService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Inventory\\ProductList.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Inventory\\ProductList',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'form',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Livewire\\Forms\\ProductForm',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'search',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updatingSearch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toggleActive',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'productId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\Pos.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Pos\\Pos',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * @property-read string $cartTotal Livewire computed property backed by getCartTotalProperty().
 */',
         'namespace' => 'App\\Livewire\\Pos',
         'uses' => 
        array (
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'insufficientstockexception' => 'App\\Exceptions\\InsufficientStockException',
          'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
          'bank' => 'App\\Models\\Bank',
          'batch' => 'App\\Models\\Batch',
          'customer' => 'App\\Models\\Customer',
          'sale' => 'App\\Models\\Sale',
          'saleservice' => 'App\\Services\\SaleService',
          'view' => 'Illuminate\\Contracts\\View\\View',
          'layout' => 'Livewire\\Attributes\\Layout',
          'component' => 'Livewire\\Component',
          'temporaryuploadedfile' => 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile',
          'withfileuploads' => 'Livewire\\WithFileUploads',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithFileUploads',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'barcodeInput',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'scanError',
          ),
           'phpDoc' => NULL,
           'type' => '?string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'cart',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<array{batch_id: int, barcode: string, product_name: string, unit_price: string, quantity: string, available: string}> */',
             'namespace' => 'App\\Livewire\\Pos',
             'uses' => 
            array (
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'insufficientstockexception' => 'App\\Exceptions\\InsufficientStockException',
              'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
              'bank' => 'App\\Models\\Bank',
              'batch' => 'App\\Models\\Batch',
              'customer' => 'App\\Models\\Customer',
              'sale' => 'App\\Models\\Sale',
              'saleservice' => 'App\\Services\\SaleService',
              'view' => 'Illuminate\\Contracts\\View\\View',
              'layout' => 'Livewire\\Attributes\\Layout',
              'component' => 'Livewire\\Component',
              'temporaryuploadedfile' => 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile',
              'withfileuploads' => 'Livewire\\WithFileUploads',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => 'array',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'customer_id',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showCheckoutModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'paymentLines',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<array{method: string, amount: string, bank_id: ?int}> */',
             'namespace' => 'App\\Livewire\\Pos',
             'uses' => 
            array (
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'insufficientstockexception' => 'App\\Exceptions\\InsufficientStockException',
              'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
              'bank' => 'App\\Models\\Bank',
              'batch' => 'App\\Models\\Batch',
              'customer' => 'App\\Models\\Customer',
              'sale' => 'App\\Models\\Sale',
              'saleservice' => 'App\\Services\\SaleService',
              'view' => 'Illuminate\\Contracts\\View\\View',
              'layout' => 'Livewire\\Attributes\\Layout',
              'component' => 'Livewire\\Component',
              'temporaryuploadedfile' => 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile',
              'withfileuploads' => 'Livewire\\WithFileUploads',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => 'array',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'capturedPhoto',
          ),
           'phpDoc' => NULL,
           'type' => '?Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scanBarcode',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'removeCartItem',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'clearCart',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'incrementQuantity',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'decrementQuantity',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getCartTotalProperty',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openCheckout',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'addPaymentLine',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        16 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'removePaymentLine',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        17 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'removePhoto',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        18 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'checkout',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'saleService',
               'type' => 'App\\Services\\SaleService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        19 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleList.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Pos\\SaleList',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Pos\\SaleShow.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Pos\\SaleShow',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'sale',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Models\\Sale',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showReturnModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'returningItemId',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'returnQuantity',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'returnReason',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'sale',
               'type' => 'App\\Models\\Sale',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openReturnForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'saleItemId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'submitReturn',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'saleReturnService',
               'type' => 'App\\Services\\SaleReturnService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseCreate.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Purchases\\PurchaseCreate',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'vendor_id',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'items',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<array{product_id: ?int, manufacturing_date: string, expiry_date: string, cost_price: string, quantity: string}> */',
             'namespace' => 'App\\Livewire\\Purchases',
             'uses' => 
            array (
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
              'bank' => 'App\\Models\\Bank',
              'product' => 'App\\Models\\Product',
              'purchase' => 'App\\Models\\Purchase',
              'vendor' => 'App\\Models\\Vendor',
              'purchaseservice' => 'App\\Services\\PurchaseService',
              'view' => 'Illuminate\\Contracts\\View\\View',
              'layout' => 'Livewire\\Attributes\\Layout',
              'component' => 'Livewire\\Component',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => 'array',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'paymentLines',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<array{method: string, amount: string, bank_id: ?int}> */',
             'namespace' => 'App\\Livewire\\Purchases',
             'uses' => 
            array (
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
              'bank' => 'App\\Models\\Bank',
              'product' => 'App\\Models\\Product',
              'purchase' => 'App\\Models\\Purchase',
              'vendor' => 'App\\Models\\Vendor',
              'purchaseservice' => 'App\\Services\\PurchaseService',
              'view' => 'Illuminate\\Contracts\\View\\View',
              'layout' => 'Livewire\\Attributes\\Layout',
              'component' => 'Livewire\\Component',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => 'array',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'addItem',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'removeItem',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'addPaymentLine',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'removePaymentLine',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'index',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTotalProperty',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return array<string, string>
     */',
             'namespace' => 'App\\Livewire\\Purchases',
             'uses' => 
            array (
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
              'bank' => 'App\\Models\\Bank',
              'product' => 'App\\Models\\Product',
              'purchase' => 'App\\Models\\Purchase',
              'vendor' => 'App\\Models\\Vendor',
              'purchaseservice' => 'App\\Services\\PurchaseService',
              'view' => 'Illuminate\\Contracts\\View\\View',
              'layout' => 'Livewire\\Attributes\\Layout',
              'component' => 'Livewire\\Component',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'purchaseService',
               'type' => 'App\\Services\\PurchaseService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseList.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Purchases\\PurchaseList',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Purchases\\PurchaseShow.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Purchases\\PurchaseShow',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'purchase',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Models\\Purchase',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showReturnModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'returningItemId',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'returnQuantity',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'returnReason',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'purchase',
               'type' => 'App\\Models\\Purchase',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openReturnForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'purchaseItemId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'submitReturn',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'purchaseReturnService',
               'type' => 'App\\Services\\PurchaseReturnService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Shared\\LanguageSwitcher.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Shared\\LanguageSwitcher',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'switchTo',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Persist the chosen locale in the session and reload so every string
     * (including lang files resolved server-side) reflects it immediately.
     */',
             'namespace' => 'App\\Livewire\\Shared',
             'uses' => 
            array (
              'view' => 'Illuminate\\Contracts\\View\\View',
              'component' => 'Livewire\\Component',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'locale',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorLedger.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Vendors\\VendorLedger',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'vendor',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Models\\Vendor',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'dateFrom',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'dateTo',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'paymentAmount',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|numeric|min:0.01\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'paymentMethod',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'required|in:cash,bank\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'bankId',
          ),
           'phpDoc' => NULL,
           'type' => '?int',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'Livewire\\Attributes\\Validate',
               'args' => 
              array (
                0 => '\'nullable|exists:banks,id\'',
              ),
            )),
          ),
           'hooks' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showPaymentModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'mount',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendor',
               'type' => 'App\\Models\\Vendor',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openPaymentForm',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'recordPayment',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Livewire\\Vendors\\VendorList.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Livewire\\Vendors\\VendorList',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Livewire\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Livewire\\WithPagination',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'form',
          ),
           'phpDoc' => NULL,
           'type' => 'App\\Livewire\\Forms\\VendorForm',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'search',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'showModal',
          ),
           'phpDoc' => NULL,
           'type' => 'bool',
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updatingSearch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendorId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'save',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toggleActive',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendorId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'Livewire\\Attributes\\Layout',
           'args' => 
          array (
            0 => '\'layouts.app\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Bank.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Bank',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Batch.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Batch',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'product',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Product, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'purchaseItem',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<PurchaseItem, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'daysUntilExpiry',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isExpired',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isExpiringSoon',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'withinDays',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Category.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Category',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'products',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<Product, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Customer.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Customer',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ledgerEntries',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<CustomerLedger, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'currentBalance',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\CustomerLedger.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\CustomerLedger',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Insert-only financial ledger row. Never update or delete an existing row —
 * post a reversing entry instead (see rules.md §2 rule 1).
 */',
         'namespace' => 'App\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
          'logicexception' => 'LogicException',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'UPDATED_AT',
               'value' => 'null',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'customer',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'creator',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array<string, mixed>  $attributes
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'logicexception' => 'LogicException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'attributes',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'options',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'delete',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Payment.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Payment',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'bank',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Product.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Product',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'category',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Category, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'batches',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<Batch, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'totalRemainingQuantity',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Purchase.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Purchase',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'vendor',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Vendor, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'items',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<PurchaseItem, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'returns',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<PurchaseReturn, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseItem.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\PurchaseItem',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'purchase',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Purchase, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasone' => 'Illuminate\\Database\\Eloquent\\Relations\\HasOne',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'product',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Product, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasone' => 'Illuminate\\Database\\Eloquent\\Relations\\HasOne',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'batch',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasOne<Batch, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasone' => 'Illuminate\\Database\\Eloquent\\Relations\\HasOne',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasOne',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'returnableQuantity',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturn.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\PurchaseReturn',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'purchase',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'vendor',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'items',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\PurchaseReturnItem.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\PurchaseReturnItem',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'purchaseReturn',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'purchaseItem',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'batch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ReceiptSetting.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ReceiptSetting',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'current',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * receipt_settings is a single-row table (id = 1); this returns that row.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Sale.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Sale',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'customer',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Customer, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'items',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<SaleItem, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'returns',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return HasMany<SaleReturn, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleItem.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\SaleItem',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'sale',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Sale, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'batch',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Batch, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'returnableQuantity',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturn.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\SaleReturn',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'sale',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'customer',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'items',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\SaleReturnItem.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\SaleReturnItem',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saleReturn',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saleItem',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'batch',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\ThemeSetting.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ThemeSetting',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'current',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * theme_settings is a single-row table (id = 1); this returns that row.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'displayName',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The name shown in the navbar, sidebar, browser tab, and receipts —
     * falls back to the app\'s own name until an admin sets a shop name.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\User.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\User',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Foundation\\Auth\\User',
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Auth\\MustVerifyEmail',
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Spatie\\Permission\\Traits\\HasRoles',
        2 => 'Illuminate\\Notifications\\Notifiable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userfactory' => 'Database\\Factories\\UserFactory',
              'mustverifyemail' => 'Illuminate\\Contracts\\Auth\\MustVerifyEmail',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
              'hasroles' => 'Spatie\\Permission\\Traits\\HasRoles',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userfactory' => 'Database\\Factories\\UserFactory',
              'mustverifyemail' => 'Illuminate\\Contracts\\Auth\\MustVerifyEmail',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
              'hasroles' => 'Spatie\\Permission\\Traits\\HasRoles',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userfactory' => 'Database\\Factories\\UserFactory',
              'mustverifyemail' => 'Illuminate\\Contracts\\Auth\\MustVerifyEmail',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
              'hasroles' => 'Spatie\\Permission\\Traits\\HasRoles',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\Vendor.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Vendor',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ledgerEntries',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'currentBalance',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Models\\VendorLedger.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\VendorLedger',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Insert-only financial ledger row. Never update or delete an existing row —
 * post a reversing entry instead (see rules.md §2 rule 1).
 */',
         'namespace' => 'App\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
          'logicexception' => 'LogicException',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'UPDATED_AT',
               'value' => 'null',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'vendor',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'creator',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  array<string, mixed>  $attributes
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'logicexception' => 'LogicException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'attributes',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'options',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'delete',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Observers\\BatchObserver.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Observers\\BatchObserver',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'saved',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Dispatch a freshness-check event whenever a batch is created or
     * updated and already falls within the expiry alert window — a
     * side-effect only, never a ledger/stock write (see rules.md §1.2).
     * The scheduled sweep (CheckExpiringBatches) covers batches that age
     * into the window without being saved again.
     */',
             'namespace' => 'App\\Observers',
             'uses' => 
            array (
              'batchexpiringsoon' => 'App\\Events\\BatchExpiringSoon',
              'batch' => 'App\\Models\\Batch',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'batch',
               'type' => 'App\\Models\\Batch',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\CustomerPolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\CustomerPolicy',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Customers are never hard-deleted (see rules.md — financial records never
 * disappear); deactivating is just an update, so there is no delete ability.
 */',
         'namespace' => 'App\\Policies',
         'uses' => 
        array (
          'customer' => 'App\\Models\\Customer',
          'user' => 'App\\Models\\User',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'viewAny',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'view',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customer',
               'type' => 'App\\Models\\Customer',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customer',
               'type' => 'App\\Models\\Customer',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\PurchasePolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\PurchasePolicy',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * A posted purchase is never edited (see rules.md §2 — corrections happen
 * via a purchase return, not a raw edit), so there is no update ability.
 */',
         'namespace' => 'App\\Policies',
         'uses' => 
        array (
          'purchase' => 'App\\Models\\Purchase',
          'user' => 'App\\Models\\User',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'viewAny',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'view',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'purchase',
               'type' => 'App\\Models\\Purchase',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\SalePolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\SalePolicy',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * A posted sale is never edited (see rules.md §2 — corrections happen via a
 * sales return, not a raw edit), so there is no update ability.
 */',
         'namespace' => 'App\\Policies',
         'uses' => 
        array (
          'sale' => 'App\\Models\\Sale',
          'user' => 'App\\Models\\User',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'viewAny',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'view',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'sale',
               'type' => 'App\\Models\\Sale',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Policies\\VendorPolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\VendorPolicy',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Vendors are never hard-deleted (see rules.md — financial records never
 * disappear); deactivating is just an update, so there is no delete ability.
 */',
         'namespace' => 'App\\Policies',
         'uses' => 
        array (
          'user' => 'App\\Models\\User',
          'vendor' => 'App\\Models\\Vendor',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'viewAny',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'view',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendor',
               'type' => 'App\\Models\\Vendor',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendor',
               'type' => 'App\\Models\\Vendor',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\AppServiceProvider.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Providers\\AppServiceProvider',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Support\\ServiceProvider',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'register',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Register any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'batchobserver' => 'App\\Observers\\BatchObserver',
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'boot',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Bootstrap any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'batchobserver' => 'App\\Observers\\BatchObserver',
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Providers\\VoltServiceProvider.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Providers\\VoltServiceProvider',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Support\\ServiceProvider',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'register',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Register services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
              'volt' => 'Livewire\\Volt\\Volt',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'boot',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Bootstrap services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
              'volt' => 'Livewire\\Volt\\Volt',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\BarcodeService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\BarcodeService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Owns barcode assignment for batches. A batch\'s barcode is derived from its
 * own id (guaranteed unique, never reused even if the batch is later
 * depleted) — see rules.md and architecture.md §3.7.
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'batch' => 'App\\Models\\Batch',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'str' => 'Illuminate\\Support\\Str',
          'dns1d' => 'Milon\\Barcode\\DNS1D',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'barcodeGenerator',
               'type' => 'Milon\\Barcode\\DNS1D',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'createBatchWithBarcode',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Create a batch and assign it a permanent barcode in one step, since the
     * barcode value is derived from the batch\'s own (post-insert) id.
     *
     * @param  array<string, mixed>  $attributes
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'str' => 'Illuminate\\Support\\Str',
              'dns1d' => 'Milon\\Barcode\\DNS1D',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\Batch',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'attributes',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'renderSvg',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'code',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ExpiryAlertService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\ExpiryAlertService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Read-side query service backing the "Expiring Soon" dashboard (see
 * prd.md §2.3) and the scheduled sweep (CheckExpiringBatches). Always
 * computed live from batches — there is no separate alerts table, so the
 * list is queryable on-demand at any time, not just via the schedule.
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'batch' => 'App\\Models\\Batch',
          'collection' => 'Illuminate\\Database\\Eloquent\\Collection',
          'carbon' => 'Illuminate\\Support\\Carbon',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'expiringWithin',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Batches within the given window that still have stock to sell,
     * soonest-expiring first.
     *
     * @return Collection<int, Batch>
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'batch' => 'App\\Models\\Batch',
              'collection' => 'Illuminate\\Database\\Eloquent\\Collection',
              'carbon' => 'Illuminate\\Support\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Collection',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'days',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\LedgerService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\LedgerService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * The only writer of vendor_ledgers/customer_ledgers rows (see rules.md §2).
 * Every entry is inserted inside its own transaction with the owning
 * vendor/customer row locked, so concurrent postings can never race on
 * running_balance.
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
          'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
          'customer' => 'App\\Models\\Customer',
          'customerledger' => 'App\\Models\\CustomerLedger',
          'user' => 'App\\Models\\User',
          'vendor' => 'App\\Models\\Vendor',
          'vendorledger' => 'App\\Models\\VendorLedger',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'postVendorEntry',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\VendorLedger',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendor',
               'type' => 'App\\Models\\Vendor',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'type',
               'type' => 'App\\Enums\\LedgerEntryType',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'amount',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'referenceType',
               'type' => 'App\\Enums\\TransactionReferenceType',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'referenceId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            5 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'description',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            6 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'postCustomerEntry',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\CustomerLedger',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customer',
               'type' => 'App\\Models\\Customer',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'type',
               'type' => 'App\\Enums\\LedgerEntryType',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'amount',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'referenceType',
               'type' => 'App\\Enums\\TransactionReferenceType',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'referenceId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            5 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'description',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            6 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PaymentSplitService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\PaymentSplitService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Decimal-safe sum-to-total validator, shared by every flow that accepts a
 * split payment (purchases now, sales/POS in Phase 5) — see rules.md §2
 * rule 3. Never compares floats; every amount is handled as a bcmath string.
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'assertBalanced',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  list<array{amount: string}>  $paymentLines
     *
     * @throws UnbalancedPaymentSplitException
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'unbalancedpaymentsplitexception' => 'App\\Exceptions\\UnbalancedPaymentSplitException',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'paymentLines',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'expectedTotal',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseReturnService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\PurchaseReturnService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Reverses a purchase, in whole or in part: restores/removes batch stock and
 * posts a reversing vendor-ledger entry — never mutates the original
 * purchase or its ledger entry (see rules.md §2 rules 1 and 6).
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
          'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
          'invalidreturnquantityexception' => 'App\\Exceptions\\InvalidReturnQuantityException',
          'batch' => 'App\\Models\\Batch',
          'purchase' => 'App\\Models\\Purchase',
          'purchaseitem' => 'App\\Models\\PurchaseItem',
          'purchasereturn' => 'App\\Models\\PurchaseReturn',
          'purchasereturnitem' => 'App\\Models\\PurchaseReturnItem',
          'user' => 'App\\Models\\User',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  list<array{purchase_item_id: int, quantity: string}>  $lines
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
              'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
              'invalidreturnquantityexception' => 'App\\Exceptions\\InvalidReturnQuantityException',
              'batch' => 'App\\Models\\Batch',
              'purchase' => 'App\\Models\\Purchase',
              'purchaseitem' => 'App\\Models\\PurchaseItem',
              'purchasereturn' => 'App\\Models\\PurchaseReturn',
              'purchasereturnitem' => 'App\\Models\\PurchaseReturnItem',
              'user' => 'App\\Models\\User',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\PurchaseReturn',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'purchase',
               'type' => 'App\\Models\\Purchase',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'lines',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\PurchaseService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\PurchaseService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Implements the purchase → purchase_items → batches → payments → vendor
 * ledger data flow from architecture.md §1.1. Every write happens inside one
 * transaction; a split payment must sum exactly to the purchase total before
 * anything is written (see rules.md §2 rules 2-3).
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
          'payabletype' => 'App\\Enums\\PayableType',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
          'payment' => 'App\\Models\\Payment',
          'purchase' => 'App\\Models\\Purchase',
          'purchaseitem' => 'App\\Models\\PurchaseItem',
          'user' => 'App\\Models\\User',
          'vendor' => 'App\\Models\\Vendor',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'str' => 'Illuminate\\Support\\Str',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'barcodeService',
               'type' => 'App\\Services\\BarcodeService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'paymentSplitService',
               'type' => 'App\\Services\\PaymentSplitService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  list<array{product_id: int, manufacturing_date: string, expiry_date: string, cost_price: string, quantity: string}>  $items
     * @param  list<array{method: string, amount: string, bank_id: ?int}>  $paymentLines
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
              'payabletype' => 'App\\Enums\\PayableType',
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
              'payment' => 'App\\Models\\Payment',
              'purchase' => 'App\\Models\\Purchase',
              'purchaseitem' => 'App\\Models\\PurchaseItem',
              'user' => 'App\\Models\\User',
              'vendor' => 'App\\Models\\Vendor',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\Purchase',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vendor',
               'type' => 'App\\Models\\Vendor',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'items',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'paymentLines',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\ReceiptRenderService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\ReceiptRenderService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Resolves a sale plus the shop\'s current receipt_settings/theme_settings
 * into the printable thermal receipt view (see prd.md §2.6, design.md §4.4).
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'payabletype' => 'App\\Enums\\PayableType',
          'payment' => 'App\\Models\\Payment',
          'receiptsetting' => 'App\\Models\\ReceiptSetting',
          'sale' => 'App\\Models\\Sale',
          'themesetting' => 'App\\Models\\ThemeSetting',
          'view' => 'Illuminate\\Contracts\\View\\View',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'sale',
               'type' => 'App\\Models\\Sale',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleReturnService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\SaleReturnService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Reverses a sale, in whole or in part: restores batch stock and posts a
 * reversing customer-ledger entry — never mutates the original sale or its
 * ledger entry (see rules.md §2 rules 1 and 6). Mirrors PurchaseReturnService.
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
          'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
          'invalidreturnquantityexception' => 'App\\Exceptions\\InvalidReturnQuantityException',
          'batch' => 'App\\Models\\Batch',
          'sale' => 'App\\Models\\Sale',
          'saleitem' => 'App\\Models\\SaleItem',
          'salereturn' => 'App\\Models\\SaleReturn',
          'salereturnitem' => 'App\\Models\\SaleReturnItem',
          'user' => 'App\\Models\\User',
          'db' => 'Illuminate\\Support\\Facades\\DB',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  list<array{sale_item_id: int, quantity: string}>  $lines
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
              'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
              'invalidreturnquantityexception' => 'App\\Exceptions\\InvalidReturnQuantityException',
              'batch' => 'App\\Models\\Batch',
              'sale' => 'App\\Models\\Sale',
              'saleitem' => 'App\\Models\\SaleItem',
              'salereturn' => 'App\\Models\\SaleReturn',
              'salereturnitem' => 'App\\Models\\SaleReturnItem',
              'user' => 'App\\Models\\User',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\SaleReturn',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'sale',
               'type' => 'App\\Models\\Sale',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'lines',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\Services\\SaleService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\SaleService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Implements the POS checkout data flow from architecture.md §1.2: validates
 * stock, decrements each sold batch, records the sale, splits payment across
 * cash/bank/ledger, and posts a customer-ledger entry for any on-account
 * portion — all inside one transaction (see rules.md §2).
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
          'payabletype' => 'App\\Enums\\PayableType',
          'paymentmethod' => 'App\\Enums\\PaymentMethod',
          'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
          'insufficientstockexception' => 'App\\Exceptions\\InsufficientStockException',
          'batch' => 'App\\Models\\Batch',
          'customer' => 'App\\Models\\Customer',
          'payment' => 'App\\Models\\Payment',
          'sale' => 'App\\Models\\Sale',
          'saleitem' => 'App\\Models\\SaleItem',
          'user' => 'App\\Models\\User',
          'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
          'db' => 'Illuminate\\Support\\Facades\\DB',
          'str' => 'Illuminate\\Support\\Str',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'paymentSplitService',
               'type' => 'App\\Services\\PaymentSplitService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ledgerService',
               'type' => 'App\\Services\\LedgerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @param  list<array{batch_id: int, quantity: string, unit_price: string}>  $items
     * @param  list<array{method: string, amount: string, bank_id: ?int}>  $paymentLines
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'ledgerentrytype' => 'App\\Enums\\LedgerEntryType',
              'payabletype' => 'App\\Enums\\PayableType',
              'paymentmethod' => 'App\\Enums\\PaymentMethod',
              'transactionreferencetype' => 'App\\Enums\\TransactionReferenceType',
              'insufficientstockexception' => 'App\\Exceptions\\InsufficientStockException',
              'batch' => 'App\\Models\\Batch',
              'customer' => 'App\\Models\\Customer',
              'payment' => 'App\\Models\\Payment',
              'sale' => 'App\\Models\\Sale',
              'saleitem' => 'App\\Models\\SaleItem',
              'user' => 'App\\Models\\User',
              'uploadedfile' => 'Illuminate\\Http\\UploadedFile',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\Sale',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'customer',
               'type' => '?App\\Models\\Customer',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'items',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'paymentLines',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'photo',
               'type' => '?Illuminate\\Http\\UploadedFile',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\AppLayout.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\View\\Components\\AppLayout',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\View\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the view / contents that represents the component.
     */',
             'namespace' => 'App\\View\\Components',
             'uses' => 
            array (
              'component' => 'Illuminate\\View\\Component',
              'view' => 'Illuminate\\View\\View',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\Users\\shehr\\OneDrive\\Desktop\\Personal Projects\\PesticidesManagmentSystem\\app\\View\\Components\\GuestLayout.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\View\\Components\\GuestLayout',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\View\\Component',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'render',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the view / contents that represents the component.
     */',
             'namespace' => 'App\\View\\Components',
             'uses' => 
            array (
              'component' => 'Illuminate\\View\\Component',
              'view' => 'Illuminate\\View\\View',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
