<?php

namespace Nttdata\Practice\Block\Product\List;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Nttdata\Practice\Helper\Data;

class Headers extends \Nttdata\Practice\Block\Product\Productlist
{
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        Data $helper
    ) {
        parent::__construct($context, $productCollectionFactory, $helper);
    }
}
