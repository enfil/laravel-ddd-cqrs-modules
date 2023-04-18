<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\ReadModel;

class HandlerMakeCommand extends AbstractReadModelMakeCommand
{
    protected $signature = 'module:make-read-model-handler {name} {module} {--type=paginated} {--force}';

    protected function getStubPath(): string
    {
        return 'read-model/' . $this->optionString('type') . '/handler';
    }

    protected function getGeneratorName(): string
    {
        return 'read-model';
    }

    protected function getFileName(): string
    {
        return 'Handler';
    }
}
