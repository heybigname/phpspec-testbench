<?php
namespace Pixelindustries\PhpspecTestbench;

use Exception;
use PhpSpec\Laravel\Util;

/**
 * This class provides an entry point into Laravel for PhpSpec.
 */
class Laravel extends Util\Laravel
{
    public function __construct($env, $appClassName = null)
    {
        $this->env          = $env ?: 'testing';
        $this->appPath      = dirname(dirname(__DIR__)) . 'orchestra/testbench/fixture';
        $this->appClassName = $appClassName ?: App::class;
    }

    /**
     * Creates a Laravel application.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected function createApplication()
    {
        putenv('APP_ENV=' . $this->getEnv());

        if (!is_a($this->appClassName, App::class, true)) {
            throw new Exception("Instance of Pixelindustries\\PhpspecTestbench\\App expected, got {$this->appClassName}.");
        }

        return (new $this->appClassName)->createApplication();
    }
}
