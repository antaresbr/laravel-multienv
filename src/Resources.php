<?php

namespace Antares\Multienv;

class Resources
{
    private $bootstrapAppPhp;
    private $bootstrapMultiEnvPhp;

    protected function bootstrapStub($stub)
    {
        return 'bootstrap' . DIRECTORY_SEPARATOR . $stub;
    }

    protected function resourceStub($stub)
    {
        return 'resources' . DIRECTORY_SEPARATOR . $stub;
    }

    public function __construct()
    {
        $this->bootstrapAppPhp = $this->bootstrapStub('app.php');
        $this->bootstrapMultiEnvPhp = $this->bootstrapStub('multienv.php');
    }

    public function sourceBootstrapAppPhp()
    {
        return ai_multienv_path($this->resourceStub($this->bootstrapAppPhp));
    }

    public function sourceBootstrapMultiEnvPhp()
    {
        return ai_multienv_path($this->resourceStub($this->bootstrapMultiEnvPhp));
    }

    public function targetBootstrapAppPhp()
    {
        return base_path($this->bootstrapAppPhp);
    }

    public function targetBootstrapMultiEnvPhp()
    {
        return base_path($this->bootstrapMultiEnvPhp);
    }
}
