<?php

namespace PlentyONETestPlugin\Services;

use Plenty\Modules\Authorization\Services\AuthHelper;
use Plenty\Modules\Comment\Contracts\CommentRepositoryContract;
use Plenty\Modules\Comment\Models\Comment;
use Plenty\Modules\Order\Contracts\OrderRepositoryContract;

class OrderCommentTestService
{
    public function __construct(
        private OrderRepositoryContract $orderRepository,
        private CommentRepositoryContract $commentRepository,
        private AuthHelper $authHelper,
    ) {
    }

    public function run(int $orderId): string
    {
        return $this->authHelper->processUnguarded(function () use ($orderId) {
            $order = $this->orderRepository->findOrderById($orderId);

            $this->commentRepository->createComment([
                'referenceType' => Comment::REFERENCE_TYPE_ORDER,
                'referenceValue' => $order->id,
                'text' => 'OrderCommentTestService ran at ' . date('Y-m-d H:i:s'),
                'isVisibleForContact' => false,
                'userId' => 2,
            ]);

            return "OK: order {$order->id} found, comment created";
        });
    }
}
