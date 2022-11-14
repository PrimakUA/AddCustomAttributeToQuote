<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Plugin;

use Primak\QuoteDate\Api\ManagementInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

/**
 * Class OrderRepositoryPlugin
 */
class OrderRepositoryPlugin
{
    /**
     * @var ManagementInterface
     */
    private ManagementInterface $management;

    /**
     * ShipmentRepositoryPlugin constructor.
     * @param ManagementInterface $management
     */
    public function __construct(
        ManagementInterface $management
    ) {
        $this->management = $management;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $orderSearchResult
     * @return OrderSearchResultInterface
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        OrderSearchResultInterface $orderSearchResult
    ): OrderSearchResultInterface {
        foreach ($orderSearchResult->getItems() as $order) {
            $this->afterGet($subject, $order);
        }
        return $orderSearchResult;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $order
    ): OrderInterface {
        $orderAttribute = $this->management->getByOrderAttributeId((int) $order->getEntityId());

        $extensionAttributes = $order->getExtensionAttributes();
        $extensionAttributes->setFirstAddTime($orderAttribute->getFirstAddTime());

        $order->setExtensionAttributes($extensionAttributes);

        return $order;
    }
}
