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
                'label' => __('Please select')
            ],
            [
                'value' => 'Permanent',
                'label' => __('Permanent')
            ],
            [
                'value' => 'Contract',
                'label' => __('Contract')
            ],
            [
                'value' => 'External',
                'label' => __('External')
            ],
        ];

        return $options;
    }

}
