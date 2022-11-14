<?php

declare(strict_types=1);

namespace Primak\QuoteDate\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Primak\QuoteDate\ViewModel\QuoteAttribute;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CheckoutConfigProvider
 */
class CheckoutConfigProvider implements ConfigProviderInterface
{
    /**
     * @var QuoteAttribute
     */
    protected QuoteAttribute $quoteDate;

    /**
     * @param QuoteAttribute $quoteDate
     */
    public function __construct(
        QuoteAttribute $quoteDate
    )
    {
        $this->quoteDate = $quoteDate;
    }

    /**
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getConfig()
    {
        if ($this->quoteDate->getQuoteAttribute())
        {
            return [
                'addingtime' => 'First item add time is - ' . $this->quoteDate->getQuoteAttribute(),
            ];
        }
        return [
            'addingtime' => '',
        ];

    }
}
