<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Model;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * class AttributeResource
 */
class AttributeResource extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('primak_quote_attribute', 'entity_id');
    }
}
