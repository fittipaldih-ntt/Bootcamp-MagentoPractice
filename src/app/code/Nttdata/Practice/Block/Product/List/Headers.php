<?php
namespace Nttdata\Practice\Block\Product\List;
class Headers extends \Nttdata\Practice\Block\Product\Productlist
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory)
    {
        parent::__construct($context, $productCollectionFactory);
    }
}
