<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Support\Str;
use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Module;
use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;

abstract class AbstractFullMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    protected $argumentName = 'name';

    abstract protected function getStubPath(): string;

    abstract protected function getGeneratorName(): string;

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $stub = $this->getStubPath();

        /** @var Module $module */
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub('/' . $stub . '.stub', [
            'NAMESPACE'         => $this->getClassNamespace($module),
            'CLASS'             => $this->getClass(),
            'CLASS_SNAKE_NAME'  => Str::snake($this->getClass()),
            'CLASS_CAMEL_NAME'  => Str::camel($this->getClass()),
            'LOWER_NAME'        => $module->getLowerName(),
            'SNAKE_NAME'        => $module->getSnakeName(),
            'MODULE'            => $this->getModuleName(),
            'STUDLY_NAME'       => $module->getStudlyName(),
            'SUB_NAMESPACE'      => $this->getSubNamespace(),
            'MODULE_NAMESPACE'  => $this->laravel['modules']->config('namespace'),
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read($this->getGeneratorName());

        return $path .
            $generatorPath->getPath() . '/' .
            $this->getSubDirectory() .
            $this->getFileName() . '.php';
    }

    protected function getFileName(): string
    {
        return Str::studly($this->argumentString('name'));
    }

    protected function getSubNamespace(): string
    {
        return '';
    }

    protected function getSubDirectory(): string
    {
        return '';
    }

    protected function argumentString(string $key): string
    {
        $argument = $this->argument($key);
        if (!is_array($argument)) {
            return $argument ?? '';
        }
        return '';
    }

    protected function argumentArray(string $key): array
    {
        $argument = $this->argument($key);
        if (!is_array($argument)) {
            return [];
        }
        return $argument;
    }

    protected function optionString(string $key): string
    {
        $argument = $this->option($key);
        if (!is_array($argument)) {
            return (string) $argument ?? '';
        }
        return '';
    }
}
