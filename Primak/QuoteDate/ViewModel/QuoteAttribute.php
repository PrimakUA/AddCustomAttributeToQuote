<?php

declare(strict_types=1);

namespace Primak\QuoteDate\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Checkout\Model\SessionFactory;
use Magento\Quote\Api\CartRepositoryInterface;

/**
 * class QuoteAttribute
 */
class QuoteAttribute implements ArgumentInterface
{
    /**
     * @var SessionFactory
     */
    protected SessionFactory $checkoutSessionFactory;

    /**
     * @var CartRepositoryInterface
     */
    protected CartRepositoryInterface $quoteRepository;

    /**
     * @param SessionFactory $checkoutSessionFactory
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        SessionFactory $checkoutSessionFactory,
        CartRepositoryInterface $quoteRepository

    ){
        $this->checkoutSessionFactory = $checkoutSessionFactory;
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @return object
     */
    protected function currentQuote(): object
    {
        return $this->checkoutSessionFactory->create()->getQuote();
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getQuoteAttribute(): string
    {
        return $this->quoteRepository->get($this->currentQuote()->getEntityId())->getExtensionAttributes()->getFirstAddTime();
    }
}
