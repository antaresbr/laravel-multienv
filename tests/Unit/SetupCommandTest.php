<?php

namespace Antares\Multienv\Tests\Unit;

use Antares\Multienv\Resources;
use Orchestra\Testbench\TestCase;

class SetupCommandTest extends TestCase
{
    /** @test */
    public function execute_and_validate_setup_command()
    {
        $targetDir = base_path('bootstrap');
        if (!file_exists($targetDir)) {
            mkdir($targetDir);
        }
        $this->assertDirectoryExists($targetDir);

        $this->artisan('antares:multienv-setup')->assertExitCode(0);

        $resources = new Resources();

        $this->assertFileExists($resources->targetBootstrapAppPhp());
        $this->assertFileEquals($resources->targetBootstrapAppPhp(), $resources->sourceBootstrapAppPhp());

        $this->assertFileExists($resources->targetBootstrapEnvPhp());
        $this->assertFileEquals($resources->targetBootstrapEnvPhp(), $resources->sourceBootstrapEnvPhp());
    }
}
