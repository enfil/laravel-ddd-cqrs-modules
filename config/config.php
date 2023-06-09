<?php

use Enfil\Laravel\DddCqrs\ModulesActivators\FileArrayActivator;
use Nwidart\Modules\Commands\CommandMakeCommand;
use Nwidart\Modules\Commands\ControllerMakeCommand;
use Nwidart\Modules\Commands\DisableCommand;
use Nwidart\Modules\Commands\DumpCommand;
use Nwidart\Modules\Commands\EnableCommand;
use Nwidart\Modules\Commands\EventMakeCommand;
use Nwidart\Modules\Commands\FactoryMakeCommand;
use Nwidart\Modules\Commands\InstallCommand;
use Nwidart\Modules\Commands\JobMakeCommand;
use Nwidart\Modules\Commands\LaravelModulesV6Migrator;
use Nwidart\Modules\Commands\ListCommand;
use Nwidart\Modules\Commands\ListenerMakeCommand;
use Nwidart\Modules\Commands\MailMakeCommand;
use Nwidart\Modules\Commands\MiddlewareMakeCommand;
use Nwidart\Modules\Commands\MigrateCommand;
use Nwidart\Modules\Commands\MigrateRefreshCommand;
use Nwidart\Modules\Commands\MigrateResetCommand;
use Nwidart\Modules\Commands\MigrateRollbackCommand;
use Nwidart\Modules\Commands\MigrateStatusCommand;
use Nwidart\Modules\Commands\MigrationMakeCommand;
use Nwidart\Modules\Commands\ModelMakeCommand;
use Nwidart\Modules\Commands\ModuleDeleteCommand;
use Nwidart\Modules\Commands\ModuleMakeCommand;
use Nwidart\Modules\Commands\NotificationMakeCommand;
use Nwidart\Modules\Commands\PolicyMakeCommand;
use Nwidart\Modules\Commands\ProviderMakeCommand;
use Nwidart\Modules\Commands\PublishCommand;
use Nwidart\Modules\Commands\PublishConfigurationCommand;
use Nwidart\Modules\Commands\PublishMigrationCommand;
use Nwidart\Modules\Commands\PublishTranslationCommand;
use Nwidart\Modules\Commands\RequestMakeCommand;
use Nwidart\Modules\Commands\ResourceMakeCommand;
use Nwidart\Modules\Commands\RouteProviderMakeCommand;
use Nwidart\Modules\Commands\RuleMakeCommand;
use Nwidart\Modules\Commands\SeedCommand;
use Nwidart\Modules\Commands\SeedMakeCommand;
use Nwidart\Modules\Commands\SetupCommand;
use Nwidart\Modules\Commands\TestMakeCommand;
use Nwidart\Modules\Commands\UnUseCommand;
use Nwidart\Modules\Commands\UpdateCommand;
use Nwidart\Modules\Commands\UseCommand;

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Modules',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => false,
        'path' => base_path() . '/app/Modules/Stubs',
        'files' => [
            'routes/api' => 'routes.php',
            'scaffold/config' => 'Config/config.php',
            'composer' => 'composer.json',
        ],
        'replacements' => [
            'routes/api' => ['LOWER_NAME', 'MODULE_NAMESPACE', 'STUDLY_NAME'],
            'webpack' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'PROVIDER_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME', 'LOWER_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
                'PROVIDER_NAMESPACE',
            ],
        ],
        'gitkeep' => true,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
        */

        'modules' => base_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
        */

        'assets' => public_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
        */
        'generator' => [
            // DOMAIN -------------------------------------------
            'src' => ['path' => 'Domain/', 'generate' => true],
            'entity' => ['path' => 'Domain/Entity', 'generate' => true],
            'use-case' => ['path' => 'Domain/UseCase', 'generate' => true],
            'event' => ['path' => 'Domain/Event', 'generate' => true],
            'repository' => ['path' => 'Domain/Repository', 'generate' => true],
            // --------------------------------------------------

            // APPLICATION --------------------------------------
            'listener' => ['path' => 'App\Listener', 'generate' => true],
            'adapter' => ['path' => 'App\Adapter', 'generate' => true],
            'service' => ['path' => 'App\Service', 'generate' => true],
            'provider' => ['path' => 'App\Provider', 'generate' => true],
            // --------------------------------------------------

            // INFRASTRUCTURE -----------------------------------
            'config' => ['path' => 'Inf\Config', 'generate' => true],
            'migration' => ['path' => 'Inf\Database/Migration', 'generate' => true],
            'seeder' => ['path' => 'Inf\Database/Seeder', 'generate' => true],
            'factory' => ['path' => 'Inf\Database/Factory', 'generate' => true],
            'jobs' => ['path' => 'Inf\Job', 'generate' => false],
            'repository-implementation' => ['path' => 'Inf\Repository', 'generate' => true],
            'read-model' => ['path' => 'Inf\ReadModel', 'generate' => true],
            // --------------------------------------------------

            // PRESENTATION -------------------------------------
            'console' => ['path' => 'Pres\Console', 'generate' => true],
            'controller' => ['path' => 'Pres\Http/V1/Controller', 'generate' => true],
            'middleware' => ['path' => 'Pres\Http/V1/Middleware', 'generate' => true],
            'request' => ['path' => 'Pres\Http/V1/Request', 'generate' => true],
            'view' => ['path' => 'Pres\Resource/view', 'generate' => false],
            // --------------------------------------------------

            // TESTING ------------------------------------------
            'unit-test' => ['path' => 'Test/Codeception/tests/unit', 'generate' => true],
            // --------------------------------------------------
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Package commands
    |--------------------------------------------------------------------------
    |
    | Here you can define which commands will be visible and used in your
    | application. If for example you don't use some of the commands provided
    | you can simply comment them out.
    |
    */
    'commands' => [
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        InstallCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        FactoryMakeCommand::class,
        PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        PublishCommand::class,
        PublishConfigurationCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        SetupCommand::class,
        UnUseCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
        LaravelModulesV6Migrator::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => true,
        'paths' => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'enfil',
        'author' => [
            'name' => 'Enfil',
        ],
    ],

    'composer-output' => false,

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
    */
    'activators' => [
        'file' => [
            'class' => FileArrayActivator::class,
            'statuses-file' => base_path('modules_statuses.php'),
            'cache-key' => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator' => 'file',
];
