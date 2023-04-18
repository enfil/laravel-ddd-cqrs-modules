<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BaseUnitTestsMakeCommand extends Command
{
    protected $signature = 'module:make-base-unit-tests {name} {module} {--force}';

    public function handle(): int
    {
        foreach (['create', 'edit', 'remove'] as $type) {
            $this->call('module:make-unit-test', [
                'name' => $this->argument('name'),
                'module' => $this->argument('module'),
                '--type' => $type
            ]);
        }
        return 1;
    }
}
