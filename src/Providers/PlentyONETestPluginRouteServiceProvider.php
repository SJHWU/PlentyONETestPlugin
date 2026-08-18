<?php

namespace PlentyONETestPlugin\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;
use PlentyONETestPlugin\Controllers\HelloWorldController;
use PlentyONETestPlugin\Controllers\OrderTestController;

/**
 * Class PlentyONETestPluginRouteServiceProvider
 * @package PlentyONETestPlugin\Providers
 */
class PlentyONETestPluginRouteServiceProvider extends RouteServiceProvider
{
    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->get('hello-world', HelloWorldController::class . '@getHelloWorldPage');
        $router->get('debug/order-test', OrderTestController::class . '@test');
    }
}
