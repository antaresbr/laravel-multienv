<?php

namespace Antares\Multienv\Console;

use Antares\Multienv\Resources;
use Illuminate\Console\Command;

class SetupCommand extends Command
{
    protected $signature = 'antares:multienv-setup';

    protected $description = 'Setup this as a multienvironment (multi tenant) application.';

    public function copyFile($sourceFile, $targetFile)
    {
        if (is_file($targetFile)) {
            $this->warn('File already exists: ' . $targetFile);
        } else {
            if (!is_file($sourceFile)) {
                $this->error('Source file not found: ' . $sourceFile);
            } else {
                if (copy($sourceFile, $targetFile)) {
                    $this->info('Copied file: ' . $targetFile);
                } else {
                    $this->error('Failed to copy file: ' . $targetFile);
                }
            }
        }
    }

    public function handle()
    {
        $resources = new Resources();

        $this->copyFile($resources->sourceBootstrapAppPhp(), $resources->targetBootstrapAppPhp());

        $this->copyFile($resources->sourceBootstrapEnvPhp(), $resources->targetBootstrapEnvPhp());
    }
}
