<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsWorkTime implements OptionSourceInterface
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
                'value' => 'Parttime',
                'label' => 'Part-time'
            ],
            [
                'value' => 'Fulltime',
                'label' => 'Full-time'
            ],
            [
                'value' => 'Freelance',
                'label' => 'Freelance'
            ],
        ];
            
        return $options;
    }
    
}
