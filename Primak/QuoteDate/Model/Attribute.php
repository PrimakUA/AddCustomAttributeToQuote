<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Model;

use Magento\Framework\Model\AbstractModel;
use Primak\QuoteDate\Api\Data\AttributeInterface;

/**
 * class Attribute
 */
class Attribute extends AbstractModel implements AttributeInterface
{

    public const QUOTE_ATTRIBUTE_ID = 'quote_attribute_id';

    public const ORDER_ATTRIBUTE_ID = 'order_attribute_id';

    public const FIRST_ADD_TIME = 'first_add_time';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(AttributeResource::class);
    }

    /**
     * @return int
     */
    public function getQuoteAttributeId(): int
    {
        return (int) $this->getData(self::QUOTE_ATTRIBUTE_ID);
    }

    /**
     * @return int
     */
    public function getOrderAttributeId(): int
    {
        return (int) $this->getData(self::ORDER_ATTRIBUTE_ID);
    }

    /**
     * @return string
     */
    public function getFirstAddTime(): string
    {
        return (string) $this->getData(self::FIRST_ADD_TIME);
    }
}
