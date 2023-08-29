<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsStudies implements OptionSourceInterface
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
                'value' => 'Secundario',
                'label' => 'Secundario'
            ],
            [
                'value' => 'Terciario',
                'label' => 'Terciario'
            ],
            [
                'value' => 'Universitario',
                'label' => 'Universitario'
            ],
            [
                'value' => 'Autodidacta',
                'label' => 'Autodidacta'
            ],
        ];
            
        return $options;
    }
    
}
