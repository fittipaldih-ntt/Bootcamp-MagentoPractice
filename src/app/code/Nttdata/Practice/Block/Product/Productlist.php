<?php

namespace Nttdata\Practice\Block\Product;

class Productlist extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ){
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    public function getProductCollectionByNameOrderDesc()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(10);
        $collection->setOrder('name', 'desc');
        return $collection;
    }
}
