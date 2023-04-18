<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Console\Command;

class ReadModelMakeCommand extends Command
{
    protected $signature = 'module:make-read-model {name} {module} {--type=single-item} {--force}';

    public function handle(): int
    {
        $type = $this->option('type');
        $this->createHandler($type);
        $this->createQuery($type);
        $this->createQueryResultItem($type);
        return 1;
    }

    /**
     * @param mixed $type
     * @return int
     */
    protected function createHandler($type): int
    {
        return $this->call('module:make-read-model-handler', [
            'name' => $this->argument('name'),
            'module' => $this->argument('module'),
            '--type' => $type,
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * @param mixed $type
     * @return int
     */
    protected function createQuery($type): int
    {
        return $this->call('module:make-read-model-query', [
            'name' => $this->argument('name'),
            'module' => $this->argument('module'),
            '--type' => $type,
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * @param mixed $type
     * @return int
     */
    protected function createQueryResultItem($type): int
    {
        return $this->call('module:make-read-model-query-result-item', [
            'name' => $this->argument('name'),
            'module' => $this->argument('module'),
            '--type' => $type,
            '--force' => $this->option('force'),
        ]);
    }
}
