<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Support\Str;

class RepositoryMakeCommand extends AbstractFullMakeCommand
{
    protected $argumentName = 'name';

    protected $signature = 'module:make-repository {name} {module} {interface=1} {--type=clear} {--force}';

    protected function getStubPath(): string
    {
        return
            'repository/' .
            ((bool) $this->argument('interface') ?
                'interface' :
                'implementation-' . $this->optionString('type'));
    }

    protected function getGeneratorName(): string
    {
        return (bool) $this->argument('interface') ? 'repository' : 'repository-implementation';
    }

    protected function getFileName(): string
    {
        return Str::studly($this->argumentString('name') ?? $this->argumentString('module')) .
            ((bool) $this->argument('interface') ? 'RepositoryInterface' : 'Repository');
    }
}
