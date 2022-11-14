<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Plugin;

use Primak\QuoteDate\Api\ManagementInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\Data\CartSearchResultsInterface;
use Magento\Quote\Api\CartRepositoryInterface;

/**
 * Class CartRepositoryPlugin
 */
class CartRepositoryPlugin
{
    /**
     * @var ManagementInterface
     */
    private ManagementInterface $management;

    /**
     * CartRepositoryPlugin constructor.
     * @param ManagementInterface $management
     */
    public function __construct(
        ManagementInterface $management
    ) {
        $this->management = $management;
    }

    /**
     * @param CartRepositoryInterface $subject
     * @param CartSearchResultsInterface $quoteSearchResult
     * @return CartSearchResultsInterface
     */
    public function afterGetList(
        CartRepositoryInterface $subject,
        CartSearchResultsInterface $quoteSearchResult
    ): CartSearchResultsInterface {
        foreach ($quoteSearchResult->getItems() as $quote) {
            $this->afterGet($subject, $quote);
        }
        return $quoteSearchResult;
    }

    /**
     * @param CartRepositoryInterface $subject
     * @param CartInterface $quote
     * @return CartInterface
     */
    public function afterGet(
        CartRepositoryInterface $subject,
        CartInterface $quote
    ): CartInterface {
        $quoteAttribute = $this->management->getByQuoteAttributeId((int) $quote->getEntityId());
        $extensionAttributes = $quote->getExtensionAttributes();
        $extensionAttributes->setFirstAddTime($quoteAttribute->getFirstAddTime());
        $quote->setExtensionAttributes($extensionAttributes);

        return $quote;
    }
}
