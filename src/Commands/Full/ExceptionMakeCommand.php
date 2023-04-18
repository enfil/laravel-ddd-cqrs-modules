<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Support\Str;

class ExceptionMakeCommand extends AbstractFullMakeCommand
{
    protected $argumentName = 'name';

    protected $signature = 'module:make-exception {name} {module} {--type=not-found} {--force}';

    protected function getStubPath(): string
    {
        return 'exception/entity-' . $this->optionString('type');
    }

    protected function getGeneratorName(): string
    {
        return 'exception';
    }

    protected function getFileName(): string
    {
        return Str::studly('EntityNotFoundException');
    }
}
