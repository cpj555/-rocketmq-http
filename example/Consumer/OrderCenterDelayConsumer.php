<?php

declare(strict_types=1);

namespace Example\Consumer;

use Example\Consumer\MessageData\OrderCloseData;
use Example\Consumer\MessageData\OrderSubmitData;
use Losingbattle\RocketMqHttp\Annotation\Consumer;
use Losingbattle\RocketMqHttp\Message\ConsumerMessage;
use Losingbattle\RocketMqHttp\Result;

/**
 * @Consumer(groupId="GID_order_center_consumer", topic="order_delay_topic", numOfMessages=16, waitSeconds=30)
 */
class OrderCenterDelayConsumer extends ConsumerMessage
{
    public function __construct()
    {
        $this->registerRoute('order_submit', [$this, 'orderSubmit']);
        $this->registerRoute('order_close', [$this, 'orderClose']);
    }

    public function isEnable(): bool
    {
        return false;
    }

    public function orderSubmit(OrderSubmitData $orderSubmitData): string
    {
        return Result::ACK;
    }

    public function orderClose(OrderCloseData  $orderCloseData): string
    {
        return Result::ACK;
    }
}
