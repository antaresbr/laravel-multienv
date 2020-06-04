<?php

namespace Antares\Multienv;

class Resources
{
    private $bootstrapAppPhp;
    private $bootstrapEnvPhp;

    public function __construct()
    {
        $this->bootstrapAppPhp = 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';
        $this->bootstrapEnvPhp = 'bootstrap' . DIRECTORY_SEPARATOR . 'env.php';
    }

    public function sourceBootstrapAppPhp()
    {
        return multienv_path($this->bootstrapAppPhp);
    }

    public function sourceBootstrapEnvPhp()
    {
        return multienv_path($this->bootstrapEnvPhp);
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
