<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\UseCase;

class HandlerMakeCommand extends AbstractUseCaseMakeCommand
{
    protected $signature = 'module:make-use-case-handler {name} {module} {--type=create} {--force}';

    protected function getStubPath(): string
    {
        return 'use-case/' . $this->optionString('type') . '/handler';
    }

    protected function getGeneratorName(): string
    {
        return 'use-case';
    }

    protected function getFileName(): string
    {
        return $this->option('type') === 'abstract' ? 'AbstractCommandHandler' : 'Handler';
    }
}
