<?php

namespace Primak\QuoteDate\Plugin;

use Magento\Framework\Exception\LocalizedException;
use Primak\QuoteDate\Model\Management;
use Magento\Checkout\Model\Cart\CartInterface;

/**
 * class AddProductPlugin
 */
class AddProductPlugin
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
     * @param CartInterface $subject
     * @return void
     * @throws LocalizedException
     */
    public function afterSave(CartInterface $subject)
    {
        try {
            $quoteId = $subject->getQuote()->getEntityId();
            $addTimeFromDatabase = $this->management->getByQuoteAttributeId($quoteId)->getFirstAddTime();
            if (!$addTimeFromDatabase)
            {
                $this->management->saveQuoteId($quoteId);
            }
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
    }
}
