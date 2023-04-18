<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full\UseCase;

use Enfil\Laravel\DddCqrs\Modules\Commands\Full\AbstractFullMakeCommand;
use Illuminate\Support\Str;

abstract class AbstractUseCaseMakeCommand extends AbstractFullMakeCommand
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
        $sub = $this->getSub();
        return'' === $sub ? '' : "{$sub}/";
    }

    protected function getSub(): string
    {
        switch ($this->optionString('type')) {
            case 'create':
                return 'Create' . Str::studly($this->argumentString('name'));
            case 'edit':
                return 'Edit' . Str::studly($this->argumentString('name'));
            case 'remove':
                return 'Remove' . Str::studly($this->argumentString('name'));
            default:
                return '';
        }
    }
}
