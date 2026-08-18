<?php

namespace PlentyONETestPlugin\CronHandlers;

use Plenty\Exceptions\ValidationException;
use Plenty\Modules\Cron\Contracts\CronHandler;
use Plenty\Plugin\Log\Loggable;
use PlentyONETestPlugin\Services\OrderCommentTestService;

class TestCronHandler extends CronHandler
{
    use Loggable;

    private const TEST_ORDER_ID = 150;

    public function __construct(
        private OrderCommentTestService $tester,
    ) {
    }

    /** handle() ist die Methode, die PlentyONE auf einem Cron-Handler aufruft - ohne Parameter. */
    public function handle(): void
    {
        try {
            $this->getLogger(__CLASS__)->report(
                'PlentyONETestPlugin::log.cronHandlerRan',
                ['message' => 'Cron handler ran', 'time' => date('Y-m-d H:i:s')]
            );

            $result = $this->tester->run(self::TEST_ORDER_ID);

            $this->getLogger(__CLASS__)->report(
                'PlentyONETestPlugin::log.cronHandlerResult',
                ['message' => $result]
            );
        } catch (ValidationException $exception) {
            $this->getLogger(__CLASS__)->error(
                'PlentyONETestPlugin::log.cronHandlerValidationError',
                [
                    'message' => $exception->getMessage(),
                    'validationErrors' => $exception->getMessageBag()->toArray(),
                ]
            );
        } catch (\Throwable $exception) {
            $this->getLogger(__CLASS__)->error(
                'PlentyONETestPlugin::log.cronHandlerError',
                ['message' => $exception->getMessage()]
            );
        }
    }
}
