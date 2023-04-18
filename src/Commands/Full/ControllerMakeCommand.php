<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Nwidart\Modules\Support\Stub;

class ControllerMakeCommand extends \Nwidart\Modules\Commands\ControllerMakeCommand
{
    protected $signature = 'module:make-api-controller {controller} {module} {--plain} {--api}';

    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'MODULENAME'        => $module->getStudlyName(),
            'CONTROLLERNAME'    => $this->getControllerName(),
            'NAMESPACE'         => $module->getStudlyName(),
            'CLASS_NAMESPACE'   => $this->getClassNamespace($module),
            'CLASS'             => $this->getControllerNameWithoutNamespace(),
            'ONLY_NAME'         => str_replace(
                'Controller',
                '',
                $this->getControllerNameWithoutNamespace()
            ),
            'LOWER_NAME'        => $module->getLowerName(),
            'MODULE'            => $this->getModuleName(),
            'NAME'              => $this->getModuleName(),
            'STUDLY_NAME'       => $module->getStudlyName(),
            'MODULE_NAMESPACE'  => $this->laravel['modules']->config('namespace'),
        ]))->render();
    }

    protected function getControllerName(): string
    {
        if (is_array(parent::getControllerName())) {
            return '';
        }
        return parent::getControllerName();
    }

    private function getControllerNameWithoutNamespace(): string
    {
        return class_basename($this->getControllerName());
    }
}
