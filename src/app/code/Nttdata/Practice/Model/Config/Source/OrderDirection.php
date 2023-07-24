<?php
namespace Nttdata\Practice\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class OrderDirection implements ArrayInterface
{
    public function toOptionArray()
    {
        return[
            ['value' => 'asc', 'label' => 'ASC'],
            ['value' => 'desc', 'label' => 'DESC']
        ];
    }
}
