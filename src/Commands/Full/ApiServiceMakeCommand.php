<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Support\Str;

class ApiServiceMakeCommand extends AbstractFullMakeCommand
{
    protected $signature = 'module:make-api-service {name} {module} {--force}';

    protected function getStubPath(): string
    {
        return 'api/api-service';
    }

    protected function getGeneratorName(): string
    {
        return 'api';
    }

    protected function getFileName(): string
    {
        return Str::studly($this->argumentString('name')) . 'Service';
    }
}
