<?php

namespace Enfil\Laravel\DddCqrs\Modules\Commands\Full;

use Illuminate\Support\Str;

class CodeceptionUnitTestMakeCommand extends AbstractFullMakeCommand
{
    protected $signature = 'module:make-unit-test {name} {module} {--type}';

    public function handle(): int
    {
        $testsPath = "modules/{$this->argumentString('module')}/Test/Codeception";
        if (!file_exists(base_path("$testsPath/codeception.yml"))) {
            $this->executeCommand(
                "php vendor/codeception/codeception/codecept bootstrap --namespace {$this->argumentString('module')}Test {$testsPath}"
            );
        }
        return parent::handle();
    }

    /**
     * @param string $command
     */
    private function executeCommand(string $command): void
    {
        passthru($command);
    }

    protected function getStubPath(): string
    {
        return "unit-test/{$this->optionString('type')}-test";
    }

    protected function getGeneratorName(): string
    {
        return 'unit-test';
    }

    protected function getFileName(): string
    {
        return Str::studly($this->optionString('type')) . $this->argumentString('name') . 'Test';
    }

    protected function getSubDirectory(): string
    {
        return Str::studly($this->argumentString('name')) . '/';
    }

    protected function getSubNamespace(): string
    {
        return $this->getSub();
    }

    protected function getSub(): string
    {
        return Str::studly($this->argumentString('name'));
    }
}
