<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Catalog\Model\Product;


/**
 * Price model for external catalogs
 */
class CatalogPrice implements CatalogPriceInterface
{
    /**
     * @var CatalogPriceFactory
     */
    protected $priceModelFactory;

    /**
     * @var array catalog price models for different product types
     */
    protected $priceModelPool;

    /**
     *
     * @param CatalogPriceFactory $priceModelFactory
     * @param array $priceModelPool
     */
    public function __construct(CatalogPriceFactory $priceModelFactory, array $priceModelPool)
    {
        $this->priceModelFactory = $priceModelFactory;
        $this->priceModelPool = $priceModelPool;
    }

    /**
     * Minimal price for "regular" user
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param null|\Magento\Store\Model\Store $store Store view
     * @param bool $inclTax
     * @throws \UnexpectedValueException
     * @return null|float
     */
    public function getCatalogPrice(\Magento\Catalog\Model\Product $product, $store = null, $inclTax = false)
    {
        if (array_key_exists($product->getTypeId(), $this->priceModelPool)) {
            $catalogPriceModel = $this->priceModelFactory->create($this->priceModelPool[$product->getTypeId()]);
            return $catalogPriceModel->getCatalogPrice($product, $store, $inclTax);
        }

        return $product->getFinalPrice();
    }

    /**
     * Regular catalog price
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return float
     * @throws \UnexpectedValueException
     */
    public function getCatalogRegularPrice(\Magento\Catalog\Model\Product $product)
    {
        if (array_key_exists($product->getTypeId(), $this->priceModelPool)) {
            $catalogPriceModel = $this->priceModelFactory->create($this->priceModelPool[$product->getTypeId()]);
            return $catalogPriceModel->getCatalogRegularPrice($product);
        }

        return $product->getPrice();
    }
}
