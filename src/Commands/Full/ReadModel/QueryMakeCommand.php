<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\ReadModel;

class QueryMakeCommand extends AbstractReadModelMakeCommand
{
    protected $signature = 'module:make-read-model-query {name} {module} {--type=paginated} {--force}';

    public function handle(): int
    {
        if ($this->getStubPath() === '') {
            return 1;
        }
        return parent::handle();
    }

    protected function getStubPath(): string
    {
        if ($this->option('type') === 'count') {
            return '';
        }
        return 'read-model/' . $this->optionString('type') . '/query';
    }

    protected function getGeneratorName(): string
    {
        return 'read-model';
    }

    protected function getFileName(): string
    {
        return 'Query';
    }
}
