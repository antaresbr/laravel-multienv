<?php

namespace Antares\Multienv\Console;

use Antares\Multienv\Resources;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SetupCommand extends Command
{
    protected $signature = 'antares:multienv-setup';

    protected $description = 'Setup this as a multienvironment (multi tenant) application.';

    protected function relativeToBasePath($path)
    {
        if (Str::startsWith($path, base_path())) {
            return Str::replaceFirst(DIRECTORY_SEPARATOR, '', Str::after($path, base_path()));
        }
        return $path;
    }

    protected function copyFile($sourceFile, $targetFile, $force = false)
    {
        if (is_file($targetFile) and !$force) {
            $this->warn('File already exists: ' . $this->relativeToBasePath($targetFile));
        } else {
            if (!is_file($sourceFile)) {
                $this->error('Source file not found: ' . $this->relativeToBasePath($sourceFile));
            } else {
                if (copy($sourceFile, $targetFile)) {
                    $this->info('Copied file: ' . $this->relativeToBasePath($targetFile));
                } else {
                    $this->error('Failed to copy file: ' . $this->relativeToBasePath($targetFile));
                }
            }
        }
    }

    protected function moveFile($sourceFile, $targetFile)
    {
        if (!is_file($sourceFile)) {
            $this->warn((is_file($targetFile) ? 'File already moved: ' : 'File not found: ') . $this->relativeToBasePath($sourceFile));
        } else {
            $targetDir = dirname($targetFile);
            if (!file_exists($targetDir)) {
                mkdir($targetDir);
            }
            if (!is_dir($targetDir)) {
                $this->error('Invalid directory: ' . $this->relativeToBasePath($targetDir));
            } else {
                if (is_file($targetFile)) {
                    $this->warn('File already exists: ' . $this->relativeToBasePath($targetFile));
                } else {
                    if (rename($sourceFile, $targetFile)) {
                        $this->info('Moved file: ' . $this->relativeToBasePath($targetFile));
                    } else {
                        $this->error('Failed to move file: ' . $this->relativeToBasePath($sourceFile));
                    }
                }
            }
        }
    }

    protected function env_path($path)
    {
        $r = base_path('env');
        if (!empty($path)) {
            $r .= DIRECTORY_SEPARATOR . $path;
        }
        return $r;
    }

    public function handle()
    {
        $resources = new Resources();

        $this->copyFile($resources->sourceBootstrapAppPhp(), $resources->targetBootstrapAppPhp(), true);
        $this->copyFile($resources->sourceBootstrapEnvPhp(), $resources->targetBootstrapEnvPhp());

        $this->moveFile(base_path('.env.example'), $this->env_path('.env.example'));
        $this->moveFile(base_path('.env'), $this->env_path('.env.local'));
    }
}
