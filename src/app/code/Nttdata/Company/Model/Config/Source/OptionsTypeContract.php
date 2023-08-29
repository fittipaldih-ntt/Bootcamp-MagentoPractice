<?php

namespace Nttdata\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OptionsTypeContract implements OptionSourceInterface
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
                'value' => 'Permanente',
                'label' => 'Permanente'
            ],
            [
                'value' => 'Contrato',
                'label' => 'Contrato'
            ],
            [
                'value' => 'Externo',
                'label' => 'Externo'
            ],
        ];
            
        return $options;
    }
    
}
