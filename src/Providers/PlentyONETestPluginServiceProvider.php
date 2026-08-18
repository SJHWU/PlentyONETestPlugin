<?php

namespace PlentyONETestPlugin\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Cron\Services\CronContainer;
use PlentyONETestPlugin\CronHandlers\TestCronHandler;

/**
 * Class PlentyONETestPluginServiceProvider
 * @package PlentyONETestPlugin\Providers
 */
class PlentyONETestPluginServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->getApplication()->register(PlentyONETestPluginRouteServiceProvider::class);
    }

    public function boot(CronContainer $cronContainer)
    {
        // Cron-Handler zum CronContainer hinzufügen
        $cronContainer->add(
            CronContainer::EVERY_FIVE_MINUTES, // Intervall
            TestCronHandler::class            // Klasse, die ausgeführt wird
        );
    }
}
