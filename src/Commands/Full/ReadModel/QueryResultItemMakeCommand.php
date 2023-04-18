<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\ReadModel;

class QueryResultItemMakeCommand extends AbstractReadModelMakeCommand
{
    protected $signature = 'module:make-read-model-query-result-item {name} {module} {--type=paginated} {--force}';

    protected function getStubPath(): string
    {
        return 'read-model/query-result-item';
    }

    protected function getGeneratorName(): string
    {
        return 'read-model';
    }

    protected function getFileName(): string
    {
        return 'QueryResultItem';
    }
}
