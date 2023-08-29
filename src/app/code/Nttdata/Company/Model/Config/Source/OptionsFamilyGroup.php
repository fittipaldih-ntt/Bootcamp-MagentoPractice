<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsFamilyGroup implements OptionSourceInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => '',
                'label' => 'Please Select'
            ],
            [
                'value' => 'Soltero',
                'label' => 'Soltero'
            ],
            [
                'value' => 'Casado',
                'label' => 'Casado'
            ],
        ];
            
        return $options;
    }
    
}
