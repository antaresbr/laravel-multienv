<?php

namespace Antares\Multienv;

class Resources
{
    private $bootstrapAppPhp;
    private $bootstrapEnvPhp;

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
        $this->bootstrapEnvPhp = $this->bootstrapStub('env.php');
    }

    public function sourceBootstrapAppPhp()
    {
        return multienv_path($this->resourceStub($this->bootstrapAppPhp));
    }

    public function sourceBootstrapEnvPhp()
    {
        return multienv_path($this->resourceStub($this->bootstrapEnvPhp));
    }

    public function targetBootstrapAppPhp()
    {
        return base_path($this->bootstrapAppPhp);
    }

    public function targetBootstrapEnvPhp()
    {
        return base_path($this->bootstrapEnvPhp);
    }
}
