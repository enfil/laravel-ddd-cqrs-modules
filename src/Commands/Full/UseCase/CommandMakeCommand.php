<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\UseCase;

class CommandMakeCommand extends AbstractUseCaseMakeCommand
{
    protected $signature = 'module:make-use-case-command {name} {module} {--type=create} {--force}';

    public function handle(): int
    {
        if ($this->getStubPath() === '') {
            return 1;
        }
        return parent::handle();
    }

    protected function getStubPath(): string
    {
        if ($this->option('type') === 'abstract') {
            return '';
        }
        return 'use-case/' . $this->optionString('type') . '/command';
    }

    protected function getGeneratorName(): string
    {
        return 'use-case';
    }

    protected function getFileName(): string
    {
        return 'Command';
    }
}
