<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Support\Str;

class EntityMakeCommand extends AbstractFullMakeCommand
{
    protected $argumentName = 'name';

    protected $signature = 'module:make-entity {name} {module} {--type=clear} {--force}';

    protected function getStubPath(): string
    {
        return 'entity/entity-' . $this->optionString('type');
    }

    protected function getGeneratorName(): string
    {
        return 'entity';
    }

    protected function getFileName(): string
    {
        return Str::studly($this->argumentString('name') ?? $this->argumentString('module'));
    }
}
