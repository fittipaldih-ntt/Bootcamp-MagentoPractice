<?php

namespace Nttdata\Practice\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory;

class OrderField implements ArrayInterface
{
    private $attributeFactory;

    public function __construct(
        CollectionFactory $attributeFactory
    )
    {
        $this->attributeFactory = $attributeFactory;
    }

    public function toOptionArray()
    {
        $attributesProducts = $this->getAllAttributesByProducts();

        $rt = [];
        foreach ($attributesProducts as $attribute) {
            $rt[] = [
                'value' => $attribute->getAttributeCode(),
                'label' => $attribute->getStoreLabel()
            ];
        }
        return $rt;
    }

    public function getAllAttributesByProducts()
    {
        return $this->attributeFactory->create()->getItems();
    }
}
