<?php

namespace Pixelindustries\PhpspecTestbench;

use Orchestra\Testbench\Traits\ApplicationTrait;
use Illuminate\Foundation\Testing\ApplicationTrait as FoundationTrait;

class App
{
  use FoundationTrait;
  use ApplicationTrait;

  protected function getEnvironmentSetUp($app)
  {
      
  }
}
