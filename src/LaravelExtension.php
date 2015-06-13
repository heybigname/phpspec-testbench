<?php
namespace Pixelindustries\PhpspecTestbench;

use PhpSpec\ServiceContainer;
use PhpSpec\Laravel\Extension;
use PhpSpec\Laravel\Listener\LaravelListener;
use PhpSpec\Laravel\Runner\Maintainer\LaravelMaintainer;
use PhpSpec\Laravel\Runner\Maintainer\PresenterMaintainer;

/**
 * Setup the Laravel extension.
 *
 * Bootstraps Laravel and sets up some objects in the Container.
 */
class LaravelExtension extends Extension\LaravelExtension
{
    /**
     * Setup the Laravel extension.
     *
     * @param  \PhpSpec\ServiceContainer $container
     * @return void
     */
    public function load(ServiceContainer $container)
    {
        // Create & store Laravel wrapper

        $container->setShared(
            'laravel',
            function (ServiceContainer $c) {
                $config = $c->getParam('laravel_extension');

                $laravel = new Laravel(
                    isset($config['testing_environment']) ? $config['testing_environment'] : null,
                    isset($config['app_classname']) ? $config['app_classname'] : null
                );

                return $laravel;
            }
        );

        // Bootstrap maintainer to bind Laravel wrapper to specs

        $container->setShared(
            'runner.maintainers.laravel',
            function (ServiceContainer $c) {
                return new LaravelMaintainer(
                    $c->get('laravel')
                );
            }
        );

        // Bootstrap maintainer to bind app Presenter to specs, so it
        // can be passed to custom matchers

        $container->setShared(
            'runner.maintainers.presenter',
            function (ServiceContainer $c) {
                return new PresenterMaintainer(
                    $c->get('formatter.presenter')
                );
            }
        );

        // Bootstrap listener to setup Laravel application for specs

        $container->setShared(
            'event_dispatcher.listeners.laravel',
            function (ServiceContainer $c) {
                return new LaravelListener($c->get('laravel'));
            }
        );
    }
}
