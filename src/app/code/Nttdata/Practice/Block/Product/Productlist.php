<?php

namespace Nttdata\Practice\Block\Product;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Nttdata\Practice\Helper\Data;

class Productlist extends \Magento\Framework\View\Element\Template
{
    protected $productCollectionFactory;
    public $helper;

    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        Data $helper
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function getCollection()
    {
        $isEnabled = $this->helper->getEnabled();

        if (!$isEnabled) {
            echo '<h2>La configuración está apagada</h2>';;
            return null;
        }

        $limit = $this->helper->getLimit();
        $orderField = $this->helper->getOrderField();
        $orderDirection = $this->helper->getOrderDirection();

        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize($limit);
        $collection->setOrder($orderField, $orderDirection);

        return $collection;
    }

}
