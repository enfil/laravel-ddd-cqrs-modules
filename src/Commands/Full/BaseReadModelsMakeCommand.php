<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Console\Command;

class BaseReadModelsMakeCommand extends Command
{
    protected $signature = 'module:make-base-read-models {name} {module} {--force}';

    public function handle(): int
    {
        foreach (['single-item', 'paginated', 'count'] as $type) {
            $this->call('module:make-read-model', [
                'name' => $this->argument('name'),
                'module' => $this->argument('module'),
                '--type' => $type,
                '--force' => $type,
            ]);
        }
        return 1;
    }
}
