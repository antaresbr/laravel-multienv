<?php

namespace Antares\Multienv\Tests\Unit;

use Antares\Multienv\Resources;
use Antares\Multienv\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class SetupCommandTest extends TestCase
{
    private function certifyDirectory($target)
    {
        $targetDir = base_path($target);
        if (!file_exists($targetDir)) {
            mkdir($targetDir);
        }
        $this->assertDirectoryExists($targetDir);
    }

    /** @test */
    public function execute_and_validate_setup_command()
    {
        $this->certifyDirectory('bootstrap');
        $this->certifyDirectory('env');

        Artisan::call('antares:multienv-setup');
        $this->logText(Artisan::output(), 'Artisan::output()');

        $resources = new Resources();

        $this->assertFileExists($resources->targetBootstrapAppPhp());
        $this->assertFileEquals($resources->targetBootstrapAppPhp(), $resources->sourceBootstrapAppPhp());

        $this->assertFileExists($resources->targetBootstrapEnvPhp());
        $this->assertFileEquals($resources->targetBootstrapEnvPhp(), $resources->sourceBootstrapEnvPhp());
    }
}
