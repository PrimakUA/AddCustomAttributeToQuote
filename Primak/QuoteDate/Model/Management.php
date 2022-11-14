<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Model;

use Primak\QuoteDate\Api\Data\AttributeInterface;
use Primak\QuoteDate\Api\ManagementInterface;
use Primak\QuoteDate\Model\AttributeFactory;
use Primak\QuoteDate\Model\AttributeResource;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * class Management
 */
class Management implements ManagementInterface
{
    /**
     * @var AttributeResource
     */
    private AttributeResource $resource;

    /**
     * @var AttributeFactory
     */
    private AttributeFactory $factory;

    /**
     * @var DateTime
     */
    protected DateTime $date;

    /**
     * Management constructor.
     * @param \Primak\QuoteDate\Model\AttributeResource $resource
     * @param AttributeFactory $attributesFactory
     * @param DateTime $date
     */
    public function __construct(
        AttributeResource $resource,
        AttributeFactory  $attributesFactory,
        DateTime          $date
    )
    {
        $this->resource = $resource;
        $this->factory = $attributesFactory;
        $this->date = $date;
    }

    /**
     * @param int $quoteId
     * @return AttributeInterface
     */
    public function getByQuoteAttributeId(int $quoteId): AttributeInterface
    {
        $object = $this->getNewInstance();
        $this->resource->load($object, $quoteId, 'quote_attribute_id');

        return $object;
    }

    /**
     * @param int $orderId
     * @return AttributeInterface
     */
    public function getByOrderAttributeId(int $orderId): AttributeInterface
    {
        $object = $this->getNewInstance();
        $this->resource->load($object, $orderId, 'order_attribute_id');

        return $object;
    }

    /**
     * @return AttributeInterface
     */
    public function getNewInstance(): AttributeInterface
    {
        return $this->factory->create();
    }

    /**
     * @param $quoteId
     * @return void
     */
    public function saveQuoteId($quoteId)
    {
        $data[] = ['quote_attribute_id' => (int)$quoteId, 'first_add_time' => (string)$this->date->gmtDate()];

        $this->resource->getConnection()->insertMultiple($this->resource->getTable('primak_quote_attribute'), $data);
    }

    /**
     * @param $orderId
     * @param $quoteId
     * @return void
     */
    public function saveOrderId($orderId, $quoteId)
    {
        $data = ['order_attribute_id' => (int)$orderId];

        $this->resource->getConnection()->update($this->resource->getTable('primak_quote_attribute'), $data, ['quote_attribute_id = ?' => $quoteId]);
    }
}
