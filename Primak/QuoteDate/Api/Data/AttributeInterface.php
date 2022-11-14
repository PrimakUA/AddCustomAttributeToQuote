<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Api\Data;

/**
 * @api
 */
interface AttributeInterface
{
    /**
     * @return int
     */
    public function getQuoteAttributeId(): int;

    /**
     * @return int
     */
    public function getOrderAttributeId(): int;

    /**
     * @return string
     */
    public function getFirstAddTime(): string;
}
