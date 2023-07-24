<?php

namespace Nttdata\Practice\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class EnableDisable implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => 'Enable'],
            ['value' => 0, 'label' => 'Disable']
        ];
    }
}

