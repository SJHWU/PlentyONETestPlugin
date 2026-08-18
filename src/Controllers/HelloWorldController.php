<?php

namespace PlentyONETestPlugin\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;

class HelloWorldController extends Controller
{
    public function getHelloWorldPage(Twig $twig): string
    {
        return $twig->render('PlentyONETestPlugin::Index');
    }
}
