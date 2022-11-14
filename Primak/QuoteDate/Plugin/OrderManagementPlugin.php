<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Plugin;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderManagementInterface;
use Primak\QuoteDate\Model\Management;

/**
 * Class OrderManagementPlugin
 */
class OrderManagementPlugin
{
    /**
     * @var Management
     */
    protected Management $management;

    /**
     * @param Management $management
     */
    public function __construct(
        Management $management
    )
    {
        $this->management = $management;
    }

    /**
     * @param OrderManagementInterface $subject
     * @param OrderInterface $order
     *
     * @return object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterPlace(
        OrderManagementInterface $subject,
        OrderInterface $order
    ): object {
        $quoteId = $order->getQuoteId();
        if ($quoteId) {
            $this->management->saveOrderId($order->getEntityId(), $quoteId);
        }
        return $order;
    }
}
