<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Model;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * class AttributeCollection
 */
class AttributeCollection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Attribute::class, AttributeResource::class);
    }
}
