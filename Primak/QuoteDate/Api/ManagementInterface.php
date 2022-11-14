<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Api;

use Primak\QuoteDate\Api\Data\AttributeInterface;

/**
 * @api
 */
interface ManagementInterface
{

    /**
     * @param int $quoteId
     * @return AttributeInterface
     */
    public function getByQuoteAttributeId(int $quoteId): AttributeInterface;

    /**
     * @param int $orderId
     * @return AttributeInterface
     */
    public function getByOrderAttributeId(int $orderId): AttributeInterface;
}
