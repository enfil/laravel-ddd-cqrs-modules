<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Console\Command;

class UseCaseMakeCommand extends Command
{
    protected $signature = 'module:make-use-case {name} {module} {--type=create} {--force}';

    public function handle(): int
    {
        $type = $this->option('type');
        $this->createHandler($type);
        $this->createCommand($type);
        return 1;
    }

    /**
     * @param mixed $type
     * @return int
     */
    protected function createHandler($type): int
    {
        return $this->call('module:make-use-case-handler', [
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
    protected function createCommand($type): int
    {
        return $this->call('module:make-use-case-command', [
            'name' => $this->argument('name'),
            'module' => $this->argument('module'),
            '--type' => $type,
            '--force' => $this->option('force'),
        ]);
    }
}
