<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\ReadModel;

use Enfil\Laravel\DddCqrs\Modules\Commands\Full\AbstractFullMakeCommand;
use Illuminate\Support\Str;

abstract class AbstractReadModelMakeCommand extends AbstractFullMakeCommand
{
    protected function getSubDirectory(): string
    {
        return Str::studly($this->argumentString('name')) . '/' . $this->getSubPath();
    }

    protected function getSubNamespace(): string
    {
        return $this->getSub();
    }

    protected function getSubPath(): string
    {
        return "{$this->getSub()}/";
    }

    protected function getSub(): string
    {
        switch ($this->optionString('type')) {
            case 'paginated':
                return 'PaginatedList';
            case 'single-item':
                return 'SingleItem';
            case 'count':
                return 'Count';
            default:
                return '';
        }
    }
}
