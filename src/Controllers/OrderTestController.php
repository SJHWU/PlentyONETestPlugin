<?php

namespace PlentyONETestPlugin\Controllers;

use Plenty\Exceptions\ValidationException;
use Plenty\Plugin\Controller;
use PlentyONETestPlugin\Services\OrderCommentTestService;

class OrderTestController extends Controller
{
    public function test(OrderCommentTestService $tester): string
    {
        try {
            return $tester->run(150);
        } catch (ValidationException $exception) {
            return 'ValidationException: ' . json_encode($exception->getMessageBag()->toArray());
        } catch (\Throwable $exception) {
            return 'Error: ' . $exception->getMessage();
        }
    }
}
