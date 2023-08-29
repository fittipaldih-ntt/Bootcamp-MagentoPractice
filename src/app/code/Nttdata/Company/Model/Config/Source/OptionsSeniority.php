<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsSeniority implements OptionSourceInterface
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
                'value' => 'Trainee',
                'label' => 'Trainee'
            ],
            [
                'value' => 'Junior',
                'label' => 'Junior'
            ],
            [
                'value' => 'Semisenior',
                'label' => 'Semi-senior'
            ],
            [
                'value' => 'Senior',
                'label' => 'Senior'
            ],
        ];
            
        return $options;
    }
    
}
