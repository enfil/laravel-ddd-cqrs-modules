<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nwidart\Modules\Traits\ModuleCommandTrait;

class CrudModuleMakeCommand extends Command
{
    use ModuleCommandTrait;

    protected $signature = 'module:make-structure
    {module}
    {entities?*}
    {--with-module=1}
    {--with-controller=1}
    {--with-api-service=1}
    {--with-read-models=1}
    {--with-entities=1}
    {--with-exception=1}
    {--with-repo-interface=1}
    {--with-repo=1}
    {--with-use-cases=1}
    {--with-requests=1}
    {--with-migration=1}
    {--with-tests=1}
    {--entity-type=clear}
    {--exception-type=not-found}
    {--force}';

    public function handle(): int
    {
        if ($this->option('with-module')) {
            $this->createModule();
        }
        $entities = $this->argument('entities');
        if (!is_array($entities)) {
            $this->error('Error in entities argument');
            return 0;
        }
        foreach ($entities as $entity) {
            $entity = Str::studly($entity);
            if ($this->option('with-controller')) {
                $this->createController($entity);
            }
            if ($this->option('with-api-service')) {
                $this->createApiService($entity);
            }
            if ($this->option('with-read-models')) {
                $this->createReadModels($entity);
            }
            if ($this->option('with-entities')) {
                $this->createEntity($entity);
            }
            if ($this->option('with-exception')) {
                $this->createException($entity);
            }
            if ($this->option('with-repo-interface')) {
                $this->createRepo($entity);
            }
            if ($this->option('with-repo')) {
                $this->createRepo($entity, false);
            }
            if ($this->option('with-use-cases')) {
                $this->createUseCases($entity);
            }
            if ($this->option('with-requests')) {
                $this->createRequest($entity);
                $this->createRequest($entity, 'Store');
            }
            if ($this->option('with-migration')) {
                $this->createMigration($entity);
            }
            if ($this->option('with-tests')) {
                $this->createUnitTests($entity);
            }
        }
        return 1;
    }

    protected function createModule(): int
    {
        return $this->call('module:make', [
            'name' => [$this->argument('module')],
            '--force' => $this->option('force'),
            '--api' => true
        ]);
    }

    protected function createController(string $entity): int
    {
        return $this->call('module:make-api-controller', [
            'controller' => $entity . 'Controller',
            'module' => $this->argument('module'),
        ]);
    }

    protected function createApiService(string $entity): int
    {
        return $this->call("module:make-api-service", [
            'name' => $entity,
            'module' => $this->argument('module'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createReadModels(string $entity): int
    {
        return $this->call("module:make-base-read-model", [
            'name' => $entity,
            'module' => $this->argument('module'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createEntity(string $entity): int
    {
        return $this->call("module:make-entity", [
            'name' => $entity,
            'module' => $this->argument('module'),
            '--type' => $this->option('entity-type'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createException(string $entity): int
    {
        return $this->call("module:make-exception", [
            'name' => $entity,
            'module' => $this->argument('module'),
            '--type' => $this->option('exception-type'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createRepo(string $entity, bool $interface = true): int
    {
        return $this->call("module:make-repository", [
            'name' => $entity,
            'module' => $this->argument('module'),
            'interface' => $interface ? 1 : 0,
            '--type' => $this->option('entity-type'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createUseCases(string $entity): int
    {
        return $this->call("module:make-base-use-cases", [
            'name' => $entity,
            'module' => $this->argument('module'),
            '--force' => $this->option('force'),
        ]);
    }

    protected function createRequest(string $entity, string $type = 'Index'): int
    {
        return $this->call("module:make-request", [
            'name' => $entity . $type . 'Request',
            'module' => $this->argument('module'),
        ]);
    }

    protected function createMigration(string $entity): int
    {
        return $this->call("module:make-migration", [
            'name' => 'create_' . Str::snake($entity) . '_table',
            'module' => $this->argument('module'),
        ]);
    }

    protected function createUnitTests(string $entity): int
    {
        return $this->call("module:make-base-unit-tests", [
            'name' => $entity,
            'module' => $this->argument('module'),
        ]);
    }
}
