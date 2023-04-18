<?php

namespace Enfil\Laravel\DddCqrs\Modules;

use Enfil\Laravel\DddCqrs\Modules\Commands\Full\ApiServiceMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\BaseUnitTestsMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\BaseUseCasesMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\CodeceptionUnitTestMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\ControllerMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\EntityMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\BaseReadModelsMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\ExceptionMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\ReadModel;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\UseCase;
use Enfil\Laravel\DddCqrs\Modules\Commands\CrudModuleMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\ReadModelMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\RepositoryMakeCommand;
use Enfil\Laravel\DddCqrs\Modules\Commands\Full\UseCaseMakeCommand;
use Illuminate\Support\ServiceProvider;

class ModuleGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands(
            [
                CrudModuleMakeCommand::class,
                ControllerMakeCommand::class,
                ApiServiceMakeCommand::class,
                EntityMakeCommand::class,
                ExceptionMakeCommand::class,
                RepositoryMakeCommand::class,
                BaseReadModelsMakeCommand::class,
                ReadModelMakeCommand::class,
                UseCaseMakeCommand::class,
                BaseUseCasesMakeCommand::class,
                ReadModel\HandlerMakeCommand::class,
                ReadModel\QueryMakeCommand::class,
                ReadModel\QueryResultItemMakeCommand::class,
                UseCase\HandlerMakeCommand::class,
                UseCase\CommandMakeCommand::class,
                CodeceptionUnitTestMakeCommand::class,
                BaseUnitTestsMakeCommand::class,
            ]
        );
    }
}
