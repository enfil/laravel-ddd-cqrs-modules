<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Console\Command;

class BaseUseCasesMakeCommand extends Command
{
    protected $signature = 'module:make-base-use-cases {name} {module} {--force}';

    public function handle(): int
    {
        foreach (['abstract', 'create', 'edit', 'remove'] as $type) {
            $this->call('module:make-use-case', [
                'name' => $this->argument('name'),
                'module' => $this->argument('module'),
                '--type' => $type,
                '--force' => $type,
            ]);
        }
        return 1;
    }
}
